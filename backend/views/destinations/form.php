<?php
use kartik\widgets\ActiveForm;
use yii\bootstrap\Html;

$form = ActiveForm::begin([
    'id' => 'new-destination-form',
    'type' => ActiveForm::TYPE_VERTICAL,
]) ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'destination') ?>
        <?= $form->field($model, 'active')->checkbox() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton(
                'Add destination',
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
