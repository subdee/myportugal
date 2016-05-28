<?php

namespace common\models;

use yii\base\Model;

class Hotel extends Model
{
    public $name;
    public $address;
    public $phone;
    public $email;
    public $details;
    public $amenities;
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
            'amenities',
            'price',
            'description'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'price', 'description'], 'required'],
        ];
    }
}