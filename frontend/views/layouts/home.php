<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use frontend\assets\FontAsset;
use frontend\assets\IeAsset;
use kartik\icons\Icon;
use kartik\widgets\Growl;
use yii\helpers\Html;

AppAsset::register($this);
FontAsset::register($this);
IeAsset::register($this);

Icon::map($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?= Growl::widget([
        'type' => ( ! empty($message['type'])) ? $message['type'] : Growl::TYPE_DANGER,
        'title' => ( ! empty($message['title'])) ? Html::encode($message['title']) : Yii::t('app', 'Oops!'),
        'icon' => ( ! empty($message['icon'])) ? $message['icon'] : 'fa fa-remove',
        'body' => ( ! empty($message['message'])) ? Html::encode($message['message']) : Yii::t('app',
            'Something went wrong!'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]) ?>
<?php endforeach; ?>
<div id="page-wrapper">
    <?php $this->beginContent('@app/views/layouts/header.php') ?>
    <section id="content">
        <?= $content ?>
    </section>
    <?php $this->endContent() ?>
    <?php $this->beginContent('@app/views/layouts/footer.php') ?>
    <?php $this->endContent() ?>
</div>
<script type="text/javascript">
    enableChaser = 0;
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
