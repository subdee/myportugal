<?php use kartik\icons\Icon;

?>

<?= $content ?>
<footer id="footer">
    <div class="footer-wrapper">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-6 col-md-4">
                    <address class="contact-details">
                        <span class="contact-phone"><?= Icon::show('phone') ?> +31 629289686</span>
                    </address>
                </div>
                <div class="col-sm-6 col-md-4">
                    <address class="contact-details">
                        <a href="#" class="contact-email">sales@deals-supply.nl</a>
                    </address>
                </div>
                <div class="col-sm-6 col-md-4">
                    <ul class="social-icons clearfix">
                        <li class="facebook">
                            <a title="Facebook" href="https://www.facebook.com/Deals-supply-1409073889397336" data-toggle="tooltip">
                                <?= Icon::show('facebook') ?>
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
                <p>&copy; 2016-2017 Deals Supply</p>
            </div>
        </div>
    </div>
</footer>