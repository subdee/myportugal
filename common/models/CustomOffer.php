<?php

namespace common\models;

use frontend\components\SendGrid;
use kartik\widgets\Growl;
use Yii;
use yii\base\Event;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\mongodb\ActiveRecord;

/**
 * @property string $_id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $destination
 * @property string $departureDate
 * @property int $duration
 * @property string $description
 */
class CustomOffer extends ActiveRecord
{

    const EVENT_AFTER_CUSTOM_REQUEST = 'after-custom-request';

    public function init()
    {
        $this->on(self::EVENT_AFTER_CUSTOM_REQUEST, [self::className(), 'sendAfterRequestEmail']);
        parent::init();
    }

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'customOffers';
    }

    public function attributes()
    {
        return [
            '_id',
            'firstName',
            'lastName',
            'email',
            'destination',
            'departureDate',
            'duration',
            'description',
            'requestedOn'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'firstName',
                    'lastName',
                    'email',
                    'destination',
                    'departureDate',
                    'duration',
                    'description',
                ],
                'required'
            ],
            ['email', 'trim'],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => Yii::t('app/forms', 'First Name'),
            'lastName' => Yii::t('app/forms', 'Last Name'),
            'email' => Yii::t('app/forms', 'Email'),
            'destination' => Yii::t('app/forms', 'Destination'),
            'departureDate' => Yii::t('app/forms', 'Departure Date'),
            'duration' => Yii::t('app/forms', '# of days'),
            'description' => Yii::t('app/forms', 'Describe your request'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'requestedOn',
                'updatedAtAttribute' => null,
                'value' => time(),
            ],
        ];
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public static function getAll()
    {
        $provider = new ActiveDataProvider([
            'query' => static::find()->orderBy(['completedOn' => SORT_DESC]),
            'pagination' => ['pageSize' => 50]
        ]);

        return $provider;
    }

    public static function sendAfterRequestEmail(Event $event)
    {
        /** @var CustomOffer $customOffer */
        $customOffer = $event->sender;

        /** @var SendGrid $sendGrid */
        $sendGrid = Yii::$app->sendGrid;
        $sendGrid->setTo($customOffer->getFullName(), $customOffer->email);
        $sendGrid->setContent('afterCustomRequest', [
            'name' => $customOffer->firstName,
            'destination' => $customOffer->destination,
        ], Yii::$app->params['sendgrid']['templates']['main']);
        $sendGrid->setSubject(Yii::t('app/emails', 'Your custom offer from Deals Supply'));
        try {
            $sendGrid->send();
        } catch (\Exception $e) {
            Yii::warning('Custom request email failed with message: ' . $e->getMessage());
            Yii::$app->session->setFlash('error', [
                'type' => Growl::TYPE_DANGER,
                'icon' => 'fa fa-ban',
                'title' => Yii::t('app', 'Email could not be sent'),
                'message' => Yii::t(
                    'app',
                    'We had trouble sending a confirmation email to ' . $customOffer->email . ' but do not worry, your 
                    request has been received.'
                ),
            ]);
        }

        return;
    }
}
