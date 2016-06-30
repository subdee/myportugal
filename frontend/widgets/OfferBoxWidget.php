<?php

namespace frontend\widgets;


use yii\base\Widget;
use yii\web\HttpException;

class OfferBoxWidget extends Widget
{
    public $offer;

    public function init()
    {
        if ($this->offer === null) {
            throw new HttpException(404);
        }
    }

    public function run()
    {
        return $this->render('offerBox', ['offer' => $this->offer]);
    }
}