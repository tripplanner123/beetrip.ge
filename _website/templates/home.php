<?php 
defined('DIR') OR exit; 
// header('Location: /'.l().'/transfers');
?>

<main class="site__content">
    <div class="content">
        <div id="slider" class="slider carousel slide" data-ride="carousel">
            <a href="#" class="tripplaner-attached-link"></a>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slider-image" style="background-image: url('_website/uploads/images/slider-1.jpg')"></div>
                </div>
            </div>
        </div>
        <div class="section section--quick-links">
            <div class="container">
                <div class="row align-items-center justify-content-center quick-links">
                    <div class="col-4 quick-links__col text-center">
                        <a href="https://tripplanner.ge/<?=l()?>/ongoing-tours/?page=1&pri=0&cat=&reg=" class="quick-links__item d-inline-block" target="_blank">
                            <span class="quick-links__icon quick-links__icon--1 d-inline-block"></span>
                            <h2 class="quick-links__title"><?=menu_title(63)?></h2>
                        </a>
                    </div>
                    <div class="col-4 quick-links__col text-center">
                        <a href="/<?=l()?>/transfers" class="quick-links__item d-inline-block">
                            <span class="quick-links__icon quick-links__icon--2 d-inline-block"></span>
                            <h2 class="quick-links__title"><?=menu_title(62)?></h2>
                        </a>
                    </div>
                    <div class="col-4 quick-links__col text-center">
                        <a href="https://tripplanner.ge/<?=l()?>/plan-your-trip" class="quick-links__item d-inline-block" target="_blank">
                            <span class="quick-links__icon quick-links__icon--3 quick-links__icon--3-disabled d-inline-block" style="    background-image: url('/_website/images/trip-planner.svg');"></span><!-- for active color remove class quick-links__icon--3-disabled -->
                            <h2 class="quick-links__title"><?=menu_title(61)?></h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php 
                    // echo "<pre>";
                    // print_r(g_homepage_tours());
                    // echo "</pre>";
                    ?>
        <div class="section pt-0 section--tours-carousel" style="padding-bottom: 100px">
            <div class="swiper-container tours-carousel">
                <div class="swiper-wrapper">

                    <?php 
                    foreach(g_homepage_tours(false, false, 20) as $item): 
                        $link = str_replace("https://beetrip.ge","https://tripplanner.ge",href(63,array(), l(), $item['id']));
                    ?>
                    <a href="<?=$link?>" target="_blank" class="swiper-slide tours-carousel__item" style="background-image:url('<?=$item['image1']?>')">
                        <div class="tours-carousel__item-details d-flex align-items-center">
                            <h2 class="tours-carousel__item-title" title="<?=htmlentities($item['title'])?>" style="max-width: 100%">
                                <p class="tours-carousel__item-link"><?=$item['title']?></p>
                            </h2>
                            <div class="ml-auto d-flex align-items-center">
                                <!-- <p class="tours-carousel__item-add-to-cart" style="background-image: none; width:auto">
                                    <?=l("more")?>
                                </p> -->
                                <!-- <div class="tours-carousel__item-price"><?=$item['price']?> <span class="lari-symbol">l</span></div> -->
                            </div>
                        </div>
                    </a> 
                    <?php endforeach; ?>
                   
                    
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</main>
<!-- content -->

<!--Custom Scripts-->
<script src="_website/minJs/default.min.js"></script>
<script src="_website/minJs/home.min.js"></script>