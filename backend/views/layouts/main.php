<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

AppAsset::register($this);
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

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MyPortugal Backend',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => Icon::show('shopping-cart') . ' Bookings',
            'url' => ['bookings/index'],
            'encode' => false,
            'visible' => Yii::$app->user->identity->admin
        ];
        $menuItems[] = [
            'label' => Icon::show('comment-o') . ' Custom requests',
            'url' => ['site/custom'],
            'encode' => false,
            'visible' => Yii::$app->user->identity->admin
        ];
        $menuItems[] = ['label' => Icon::show('cogs') . ' Offers', 'url' => ['offers/index'], 'encode' => false];
        $menuItems[] = [
            'label' => Icon::show('user-secret') . ' Agents',
            'url' => ['agents/index'],
            'encode' => false,
            'visible' => Yii::$app->user->identity->admin
        ];
        $menuItems[] = '<li>'
                       . Html::beginForm(['/site/logout'], 'post')
                       . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
                       . Html::endForm()
                       . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MyPortugal.nl <?= date('Y') ?></p>

        <p class="pull-right"><a href="mailto:info@subdee.org?subject=MyPortugal%20Admin%20Support">Support</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
