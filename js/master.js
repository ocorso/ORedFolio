/*                                     oooo                                .
                                       `888                              .o8
   .ooooo.   oooo d8b   .ooooo.    .ooooo88        ooo. .oo.   .ooooo. .o888oo
  d88' `88b  `888""8P  d88' `88b  d88' `88b       `888P"Y88b  d88' `88b  888
  888   888   888      888"""888  888   888        888   888  888"""888  888
  888   888   888      888        888   888   .o.  888   888  888        888 .
  `Y8bod8P'  d888b     `Y8bod8P'  `Y8bod8P8o  Y8P o888o o888o `Y8bod8P'  "888"

*/


// =======================================================================================================================
// ================ @Declarations
// =======================================================================================================================

var main = 	{};

main.routes 			= {};
main.settings 			= {};
main.sidebar 			= {};
main.nav 				= {};
main.search 			= {};
main.content 			= {};
main.address 			= {};
main.history 			= {};
main.post 				= {};
main.category 			= {};
main.subcategory 		= {};
main.preloader 			= {};
main.video 				= {};
main.bitly 				= {};
main.timers				= {};
main.filters 			= {};
main.isotope			= {};
main.isotope.config		= {};
main.detail 			= {};
main.detail.asset 		= {};
main.pages 				= {};
main.soundcloud 		= {};


// =======================================================================================================================
// ================ @Defaults
// =======================================================================================================================

main.isotope.config.itemSelector				= '.post';
main.isotope.config.sortBy 						= 'id';
main.isotope.config.itemPositionDataEnabled		= true;
main.isotope.config.sortAscending 				= true;
main.isotope.config.masonry 					= { columnWidth: 210 };
main.isotope.config.containerStyle				= { position: 'relative', overflow: 'visible' };
main.isotope.config.getSortData 				= { id : function( $elem ) { return parseInt($elem.attr("data-id"),10); } };
main.isotope.config.containerStyle				= { position: 'relative', overflow: 'hidden' };

main.domain						= document.domain;
main.base_url					= base_url;
main.local 						= main.domain == "oredfolio.dev" || main.domain =="ored.dev" ? true : false;
main.address.pathNames 			= [];

main.search.current				= ["animal", "awesome"];

main.post.currentId	 			= "";

main.settings.defaultEasing		= "swing";
main.settings.defaultDuration	= 200;
main.settings.ipad 				= false;
main.settings.iphone 			= false;
main.settings.android 			= false;
main.settings.mac 				= false;
main.settings.windows 			= false;

main.routes.postVideosDir		= "https://storage.googleapis.com/ored-studios.appspot.com/media/video/";
main.routes.postImagesDir 		= "https://storage.googleapis.com/ored-studios.appspot.com/media/images/";
//main.routes.postImagesDir 		= "http://media.click3x.com/images/";//oc: could be .dev if you turn on a local media server
main.routes.posts 				= "data/posts.json";
main.routes.detail 				= "data/detail.json";

main.bitly.url					= "https://api-ssl.bitly.com/v3/shorten?access_token=ce1cb3356808fcf009cda750ef8f1ce940c592a8&longUrl=";
main.bitly.current				= "";

main.filters.page				= "";
main.filters.categories 		= [];

main.detail.asset.currentId		= "1";
main.detail.currentFileName 	= "";

main.preloader.opts 			=	{
										lines: 10, // The number of lines to draw
										length: 1, // The length of each line
										width: 4, // The line thickness
										radius: 14, // The radius of the inner circle
										corners: 1, // Corner roundness (0..1)
										rotate: 0, // The rotation offset
										direction: 1, // 1: clockwise, -1: counterclockwise
										color: '#666', // #rgb or #rrggbb
										speed: 1.5, // Rounds per second
										trail: 33, // Afterglow percentage
										shadow: false, // Whether to render a shadow
										hwaccel: true, // Whether to use hardware acceleration
										className: 'spinner', // The CSS class to assign to the spinner
										zIndex: 2e9, // The z-index (defaults to 2000000000)
									};

