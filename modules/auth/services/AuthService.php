<?php

namespace app\modules\auth\services;

use app\models\LoginForm;
use app\modules\auth\models\AuthAction;
use app\modules\Constant;
use app\modules\auth\models\AuthAssignment;
use app\modules\auth\models\AuthGroup;
use app\modules\auth\models\AuthRole;
use app\modules\auth\models\UserRefreshToken;
use app\modules\cms\models\AuthUser;
use Lcobucci\JWT\Token;
use Yii;
use yii\helpers\Url;

class AuthService
{


    /**
     * Check access
     *
     * @param int $userId
     * @param string $actionId
     * @return boolean
     */
    public static function can($userId, $actionKey)
    {
        $count  = AuthAssignment::find()
            ->joinWith(['group' => function ($q) {
                $q->joinWith(['roles' => function ($q2) {
                    $q2->joinWith(['actions a']);
                }]);
            }])
            ->where(['a.name' => $actionKey, 'user_id' => $userId])->count();

        return $count > 0;
    }

    /**
     * Check user has group
     *
     * @param int $userId
     * @param int $groupId
     * @return boolean
     */
    public static function hasGroup($userId, $groupId)
    {
        return AuthAssignment::find()
            ->joinWith(['group'])
            ->where(['auth_group.id' => $groupId, 'user_id' => $userId])
            ->exists();
    }


    /**
     * Assign 
     *
     * @param int $userId
     * @param int[] $groupIds
     * @return void
     */
    public static function assign($userId, $groupIds)
    {
        $result = true;

        AuthAssignment::deleteAll(['user_id' => $userId]);

        foreach ($groupIds as $groupId) {

            $model = new AuthAssignment();
            //
            $model->group_id = $groupId;
            $model->user_id = $userId;
            $result = $result && $model->save();
        }

        return $result;
    }

    /**
     * Login REST
     *
     * @param LoginForm $model
     * @param array $formData
     * @return Token|null
     */
    public static function loginREST($model, $formData)
    {
        if ($model->load($formData, '') && $model->login()) {
            $user = Yii::$app->user->identity;

            $token = static::generateJwt($user);

            static::generateRefreshToken($user);
            return $token;
        }

        return null;
    }

    /**
     * Login from
     *
     * @param Token $token
     * @return AuthUser|null
     */
    public static function loginFromToken($token)
    {
        $userId = $token->getClaim('uid');
        $userIP = $token->getClaim('ip');
        $userAgent = $token->getClaim('user_agent');
        if ($userIP != Yii::$app->request->userIP || $userAgent != Yii::$app->request->userAgent) {
            return null;
        }
        $identity = AuthUser::findOne(['id' => $userId]);
        if ($identity) {
            return $identity;
        }
        return null;
    }

    /**
     * Refresh token
     *
     * @param UserRefreshToken $userRefreshToken
     * @return string
     */
    public static function refreshToken($userRefreshToken)
    {
        // Getting new JWT after it has expired
        if (!$userRefreshToken) {
            return new \yii\web\UnauthorizedHttpException('The refresh token no longer exists.');
        }

        $user = AuthUser::find()  //adapt this to your needs
            ->where(['id' => $userRefreshToken->user_id])
            ->andWhere(['status' => Constant::STATUS_ACTIVE])
            ->one();
        if (!$user) {
            $userRefreshToken->delete();
            return new \yii\web\UnauthorizedHttpException('The user is inactive.');
        }

        $token = static::generateJwt($user);
        return $token;
    }

    /**
     * Get all groups
     *
     * @return AuthGroup[]
     */
    public static function getAllGroups()
    {
        return AuthGroup::find()->asArray()->all();
    }

    /**
     * Get groups by user id
     *
     * @param int $userId
     * @return AuthGroup[]
     */
    public static function getGroupsByUserId($userId)
    {
        return AuthGroup::find()->joinWith('assignments', false)->where(['user_id' => $userId])->asArray()->all();
    }

    /**
     * Get roles by user id
     *
     * @param int $userId
     * @return AuthRole[]
     */
    public static function getRolesByUserId($userId)
    {
        $groupIds = AuthGroup::find()->joinWith('assignments', false)
            ->where(['user_id' => $userId])
            ->select('auth_group.id');

        return AuthRole::find()
            ->joinWith('groupRoles', false)
            ->where(['group_id' => $groupIds])
            ->asArray()
            ->all();
    }

    /**
     * Get data by user id
     *
     * @param int $userId
     * @return AuthData[]
     */
    public static function getDataByUserId($userId)
    {
        //TODO chưa implement
        return [];
    }

    /**
     * Get actions by user id
     *
     * @param int $userId
     * @return AuthAction[]
     */
    public static function getActionsByUserId($userId)
    {
        $groupIds = AuthGroup::find()->joinWith('assignments', false)
            ->where(['user_id' => $userId])
            ->select('auth_group.id');

        $roleIds =  AuthRole::find()
            ->joinWith('groupRoles', false)
            ->where(['group_id' => $groupIds])
            ->select('auth_role.id');

        return AuthAction::find()
            ->joinWith('roleActions', false)
            ->where(['role_id' => $roleIds])
            ->asArray()
            ->all();
    }

    /**
     * Get userId from request
     *
     * @return int|null
     */
    public static function getUserIdFromRequest()
    {
        $authHeader = Yii::$app->request->getHeaders()->get('Authorization');
        $schema = "Bearer";
        if ($authHeader !== null && preg_match('/^' . $schema . '\s+(.*?)$/', $authHeader, $matches)) {
            $token = Yii::$app->jwt->loadToken($matches[1]);
            return $token->getClaim('uid');
        }

        return null;
    }


    private static function generateJwt($user)
    {
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();

        $jwtParams = Yii::$app->params['jwt'];

        return $jwt->getBuilder()
            ->issuedBy($jwtParams['issuer'])
            ->permittedFor($jwtParams['audience'])
            ->identifiedBy($jwtParams['id'], true)
            ->issuedAt($time)
            ->expiresAt($time + $jwtParams['expire'])
            ->withClaim('uid', $user->id)
            ->withClaim('ip', Yii::$app->request->userIP)
            ->withClaim('user_agent', Yii::$app->request->userAgent)
            ->getToken($signer, $key);
    }

    /**
     * @throws yii\base\Exception
     */
    private static function generateRefreshToken($user)
    {
        $refreshToken = Yii::$app->security->generateRandomString(200);

        // TODO: Don't always regenerate - you could reuse existing one if user already has one with same IP and user agent
        $userRefreshToken = new UserRefreshToken([
            'user_id' => $user->id,
            'token' => $refreshToken,
            'ip' => Yii::$app->request->userIP,
            'user_agent' => Yii::$app->request->userAgent,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if (!$userRefreshToken->save()) {
            throw new \yii\web\ServerErrorHttpException('Failed to save the refresh token. ' . json_encode($userRefreshToken->errors));
        }

        // Send the refresh-token to the user in a HttpOnly cookie that Javascript can never read and that's limited by path
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'refresh-token',
            'value' => $refreshToken,
        ]));

        return $userRefreshToken;
    }
}
