<?php

namespace common\models;

use yii\base\Model;
use yii2tech\embedded\ContainerInterface;
use yii2tech\embedded\ContainerTrait;

/**
 * @property Amenity[] $amenities
 */
class Hotel extends Model implements ContainerInterface
{
    use ContainerTrait;

    public $name;
    public $address;
    public $phone;
    public $email;
    public $details;
    public $amenitiesData;
    public $price;
    public $description;
    public $type;

    const BB = 1;
    const ALLIN = 2;
    const HALFBOARD = 3;
    const SINGLEBED = 4;

    public function attributes()
    {
        return [
            'name',
            'address',
            'phone',
            'email',
            'details',
            'amenitiesData',
            'price',
            'description',
            'type'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'price', 'description', 'address', 'phone', 'email', 'details', 'type'], 'required'],
            [['amenitiesData'], 'yii2tech\embedded\Validator'],
        ];
    }

    public function embedAmenities()
    {
        return $this->mapEmbeddedList('amenitiesData', Amenity::className());
    }

    public static function getTypes()
    {
        return [
            self::BB => 'Bed & Breakfast',
            self::ALLIN => 'All inclusive',
            self::HALFBOARD => 'Half board',
            self::SINGLEBED => 'Single bed',
        ];
    }
}