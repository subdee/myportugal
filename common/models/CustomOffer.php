<?php

namespace common\models;

use Yii;
use yii\mongodb\ActiveRecord;

class CustomOffer extends ActiveRecord
{

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'customOffers';
    }

    public function attributes()
    {
        return [
            '_id',
            'firstName',
            'lastName',
            'email',
            'destination',
            'departureDate',
            'duration',
            'description',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'firstName',
                    'lastName',
                    'email',
                    'destination',
                    'departureDate',
                    'duration',
                    'description',
                ],
                'required'
            ],
            ['email', 'trim'],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => Yii::t('app/forms', 'First Name'),
            'lastName' => Yii::t('app/forms', 'Last Name'),
            'email' => Yii::t('app/forms', 'Email'),
            'destination' => Yii::t('app/forms', 'Destination'),
            'departureDate' => Yii::t('app/forms', 'Departure Date'),
            'duration' => Yii::t('app/forms', '# of days'),
            'description' => Yii::t('app/forms', 'Describe your request'),
        ];
    }
}
