<?php use kartik\icons\Icon;
use yii\bootstrap\Html;

?>

<?= $content ?>
<footer id="footer">
    <div class="footer-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <h2>Discover</h2>
                    <ul class="discover triangle hover row">
                        <li class="col-xs-6"><a href="#"><?= Yii::t('app', 'Safety') ?></a></li>
                        <li class="col-xs-6"><a href="#"><?= Yii::t('app', 'About') ?></a></li>
                        <li class="col-xs-6"><a href="#"><?= Yii::t('app', 'Site Map') ?></a></li>
                        <li class="col-xs-6"><a href="#"><?= Yii::t('app', 'Policies') ?></a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h2><?= Yii::t('app', 'Travel News') ?></h2>
                    <ul class="travel-news">
                        <?php for ($i = 1; $i <= 2; $i++) : ?>
                            <li>
                                <div class="thumb">
                                    <a href="#">
                                        <?= Html::img('@web/images/planet.jpg', [
                                            'class' => 'logoimg',
                                            'width' => 63,
                                            'height' => 63,
                                        ]) ?>
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
                    <h2><?= Yii::t('app', 'Mailing List') ?></h2>
                    <p><?= Yii::t('app', 'Sign up for our mailing list to get latest updates and offers.') ?></p>
                    <div class="input-group">
                        <input type="text" class="input-text full-width"
                               placeholder="<?= Yii::t('app', 'your email') ?>"
                               aria-describedby="basic-addon"/>
                            <span class="input-group-addon" id="basic-addon">
                                <?= Icon::show('check') ?>
                            </span>
                    </div>
                    <span><?= Yii::t('app', 'We respect your privacy') ?></span>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h2><?= Yii::t('app', 'About MyPortugal.nl') ?></h2>
                    <p>
                        <?= Yii::t('app', 'Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massaidp nequetiam lore
                        elerisque.') ?>
                    </p>
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
            <div class="pull-right">
                <a id="back-to-top" href="#">
                    <?= Icon::show('arrow-up') ?> Back to top
                </a>
            </div>
            <div class="copyright pull-right">
                <p>&copy; 2016 MyPortugal.nl</p>
            </div>
        </div>
    </div>
</footer>