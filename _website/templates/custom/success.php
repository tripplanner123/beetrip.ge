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
                                <div class="text-holder text-holder--tour-details">
                                    <?php echo $content; ?>
                                </div>
                                <script type="text/javascript">
                                    setTimeout(function(){
                                        location.href = "http://beetrip.ge/<?=l()?>/profile";
                                    }, 2000);
                                </script>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>                    
        </div>
    </div>
</main>
<!-- content -->