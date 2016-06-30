<?php

namespace common\models\queries;


use common\models\Destination;
use frontend\models\TravelSearchForm;
use yii\mongodb\ActiveQuery;

class OfferQuery extends ActiveQuery
{
    public function byAgent($agentId)
    {
        return $this->andWhere(['createdBy' => $agentId]);
    }

    public function bySearchForm(TravelSearchForm $search)
    {
        if ($search->destination) {
            $destination = Destination::findOne($search->destination);
            $this->andWhere(['like', 'destination', $destination->destination]);
        }

        if ($search->dateFrom && $search->duration) {
            $departureDate = new \DateTimeImmutable($search->dateFrom);
            $start = $departureDate->setTime(0, 0)->format('U');
            $end = $departureDate->add(new \DateInterval('P' . $search->duration . 'D'))->setTime(23, 59)->format('U');
            $this->andWhere(['between', 'flightData.beginDepartureDate', $start, $end]);
        } elseif ($search->dateFrom) {
            $departureDate = new \DateTimeImmutable($search->dateFrom);
            $start = $departureDate->setTime(0, 0)->format('U');
            $end = $departureDate->setTime(23, 59)->format('U');
            $this->andWhere(['between', 'flightData.beginDepartureDate', $start, $end]);
        }

        if ($search->hotelType) {
            $this->andWhere(['hotelData.type', $search->hotelType]);
        }

        return $this;
    }
}