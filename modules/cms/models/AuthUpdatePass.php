<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\web\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AuthUpdatePass extends Model {

    public $newpassword;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['newpassword'], 'required', 'message' => 'Dữ liệu bắt buộc'],
            [['newpassword'], 'string', 'min' => 6],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function change() {
        if ($this->validate()) {
            if ($this->validatePassword($this->password)) {
                $this->addError($this->password, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function updatePassword($user) {
        // dd($user->validatePassword($this->password));

        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->newpassword);
        if ($user->save()) {
            return true;
        }
        return FALSE;
    }

    public function attributeLabels() {
        return [
            'newpassword' => 'Mật khẩu mới',
        ];
    }

}
