<?php
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Login form
 */
class LoginForm extends \common\models\LoginForm
{
    public $username;
    public $password;
    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['username', 'validateRole'],
        ]);
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validateRole($attribute)
    {
        if ( ! $this->hasErrors()) {
            $user = $this->getUser();
            if ( ! $user || ! $user->validateRole()) {
                $this->addError($attribute, 'You don\'t have access here.');
            }
        }
    }
}
