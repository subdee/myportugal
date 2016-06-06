<?php

/* @var $this yii\web\View */

use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use yii\bootstrap\Button;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'myportugal.nl - Homepage';
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
                ]), '#') ?>
            </div>
        </div>
    </div>
    <?php for ($i = 0; $i <= 1; $i++) : ?>
        <div class="row image-box listing-style1 flight">
            <?php for ($j = 0; $j <= 2; $j++) : ?>
                <?php if (isset($offers[($i * 3) + $j])) : ?>
                    <?php $offer = $offers[($i * 3) + $j] ?>
                    <div class="col-sm-6 col-md-3">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown">
                            <span>
                                <?php if ($offer->photo->content) : ?>
                                    <img alt="<?= $offer->photo->filename ?>"
                                         src="data://<?= $offer->photo->type ?>;base64, <?= $offer->photo->content ?>">
                                <?php else : ?>
                                    <img src="<?= Url::to('@web/images/no-image.png') ?>" width="238px">
                                <?php endif; ?>
                            </span>
                            </figure>
                            <div class="details">
                            <span class="price">
                                <small>per person</small>
                                <?= Yii::$app->formatter->asCurrency($offer->price) ?>
                            </span>
                                <h4 class="box-title">
                                    <?= $offer->title ?>
                                    <small>
                                        <?= Yii::t('app', '{n,plural,=1{# day} other{# days}}', [
                                            'n' => $offer->flight->duration
                                        ]) ?> /
                                        <?= Yii::t('app', '{n,plural,=1{# night} other{# nights}}', [
                                            'n' => max($offer->flight->duration - 1, 0)
                                        ]) ?>
                                    </small>
                                </h4>
                                <div class="time">
                                    <div class="take-off">
                                        <div class="icon">
                                            <?= Icon::show('plane', ['class' => 'yellow-color']); ?>
                                        </div>
                                        <div>
                                            <span class="skin-color">Leave</span>
                                            <br>
                                            <?= Yii::$app->formatter->asDate($offer->flight->beginDepartureDate) ?>
                                            <br>
                                            <?= Yii::$app->formatter->asTime($offer->flight->beginDepartureDate,
                                                'short') ?>
                                        </div>
                                    </div>
                                    <div class="return">
                                        <div class="icon">
                                            <?= Icon::show('plane', ['class' => 'yellow-color']); ?>
                                        </div>
                                        <div>
                                            <span class="skin-color">return</span>
                                            <br>
                                            <?= Yii::$app->formatter->asDate($offer->flight->returnArrivalDate) ?>
                                            <br>
                                            <?= Yii::$app->formatter->asTime($offer->flight->returnArrivalDate,
                                                'short') ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="duration fourty-space"><span class="skin-color">Including</span> Hotel
                                    executive
                                    room
                                </p>
                                <div class="action">
                                    <?= Html::a(strtoupper(Yii::t('app', 'Book now')), [
                                        'offer/index',
                                        'slug' => $offer->slug
                                    ], ['class' => 'button btn-small full-width']) ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($i === 0) : ?>
                <div class="col-sm-6 col-md-3">
                    <article class="box travel-search-form">
                        <div class="row">
                            <div class="col-md-12">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'travel-search-form',
                                    'enableClientValidation' => false,
                                    'type' => ActiveForm::TYPE_VERTICAL
                                ]) ?>
                                <?= $form->field($model, 'dateFrom')->widget(DatePicker::className(), [
                                    'options' => ['placeholder' => 'From...'],
                                    'removeButton' => false,
                                    'pluginOptions' => ['autoclose' => true]
                                ]) ?>
                                <?= $form->field($model, 'dateTo')->widget(DatePicker::className(), [
                                    'options' => ['placeholder' => 'To...'],
                                    'removeButton' => false,
                                    'pluginOptions' => ['autoclose' => true]
                                ]) ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'adults')->dropDownList(
                                            [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]
                                        ) ?>

                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'children')->dropDownList(
                                            [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]
                                        ) ?>
                                    </div>
                                </div>

                                <?= $form->field($model, 'origin')->dropDownList(
                                    [
                                        'amsterdam' => Yii::t('app/forms', 'Amsterdam Schiphol'),
                                        'eindhoven' => Yii::t('app/forms', 'Eindhoven'),
                                        'brussels' => Yii::t('app/forms', 'Brussels'),
                                        'dusseldorf' => Yii::t('app/forms', 'Dusseldorf'),
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
            <?php elseif ($i === 1) : ?>
                <div class="col-sm-6 col-md-3">
                    <article class="box destinations">
                        <h3><?= Yii::t('app', 'Destinations') ?></h3>
                        <ul>
                            <li><a href="#">Lisbon</a></li>
                            <li><a href="#">Algarve</a></li>
                            <li><a href="#">Portimao</a></li>
                            <li><a href="#">Faro</a></li>
                            <li><a href="#">Porto</a></li>
                            <li><a href="#">Averio</a></li>
                            <li><a href="#">Batalha</a></li>
                        </ul>
                    </article>
                </div>
            <?php endif; ?>
        </div>
    <?php endfor; ?>
</div>

<div class="global-map-area mobile-section parallax" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="table-wrapper hidden-table-sm">
            <div class="col-md-6 description section table-cell">
                <h1><?= Yii::t('app', 'MyPortugal.nl Header') ?></h1>
                <div class="review clearfix">
                    <div class="five-stars-container pull-left">
                        <div class="five-stars transparent-bg" style="width: 100%;"></div>
                    </div>
                    &nbsp;&nbsp;&nbsp;<label>
                        <small class="white-color uppercase">
                            <?= Yii::t('app', '{n,plural,=1{1 user rating} other{# user ratings}}', [
                                'n' => 455
                            ]) ?>
                        </small>
                    </label>
                </div>
                <br>
                <p><?= Yii::t('app', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                    Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                    ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                    consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                    arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                    pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean
                    vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,
                    enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra
                    nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel
                    augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                    tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed
                    ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio
                    et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                    Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet
                    nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit
                    cursus nunc,') ?></p>
            </div>
            <div class="col-md-6 image-wrapper table-cell hidden-sm">
                <?= Html::img('@web/images/cities.jpg', [
                    'class' => 'animated',
                    'data-animation-type' => 'fadeInUp'
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="container section">
    <h2>MyPortugal.nl Photo Gallery</h2>
    <div class="flexslider image-carousel style2 row-2" data-animation="slide" data-item-width="170"
         data-item-margin="30">
        <ul class="slides">
            <?php for ($i = 1; $i <= 7; $i++) : ?>
                <li>
                    <a href="#" class="hover-effect">
                        <?= Html::img('@web/images/foto.jpg') ?>
                        <p class="caption">Praia da Marinha</p>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</div>

<div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
    <div class="container description">
        <h1 class="text-center box">Why MyPortugal.nl</h1>
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp" data-animation-delay="0">
                    <?= Icon::show('bed') ?>
                    <h4 class="box-title">135,000+ Hotels</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="0.6">
                    <?= Icon::show('check-square-o') ?>
                    <h4 class="box-title">Low Rates &amp; Top Savings</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="0.9">
                    <?= Icon::show('star') ?>
                    <h4 class="box-title">Reviewed by Real Travellers</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="1.2">
                    <?= Icon::show('phone-square') ?>
                    <h4 class="box-title">We Speak your Language</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>