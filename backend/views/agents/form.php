<?php
use kartik\widgets\ActiveForm;
use yii\bootstrap\Html;

$form = ActiveForm::begin([
    'id' => 'new-agent-form',
    'type' => ActiveForm::TYPE_VERTICAL,
]) ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton(
                'Create new agent',
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
