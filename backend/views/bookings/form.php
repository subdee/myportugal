<?php
use kartik\form\ActiveForm;
use kartik\money\MaskMoney;
use yii\bootstrap\Html;

$form = ActiveForm::begin([
    'id' => 'new-booking-form',
    'type' => ActiveForm::TYPE_VERTICAL
]) ?>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <fieldset>
            <h4>Booking details</h4>
            <?= $form->field($booking, 'title') ?>
            <?= $form->field($booking, 'price')->widget(MaskMoney::className(), [
                'pluginOptions' => [
                    'allowNegative' => false,
                    'suffix' => '€'
                ],
                'options' => ['class' => 'text-right']
            ]) ?>
            <?= $form->field($booking, 'description')->textarea() ?>
        </fieldset>
    </div>
    <div class="col-md-6 col-sm-12">
        <fieldset>
            <h4>Flight details</h4>
            <?= $form->field($flight, 'airline') ?>
            <?= $form->field($flight, 'price')->widget(MaskMoney::className(), [
                'pluginOptions' => [
                    'allowNegative' => false,
                    'suffix' => '€'
                ],
                'options' => ['class' => 'text-right']
            ]) ?>
            <?= $form->field($flight, 'description')->textarea() ?>
        </fieldset>
        <fieldset>
            <h4>Hotel details</h4>
            <?= $form->field($hotel, 'name') ?>
            <?= $form->field($hotel, 'price')->widget(MaskMoney::className(), [
                'pluginOptions' => [
                    'allowNegative' => false,
                    'suffix' => '€'
                ],
                'options' => ['class' => 'text-right']
            ]) ?>
            <?= $form->field($hotel, 'description')->textarea() ?>
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton('Create new booking', ['class' => 'btn btn-primary']) ?>
        </div>
        <p class="help-block">
            The booking created will not be active. You can activate it in the main bookings page.
        </p>
    </div>
</div>
<?php ActiveForm::end() ?>
