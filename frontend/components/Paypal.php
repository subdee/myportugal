<?php

namespace frontend\components;


use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use yii\base\Component;

class Paypal extends Component
{
    public $client_id;
    public $client_secret;
    private $apiContext;

    public function init()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential($this->client_id, $this->client_secret)
        );
    }

    public function getContext()
    {
        return $this->apiContext;
    }
}