main.soundcloud.isInit 				= false;
main.soundcloud.waitToUpdateDetail 	= false;

// =======================================================================================================================
// ================ @Doc Ready
// =======================================================================================================================
jQuery( function($){
	console.log("-- Doc Ready Start --");
	console.log(" - window width - : ", $(window).width());	
	console.log(" - domain - : ", main.domain );
	console.log(" - local - : ", main.local );	
	console.log("page: ",start_page);

  	//Determine OS.
  	main.settings.agent = navigator.userAgent;
  	main.settings.addClassForMobile();
	
	//Change the grid size for iPhone.
	if(main.settings.iphone)
		main.isotope.config.masonry.columnWidth = 150;

	//oc: get tracks if we're on the music page and wait to init address or just init main
	if(start_page == "music")	
			main.soundcloud.init(main.init);

	main.init();

//    console.log(" - agent - : ", main.settings.agent);
//	console.log(" - iphone - : ", main.settings.iphone);
	console.log("-- Doc Ready End --");

	//initial google analytics call
	if(!main.local)
		_gaq.push(['_trackPageview']);
});
// =======================================================================================================================
// ================ @Settings
// =======================================================================================================================
function isotopeComplete(){
	console.log("isotopeComplete");
	$("#content").fadeIn(main.loadImages);
}

main.settings.addClassForMobile = function(){
		if( main.settings.agent.match(/iPhone/i) || main.settings.agent.match(/iPod/i) ){
		main.settings.iphone = true;
		$("body").addClass("iPhone");
	}else if( main.settings.agent.match(/iPad/i) ){
		main.settings.ipad = true;
		$("body").addClass("iPad");
	}else if ( main.settings.agent.match(/Android/i) ){
		main.settings.android = true;
		$("body").addClass("Android");
	}else if( main.settings.agent.match(/Mac OS/i)){
		main.settings.mac = true;
		$("body").addClass("Mac");
	}else if( main.settings.agent.match(/Windows/i)){
		main.settings.windows = true;
		$("body").addClass("Windows");
	}
};

// =======================================================================================================================
// ================ @Main Methods
// =======================================================================================================================
main.init 		= function (){
	console.log("main.init")
	//init Address
	main.address.init();

	//Init Isotope.
    $("#content").isotope(main.isotope.config, isotopeComplete );

    //oc: add event handlers
    main.addEventHandlers();

    //call resize a tiny bit after page is resized.
    $(window).resize( function(){
		clearTimeout(main.timers.resize);
		main.timers.resize = setTimeout( main.onResize, 200 );
	});
};

main.loadImages = function (){

	console.log("Load Images");

	$(".post").each(function(){
		var post = $(this);

		var img = new Image();
		$(img).hide();
		post.append(img);

		img.onload = function() { $(this).fadeIn(0); console.log("image complete"); }

		if(post.attr("data-image") != undefined){
			//console.debug(post.attr("data-image"));
			img.src = post.attr("data-image");
		}
	});
};
main.content.reLayout 	= function ( $complete ){
	$('#content').isotope( 'reLayout', function(){
		console.log("-- ReLayout Complete --");

		if($complete != undefined)
			$complete();
	});
};

main.onResize	= function($e){
	console.log("window width: "+$(window).width());
	main.content.reLayout( function(){
		main.detail.scrollTop( function( $didscroll ){
			console.log("-- ScrollTop Complete -- : ", $didscroll);
		});
	});
};

main.applyFilters = function(){
	//var f = "." + main.filters.page + "." + main.filters.categories.join(".");
	var f = "." + main.filters.categories.join(".");
	console.log( "-- Applying Filters -- :",f );
	$("#content").isotope( { filter: f  }, main.applyFiltersComplete );
};

main.applyFiltersComplete = function(){
	console.log("-- Apply Filters Complete --");
	
	//check for asset id deep-link
	if( main.curPathLevels > 3 )
		main.detail.asset.currentId = main.address.pathNames[3];
	
	//check for post detail id deep-link
	if( main.curPathLevels > 2 ){
		main.post.currentId = main.address.pathNames[2];
		main.detail.init( parseInt( main.post.currentId , 10 ) );
	}
};


