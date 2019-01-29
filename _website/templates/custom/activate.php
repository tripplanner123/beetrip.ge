<?php 
$sql = "UPDATE `site_users` SET `active`=1, `random`='' WHERE `random`='".(int)$_GET["a"]."'";
db_query($sql);
?>
<div style="clear:both"></div>
<div style="width:100%; background-color: #f1f9f5; padding: 220px 0; text-align: center;">
	<p style="width: 450px; margin: auto"><?=l("youraccountisactivated")?></p>
</div>