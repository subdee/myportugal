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
    <section id="content">
        <?= $content ?>
    </section>
    <?php $this->endContent() ?>
    <footer id="footer">
        <div class="footer-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <h2>Discover</h2>
                        <ul class="discover triangle hover row">
                            <li class="col-xs-6"><a href="#">Safety</a></li>
                            <li class="col-xs-6"><a href="#">About</a></li>
                            <li class="col-xs-6"><a href="#">Site Map</a></li>
                            <li class="col-xs-6"><a href="#">Policies</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h2>Travel News</h2>
                        <ul class="travel-news">
                            <?php for ($i = 1; $i <= 2; $i++) : ?>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="images/planet.jpg" alt="" width="63" height="63"/>
                                        </a>
                                    </div>
                                    <div class="description">
                                        <h5 class="s-title"><a href="#">Amazing Places</a></h5>
                                        <p>Purus ac congue arcu cursus ut vitae pulvinar massaidp.</p>
                                        <span class="date">25 Apr, 2016</span>
                                    </div>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h2>Mailing List</h2>
                        <p>Sign up for our mailing list to get latest updates and offers.</p>
                        <div class="input-group">
                            <input type="text" class="input-text full-width" placeholder="your email"
                                   aria-describedby="basic-addon"/>
                            <span class="input-group-addon" id="basic-addon">
                                <?= Icon::show('check') ?>
                            </span>
                        </div>
                        <span>We respect your privacy</span>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h2>About MyPortugal.nl</h2>
                        <p>Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massaidp nequetiam lore
                            elerisque.</p>
                        <br/>
                        <address class="contact-details">
                            <span class="contact-phone"><?= Icon::show('phone') ?> 010-123-4567</span>
                            <br/>
                            <a href="#" class="contact-email">help@MyPortugal.nl.com</a>
                        </address>
                        <ul class="social-icons clearfix">
                            <li class="twitter">
                                <a title="twitter" href="#" data-toggle="tooltip">
                                    <?= Icon::show('twitter') ?>
                                </a>
                            </li>
                            <li class="googleplus">
                                <a title="googleplus" href="#" data-toggle="tooltip">
                                    <?= Icon::show('google-plus') ?>
                                </a>
                            </li>
                            <li class="facebook">
                                <a title="facebook" href="#" data-toggle="tooltip">
                                    <?= Icon::show('facebook') ?>
                                </a>
                            </li>
                            <li class="linkedin">
                                <a title="linkedin" href="#" data-toggle="tooltip">
                                    <?= Icon::show('linkedin') ?>
                                </a>
                            </li>
                            <li class="vimeo">
                                <a title="vimeo" href="#" data-toggle="tooltip">
                                    <?= Icon::show('vimeo') ?>
                                </a>
                            </li>
                            <li class="dribble">
                                <a title="dribble" href="#" data-toggle="tooltip">
                                    <?= Icon::show('dribbble') ?>
                                </a>
                            </li>
                            <li class="flickr">
                                <a title="flickr" href="#" data-toggle="tooltip">
                                    <?= Icon::show('flickr') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom gray-area">
            <div class="container">
                <div class="logo pull-left">
                    <a href="index.html" title="MyPortugal.nl - home">
                        <img src="images/logo.png" alt="MyPortugal.nl"/>
                    </a>
                </div>
                <div class="pull-right">
                    <a id="back-to-top" href="#" class="animated" data-animation-type="bounce">
                        <?= Icon::show('arrow-up') ?> Back to top
                    </a>
                </div>
                <div class="copyright pull-right">
                    <p>&copy; 2016 MyPortugal.nl</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript">
    enableChaser = 0;
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