// =======================================================================================================================
// ================ @jQuery Address Methods
// =======================================================================================================================
    //Init Jquery Address.
main.address.init 	= function(){
	console.log("main.address.init")
    $.address.init( function( event ){ console.log(" - Init jQuery Address - : "); }).change(main.address.change);
};

main.address.change	= function (){
	console.log("-- jQuery Address Change -- : " + $.address.pathNames());

	main.address.pathNames 	= $.address.pathNames();
	main.curPathLevels 		= main.address.pathNames.length;
	var categoryChanged 	= false;
	var pageChanged 		= false;
	var detailChanged 		= false;

	//hide dropdown of current category filter
	$(".portfolio-categories div:last-child").css("display","none");

	//check page
	if( main.curPathLevels >= 1){
		if(main.filters.page != main.address.pathNames[0] ){
			main.filters.page = main.address.pathNames[0];
			pageChanged = true;
		}
	} else {
		if( main.filters.page != start_page ){
			main.filters.page = start_page;
			pageChanged = true;
		}
	}
	
	//check category
	if( main.curPathLevels >= 2 ){
		console.log("category here");
		console.log( main.filters.categories.join("-") + " :: " + main.address.pathNames[1] );

		if( main.filters.categories.join("-") != main.address.pathNames[1] ){
			main.filters.categories = main.address.pathNames[1].split("-");
			categoryChanged 		= true;
		}
	} else {
		var num_categories 		= $(".page-header[data-page='" + main.filters.page + "'] .category-menu li").length;
		var default_category 	= "all";
		
		if(num_categories != 0){
			default_category 	= $(".page-header[data-page='" + main.filters.page + "'] .category-menu li:first-child a").attr("data-id");
		}

		if(start_category != undefined && start_category != ""){
			default_category 	= start_category;
		}

		if( main.filters.categories != [default_category] ){
			main.filters.categories = [default_category];
			categoryChanged = true;
		}
	}
	
	//see if we have to close the detail
	if( main.curPathLevels < 3 || main.post.currentId != main.address.pathNames[2] || categoryChanged == true || pageChanged == true ){
		if($("#post-detail").hasClass("active")){
			console.log("closing details");
			main.detail.reset();
		}
	}
	
	//reset post id if it's not given
	if(main.curPathLevels < 3){
		main.post.currentId = "";
	}
	
	//reset asset id if it's not given
	if(main.curPathLevels < 4){
		main.detail.asset.currentId = "1";
	}
	
	//apply filters if category or page changed. otherwise continue checking.
	if(categoryChanged == true || pageChanged == true){
		main.applyFilters();
	} else {
		
		//check for asset id
		if( main.curPathLevels > 3 && main.detail.asset.currentId != main.address.pathNames[3] ){
			main.detail.asset.currentId = main.address.pathNames[3];
		}
		
		//check for detail id
		if( main.curPathLevels > 2 && main.post.currentId != main.address.pathNames[2] ){
			main.post.currentId = main.address.pathNames[2];
			detailChanged = true;
			
			main.detail.init( parseInt( main.post.currentId , 10 ) );
		}
		
		//change the asset if the detail isn't changing
		if(detailChanged == false && main.curPathLevels > 3){
			console.log("detail changed");

			main.detail.asset.select( parseInt( main.detail.asset.currentId ,10) );
		}
	}
	
	//Close the main nav after clicking if window is less than 800.
	if($("body").hasClass("nav-open") && $(window).width() < 800)
		setTimeout( main.nav.click, 450 );

	//google anaytics page view.
	if(!main.local){
		if(main.curPathLevels > 0){
			_gaq.push(['_trackPageview', main.address.pathNames.join("/")]);
		}
	}

	if(pageChanged)
		$("body").scrollTop(0);

	//show proper page header
	$(".page-header[data-page='" + main.filters.page + "']").show();
	
	//show category menu if needed
	if(main.filters.categories.length > 0){

		//set text
		$(".portfolio-categories div:first-child a.dropdown-toggle").text( main.filters.categories[0].replace("_"," ") );

		//show proper category menu
		$(".portfolio-categories div:last-child").css("display","block");


	}
}
// =======================================================================================================================
// ================ @Event Handler INIT
// =======================================================================================================================
main.addEventHandlers = function(){
	console.log("main.addEventHandlers");

	//add click handlers to posts
    $(".post:not(.detail)").each(function(){
    	$p = $(this);

    	if(!$p.attr("href")|| $p.attr("href") == undefined || $p.attr("href") == "" || $p.attr("href") == "#"){
			$p.click( main.post.click );
		} else {
			console.log("not adding click");
		}
    });

    //add click handler to catgories 
    $(".category-anchor").click( main.category.click );

    //Add Event Handlers.
    $('#nav_toggler').mousedown(function(){$(this).css('background-position', "0 -88px");}).mouseup(function(){$(this).css('background-position', "");});
	$('#nav_toggler').click( main.nav.click );
    

   	//close btn
    $("#post-detail .close-btn").click( main.detail.close );

    //esc to close
    $('body').keypress(function(e){  
    	var code = e.keyCode ? e.keyCode : e.which;
   
    	console.log("esc pressed;",code );
    	if(code == 27 ) main.detail.close(); 
    	});


    //remove rollover on iPhone.
    if(main.settings.iphone == true && rollover.hasClass("fixed")) $(".post .over-state").removeClass("fixed");


};
// =======================================================================================================================
// ================ @Click Event Handlers
// =======================================================================================================================

