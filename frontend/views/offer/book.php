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
            <?php $form = ActiveForm::begin(['id' => 'booking-form']); ?>
            <div class="person-information">
                <h2><?= Yii::t('app', 'Booking options') ?></h2>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'adults')->dropDownList(
                            [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]
                        ) ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'children')->dropDownList(
                            [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]
                        ) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10">
                        <?= $form->field($model, 'remarks')->textarea() ?>
                    </div>
                </div>
            </div>
            <div class="person-information">
                <h2><?= Yii::t('app', 'Your Personal Information') ?></h2>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'firstName') ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'lastName') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'phone') ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'mobile') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'email2') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'password2')->passwordInput() ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'newsletter')->checkbox() ?>
                </div>
            </div>
            <hr/>
            <div class="card-information">
                <h2><?= Yii::t('app', 'Payment information') ?></h2>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        Select payment method
                    </div>
                </div>
            </div>
            <hr/>
            <div class="form-group">
                <?= $form->field($model, 'termsAndConditions')->checkbox([
                    'label' => Yii::t('app/forms', 'By continuing, you agree to the {termsAndCondsLink}', [
                        'termsAndCondsLink' => Html::a(
                            Html::tag(
                                'span',
                                Yii::t('app/forms', 'Terms and Conditions'),
                                ['class' => 'skin-color']
                            ),
                            Url::to(['site/terms'])
                        )
                    ])
                ]) ?>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 col-md-5">
                    <a href="#" onclick="$('#booking-form').submit(); return false;">
                        <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left"
                             style="margin-right:7px;">
                    </a>
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