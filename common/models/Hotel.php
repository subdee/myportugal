<?php

namespace common\models;

use yii\base\Model;
use yii2tech\embedded\ContainerInterface;
use yii2tech\embedded\ContainerTrait;

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
            'description'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'price', 'description', 'address', 'phone', 'email', 'details'], 'required'],
        ];
    }

    public function embedAmenities()
    {
        return $this->mapEmbeddedList('amenitiesData', Amenity::className());
    }
}