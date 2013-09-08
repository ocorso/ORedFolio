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

main.facebook  			= {};
main.facebook.share 	= {};
main.facebook.feed 		= "";

main.twitter 			= {};
main.twitter.share 		= {};
main.twitter.settings 	= {};
main.twitter.postdata 	= {};

main.pages 				= {};



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
main.local 						= main.domain == "oredfolio.dev" ? true : false;
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

main.routes.postVideosDir		= "http://media.click3x.com/video/";
main.routes.postImagesDir 		= "http://media.click3x.com/images/";
main.routes.posts 				= "data/posts.json";
main.routes.detail 				= "data/detail.json";

main.bitly.url					= "https://api-ssl.bitly.com/v3/shorten?access_token=ce1cb3356808fcf009cda750ef8f1ce940c592a8&longUrl=";
main.bitly.current				= "";

main.filters.page				= "";
main.filters.categories 		= [];

main.detail.asset.currentId		= "1";
main.detail.currentFileName 	= "";

main.facebook.settings			= 	{ appid: ( fb_app_id ) };
main.facebook.postdata 			= 	{
										method: 'feed',
										display: 'popup',
										link: '',
										picture: '',
										name: '',
										caption: '',
										description: ''
									};

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

// =======================================================================================================================
// ================ @Doc Ready
// =======================================================================================================================
function isotopeComplete(){
	$("#content").fadeIn(loadImages);
}
function loadImages(){

	console.log("Load Images");

	$(".post").each(function(){
		var post = $(this);

		var img = new Image();
		$(img).hide();
		post.append(img);

		img.onload = function() { $(this).fadeIn(0); console.log("image complete") }

		if(post.attr("data-image") != undefined)
			img.src = post.attr("data-image");
	});
}

jQuery( function($){
	console.log("-- Doc Ready Start --");
	console.log(" - window width - : ", $(window).width());	
	console.log(" - domain - : ", main.domain );
	console.log(" - local - : ", main.local );	

  	//Determine OS.
  	main.settings.agent = navigator.userAgent;
  
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
	
	//Change the grid size for iPhone.
	if(main.settings.iphone)
		main.isotope.config.masonry.columnWidth = 150;

	//Init Isotope.
    $("#content").isotope(main.isotope.config, isotopeComplete );
    
    //Init Jquery Address.
    $.address.init( function( event ){
    	console.log(" - Init jQuery Address - : ");
    }).change(main.address.change);

    //Add Event Handlers.
    $('#nav_toggler').mousedown(function(){$(this).css('background-position', "0 -88px");}).mouseup(function(){$(this).css('background-position', "");});
	$('#nav_toggler').click( main.nav.click );
    $("#post-detail .close-btn").click( main.detail.close );
    $(".page-header ul.dropdown-menu.subcategory-menu li a").click( main.subcategory.click );


    $(".post:not(.detail)").each(function(){
    	$p = $(this);

    	if(!$p.attr("href")|| $p.attr("href") == undefined || $p.attr("href") == ""){
			$p.click( main.post.click );
		} else {
			console.log("not adding click");
		}
    });

    if(main.settings.iphone == true && rollover.hasClass("fixed"))
		$(".post .over-state").removeClass("fixed");

    $(window).resize( function(){
		clearTimeout(main.timers.resize);
		main.timers.resize = setTimeout( main.onResize, 200 );
	});

    console.log(" - agent - : ", main.settings.agent);
	console.log(" - iphone - : ", main.settings.iphone);
	console.log("-- Doc Ready End --");

	//initial google analytics call
	if(!main.local)
		_gaq.push(['_trackPageview']);
});


// =======================================================================================================================
// ================ @Main Methods
// =======================================================================================================================

main.content.reLayout 	= function ( $complete ){
	$('#content').isotope( 'reLayout', function(){
		console.log("-- ReLayout Complete --");

		if($complete != undefined)
			$complete();
	});
};

main.onResize	= function($e){
	main.content.reLayout( function(){
		main.detail.scrollTop( function( $didscroll ){
			console.log("-- ScrollTop Complete -- : ", $didscroll);
		});
	});
};

main.applyFilters = function(){
	console.log( "-- Applying Filters -- :" + "." + main.filters.page + "." + main.filters.categories.join(".") );
	
	$("#content").isotope( { filter: "." + main.filters.page + "." + main.filters.categories.join(".")  }, main.applyFiltersComplete );
}

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
}

// =======================================================================================================================
// ================ @jQuery Address Methods
// =======================================================================================================================

