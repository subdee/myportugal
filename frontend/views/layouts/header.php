<?php
use kartik\widgets\Growl;
use lajax\languagepicker\widgets\LanguagePicker;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>
    <header id="header" class="navbar-static-top style2">
        <div class="topnav">
            <div class="container">
                <nav id="main-menu" role="navigation">
                    <ul class="menu">
                        <li>
                            <a href="<?= Url::toRoute(['site/index']) ?>">
                                <?= Html::img('@web/images/logo.png', [
                                    'class' => 'logoimg',
                                    'alt' => 'Deals Supply Logo'
                                ]) ?>
                            </a>
                        </li>
                    </ul>
                </nav>
                <ul class="quick-menu pull-right clearfix">
                    <li class="ribbon">
                        <?= LanguagePicker::widget([
                            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
                            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_SMALL,
                            'parentTemplate' => '{activeItem}<ul class="menu mini">{items}</ul>'
                        ]) ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-header">

            <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
                Mobile Menu Toggle
            </a>

            <nav id="mobile-menu-01" class="mobile-menu collapse">
                <ul id="mobile-primary-menu" class="menu">
                    <li>
                        <a href="index.html">Deals Supply</a>
                    </li>
                </ul>

                <ul class="mobile-topnav container">
                    <li class="ribbon language menu-color-skin">
                        <a href="#" data-toggle="collapse">
                            <?= Locale::getDisplayLanguage(Yii::$app->language, Yii::$app->language) ?>
                        </a>
                        <ul class="menu mini">
                            <li class="<?= Yii::$app->language === 'nl-NL' ? 'active' : '' ?>">
                                <a href="#"><?= Locale::getDisplayLanguage('nl-NL', Yii::$app->language) ?></a>
                            </li>
                            <li class="<?= Yii::$app->language === 'en-GB' ? 'active' : '' ?>">
                                <a href="#"><?= Locale::getDisplayLanguage('en-GB', Yii::$app->language) ?></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
<?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?= Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : Growl::TYPE_DANGER,
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : Yii::t('app', 'Oops!'),
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-remove',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('app',
            'Something went wrong!'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'delay' => 5000,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]) ?>
<?php endforeach; ?>
<?= $content ?>