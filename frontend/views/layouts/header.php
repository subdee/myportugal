<?php
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
                                <?= Html::img('@web/images/logo-inverse.png', [
                                    'class' => 'logoimg',
                                    'alt' => 'MyPortugal Logo'
                                ]) ?>
                            </a>
                        </li>
                        <li>
                            <a href="#"><?= Yii::t('app', 'Fly & Drives') ?></a>
                        </li>
                        <li>
                            <a href="#"><?= Yii::t('app', 'Authentic Portugal - Pusadas and more') ?></a>
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
                        <a href="index.html">MYPORTUGAL.NL</a>
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
<?= $content ?>