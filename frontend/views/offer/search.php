<?php
use frontend\widgets\OfferBoxWidget;

?>
<div class="container">
    <div class="row image-box listing-style1 flight">
        <?php foreach ($offers as $offer) : ?>
            <?= OfferBoxWidget::widget(['offer' => $offer]) ?>
        <?php endforeach; ?>
    </div>
</div>