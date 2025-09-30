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

	<!--Header Bar-->
	<?php $this->load->view(SITE.'/'.SITE."_header_view")?>
	<!--End Header Bar-->

      <!--Sidebar Navigation-->
   	<?php $this->load->view("sidebar_view")?>
	<!-- End Sidebar Navigation-->

    <!-- Main Content -->
	<div id="main">   

  		<!-- Chat Wrapper Container --> 
		<div id="chat-wrapper">

      <div class="chat-container">
        <header class="chat-header">
            <h3>O Red Chatbot</h3>
        </header>
        <div class="chat-messages" id="chat-messages">
            </div>
        <form class="chat-input-form" id="chat-input-form">
            <input type="text" id="user-input" placeholder="Type your message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
    </div> <!-- End Content Div -->
</div> <!-- End Main Div -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('chat-input-form');
    const input = document.getElementById('user-input');
    const messages = document.getElementById('chat-messages');

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const userText = input.value.trim();
        if (userText !== '') {
            appendMessage(userText, 'user-message');
            input.value = '';
            // Simulate a bot response after a short delay
            setTimeout(() => {
                const botResponse = generateBotResponse(userText);
                appendMessage(botResponse, 'bot-message');
            }, 500);
        }
    });

    function appendMessage(text, className) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add(className);
        messageDiv.textContent = text;
        messages.appendChild(messageDiv);
        messages.scrollTop = messages.scrollHeight; // Auto-scroll to the latest message
    }

    function generateBotResponse(userMessage) {
        const lowerCaseMessage = userMessage.toLowerCase();
        
        if (lowerCaseMessage.includes('hello') || lowerCaseMessage.includes('hi')) {
            return "Hello there! How can I help you today?";
        } else if (lowerCaseMessage.includes('how are you')) {
            return "I'm just a program, but I'm doing great! Thanks for asking.";
        } else if (lowerCaseMessage.includes('name')) {
            return "I don't have a name, but you can call me Chatbot.";
        } else if (lowerCaseMessage.includes('help')) {
            return "I can answer basic questions. Try asking about my name or how I am.";
        } else {
            return "I'm sorry, I don't understand that. Can you rephrase your question?";
        }
    }
});
    </script>
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