main.nav.click	= function(){
	$("body").toggleClass("nav-open");
	
	setTimeout(main.content.reLayout,350);
	
	return false;
};

main.category.click	= function($e){
	$a 		= $(this);
	var url = main.filters.page + "/"+ $a.attr("data-id") ;

	console.log("category click: ", url);
	$.address.value( url );

	$("#filter-menu").removeClass("open");
	$(".portfolio-categories div").removeClass("open");
	
	$e.preventDefault();
	return false;
};

main.post.click = function( $e ){

	$p = $(this);
	var url = main.filters.page + "/" + main.filters.categories.join("-") + "/" + $p.attr("data-id") ;
	console.log("post click",url);
	$.address.value( url );
	
	 return false;
}

main.detail.close		= function($e){
	console.log("main.detail.close");
	$.address.value( main.address.pathNames.slice(0,2).join( "/" ) );
	
	 return false;
};

main.detail.asset.click = function($e){
	var el = $(this);
	
	$.address.value( main.filters.page + "/" + main.filters.categories.join("-") + "/" + main.post.currentId + "/" + el.attr("data-id") );
	
	 return false;
};

main.trackOutboundLink = function(link, category, action) { 
 
	try { 
	_gaq.push(['_trackEvent', category , action]); 
	} catch(err){}
	 
	setTimeout(function() {
		window.open(link.href);
	}, 100);
};

// =======================================================================================================================
// ================ @Post Methods
// =======================================================================================================================

main.post.select = function( $data_id ){
	$("#content .post").each( function($i, $e){
		$p = $(this);
		
		if(parseInt($p.attr("data-id"),10) == $data_id ){
			main.currentPost = $p;
			
			if(!$p.hasClass("selected")){
				$p.addClass("selected");
			}
		}
	});
}

// =======================================================================================================================
// ================ @Post Detail Methods
// =======================================================================================================================

