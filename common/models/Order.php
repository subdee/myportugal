<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\mongodb\ActiveRecord;

class Order extends ActiveRecord
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'orders';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'offer', 'user', 'date_completed', 'payment', 'status'];
    }

    public static function getOpen()
    {
        $provider = new ActiveDataProvider([
            'query' => static::find(),
            'pagination' => ['pageSize' => 50]
        ]);

        return $provider;
    }
}