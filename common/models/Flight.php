<?php

namespace common\models;

use yii\base\Model;

class Flight extends Model
{
    public $airline;
    public $price;
    public $taxes;
    public $beginAirport;
    public $beginDepartureDate;
    public $beginArrivalDate;
    public $returnAirport;
    public $returnDepartureDate;
    public $returnArrivalDate;
    public $description;

    public function attributes()
    {
        return [
            'airline',
            'price',
            'taxes',
            'beginAirport',
            'beginDepartureDate',
            'beginArrivalDate',
            'returnAirport',
            'returnDepartureDate',
            'returnArrivalDate',
            'description'
        ];
    }

    public function rules()
    {
        return [
            [['airline', 'price', 'description'], 'required'],
        ];
    }

    public function getDuration()
    {
        $returnDate = \DateTime::createFromFormat('U', $this->returnArrivalDate);
        $departDate = \DateTime::createFromFormat('U', $this->beginDepartureDate);

        return $departDate->diff($returnDate)->days;
    }
}