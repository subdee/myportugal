<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class TravelSearchForm extends Model
{
    public $dateFrom;
    public $duration;
    public $adults;
    public $children;
    public $destination;
    public $hotelType;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateFrom', 'duration', 'adults', 'children', 'destination', 'hotelType'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dateFrom' => Yii::t('app/forms', 'Date of trip'),
            'duration' => Yii::t('app/forms', 'Length of stay (# of days)'),
            'adults' => Yii::t('app/forms', '# of adults'),
            'children' => Yii::t('app/forms', '# of children'),
            'destination' => Yii::t('app/forms', 'Destination'),
            'hotelType' => Yii::t('app/forms', 'Accommodation type'),
        ];
    }
}
