<!DOCTYPE html> <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8
lt-ie7"> <![endif]--> <!--[if IE 7]> <html class="no-js lt-ie9 lt- ie8">
<![endif]--> <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<!--
                                       oooo                                .
                                       `888                              .o8
   .ooooo.   oooo d8b   .ooooo.    .ooooo88        ooo. .oo.   .ooooo. .o888oo
  d88' `88b  `888""8P  d88' `88b  d88' `88b       `888P"Y88b  d88' `88b  888
  888   888   888      888"""888  888   888        888   888  888"""888  888
  888   888   888      888        888   888   .o.  888   888  888        888 .
  `Y8bod8P'  d888b     `Y8bod8P'  `Y8bod8P8o  Y8P o888o o888o `Y8bod8P'  "888"

-->
	<head>
		<meta charset="utf-8">        
		<meta http- equiv="X-UA- Compatible" content="IE=edge,chrome=1">
		<title><?= SITE_TITLE; ?></title>
		<meta name="description" content="<?= SITE_DESCRIPTION; ?>">         
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/><!--320-->
		
		<!-- Apple Device Icons -->
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-57x57-precomposed" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-72x72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-114x114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-144x144-precomposed.png" />

		<!-- Bootstrap Styles -->
	    <link rel="stylesheet" href="<?= base_url(); ?>css/vendor/bootstrap.min.css">
	    <link rel="stylesheet" href="<?= base_url(); ?>css/vendor/bootstrap-responsive.min.css">

	    <!-- Custom Styles -->
	    <link rel="stylesheet" href="<?= base_url(); ?>css/fonts.css">
	    <link rel="stylesheet" href="<?= base_url(); ?>css/master.css">
	    
	    <link rel="stylesheet" href="<?= base_url(); ?>css/<?= SITE; ?>_main.css">

	    <link rel="stylesheet" href="<?= base_url(); ?>css/responsive.css">
	    <link rel="stylesheet" href="<?= base_url(); ?>css/vendor/video-js.css" rel="stylesheet">

	    <!-- Modernizer Styles -->
	    <script src="<?= base_url(); ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>

    <body>

 	<?php $this->load->library('user_agent'); ?>
 	
	<!--[if lt IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->

	<!--[if gte IE 9]>
	<style type="text/css">
		.gradient {
			filter: none;
		}
	</style>
	<![endif]-->

	<?php 
	function checkForSubCat($categories){
		$hassub = false;
		foreach ($categories as $value) {
			if(!empty($value["subcategories"])){
				$hassub = true;
				break;
			}
		}
		return $hassub;
	}
	?>

	<!--Header Bar-->
	<?php $this->load->view(SITE.'/'.SITE."_header_view")?>
	<!--End Header Bar-->

    <!--Sidebar Navigation-->
   	<?php $this->load->view("sidebar_view")?>
	<!-- End Sidebar Navigation-->

    <!-- Main Content -->
	<div id="main">   
		<!-- Page Header --> 
			<div class="page-header" data-page="_all" style="display:none">
				<h1></h1>
			</div>
			<?php foreach ($pages as $value): ?>
				<div class="page-header clearfix" data-page="<?= $value["id"]; ?>" style="display:none">
					<h1><?= $value["heading"]; ?></h1>
				
					<div class="portfolio-categories dropdown">
						<div>
							<?php 
								if(!empty($value["categories"]))
									$categories = $value["categories"];
								else if( isset($categories) ) unset($categories);
								
								if(isset($categories)) : ?>
									<?php $hassubcat = checkForSubCat($categories)?>
									<span>showing</span>
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">All</a>
									<ul class="dropdown-menu category-menu" role="menu">
										<?php foreach($categories as $cval): ?>
											<li><a class="category-anchor" data-id="<?= $cval["id"]; ?>" data-filter=".<?= $cval["id"]; ?>" href="<?= base_url().$value["id"]."/".$cval["id"]; ?>"><?= $cval["label"]; ?></a></li>
										<?php endforeach ?>
							 		</ul>
							 	<?php endif ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		
		<!-- End Page Header --> 

		<!-- Isotope Container --> 
		<div id="content">
			<!--posts-->
			<?php foreach ($posts as $post): ?>
			<?php
			 	$image_ext 		= ".jpg";
			 	$size 			= ($this->agent->is_mobile) ? "200x200" : $post->size;
			 	if( !empty($post->media_type) && $post->media_type == "3") 
			 		$image_ext 	= ".gif";
			 	$imagepath 		= $post->tags == "soundcloud" ? $post->src : $this->config->item("media_url")."images/".$size."/".$post->filename.$image_ext;
			 	$classes 		= "post "."p".$size." ".$post->pages." ".$post->categories;
			 	if($post->tags == "soundcloud") $classes .= " soundcloud";
			 	$overstatestyle = "over-state";
			 	$detail_name 	= "";
			 	$href	 		= "#";

			 	if(!empty($post->href))
			 		$href = $post->href;

			 	if(!empty($post->detail_name))
			 		$detail_name = $post->detail_name;

		 		if(!empty($post->overstatestyle) && !$this->agent->is_mobile)
					$overstatestyle .= " ".$post->overstatestyle;				
			 ?>
<a href="<?= $href; ?>" data-type="<?= $post->media_type; ?>" data-image="<?= $imagepath; ?>" data-id="<?= $post->id; ?>" data-title="<?= $post->title; ?>" data-client="<?= $post->client; ?>" data-detail-id="<?= $detail_name ?>" data-index="<?= $post->index; ?>" class="<?= $classes;?>">
					<div id="rollover" class="<?= $overstatestyle; ?>">
						<h1><?= $post->title; ?></h1>
						<p><?= $post->tags == "soundcloud" ? $post->client : $post->description; ?></p>
					</div>
				</a>
			<?php endforeach ?>
		</div>
		<!-- End Isotope Container --> 

		<!-- Post Detail --> 
	    <div id="post-detail" class="post detail">
	    	<div id="post-detail-preloader" class="preloader">
	    	</div>

			<div id="post-detail-content"  data-post-id="1000">
	           <div id="post_detail_header">
                	<a class="close-btn"></a>
                    <h1></h1>
                    <h2></h2>
	            </div>
	            <div id="post_detail_main">
	           
                    <img id="detail_image" src="" width="700" width="394">
                    <video id="video_player" class="video-js vjs-default-skin" controls preload="auto" width="700" height="394" poster="" data-setup="{}">
						<source src="" type='video/mp4' />
						<source src="" type='video/webm' />
						<source src="" type='video/ogg' />
					</video>
                    <div id="detail_body"></div>
	            </div>
	            <div id="detail_sidebar">
	                <ul id="related_assets">
					</ul>
					<ul id="related_links">
						<h3>Links</h3>
					</ul>
					<ul id="related_posts">
						<h3>Related</h3>
					</ul>
				</div>
			</div>
			
		</div>
		<!-- End Post Detail --> 
	</div>
	</div>
	<!-- End Main Content --> 

	<!-- Facebook Container --> 
	<div id="fb-root"></div>
	<!-- End Facebook Container --> 


	<!-- Soundcloud Include --> 
<script src="//connect.soundcloud.com/sdk.js"></script>
<script>
  SC.initialize({
    client_id: "<?= $soundcloud_id; ?>",
    //redirect_uri: "<?= base_url(); ?>music/callback",
  });
</script>
	<!-- End Soundcloud Include --> 

	<!-- jQuery --> 
    <script src="<?= base_url(); ?>js/vendor/jquery-1.9.0.min.js"></script>
	<script src="<?= base_url(); ?>js/vendor/jquery-migrate-1.1.1.min.js"></script>
	<script src="<?= base_url(); ?>js/vendor/jquery.easing.1.3.js"></script>

	<!-- Page Scripts --> 
	<script type="text/javascript">
		var fb_app_id 		= "<?= FB_APP_ID; ?>";
		var base_url 		= "<?= base_url(); ?>";
		var data_directory 	= "<?= base_url().'data/'.SITE.'/'; ?>";
		var start_page 		= "<?= $page_id; ?>";
		var start_category 	= "<?= $category_id; ?>";
		var post_id 		= "<?= $post_id; ?>";
		var categorieswithsubcategories = [];
		$(".subcategory-menu").each(function(){
			$a = $(this);
			categorieswithsubcategories.push($a.attr("data-category"));
		})
	</script>
   	
   	<!-- Isotope --> 
    <script src="<?= base_url(); ?>js/vendor/jquery.isotope.min.js"></script>

    <!-- jQuery Address --> 
    <script src="<?= base_url(); ?>js/vendor/jquery.address-1.5.js"></script>

    <!-- Bootstrap --> 
    <script src="<?= base_url(); ?>js/vendor/bootstrap.min.js"></script>
   
   	<!-- Preloader --> 
    <script src="<?= base_url(); ?>js/vendor/spin.min.js"></script>
    <script src="<?= base_url(); ?>js/vendor/jquery.spin.js"></script>

 	<!-- Video JS --> 
    <script src="<?= base_url(); ?>js/vendor/video.js"></script>
	
	<!-- Custom --> 
    <script src="<?= base_url(); ?>js/plugins.js"></script>
    <script src="<?= base_url(); ?>js/master.js"></script>

    <!-- Google Analytics --> 
    <?php $this->load->view(SITE.'/'.SITE."_ga_view")?>
	<!-- End Google Analytics --> 
    <script>console.log("Environment: <?= ENVIRONMENT; ?>"); </script>
    <script>console.log("Site: <?= SITE; ?>"); </script>
    </body>
</html>