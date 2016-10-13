<?php

/** @var $this yii\web\View */
/** @var $offers \common\models\Offer[] */
/** @var $destinations Destination[] */

use common\models\Destination;
use common\models\Hotel;
use frontend\widgets\OfferBoxWidget;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use yii\bootstrap\Button;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Deals Supply';
?>
<div class="container">
    <div class="row action-buttons">
        <div class="col-md-6">
            <div class="action-button-green"><?= strtoupper(Yii::t('app',
                    'You don\'t want to miss the nature!')) ?></div>
            <br>
            <div class="action-button-red"><?= strtoupper(Yii::t('app', 'Give yourself a break and escape!')) ?></div>
        </div>
        <div class="col-md-3 col-md-offset-3">
            <div class="custom-trip-btn">
                <?= Html::a(Button::widget([
                    'label' => Yii::t('app', 'Get a tailor made quote now'),
                    'options' => ['class' => 'btn btn-default btn-hollow']
                ]), ['custom-offer/index']) ?>
            </div>
        </div>
    </div>
    <?php for ($i = 0; $i <= 1; $i++) : ?>
        <div class="row image-box listing-style1 flight">
            <?php if ($i === 0) : ?>
                <div class="col-sm-6 col-md-3">
                    <article class="box travel-search-form">
                        <h3><?= Yii::t('app', 'Search offers') ?></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'travel-search-form',
                                    'action' => Url::to(['offer/search']),
                                    'enableClientValidation' => false,
                                    'type' => ActiveForm::TYPE_VERTICAL
                                ]) ?>
                                <?= $form->field($model, 'dateFrom')->widget(DatePicker::className(), [
                                    'options' => ['placeholder' => 'From...'],
                                    'removeButton' => false,
                                    'pluginOptions' => ['autoclose' => true]
                                ]) ?>
                                <?= $form->field($model, 'duration') ?>

                                <?= $form->field($model, 'destination') ?>

                                <?= $form->field($model, 'hotelType')->dropDownList(
                                    Hotel::getTypes(),
                                    [
                                        'prompt' => 'Any type'
                                    ]
                                ) ?>

                                <div class="form-group">
                                    <div class="col-lg-offset-1 col-lg-11">
                                        <?= Html::submitButton(Yii::t('app/forms', 'Search'),
                                            ['class' => 'btn btn-primary']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endif; ?>
            <?php for ($j = 0; $j <= 2; $j++) : ?>
                <?php if (isset($offers[($i * 3) + $j])) : ?>
                    <?php $offer = $offers[($i * 3) + $j] ?>
                    <?= OfferBoxWidget::widget(['offer' => $offer]) ?>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

<div class="global-map-area mobile-section parallax" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="table-wrapper hidden-table-sm">
            <div class="col-md-12 description section table-cell">
                <h1><?= Yii::t('app', 'About Deals Supply') ?></h1>
                <br>
                <h3>Who are we?</h3>
                <p>A small team of travel professionals combining experience and enthusiasm, dedicated only on providing
                    handpicked travel deals to selected deal sites and indiviadual clients, all over the world. We are
                    mainly dedicated on B2B channel sales, however, you may book some of our special deals every week,
                    directly with us too.</p>
                <p>We do not believe in mass sales but in the combination of quality holiday proposals for selected
                    accomodation. We stay away from cheap-low quality accomodation with bad reviews proposed only to
                    create sales. We only provide review checked accomodation. Above all, we KNOW the destination and
                    what we offer. With all our respect to our competition, we know that sometimes while booking you end
                    up talking to an intern that has no idea where Kos is.... Our small team, working mobile, avoiding
                    the high expenses of a luxurious office and of a huge staff, knows what we offer, when to offer it
                    and what fits best to your holidays expectations.</p>
                <p>No 9-5 working hours here...You can contact us 24/7 and we guarantee you our reply within 24
                    hours.</p>
                <h3>Company's Philosophy</h3>
                <p>Selected holiday deal proposals - better value for money = satisfied clients.</p>
                <p>We are passionate with what we do and we do it always thinking that this coud have been OUR
                    holiday.</p>
                <h3>History of our team</h3>
                <p>A small team combining the experience of some of our team members in the field of tourism and the
                    enthusiasm of our younger members.</p>
                <p>Our team members, have worked in key positions in the travel industry, like contract managers,
                    product managers, reservation supervisors. From their experience they can contribute the best when
                    it comes to holiday offers.</p>
            </div>
        </div>
    </div>
    <div class="container description">
        <h1 class="text-center box">Why Deals Supply</h1>
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp" data-animation-delay="0">
                    <?= Icon::show('bed') ?>
                    <h4 class="box-title">No reservation costs</h4>
                    <p class="description">
                        We are not hiding behind set rules to charge you for changes, cancellations or modifications of your booking.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="0.6">
                    <?= Icon::show('check-square-o') ?>
                    <h4 class="box-title">Book now, pay later</h4>
                    <p class="description">
                        Our rates are checked to offer the best price in the net
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="0.9">
                    <?= Icon::show('star') ?>
                    <h4 class="box-title">Personalized service</h4>
                    <p class="description">
                        Direct contracts with suppliers
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="1.2">
                    <?= Icon::show('phone-square') ?>
                    <h4 class="box-title">24/7 customer service</h4>
                    <p class="description">
                        You can contact us as often as you wish
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>