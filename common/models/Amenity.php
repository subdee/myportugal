<?php

namespace common\models;

use yii\base\Model;

class Amenity extends Model
{
    public $type;
    public $icon;

    const BATH = 1;
    const POOL = 2;
    const KITCHEN = 3;
    const PETS = 4;
    const ACTIVITIES = 5;
    const TV = 6;
    const MINIBAR = 7;
    const ROOM = 8;
    const INTERNET = 9;
    const PARKING = 10;
    const KIDCARE = 11;
    const LAUNDRY = 12;
    const AC = 13;
    const SMOKING = 14;
    const WAKEUP = 15;
    const TRANSPORT = 16;
    const STORAGE = 17;
    const SPA = 18;

    public function attributes()
    {
        return [
            'type',
            'icon',
        ];
    }

    public function rules()
    {
        return [
            [['type', 'icon'], 'required'],
        ];
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return [
            static::BATH => 'Bath',
            static::POOL => 'Pool',
            static::KITCHEN => 'Kitchen',
            static::PETS => 'Pets',
            static::ACTIVITIES => 'Activities',
            static::TV => 'TV',
            static::MINIBAR => 'Minibar',
            static::ROOM => 'Room service',
            static::INTERNET => 'Internet',
            static::PARKING => 'Parking',
            static::KIDCARE => 'Kid care',
            static::LAUNDRY => 'Laundry',
            static::AC => 'Air conditioning',
            static::SMOKING => 'Smoking area',
            static::WAKEUP => 'Wake-up service',
            static::TRANSPORT => 'Transport service',
            static::STORAGE => 'Storage',
            static::SPA => 'Spa',
        ];
    }

    /**
     * @return void
     */
    public function assignIcon()
    {
        switch ($this->type) {
            case static::BATH:
                $this->icon = 'map-icon map-icon-toilet';
                break;
            case static::POOL:
                $this->icon = 'map-icon map-icon-swimming';
                break;
            case static::KITCHEN:
                $this->icon = 'map-icon map-icon-restaurant';
                break;
            case static::PETS:
                $this->icon = 'fa fa-paw';
                break;
            case static::ACTIVITIES:
                $this->icon = 'map-icon map-icon-horse-riding';
                break;
            case static::TV:
                $this->icon = 'fa fa-television';
                break;
            case static::MINIBAR:
                $this->icon = 'map-icon map-icon-liquor-store';
                break;
            case static::ROOM:
                $this->icon = 'map-icon map-icon-cafe';
                break;
            case static::INTERNET:
                $this->icon = 'fa fa-wifi';
                break;
            case static::PARKING:
                $this->icon = 'map-icon map-icon-parking';
                break;
            case static::KIDCARE:
                $this->icon = 'fa fa-child';
                break;
            case static::LAUNDRY:
                $this->icon = 'map-icon map-icon-laundry';
                break;
            case static::AC:
                $this->icon = 'map-icon map-icon-snow';
                break;
            case static::SMOKING:
                $this->icon = 'fa fa-fire';
                break;
            case static::WAKEUP:
                $this->icon = 'fa fa-clock-o';
                break;
            case static::TRANSPORT:
                $this->icon = 'fa fa-bus';
                break;
            case static::STORAGE:
                $this->icon = 'map-icon map-icon-storage';
                break;
            case static::SPA:
                $this->icon = 'map-icon map-icon-spa';
                break;
        }
    }
}