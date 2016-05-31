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
            'beginDepartureDate',
            'beginArrivalDate',
            'returnDepartureDate',
            'returnArrivalDate',
            'description'
        ];
    }

    public function rules()
    {
        return [
            [['airline', 'price', 'description', 'taxes', 'beginDepartureDate', 'beginArrivalDate', 
                'returnDepartureDate', 'returnArrivalDate'], 'required'],
        ];
    }

    public function getDuration()
    {
        $returnDate = \DateTime::createFromFormat('U', $this->returnArrivalDate);
        $departDate = \DateTime::createFromFormat('U', $this->beginDepartureDate);

        return $departDate->diff($returnDate)->days;
    }

    public function getBeginFlightDuration()
    {
        $arriveDate = \DateTime::createFromFormat('U', $this->beginArrivalDate);
        $departDate = \DateTime::createFromFormat('U', $this->beginDepartureDate);

        return ['hours' => $departDate->diff($arriveDate)->h, 'minutes' => $departDate->diff($arriveDate)->i];
    }

    public function getReturnFlightDuration()
    {
        $arriveDate = \DateTime::createFromFormat('U', $this->returnArrivalDate);
        $departDate = \DateTime::createFromFormat('U', $this->returnDepartureDate);

        return ['hours' => $departDate->diff($arriveDate)->h, 'minutes' => $departDate->diff($arriveDate)->i];
    }

    public function getTotalPrice()
    {
        return $this->price + $this->taxes;
    }
}