<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii2tech\embedded\mongodb\ActiveRecord;

class Booking extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'bookings';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'flightData',
            'hotelData',
            'price',
            'description',
            'photo',
            'active',
            'created_on',
            'updated_on'
        ];
    }

    public function rules()
    {
        return [
            [['title', 'price', 'description'], 'required'],
            [['flightData', 'hotelData'], 'yii2tech\embedded\Validator'],
            ['active', 'default', 'value' => false],
            [
                'created_on',
                'default',
                'value' => time(),
                'when' => function ($model) {
                    return $model->isNewRecord;
                }
            ],
            ['updated_on', 'default', 'value' => time()]
        ];
    }

    public function embedFlight()
    {
        return $this->mapEmbedded('flightData', Flight::className());
    }

    public function embedHotel()
    {
        return $this->mapEmbedded('hotelData', Hotel::className());
    }

    public static function getAll()
    {
        $provider = new ActiveDataProvider([
            'query' => static::find(),
            'pagination' => ['pageSize' => 50]
        ]);

        return $provider;
    }
}