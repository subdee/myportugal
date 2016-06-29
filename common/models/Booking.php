<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii2tech\embedded\mongodb\ActiveRecord;

/**
 * @property string $_id
 * @property integer $userId
 * @property integer $adults
 * @property integer $children
 * @property string $remarks
 * @property string $firstName
 * @property string $lastName
 * @property string $phone
 * @property string $mobile
 * @property string $fullName
 * @property string $status
 * @property string $statusText
 * @property integer $completedOn
 * @property Offer $offer
 * @property Payment $payment
 */
class Booking extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;
    const STATUS_CANCELLED = 8;
    const STATUS_FAILED = 9;

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'bookings';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return [
            '_id',
            'userId',
            'offerData',
            'adults',
            'children',
            'remarks',
            'firstName',
            'lastName',
            'phone',
            'mobile',
            'completedOn',
            'paymentData',
            'status',
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'userId',
                    'adults',
                    'children',
                    'firstName',
                    'lastName',
                    'phone'
                ],
                'required'
            ],
            [['offerData', 'paymentData'], 'yii2tech\embedded\Validator'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            [['mobile', 'remarks'], 'safe']
        ];
    }

    public function embedOffer()
    {
        return $this->mapEmbedded('offerData', Offer::className());
    }

    public function embedPayment()
    {
        return $this->mapEmbedded('paymentData', Payment::className());
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'completedOn',
                'updatedAtAttribute' => null,
                'value' => time(),
            ],
        ];
    }

    public function getUser()
    {
        return User::findOne($this->userId);
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                return 'New';
            case self::STATUS_PAID:
                return 'Paid';
            case self::STATUS_CANCELLED:
                return 'Cancelled';
            case self::STATUS_FAILED:
                return 'Failed';
            default:
                return 'Unknown';
        }
    }

    public static function getAll()
    {
        $provider = new ActiveDataProvider([
            'query' => static::find()->orderBy(['completedOn' => SORT_DESC]),
            'pagination' => ['pageSize' => 50]
        ]);

        return $provider;
    }
}