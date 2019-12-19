<?php defined('DIR') OR exit;?>

<main class="site__content" style="margin-bottom: 40px;">
  <div class="content">
      <div class="page-content page-content--transfer">

        <div class="container">
            <div class="transfer-header text-center">
                <h2 class="transfer-heading d-inline-block position-relative"><?=$title?></h2>
            </div>

           <div class="row" style="margin: 0 0 60px 0">
            <?php 
            $items = g_homepage_tours(false, false, 150);
            $x=1;
            foreach($items as $item): 
            $link = str_replace("https://tripplanner.ge","https://beetrip.ge",href(63,array(), l(), $item['id']));
            ?>
              <div class="col-md-4 col-sx-12">
                <div class="other-tour text-center">
                  <?php if((int)$item["special_offer2"] > 0): ?>
                  <div class="special-offer"><?=l("specialoffer")?></div>
                  <?php endif; ?>
                  <a href="<?=$link?>" class="other-tour__img-container d-block position-relative" style="width: 100%; height: 220px; background-size: cover; background-image: url('<?=$item["image1"]?>'); display: block;">
                  </a>
                  <h4 class="other-tour__title"><a href="#"><?=$item["title"]?></a></h4>
                  <div class="button-group">
                  <a href="<?=$link?>" class="button button--green button--icon-position-left" style="padding: 5px 25px; margin-bottom: 40px;"><?=l("read.more")?></a>
                  </div>
                </div>
              </div>

            <?php
            endforeach; 
            ?>
            </div>
                          

          </div>
      </div>
  </div>
</main>

<script>
  (function(){
    document.getElementsByClassName("g-ongoing-tourx")[0].classList.add("active");
  })();
</script>