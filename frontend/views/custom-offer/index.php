<?php

/* @var $this yii\web\View */
use kartik\datecontrol\DateControl;
use kartik\widgets\ActiveForm;

$this->title = Yii::t('app', 'Custom offer');
?>
<div class="row">
    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
        <div class="booking-section travelo-box">
            <?php $form = ActiveForm::begin(['class' => 'custom-offer-form']); ?>
            <div class="person-information">
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
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'destination') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'departureDate')->widget(DateControl::className(), [
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'language' => Yii::$app->language,
                                'readonly' => true,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                ]
                            ]
                        ]) ?>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <?= $form->field($model, 'duration') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-12">
                        <?= $form->field($model, 'description')->textarea() ?>
                    </div>
                </div>
            </div>
            <hr/>
            <hr/>
            <div class="form-group row">
                <div class="col-sm-6 col-md-5">
                    <button type="submit" class="full-width btn-large">
                        <?= Yii::t('app/forms', 'Request an offer') ?>
                    </button>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>