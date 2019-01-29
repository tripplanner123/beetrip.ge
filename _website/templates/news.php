<?php defined('DIR') OR exit; ?>
<!-- main-cont -->
<div class="main-cont">
  <div class="body-wrapper">
    <div class="page-head">
    	 <div class="wrapper-padding">
		      <div class="page-title">სიახლეები</div>
		      <div class="clear"></div>
	     </div>
    </div>
    <div class="wrapper-padding ip-full-width">
          <div class="padding">
		        <div class="catalog-row alternative">
<?php foreach($news as $a) : ?>					
					<div class="flat-adv large">
						<div class="flat-adv-a">
							<div class="flat-adv-l">
								<a href="<?php echo href($a["id"]);?>"><img alt="" src="<?php echo ($a["image1"]!="") ? $a["image1"]:"_website/img/article1.jpg";?>" width="99" height="99"></a>
							</div>
							<div class="flat-adv-r">
								<div class="flat-adv-rb">
									<div class="flat-adv-b"><a href="<?php echo href($a["id"]);?>"><?php echo $a["title"];?></a></div>
									<div class="flat-adv-c">
										<?php echo $a["description"];?>
									</div>
									<a class="flat-adv-btn" href="<?php echo href($a["id"]);?>">დეტალურად</a>
								</div>
							</div>
						</div>
					</div>
<?php endforeach; ?>
			    </div>

		        <div class="clear"></div>
		        
<?php if($page_max>1) : ?>
		        <div class="pagination">
<?php for($i=1;$i<=$page_max;$i++) : ?>		          
		          <a href="<?php echo href($id).'?page='.$i;?>" <?php echo ($page_cur==$i) ? 'class="active"':'';?> ><?php echo $i;?></a>
<?php endfor; ?>
		          <div class="clear"></div>
		        </div>            
<?php endif;?>



          </div>
        <br class="clear" />
    <div class="clear"></div>
    </div>	
  </div>
    
<!-- /main-cont -->

<?php require("_website/templates/widgets/popular.php");?>

</div>