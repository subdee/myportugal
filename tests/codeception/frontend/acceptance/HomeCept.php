<?php

namespace tests\codeception\frontend\acceptance;

use tests\codeception\frontend\AcceptanceTester;
use Yii;

/* @var $scenario \Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('YOU DON\'T WANT TO MISS THE NATURE!');
$I->seeLink('Get a tailor made quote now');