main.address.change	= function (){
	console.log("-- jQuery Address Change -- : " + $.address.pathNames());
	console.log("-- categorieswithsubcategories -- : " + categorieswithsubcategories);

	main.address.pathNames 	=  $.address.pathNames();
	main.curPathLevels 		= main.address.pathNames.length;
	
	var categoryChanged 	= false;
	var pageChanged 		= false;
	var detailChanged 		= false;

	$("#portfolio-categories div:last-child").css("display","none");
	$(".page-header .subcategory-menu").css("opacity","0").css("z-index","-1");
	
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
			categoryChanged = true;
		}
	} else {
		var num_categories = $(".page-header[data-page='" + main.filters.page + "'] .category-menu li").length;
		var default_category = "all";
		
		if(num_categories != 0){
			default_category = $(".page-header[data-page='" + main.filters.page + "'] .category-menu li:first-child a").attr("data-id");
		}

		if(start_category != undefined && start_category != ""){
			default_category = start_category;
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
	
	//show subcategory menu if needed
	if(main.filters.categories.length > 0){
		console.log( categorieswithsubcategories.indexOf(main.filters.categories[0]) );

		$("#portfolio-categories div:first-child a.dropdown-toggle").text( main.filters.categories[0].replace("_"," ") );

		if(main.filters.categories.length > 1){
			$("#portfolio-categories div:last-child a.dropdown-toggle").text( main.filters.categories[1].replace("_"," ") );
		} else {
			$("#portfolio-categories div:last-child a.dropdown-toggle").text( "all" );
		}

		if(categorieswithsubcategories.indexOf(main.filters.categories[0]) != -1 && main.filters.categories[0] != "all"){
			$(".subcategory-menu[data-category='" + main.filters.categories[0] + "']").css("opacity","1").css("z-index","1000");
			$("#portfolio-categories div:last-child").css("display","block");
		}
	}
}

// =======================================================================================================================
// ================ @Click Event Handlers
// =======================================================================================================================

main.nav.click	= function(){
	$("body").toggleClass("nav-open");
	
	setTimeout(main.content.reLayout,350);
	
	return false;
};

main.category.click	= function(){
	//$a = $(this);
	
	//$.address.value( main.filters.page + "/" + $a.attr("data-id") );

	//$("#filter-menu").removeClass("open");
	//$(".#page-header div").removeClass("open");
	
	// return false;
};

main.subcategory.click	= function(){
	$a = $(this);
	
	if(!main.filters.categories || main.filters.categories.length == 0){
		main.filters.categories = ["all"]
	}

	$.address.value( main.filters.page + "/" + main.filters.categories[0] + "-" + $a.attr("data-id") );
	
	$("#filter-menu").removeClass("open");
	$(".#page-header div").removeClass("open");

	 return false;
};


main.post.click = function( $e ){
	$p = $(this);
	$.address.value( main.filters.page + "/" + main.filters.categories.join("-") + "/" + $p.attr("data-id") );
	
	 return false;
}

main.detail.close		= function($e){
	$.address.value( main.address.pathNames.slice(0,2).join( "/" ) );
	
	 return false;
};

main.detail.asset.click = function($e){
	var el = $(this);
	
	$.address.value( main.filters.page + "/" + main.filters.categories.join("-") + "/" + main.post.currentId + "/" + el.attr("data-id") );
	
	 return false;
}


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
		
	//transition in
	$("#content").isotope( 'insert', element, function(){
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

		if(element.hasClass("facebook") || element.hasClass("twitter")){
			if(!element.hasClass("ready")){
				element.addClass("ready");
			}

			setTimeout(function(){ 
				main.content.reLayout(function(){
					if(!element.hasClass("complete")){
						element.addClass("complete");
					}

					main.detail.asset.select( parseInt( main.detail.asset.currentId ,10) );
				});

				main.detail.scrollTop(function(){});
			},200);
		} else {
			main.detail.load( function(){
				if(!element.hasClass("ready")){
					element.addClass("ready");
				}

				setTimeout(function(){ 
					main.content.reLayout(function(){
						if(!element.hasClass("complete")){
							element.addClass("complete");
						}

						main.detail.asset.select( parseInt( main.detail.asset.currentId ,10) );
					});

					main.detail.scrollTop(function(){});
				},300);
			});
		}
	});
}

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
			$('body').animate({
			    	scrollTop: element.offset().top -70
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
	var a		= $("<a />").attr({ "href": base_url + "index.php/" + $a.page + "/" + $a.category + "/#/" + $a.page + "/" + $a.category + "/" + $a.id}).appendTo(item);
	var img 	= $("<img />").attr("src", main.routes.postImagesDir + "200x200/" + $a.filename + ".jpg" ).appendTo(a);
	
	$("#related_posts").append(item);	
};

main.detail.buildRelatedLinks	= function($i, $a){
	var item 	= $("<li />").attr({ "data-filename": $a.filename , "data-id":$a.id, "data-type":$a.media_type });
	var a		= $("<a />").attr({ "href": $a.href,"target":"_blank"}).text( $a.title ).appendTo(item);
	
	$("#related_links").append(item);
};

// =================================================
// ================ @Detail Assets
// =================================================

main.detail.asset.select = function( $asset_id ){
	console.log("detail.asset.select");

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
			default:
				console.log("-- ERROR - No media type found --");
		}				
		var typeClass = "media-type-" + main.currentAsset.attr("data-type");
	}

	

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