main.detail.init = function( $post_id ){
console.log("main.detail.init:", $post_id);	
	main.post.select( $post_id );
	
	//insert the details div
	var element = $( "#post-detail" )
		.attr({
			"data-id"	: $post_id + .5
		});
		
	if(!element.hasClass("active"))
		element.addClass("active");
	
	if(!element.hasClass(main.filters.page))
		element.addClass(main.filters.page);
		
	for(var i = 0; i<main.filters.categories.length; i++){
		var cat = main.filters.categories[i];

		if(!element.hasClass(cat))
			element.addClass(cat);
	}
		
	//oc: transition in when isotope is done.
	$("#content").isotope( 'insert', element, main.detail.onIsotopeComplete);
};
//oc: transition in when isotope is done.
main.detail.onIsotopeComplete = function(){
		var element = $( "#post-detail" );
		if(!element.hasClass("start")){
			element.addClass("start");
		}

		console.log("insert detail complete");
		console.log(element.position().top);
		console.log(main.currentPost.position().top);
		console.log(main.currentPost.height());
		
		if(	element.position().top - main.currentPost.position().top > 210 &&
			main.currentPost.height() == 200){
			element.css("margin-top","-215px");
			$("#post-detail-preloader").css("padding-bottom","210px");
		}
		
		$("#post-detail-preloader").spin(main.preloader.opts);

		if($('.selected').hasClass("soundcloud")){
			console.log("need SOUNDCLOUD Detail", main.soundcloud.isInit);
			if(main.soundcloud.isInit){

				main.soundcloud.updateDetail();
			
			}else{
				main.soundcloud.waitToUpdateDetail = true;
			}
		} else {
			main.detail.load( function(){
				console.log("detail loaded");
				setTimeout(main.detail.creationComplete,300);
			});
		}
	};

	main.detail.creationComplete = function(){
		console.log("main.detail.creationComplete");

		var element = $( "#post-detail" );
		if(!element.hasClass("ready")){
			element.addClass("ready");
		}

		main.content.reLayout(function(){
			if(!element.hasClass("complete")){
				element.addClass("complete");
			}

			main.detail.asset.select( parseInt( main.detail.asset.currentId ,10) );
		});

		main.detail.scrollTop(function(){});		
};

main.detail.load = function( $complete ){
	console.log("post id loading : " + main.post.currentId);
	
	$.ajax({
		url: data_directory + $(".post.selected").attr("data-detail-id") + ".json",
		type: "GET",
		dataType: "json",
		success: function( $data ) {			
			console.log("post detail load complete - " + $data.post_detail);	
			
			main.detail.update($data.post_detail);
			$complete();
		},
		error: function( $error ){
			console.log("load details failed : ", $error );
		}
	});
}

main.detail.reset = function(){
	main.detail.asset.deselectAll();
	
	$(".post.selected").removeClass("selected");
	
	var element = $( "#post-detail" ).attr({ "data-id"	: 1000000000000 });
		
	element.css("margin-top","-5px");
	$("#post-detail-preloader").css("padding-bottom","0");
		
	element.removeClass();
	element.addClass("post detail");

	$("#detail_sidebar li").remove();
			
	$("#content").isotope( 'insert', element );
}

main.detail.scrollTop = function( $complete ){
	//check to see if details are off screen
	var element 	= $("#post-detail"), topMargin = $("#content").position().top;
	elementHeight 	= element.height(),
	elementTop 		= element.position().top + topMargin,
	bodyTop 		= $("body").scrollTop(),
	elementBottom 	= elementTop-bodyTop+elementHeight,
	winHeight 		= $(window).height();
	
	console.log("checking scroll :: ", topMargin, elementBottom, winHeight);
			
	if(elementBottom > winHeight || (elementTop-bodyTop) < 0){
		if($("#post-detail").hasClass("active")){
			var destination = element.offset().top -70;
			console.log("SCROLL to ", destination);
			//$('body').animate({ scrollTop: destination},{duration: 400,specialEasing: {scrollTop: 'easeInOutCubic'}});
			$('body,html').animate({
			    	scrollTop: destination
				},
				{
			    	duration: 400,
			    	specialEasing: {
			    		scrollTop: 'easeInOutCubic'
			   	 	},
			    	complete: $complete(true)
				}
			);
		}
	} else {
		$complete(false);
	}
}

