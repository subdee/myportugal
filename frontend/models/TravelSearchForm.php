<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class TravelSearchForm extends Model
{
    public $dateFrom;
    public $dateTo;
    public $adults;
    public $children;
    public $origin;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateFrom', 'dateTo', 'adults', 'children', 'origin'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dateFrom' => Yii::t('app/forms', 'Leave'),
            'dateTo' => Yii::t('app/forms', 'Return'),
            'adults' => Yii::t('app/forms', '# of adults'),
            'children' => Yii::t('app/forms', '# of children'),
            'origin' => Yii::t('app/forms', 'Preferred airport'),
        ];
    }
}
