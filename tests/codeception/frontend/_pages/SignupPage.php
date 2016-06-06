<?php

namespace tests\codeception\frontend\_pages;

use frontend\models\SignupForm;
use tests\codeception\frontend\AcceptanceTester;
use yii\codeception\BasePage;

/**
 * Represents signup page
 * @property AcceptanceTester $actor
 */
class SignupPage extends BasePage
{

    public $route = 'user/signup';

    /**
     * @param array $signupData
     */
    public function submit(array $signupData)
    {
        $signupForm = new SignupForm;

        foreach ($signupData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="' . $signupForm->formName() . '[' . $field . ']"]', $value);
        }
        $this->actor->click('signup-button');
    }
}