main.detail.update	= function ($p){
	console.log("update Post detail");
	
	$("#post-detail h1").html( $p.title != undefined &&  $p.title != "" ? $p.title : "&nbsp" );
	$("#post-detail h2").html( $p.client != undefined &&  $p.client != "" ? $p.client : "&nbsp" );
	$("#post_detail_main #detail_body").html( $p.description  );
		
	if($p.assets.length == 0){	
		$("#post-detail").addClass("no-assets");
	}else {
		if($p.assets.length == 1){
			$("#post-detail").addClass("single-asset");
		}
		$($p.assets).each( main.detail.buildRelatedAssets );
	}
	
	if($p.related_posts.length == 0){
		$("#post-detail").addClass("no-related-posts");
	}else{
		$($p.related_posts).each( main.detail.buildRelatedPosts );
	}
	
	if($p.related_links.length == 0){
		$("#post-detail").addClass("no-links");
	}else{
		$($p.related_links).each(main.detail.buildRelatedLinks);
	}

	//set custom headings if provided
	if($p.related_links_title != undefined){
		$("#post-detail #related_links h3").text($p.related_links_title);
	} else {
		$("#post-detail #related_links h3").text("Links");
	}

	if($p.related_posts_title != undefined){
		$("#post-detail #related_posts h3").text($p.related_posts_title);
	} else {
		$("#post-detail #related_posts h3").text("Related");
	}
}

main.detail.buildRelatedAssets	= function($i, $a){
	var item = $("<li />").attr({ "data-filename": $a.filename , "data-id":$a.id, "data-type":$a.media_type });
	
	var type = "jpg";

	//check for gif
	if($a.media_type != undefined && $a.media_type == "3")
		type = "gif";

	var img = $("<img />").attr("src", main.routes.postImagesDir + "200x200/" + $a.filename + "." + type ).appendTo(item);
	
	$(item).click(main.detail.asset.click);
	$("#related_assets").append(item);
};

main.detail.buildRelatedPosts	= function($i, $a){
	var item 	= $("<li />").attr({ "data-filename": $a.filename , "data-id":$a.id, "data-type":$a.media_type });
	var a		= $("<a />").attr({ "href": base_url + $a.page + "/" + "/#/" + $a.page + "/" + $a.category + "/" + $a.id}).appendTo(item);
	var img 	= $("<img />").attr("src", main.routes.postImagesDir + "200x200/" + $a.filename + ".jpg" ).appendTo(a);
	
	$("#related_posts").append(item);	
};

main.detail.buildRelatedLinks	= function($i, $a){
	var item 	= $("<li />").attr({ "data-filename": $a.filename , "data-id":$a.id, "data-type":$a.media_type });
	var a		= $("<a />").attr({ "href": $a.href,"target":"_blank", "onClick":"main.trackOutboundLink(this, 'Outbound Links', '"+ $a.href+"'); return false;"}).text( $a.title ).appendTo(item);
	
	$("#related_links").append(item);
};

// =================================================
// ================ @Detail Assets
// =================================================

main.detail.asset.select = function( $asset_id ){
	console.log("detail.asset.select: ", $asset_id);

	main.detail.asset.deselectAll();
	
	$("#related_assets li").each( function( $i, $e ){
		var $a = $(this);
		
		if( parseInt($a.attr("data-id"),10) == $asset_id){
			main.currentAsset = $a;
			
			if(!$a.hasClass("selected")){
				$a.addClass("selected");
			}
		}
	});
	
	if(main.currentAsset != undefined){
		switch( main.currentAsset.attr("data-type") ){
			case "1": 
				//video
				$("#video_player img").attr("src", main.routes.postImagesDir + "700x394/" + main.currentAsset.attr("data-filename") + ".jpg");
				$("iframe").hide();
				if( jQuery.browser.mozilla  ){
					$("video:nth-child(1)").attr("src",  main.routes.postVideosDir + main.currentAsset.attr("data-filename") + ".webm")
					.attr("type","video/webm");
				}else{
					$("video:nth-child(1)").attr("src", main.routes.postVideosDir + main.currentAsset.attr("data-filename") + ".mp4")
					.attr("type","video/mp4");
				}

				main.video.showPoster();
			break;
			case "2": 
				//jpg
				$("#post_detail_main #detail_image").attr("src", main.routes.postImagesDir + "700x394/" + main.currentAsset.attr("data-filename") + ".jpg");
			break;
			case "3": 
				//gif
				$("#post_detail_main #detail_image").attr("src", main.routes.postImagesDir + "700x394/" + main.currentAsset.attr("data-filename") + ".gif");
			break;
			case "4":
			$("iframe").show();
				//soundcloud
				var o = $("#post_detail_main iframe").replaceWith(main.soundcloud.getEmbedHTML(main.currentPost.attr('data-id')));
				if (o.length == 0){

					console.log("iframe not replaced. appending new");
					$("#post_detail_main").prepend(main.soundcloud.getEmbedHTML(main.currentPost.attr('data-id')));
				} 
				break;
			default:
				console.log("-- ERROR - No media type found --");
		}				
		var typeClass = "media-type-" + main.currentAsset.attr("data-type");
	}else{ console.error("ORED: CURRENT ASSET UNDEFINED");}

	

	if(!$("#post_detail_main").hasClass(typeClass)){
		$("#post_detail_main").addClass(typeClass);
	}
}

