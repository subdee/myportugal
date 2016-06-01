<?php
use kartik\datecontrol\DateControl;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\bootstrap\Html;

$form = ActiveForm::begin([
    'id' => 'new-booking-form',
    'type' => ActiveForm::TYPE_VERTICAL,
    'options' => ['enctype' => 'multipart/form-data']
]) ?>

<div class="row">
    <fieldset>
        <h4>Booking details</h4>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($booking, 'title') ?>
            <?= $form->field($booking, 'price', [
                'addon' => [
                    'prepend' => ['content' => '€']
                ]
            ]) ?>
            <?= $form->field($booking, 'description')->textarea() ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($booking, 'origin') ?>
            <?= $form->field($booking, 'destination') ?>
            <?= $form->field($booking, 'photoFile')->widget(FileInput::className(), [
                'language' => Yii::$app->language,
                'resizeImages' => true,
                'options' => ['multiple' => false, 'accept' => 'image/*'],
                'pluginOptions' => [
                    'previewFileType' => 'image',
                    'maxImageWidth' => 1024,
                    'maxImageHeight' => 1024,
                    'maxFileSize' => 10000
                ]
            ]) ?>
        </div>
    </fieldset>
</div>
<hr>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <fieldset>
            <h4>Flight details</h4>
            <?= $form->field($flight, 'airline') ?>
            <?= $form->field($flight, 'price', [
                'addon' => [
                    'prepend' => ['content' => '€']
                ]
            ]) ?>
            <?= $form->field($flight, 'taxes', [
                'addon' => [
                    'prepend' => ['content' => '€']
                ]
            ]) ?>
            <?= $form->field($flight, 'beginDepartureDate')->widget(DateControl::className(), [
                'type' => DateControl::FORMAT_DATETIME,
                'options' => [
                    'language' => Yii::$app->language,
                    'readonly' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]
            ]) ?>
            <?= $form->field($flight, 'beginArrivalDate')->widget(DateControl::className(), [
                'type' => DateControl::FORMAT_DATETIME,
                'options' => [
                    'language' => Yii::$app->language,
                    'readonly' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]
            ]) ?>
            <?= $form->field($flight, 'returnDepartureDate')->widget(DateControl::className(), [
                'type' => DateControl::FORMAT_DATETIME,
                'options' => [
                    'language' => Yii::$app->language,
                    'readonly' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]
            ]) ?>
            <?= $form->field($flight, 'returnArrivalDate')->widget(DateControl::className(), [
                'type' => DateControl::FORMAT_DATETIME,
                'options' => [
                    'language' => Yii::$app->language,
                    'readonly' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]
            ]) ?>
            <?= $form->field($flight, 'description')->textarea() ?>
        </fieldset>
    </div>
    <div class="col-md-6 col-sm-12">
        <fieldset>
            <h4>Hotel details</h4>
            <?= $form->field($hotel, 'name') ?>
            <?= $form->field($hotel, 'address')->textarea() ?>
            <?= $form->field($hotel, 'phone') ?>
            <?= $form->field($hotel, 'email') ?>
            <?= $form->field($hotel, 'details')->textarea() ?>
            <?= $form->field($hotel, 'price', [
                'addon' => [
                    'prepend' => ['content' => '€']
                ]
            ]) ?>
            <?= $form->field($hotel, 'description')->textarea() ?>
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton(
                $booking->isNewRecord ? 'Create new booking' : 'Update booking',
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
        <p class="help-block">
            The booking created will not be active. You can activate it in the main bookings page.
        </p>
    </div>
</div>
<?php ActiveForm::end() ?>
