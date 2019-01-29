<?php defined('DIR') OR exit; ?>

<main class="site__content">
    <div class="content">
        <div class="page-content pt-0 pb-0">
            <div class="section pb-0">
                <div class="container-fluid-from-before-xl">
                    <div class="d-lg-flex align-items-lg-center position-relative">
                        <div class="swiper-container tour-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="background-image: url('<?php echo $image1 ?>');"></div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination swiper-pagination--tour-slider"></div>
                        </div>
                        <div class="tour-details text-center text-lg-left">
                            <div class="tour-details__content">
                                <h2 class="tour-title"><?php echo $title ?></h2>
                                <!-- <ul class="tour-info-list d-lg-flex align-items-lg-center">
                                    <li class="tour-info-list__item">Duration: 2 days</li>
                                    <li class="tour-info-list__item">Group: 7 persons</li>
                                    <li class="tour-info-list__item">Season: All year round</li>
                                </ul> -->
                                <div class="text-holder text-holder--tour-details">
                                    <?php echo strip_tags($content,"<p><br><a>") ?>
                                </div>
                            </div>
                            <!-- <div class="tour-details__footer d-lg-flex align-items-lg-center">
                                <div class="tour-price text-yellow">980 <span class="lari-symbol">l</span></div>
                                <div class="button-group ml-lg-auto">
                                    <a href="#" class="button button--green button--icon button--icon-position-left button--icon-cart button--add-to-cart">Add to Cart</a>
                                    <a href="#" class="button button--gray button--icon button--icon-position-left button--icon-heart button--add-to-wishlist">Add to Wishlist</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>                        
            </div>                    
        </div>
    </div>
</main>
<!-- content -->