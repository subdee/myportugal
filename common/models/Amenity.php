<?php

namespace common\models;

use yii\base\Model;

class Amenity extends Model
{
    public $name;
    public $icon;

    public function attributes()
    {
        return [
            'name',
            'icon',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'icon'], 'required'],
        ];
    }
}