<?php

/* @var $this yii\web\View */

use kartik\form\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Deals Supply';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3><?= Yii::t('app', 'Signup form') ?></h3>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>