main.detail.asset.deselectAll = function(){
	main.video.stop();
	
	$("#related_assets li").removeClass("selected");

	$("#post_detail_main").removeClass();

	$("#video_player img").attr("src", base_url + "img/blank_img.jpg");
	$("#post_detail_main #detail_image").attr("src", base_url + "img/blank_img.jpg");
}

// =================================================
// ================ @Video Player Controls
// =================================================
main.video.stop = function(){
	console.log("--video.stop--");

	var v = _V_("video_player");
	
	v.pause();
	v.currentTime(0);
	v.posterImage.show();
	v.bigPlayButton.show();
}

main.video.showPoster = function(){
	console.log("--video.showPoster--");

	var v = _V_("video_player");
	v.posterImage.show();
	v.bigPlayButton.show();
}

// =================================================
// ================ @Soundcloud
// =================================================
main.soundcloud.init = function ($complete){
	console.log("sc init");
	var playlist_url = 'https://soundcloud.com/ocorso/sets/o-red-folio';//

	//SC.get('/resolve', { url: playlist_url }, function($playlist) {
	SC.get('/playlists/10225031', { format: "json" }, function($playlist) {
		console.log("sc get complete");
 		console.debug($playlist);
 		main.soundcloud.playlist 	= $playlist.tracks;
 		main.soundcloud.isInit		= true;
 		if (main.soundcloud.waitToUpdateDetail) {
 			main.soundcloud.waitToUpdateDetail = false;
 			main.soundcloud.updateDetail();
 		}//endif
	});
};
main.soundcloud.updateDetail = function(){
	console.log("main.soundcloud.updateDetail");
	main.detail.update(main.soundcloud.createDetailObject());
	setTimeout(main.detail.creationComplete,200);
};
main.soundcloud.createDetailObject = function(){
	var d 				= main.currentPost.data();
	var s 				= {};
	s.id 				= 1;
	s.media_type 		= "4";
	s.filename 			= "ored_sc";
	d.assets 			= [s];
	d.related_posts 	= [];
	d.related_links 	= [];
	d.description 		= main.soundcloud.getLyricsByIndex(d.index);
	//d.filename 			= "sc";
	console.debug(d);
	return d;
};

main.soundcloud.getEmbedHTML = function($id){
	console.log("main.soundcloud.getEmbedHTML: ", $id);
	var url 	= "https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F" + $id + "&amp;color=ff0000&amp;auto_play=false&amp;show_artwork=true";
	var iFrame 	= $("<iframe>");
	iFrame.width("100%");
	iFrame.height("163");
	iFrame.attr("src", url);
	return iFrame;
};

main.soundcloud.getLyricsByIndex = function($i){

	var songData 	= main.soundcloud.playlist[$i];
	//var lyrics 		= songData.description.replace("\n", "<br>");
	//lyrics 			= lyrics.replace("\r", "<br>");
	var lyrics 		= songData.description.replace(/\r?\n/g, '<br />');

	console.debug(lyrics);
	return lyrics;

};