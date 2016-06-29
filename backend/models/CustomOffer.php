<?php

namespace backend\models;

use common\models\CustomOffer as CommonCustomOffer;
use Yii;

class CustomOffer extends CommonCustomOffer
{

    public function attributeLabels()
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'destination' => 'Destination',
            'departureDate' => 'Departure Date',
            'duration' => '# of days',
            'description' => 'Description',
        ];
    }
}
