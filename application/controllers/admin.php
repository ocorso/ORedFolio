<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		echo "<h1>Hi O <span style='color:red; font-weight:bold;'> Red</span> Admin </h1>";
	
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

		print_r("<h2>Playlist Info</h2>");
		//$playlist 	= json_decode(file_get_contents($this->config->item('soundcloud_playlist_route')));
		foreach ($playlist->tracks as $s){
			print_r("<li>".$s->title . "</li>" );
		}

	}

	public function populate()
	{
		$posts_s = file_get_contents( base_url()."data/".SITE."/posts.json");
		$posts_json = json_decode( $posts_s, true );
		$posts = $posts_json["posts"];

		$this->load->model("posts_model");
		$this->fields = $this->posts_model->fields();

		foreach($posts as $post){
			$post_data = array(
				'id' 							=> isset($post["id"]) ? $post["id"] : "",
				'media_type' 					=> isset($post["media_type"]) ? $post["media_type"] : "",
				'size'							=> isset($post["size"]) ? $post["size"] : "",
				'title'							=> isset($post["title"]) ? $post["title"] : "",
				'client'						=> isset($post["client"]) ? $post["client"] : "",
				'description'					=> isset($post["description"]) ? $post["description"] : "",
				'detail_name'					=> isset($post["detail_name"]) ? $post["detail_name"] : "",
				'filename'						=> isset($post["filename"]) ? $post["filename"] : "",
				'tags'							=> isset($post["tags"]) ? implode(" ", $post["tags"]) : "",
				'categories'					=> isset($post["categories"]) ? implode(" ", $post["categories"]) : "",
				'pages'							=> isset($post["pages"]) ? implode(" ", $post["pages"]) : "",
				'overstatestyle'				=> isset($post["overstatestyle"]) ? $post["overstatestyle"] : "",
				'href'							=> isset($post["href"]) ? $post["href"] : ""
			);

			$this->posts_model->add($post_data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */