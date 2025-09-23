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
        <link rel="shortcut icon" href="favicon.ico" />
		<!-- Apple Device Icons -->
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-57x57-precomposed" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-72x72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-114x114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url(); ?>img/vendor/apple/apple-touch-icon-144x144-precomposed.png" />
   		
    <!-- jQuery --> 
    <script src="<?= base_url(); ?>js/vendor/jquery-1.9.0.min.js"></script>
    <script src="<?= base_url(); ?>js/vendor/jquery-migrate-1.1.1.min.js"></script>
    <script src="<?= base_url(); ?>js/vendor/jquery.easing.1.3.js"></script>

    <!-- Page Scripts --> 
    <script type="text/javascript">

      var base_url 		= "<?= base_url(); ?>";
      var data_directory 	= "<?= base_url().'data/'.SITE.'/'; ?>";
      var start_page 		= "<?= $page_id; ?>";
      var start_category 	= "<?= $category_id; ?>";
      var post_id 		= "<?= $post_id; ?>";

    </script>
      <!-- Isotope --> 
      <script src="<?= base_url(); ?>js/vendor/jquery.isotope.min.js"></script>

      <!-- jQuery Address --> 
      <script src="<?= base_url(); ?>js/vendor/jquery.address-1.5.js"></script>

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