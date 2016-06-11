<?php

namespace common\models;

use yii\base\Model;

class Payment extends Model
{
    public $paymentMethod;
    public $amount;
    public $transactionNumber;
    public $completedOn;

    public function attributes()
    {
        return [
            'paymentMethod',
            'amount',
            'transactionNumber',
            'completedOn',
        ];
    }

    public function rules()
    {
        return [
            [['paymentMethod', 'amount'], 'required'],
        ];
    }
}