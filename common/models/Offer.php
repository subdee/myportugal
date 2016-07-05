<?php

namespace common\models;

use common\models\queries\OfferQuery;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii2tech\embedded\mongodb\ActiveRecord;

/**
 * @property string $_id
 * @property string $title
 * @property string $slug
 * @property float $price
 * @property string $description
 * @property string $origin
 * @property string $destination
 * @property bool $active
 * @property string $created_on
 * @property string $updated_on
 * @property int $createdBy
 * @property User $creator
 * @property Flight $flight
 * @property Hotel $hotel
 * @property Image $photo
 */
class Offer extends ActiveRecord
{
    public $photoFile;

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'offers';
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
            'createdBy'
        ];
    }

    public function rules()
    {
        return [
            [['title', 'price', 'description', 'origin', 'destination', 'createdBy'], 'required'],
            [['flightData', 'hotelData', 'photoData'], 'yii2tech\embedded\Validator'],
            ['photoFile', 'image', 'maxSize' => 10 * 1024 * 1024],
            ['active', 'default', 'value' => false],
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
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_on',
                'updatedAtAttribute' => 'updated_on',
                'value' => time(),
            ],
        ];
    }

    public static function find()
    {
        return new OfferQuery(get_called_class());
    }

    /**
     * @param User $user
     * @return ActiveDataProvider
     */
    public static function getAll(User $user)
    {
        $query = static::find();
        if ($user->agent) {
            $query = static::find()->byAgent($user->id);
        }
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50]
        ]);

        return $provider;
    }

    /**
     * @return null|User
     */
    public function getCreator()
    {
        return User::findOne($this->createdBy);
    }
}