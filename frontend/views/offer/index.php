<?php

/* @var $this yii\web\View */

use frontend\assets\MapIconsAsset;
use frontend\models\Amenity;
use kartik\icons\Icon;
use yii\bootstrap\BootstrapPluginAsset;
use yii\bootstrap\Html;
use yii\helpers\Url;

BootstrapPluginAsset::register($this);
MapIconsAsset::register($this);

$this->title = $offer->title;
?>
<div class="flight-detail-page">
    <div class="row">
        <div id="main" class="col-md-9">
            <div class="tab-container style1 box" id="flight-main-content">
                <div class="tab-content">
                    <div id="photo-tab" class="tab-pane fade in active">
                        <div class="featured-image image-container">
                            <?php if ($offer->photo->content) : ?>
                                <?= Html::img('data://' . $offer->photo->type . ';base64, ' . $offer->photo->content,
                                    [
                                        'alt' => $offer->photo->filename
                                    ]) ?>
                            <?php else : ?>
                                <?= Html::img('@web/images/no-image.png') ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="flight-features" class="tab-container">
                <ul class="tabs">
                    <li class="active">
                        <a href="#flight-details" data-toggle="tab"><?= Yii::t('app', 'Flight Details') ?></a>
                    </li>
                    <li>
                        <a href="#hotel-details" data-toggle="tab"><?= Yii::t('app', 'Hotel Details') ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="flight-details">
                        <div class="intro table-wrapper full-width hidden-table-sm box">
                            <div class="col-md-4 table-cell travelo-box">
                                <dl class="term-description">
                                    <dt><?= Yii::t('app', 'Airline') ?>:</dt>
                                    <dd><?= $offer->flight->airline ?></dd>
                                    <dt><?= Yii::t('app', 'Base fare') ?>:</dt>
                                    <dd><?= Yii::$app->formatter->asCurrency($offer->flight->price) ?></dd>
                                    <dt><?= Yii::t('app', 'Taxes & Fees') ?>:</dt>
                                    <dd><?= Yii::$app->formatter->asCurrency($offer->flight->taxes) ?></dd>
                                    <dt><?= Yii::t('app', 'total price') ?>:</dt>
                                    <dd><?= Yii::$app->formatter->asCurrency($offer->flight->totalPrice) ?></dd>
                                </dl>
                            </div>
                            <div class="col-md-8 table-cell">
                                <div class="detailed-features booking-details">
                                    <div class="travelo-box">
                                        <a href="#" class="button btn-mini yellow pull-right">DIRECT</a>
                                        <h4 class="box-title">
                                            <?= $this->render('title', ['offer' => $offer]) ?>
                                        </h4>
                                    </div>
                                    <div class="table-wrapper flights">
                                        <div class="table-row first-flight">
                                            <div class="table-cell timing-detail">
                                                <div class="timing">
                                                    <?= $this->render('duration', ['offer' => $offer]) ?>
                                                </div>
                                                <label class="layover">
                                                    <?= Yii::t('app', 'Duration : {days}d', [
                                                        'days' => $offer->flight->duration
                                                    ]) ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="table-row second-flight">
                                            <div class="table-cell timing-detail">
                                                <div class="timing">
                                                    <div class="check-in">
                                                        <label><?= Yii::t('app', 'Take off') ?></label>
                                                        <span><?= Yii::$app->formatter->asDatetime($offer->flight->returnDepartureDate) ?></span>
                                                    </div>
                                                    <div class="duration text-center">
                                                        <?= Icon::show('clock-o') ?>
                                                        <span>
                                                            <?= Yii::t('app', '{hours}h {minutes}m', [
                                                                'hours' => $offer->flight->returnFlightDuration['hours'],
                                                                'minutes' => $offer->flight->returnFlightDuration['minutes'],
                                                            ]) ?>
                                                        </span>
                                                    </div>
                                                    <div class="check-out">
                                                        <label><?= Yii::t('app', 'Landing') ?></label>
                                                        <span><?= Yii::$app->formatter->asDatetime($offer->flight->returnArrivalDate) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="long-description">
                            <h2><?= Yii::t('app', 'About Flight') ?></h2>
                            <p>
                                <?= $offer->flight->description ?>
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hotel-details">
                        <h2><?= Yii::t('app', 'Hotel Details') ?></h2>
                        <p><?= $offer->hotel->details ?></p>
                        <ul class="amenities clearfix style1 box">
                            <?php foreach ($offer->hotel->amenities as $amenity) : ?>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1">
                                        <i class="<?= $amenity->icon ?>"></i>
                                        <?= Amenity::getName($amenity->type) ?>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                        <div class="long-description">
                            <h2><?= Yii::t('app', 'About Hotel') ?></h2>
                            <p>
                                <?= $offer->hotel->description ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar col-md-3">
            <article class="detailed-logo">
                <figure>
                    <?= Html::img('@web/images/stock-photo-palm-and-beach-58860614.jpg') ?>
                </figure>
                <div class="details">
                    <h2 class="box-title">
                        <?= Yii::t('app', '{origin} to {destination}', [
                            'origin' => $offer->origin,
                            'destination' => $offer->destination
                        ]) ?>
                        <small><?= Yii::t('app', 'Return flight') ?></small>
                    </h2>
                                <span class="price clearfix">
                                    <small class="pull-left"><?= Yii::t('app', 'per person') ?></small>
                                    <span class="pull-right">
                                        <?= Yii::$app->formatter->asCurrency($offer->price) ?>
                                    </span>
                                </span>

                    <div class="duration">
                        <i class="soap-icon-clock"></i>
                        <dl>
                            <dt class="skin-color"><?= Yii::t('app', 'Total Time') ?>:</dt>
                            <dd><?= Yii::t('app', '{n,plural,=1{# day} other{# days}}', [
                                    'n' => $offer->flight->duration
                                ]) ?></dd>
                        </dl>
                    </div>

                    <p class="description">
                        <?= $offer->description ?>
                    </p>
                    <a href="<?= Url::toRoute(['offer/book', 'slug' => $offer->slug]) ?>"
                       class="button green full-width uppercase btn-medium">
                        <?= Yii::t('app', 'Book now') ?>
                    </a>
                </div>
            </article>
        </div>
    </div>
</div>