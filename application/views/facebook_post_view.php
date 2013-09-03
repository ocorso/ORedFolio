<?php
 	$title = $post["from"]["name"];
 	$message = "";
 	$fb_ost_id = $post["id"];

 	if( !empty($post["picture"]) )
 		$imagepath = $post["picture"];
 	else 
 		$imagepath = $this->config->item("media_url")."images/200x200/facebook_icon.jpg";

 	if( !empty($post["message"]) )
 		$message = $post["message"];
?>

<a>
	<div class="fbpost clearfix">
		<div class="fbpost-header clearfix">
			<img src="<?php echo base_url(). "img/fbicon_".SITE.".jpg"; ?>" width="50" height="50"/>
			<h3><?php echo $title; ?></h3>
			<button onclick="main.facebook.initLike(this)" data-id="<?php echo $fb_ost_id; ?>" traget="_blank">Like</button>
		</div>
		<div class="fbpost-content">
			<img src="<?php echo $imagepath ?>"/>
			<p><?php echo $message; ?></p>
		</div>
	</div>
</a>