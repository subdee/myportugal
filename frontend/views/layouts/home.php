<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use frontend\assets\FontAsset;
use frontend\assets\IeAsset;
use kartik\icons\Icon;
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

<div id="page-wrapper">
    <?php $this->beginContent('@app/views/layouts/header.php') ?>
    <section id="content-home">
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
