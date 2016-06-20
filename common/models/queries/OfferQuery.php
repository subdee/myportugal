<?php

namespace common\models\queries;


use yii\mongodb\ActiveQuery;

class OfferQuery extends ActiveQuery
{
    public function byAgent($agentId)
    {
        return $this->andWhere(['createdBy' => $agentId]);
    }
}