<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\data\ActiveDataProvider;
use yii2tech\embedded\mongodb\ActiveRecord;

/**
 * @property Flight $flight
 * @property Hotel $hotel
 * @property Image $photo
 */
class Booking extends ActiveRecord
{
    public $photoFile;

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
            'slug',
            'flightData',
            'hotelData',
            'price',
            'description',
            'origin',
            'destination',
            'photoData',
            'active',
            'created_on',
            'updated_on',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'price', 'description', 'origin', 'destination'], 'required'],
            [['flightData', 'hotelData', 'photoData'], 'yii2tech\embedded\Validator'],
            ['photoFile', 'image', 'maxSize' => 10 * 1024 * 1024],
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

    public function embedPhoto()
    {
        return $this->mapEmbedded('photoData', Image::className());
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
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