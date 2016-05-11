<?php

/* @var $this yii\web\View */

use kartik\icons\Icon;

$this->title = 'myportugal.nl - Homepage';
?>
<div class="container">
    <div class="row action-buttons">
        <div class="action-button-green">YOU DON'T WANT TO MISS THE NATURE!</div>
        <br>
        <div class="action-button-red">GIVE YOURSELF A BREAK AND ESCAPE!</div>
    </div>
    <?php for ($i = 1; $i <= 2; $i++) : ?>
        <div class="row image-box listing-style1 flight">
            <?php for ($j = 1; $j <= 4; $j++) : ?>
                <div class="col-sm-6 col-md-3">
                    <article class="box">
                        <figure class="animated" data-animation-type="fadeInDown">
                            <span><img alt="" src="images/stock-photo-palm-and-beach-58860614.jpg"></span>
                        </figure>
                        <div class="details">
                            <span class="price"><small>per person</small>€620</span>
                            <h4 class="box-title">Portugal
                                <small>3 days / 2 nights</small>
                            </h4>
                            <div class="time">
                                <div class="take-off">
                                    <div class="icon">
                                        <?= Icon::show('plane', ['class' => 'yellow-color']); ?>
                                    </div>
                                    <div>
                                        <span class="skin-color">Leave</span><br>wed jul 10<br>7:50 Am
                                    </div>
                                </div>
                                <div class="return">
                                    <div class="icon">
                                        <?= Icon::show('plane', ['class' => 'yellow-color']); ?>
                                    </div>
                                    <div>
                                        <span class="skin-color">return</span><br>wed jul 10<br>7:50 Am
                                    </div>
                                </div>
                            </div>
                            <p class="duration fourty-space"><span class="skin-color">Including</span> Hotel executive
                                room
                            </p>
                            <div class="action">
                                <a class="button btn-small full-width" href="booking-detailed.html">BOOK NOW</a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

<div class="global-map-area mobile-section parallax" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="table-wrapper hidden-table-sm">
            <div class="col-md-6 description section table-cell">
                <h1>MyPortugal.nl Header</h1>
                <div class="review clearfix">
                    <div class="five-stars-container pull-left">
                        <div class="five-stars transparent-bg" style="width: 100%;"></div>
                    </div>
                    &nbsp;&nbsp;&nbsp;<label>
                        <small class="white-color uppercase">455 user ratings</small>
                    </label>
                </div>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                    Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                    ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                    consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                    arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                    pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean
                    vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,
                    enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra
                    nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel
                    augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                    tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed
                    ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio
                    et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                    Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet
                    nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit
                    cursus nunc,</p>
            </div>
            <div class="col-md-6 image-wrapper table-cell hidden-sm">
                <img src="images/cities.jpg" alt="" class="animated" data-animation-type="fadeInUp">
            </div>
        </div>
    </div>
</div>

<div class="container section">
    <h2>MyPortugal.nl Photo Gallery</h2>
    <div class="flexslider image-carousel style2 row-2" data-animation="slide" data-item-width="170"
         data-item-margin="30">
        <ul class="slides">
            <?php for ($i = 1; $i <= 7; $i++) : ?>
                <li>
                    <a href="#" class="hover-effect">
                        <img src="images/foto.jpg" alt=""/>
                        <p class="caption">Praia da Marinha</p>
                    </a>
                    <a href="#" class="hover-effect">
                        <img src="images/foto.jpg" alt=""/>
                        <p class="caption">Praia da Marinha</p>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</div>

<div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
    <div class="container description">
        <h1 class="text-center box">Why MyPortugal.nl</h1>
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp" data-animation-delay="0">
                    <?= Icon::show('bed') ?>
                    <h4 class="box-title">135,000+ Hotels</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="0.6">
                    <?= Icon::show('check-square-o') ?>
                    <h4 class="box-title">Low Rates &amp; Top Savings</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="0.9">
                    <?= Icon::show('star') ?>
                    <h4 class="box-title">Reviewed by Real Travellers</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="icon-box style8 animated" data-animation-type="slideInUp"
                     data-animation-delay="1.2">
                    <?= Icon::show('phone-square') ?>
                    <h4 class="box-title">We Speak your Language</h4>
                    <p class="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>