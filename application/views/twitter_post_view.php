<?php
 	$message = "";

 	$imagepath = $this->config->item("media_url")."images/200x200/twitter_icon.jpg";

 	if( !empty($post["text"]) )
 		$message = $post["text"];
?>

<a>
	<div class="fbpost clearfix">
		<div class="fbpost-header clearfix">
			<img src="<?php echo base_url(). "img/fbicon_".SITE.".jpg"; ?>" width="50" height="50"/>
			<h3><?php echo TWITTER_SCREEN_NAME; ?></h3>
		</div>
		<div class="fbpost-content">
			<img src="<?php echo $imagepath ?>"/>
			<p><?php echo $message; ?></p>
		</div>
	</div>
</a>