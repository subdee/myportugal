<?php

namespace frontend\models;

use common\models\Amenity as CommonAmenity;
use Yii;

class Amenity extends CommonAmenity
{
    public static function getName($type)
    {
        return static::getTranslated()[$type];
    }

    protected static function getTranslated()
    {
        return [
            static::BATH => Yii::t('app', 'Bath'),
            static::POOL => Yii::t('app', 'Pool'),
            static::KITCHEN => Yii::t('app', 'Kitchen'),
            static::PETS => Yii::t('app', 'Pets'),
            static::ACTIVITIES => Yii::t('app', 'Activities'),
            static::TV => Yii::t('app', 'TV'),
            static::MINIBAR => Yii::t('app', 'Minibar'),
            static::ROOM => Yii::t('app', 'Room service'),
            static::INTERNET => Yii::t('app', 'Internet'),
            static::PARKING => Yii::t('app', 'Parking'),
            static::KIDCARE => Yii::t('app', 'Kid care'),
            static::LAUNDRY => Yii::t('app', 'Laundry'),
            static::AC => Yii::t('app', 'Air conditioning'),
            static::SMOKING => Yii::t('app', 'Smoking area'),
            static::WAKEUP => Yii::t('app', 'Wake-up service'),
            static::TRANSPORT => Yii::t('app', 'Transport service'),
            static::STORAGE => Yii::t('app', 'Storage'),
            static::SPA => Yii::t('app', 'Spa'),
        ];
    }
}