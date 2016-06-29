<?php

namespace frontend\models;

use common\models\Booking;
use common\models\Offer;
use common\models\User;
use Yii;
use yii\base\Model;

class BookingForm extends Model
{
    public $adults;
    public $children;
    public $remarks;
    public $firstName;
    public $lastName;
    public $email;
    public $email2;
    public $password;
    public $password2;
    public $mobile;
    public $phone;
    public $newsletter;
    public $termsAndConditions;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'adults',
                    'children',
                    'firstName',
                    'lastName',
                    'email',
                    'email2',
                    'password',
                    'password2',
                    'phone',
                    'termsAndConditions'
                ],
                'required'
            ],
            ['email', 'trim'],
            ['email', 'email'],
            ['email2', 'compare', 'compareAttribute' => 'email'],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('app', 'This email address has already been taken.')
            ],
            ['password2', 'compare', 'compareAttribute' => 'password'],
            [
                'termsAndConditions',
                'compare',
                'compareValue' => true,
                'message' => Yii::t('app/forms', 'You must agree to the terms and conditions')
            ],
            [['mobile', 'newsletter', 'remarks'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'adults' => Yii::t('app/forms', '# of adults'),
            'children' => Yii::t('app/forms', '# of children'),
            'remarks' => Yii::t('app/forms', 'Extra remarks regarding your booking'),
            'firstName' => Yii::t('app/forms', 'First Name'),
            'lastName' => Yii::t('app/forms', 'Last Name'),
            'email' => Yii::t('app/forms', 'Email'),
            'email2' => Yii::t('app/forms', 'Verify email'),
            'password' => Yii::t('app/forms', 'Password'),
            'password2' => Yii::t('app/forms', 'Repeat your password'),
            'phone' => Yii::t('app/forms', 'Phone number'),
            'mobile' => Yii::t('app/forms', 'Mobile number'),
            'newsletter' => Yii::t('app/forms', 'I want to receive promotional offers in the future'),
            'termsAndConditions' => Yii::t('app/forms', 'I want to receive promotional offers in the future'),
        ];
    }

    public function save(Offer $offer)
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $user = new User();
            $user->username = $this->email;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
        }
        $user->newsletter = $this->newsletter;
        $user->save();

        $booking = new Booking();
        $booking->offer = $offer;
        $booking->userId = $user->id;
        $booking->firstName = $this->firstName;
        $booking->lastName = $this->lastName;
        $booking->phone = $this->phone;
        $booking->mobile = $this->mobile;
        $booking->adults = $this->adults;
        $booking->children = $this->children;
        $booking->remarks = $this->remarks;

        return $booking->save();
    }
}
