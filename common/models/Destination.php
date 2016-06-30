<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $destination
 * @property integer $active
 * @property string $slug
 */
class Destination extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'destination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['destination'], 'required'],
            [['active'], 'integer'],
            [['destination'], 'string', 'max' => 255],
            [['destination', 'slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'destination' => Yii::t('app', 'Destination'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'destination',
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