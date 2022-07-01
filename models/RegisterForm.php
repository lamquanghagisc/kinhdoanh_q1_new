<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07-Mar-19
 * Time: 9:22 AM
 */

namespace app\models;

use app\modules\cms\models\AuthUser;
use app\modules\cms\services\AuthUserService;
use app\modules\contrib\helper\DateHelper;
use Yii;
use yii\base\Model;

class RegisterForm extends Model {

    public $username;
    public $email;
    public $password;
    public $cpassword;
    public $fullname;

    public function rules() {
        return [
            [['username', 'password', 'email', 'cpassword', 'fullname'], 'required', 'message' => '{attribute} can not be blank'],
            [['password', 'cpassword'], 'string', 'min' => 6, 'max' => 15, 'tooLong' => '{attribute} must contain at most 15 characters', 'tooShort' => '{attribute} must contain at least 6 characters'],
            [['cpassword'], 'compare', 'compareAttribute' => 'password', 'message' => AuthUserService::$RESPONSES['PASSWORD_MATCH']],
            ['email', 'email', 'message' => AuthUserService::$RESPONSES['EMAIL_FORMAT']],
            ['username', 'validateUsername'],
            ['email', 'validateEmail'],
        ];
    }

    public function validateEmail($attribute, $params) {
        if (AuthUserService::CheckEmailExist($this->email)) {
            $this->addError($attribute, AuthUserService::$RESPONSES['EMAIL_EXIST']);
        }
    }

    public function validateUsername($attribute, $params) {
        if (AuthUserService::CheckUsernameExist($this->username)) {
            $this->addError($attribute, AuthUserService::$RESPONSES['USERNAME_EXIST']);
        }
    }

    public function register() {
        if ($this->validate()) {
            $authUser = new AuthUser([
                'username' => $this->username,
                'email' => $this->email,
                'fullname' => $this->fullname,
                'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password),
                'status' => AuthUserService::$USER_STATUS['ACTIVE'],
                'active' => AuthUserService::$USER_ACTIVE['ACTIVE'],
                'confirmed' => AuthUserService::$USER_CONFIRM['UNCONFIRMED'],
                'created_at' => DateHelper::now(),
                         ]);

            $authUser->generateAuthKey();
            $authUser->generateAccessToken();

            if ($authUser->save()) {
//                $userInfo = new AuthUserInfo([
//                    'auth_user_id' => $authUser->id
//                ]);
//                $userInfo->save();
//                SiteService::WriteLog($authUser->id, SiteService::$ACTIVITIES['REGISTER']);

                return true;
            }
        }
        return false;
    }

    public function attributeLabels() {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'cpassword' => Yii::t('app', 'Confirm password'),
            'fullname' => Yii::t('app', 'Fullname')
        ];
    }

}
