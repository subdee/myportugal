<?php

/* @var $this yii\web\View */
use kartik\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Book {offer}', ['offer' => $offer->title]);
?>
<div class="row">
    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
        <div class="booking-section travelo-box">
            <?php $form = ActiveForm::begin(['class' => 'booking-form']); ?>
            <div class="person-information">
                <h2><?= Yii::t('app', 'Your Personal Information') ?></h2>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <label>first name</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <label>last name</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <label>email address</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <label>Verify E-mail Address</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <label>Country code</label>
                        <div class="selector">
                            <select class="full-width">
                                <option>Netherlands (+31)</option>
                                <option>United States (+1)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <label>Phone number</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> I want to receive <span class="skin-color">MyPortugal.nl</span>
                            promotional offers in the future
                        </label>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="card-information">
                <h2>Your Card Information</h2>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <label>Credit Card Type</label>
                        <div class="selector">
                            <select class="full-width">
                                <option>select a card</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <label>Card holder name</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <label>Card number</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <label>Card identification number</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <label>Expiration Date</label>
                        <div class="constant-column-2">
                            <div class="selector">
                                <select class="full-width">
                                    <option>month</option>
                                </select>
                            </div>
                            <div class="selector">
                                <select class="full-width">
                                    <option>year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <label>billing zip code</label>
                        <input type="text" class="input-text full-width" value="" placeholder=""/>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> By continuing, you agree to the <a href="#"><span
                                class="skin-color">Terms and Conditions</span></a>.
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 col-md-5">
                    <button type="submit" class="full-width btn-large">CONFIRM BOOKING</button>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="sidebar col-sms-6 col-sm-4 col-md-3">
        <div class="booking-details travelo-box">
            <h4><?= Yii::t('app', 'Booking Details') ?></h4>
            <article class="flight-booking-details">
                <figure class="clearfix">
                    <?= Html::a(
                        Html::img('data://' . $offer->photo->type . ';base64, ' . $offer->photo->content, [
                            'class' => 'middle-item'
                        ]),
                        Url::toRoute(['offer/index', 'slug' => $offer->slug]),
                        ['class' => 'middle-block']
                    ) ?>
                    <div class="travel-title">
                        <h5 class="box-title">
                            <?= $this->render('title', ['offer' => $offer]) ?>
                        </h5>
                        <?= Html::a(
                            strtoupper(Yii::t('app', 'View')),
                            Url::toRoute(['offer/index', 'slug' => $offer->slug]),
                            ['class' => 'button']
                        ) ?>
                    </div>
                </figure>
                <div class="details">
                    <div class="constant-column-3 timing clearfix">
                        <?= $this->render('duration', ['offer' => $offer]) ?>
                    </div>
                </div>
            </article>

            <h4>Other Details</h4>
            <dl class="other-details">
                <dt class="feature"><?= Yii::t('app', 'Airline') ?>:</dt>
                <dd class="value"><?= $offer->flight->airline ?></dd>
                <dt class="feature"><?= Yii::t('app', 'Base fare') ?>:</dt>
                <dd class="value">
                    <?= Yii::$app->formatter->asCurrency($offer->flight->price, null, [
                        NumberFormatter::MIN_FRACTION_DIGITS => 0
                    ]) ?>
                </dd>
                <dt class="feature"><?= Yii::t('app', 'Hotel fare') ?>:</dt>
                <dd class="value">
                    <?= Yii::$app->formatter->asCurrency($offer->hotel->price, null, [
                        NumberFormatter::MIN_FRACTION_DIGITS => 0
                    ]) ?>
                </dd>
                <dt class="feature"><?= Yii::t('app', 'Taxes and fees') ?>:</dt>
                <dd class="value">
                    <?= Yii::$app->formatter->asCurrency($offer->flight->taxes, null, [
                        NumberFormatter::MIN_FRACTION_DIGITS => 0
                    ]) ?>
                </dd>
                <dt class="total-price"><?= Yii::t('app', 'Total Price') ?></dt>
                <dd class="total-price-value">
                    <?= Yii::$app->formatter->asCurrency($offer->price, null, [
                        NumberFormatter::MIN_FRACTION_DIGITS => 0
                    ]) ?>
                </dd>
            </dl>
        </div>

        <div class="travelo-box contact-box">
            <h4>Need MyPortugal.nl Help?</h4>
            <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
            <address class="contact-details">
                <span class="contact-phone"><i class="soap-icon-phone"></i> 010-123-4567</span>
                <br>
                <a class="contact-email" href="#">help@MyPortugal.nl</a>
            </address>
        </div>
    </div>
</div>