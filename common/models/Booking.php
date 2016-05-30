<?php

namespace common\models;

use MongoDB\BSON\Binary;
use yii\behaviors\SluggableBehavior;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
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
            'slug',
            'flightData',
            'hotelData',
            'price',
            'description',
            'origin',
            'destination',
            'photo',
            'active',
            'created_on',
            'updated_on',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'price', 'description', 'origin', 'destination', 'photo'], 'required'],
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

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    public function beforeSave($insert)
    {
        $tmpname = UploadedFile::getInstance($this, 'photo')->tempName;
        $this->photo = new Binary(file_get_contents($tmpname), Binary::TYPE_GENERIC);

        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->photo = $this->photo ? $this->photo->getData() : null;

        return true;
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