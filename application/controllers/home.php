<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($pageId, $categoryId = "_all", $postId = "-1")
	{
		//Load settings from config file
		$this->load->config('soundcloud');

		$main_data_s 	= file_get_contents( base_url()."data/".SITE."/main.json");
		$main_data_json = json_decode( $main_data_s, true );
		$pages 			= $main_data_json["pages"];
		$suggestions 	= $main_data_json["suggestions"];
		$posts 			= ($pageId != "music") ? $this->posts(0,$pageId,$categoryId) : array_merge($this->posts(0,$pageId,$categoryId), $this->getSongs());
		//print_r($posts);


		$this->load->view(	'home_view', 
							array( 	"pages"=>$pages, 
									"suggestions"=>$suggestions, 
									"posts"=>$posts, 
									"page_id"=>$pageId, 
									"category_id"=>$categoryId,
									"soundcloud_id"=>$this->config->item('soundcloud_key'),
									"post_id"=>$postId
								) 
							);
	}
	public function songs($band){
		//$this->load->
	}
	public function posts( $givemejson, $pages = "", $categories = ""){
		$this->load->model("posts_model");

		$result = $this->posts_model->get( array("pages"=>$pages, "categories"=>$categories) );

		if($givemejson){
			$result = json_encode($result);
		}

		return $result;
	}

	public function getSongs(){ 


		//prepare SoundCloud API Request to get playlist
		//Load access token from model
		$this->load->model('token_model');
		$result = $this->token_model->get_entry();

		print_r("<h2>Token info</h2><pre>");
		print_r($result);
		print_r("</pre>");

		//Load settings from config file
		$this->load->config('soundcloud');

		// Create a stream
		$opts = [
			"http" => [
				"method" => "GET",
				"header" => "accept: application/json; charset=utf-8\r\n" .
					"Authorization: Bearer ".$result[0]->access_token."\r\n"
			]
		];

		// DOCS: https://www.php.net/manual/en/function.stream-context-create.php
		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		// DOCS: https://www.php.net/manual/en/function.file-get-contents.php
		$playlist = json_decode(file_get_contents($this->config->item('soundcloud_playlist_route'), false, $context));

		//print_r($playlist);
		$songs 		= array();
		$i = 0;
		foreach ($playlist->tracks as $s){
			$song 					= new stdClass();
			$song->index 			= $i;	
			$song->id 				= $s->id;
			$song->media_type 		= 4;
			$song->size				= "200x200";
			$song->title			= $s->title;
			$song->client			= $s->user->username;
			$song->lyrics			= $s->description;
			$song->description 		= "Have a listen.";
			$song->detail_name		= "";
			$song->filename			= "";
			$song->tags				= "soundcloud";
			$song->categories		= "_all " . $s->user->permalink . " " . str_replace('"', "", $s->tag_list);
			$song->pages			= "music";
			$song->overstatestyle	= "";
			$song->href				= "";
			$song->src				= str_replace("large", "t300x300", $s->artwork_url);
				
			$songs[] = $song;
			$i++;
		}
//print_r($songs);
		return $songs;
	}//end function 
}

/* End of file home.php */
/* Location: ./application/controllers/welcome.php */