<?php defined('DIR') OR exit; ?>
<?php defined('DIR') OR exit; ?>
<!-- main-cont -->
<div class="main-cont">
  <div class="body-wrapper">
    <div class="page-head">
    	 <div class="wrapper-padding">
		      <div class="page-title">სტატია</div>
		      <div class="clear"></div>
	     </div>
    </div>
    <div class="blog-page">
          <div class="content-wrapper">
			   <div class="blog-sidebar">
			   		<div class="blog-sidebar-l">
			   			<div class="blog-sidebar-lb">
			   				<div class="blog-sidebar-p">
			   					<div class="blog-row">
			   						<div class="blog-post-cb">
										<div class="blog-post-title"><h1><?php echo $title ?></h1></div>
										<div class="blog-post-infos">
											<div class="blog-post-date"><?php echo convert_date($postdate);?></div>
											<div class="blog-post-auth">
												<a href="<?php echo href(31).'?q='.$author;?>" style="color:#f3b01a; text-decoration:none;"><?php echo $author;?></a>
											</div>
										</div>
										<?php if($image1!="") :?>
										<div class="blog-post-preview">
											<div class="blog-post-img">
												<a href="javascript:;"><img alt="" src="<?php echo $image1;?>"></a>
											</div>
										</div>
										<?php endif;?>
										<div class="blog-post-txt">
											 <?php echo $content ?>
										</div>
<?php
	if(count($files) > 0) :
?>	
										<div class="attached-files">
											<div class="title">
												<h4>მიმაგრებული ფაილები</h4>
											</div>
											<ul class="list">
<?php foreach($files as $file) : ?>   
<?php $ext = strtolower(substr(strrchr($file['file'], '.'), 1)); ?>
<?php if (!in_array($ext, c('thumbnail.exts'))) : ?>
												<li class="fix">
													<div class="img">
														<img src="_website/img/<?php echo $ext;?>.png" width="16" height="18" alt="">
													</div>
													<div class="txt">
														<a href="<?php echo $file['file'];?>" target="_blank"><?php echo $file['title'];?></a>
													</div>
												</li>
<?php endif; ?>
<?php endforeach; ?>
											</ul>
										</div>
										<div class="attached-photoes">
											<div class="title">
												<h4>მიმაგრებული ფოტოსურათები</h4>
											</div>
											<ul class="list">
<?php foreach($files as $file) : ?>   
<?php $ext = strtolower(substr(strrchr($file['file'], '.'), 1)); ?>
<?php if (in_array($ext, c('thumbnail.exts'))) : ?>
												<li>
													<a href="<?php echo $file['file'];?>" class="popup-img">
														<img src="<?php echo $file['file'];?>" width="150" height="100" alt="">
													</a>
												</li>
<?php endif; ?>
<?php endforeach; ?>
											</ul>
										</div>
<?php endif; ?>
										<div class="blog-post-footer fix">
											<a href="javascript:backPage();" class="back-btn">უკან</a>
<script>
	function backPage() {
		 window.history.back();
	}
</script>
<?php require("_website/templates/widgets/social.php");?>
										</div>
									</div>
									<div class="clear"></div>
			   					</div>
			   				</div>
			   			</div>
			   		</div>
		  			<!-- \\ widget \\ -->
			   </div>
			   <div class="blog-sidebar-r">
<?php require("_website/templates/widgets/search.php");?>
<?php require("_website/templates/widgets/new_articles.php");?>
		  			<div class="blog-widget tags-widget">
	  					<h2>თეგები</h2>
	  					<div class="tags-row">
<?php 
	$tags = explode(",", $meta_keys);
	foreach($tags as $tag) :
?>	
							<a href="<?php echo href(31).'?q='.$tag;?>"><?php echo $tag;?></a>
<?php
	endforeach;
?>
	  					</div>
	  					<div class="clear"></div>
	  				</div>
	
	
	
				</div>
				<div class="clear"></div>    
          </div>
       	  <div class="clear"></div>
    </div>	
</div>

<?php require("_website/templates/widgets/popular.php");?>
<script type="text/javascript">
</script>