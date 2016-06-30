<?php
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>

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