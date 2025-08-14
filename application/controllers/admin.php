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

	public function posts()
	{
		$posts 			= ($pageId != "music") ? $this->posts(0,$pageId,$categoryId) : array_merge($this->posts(0,$pageId,$categoryId), $this->getSongs());

		if (empty($posts)) {
			echo "<h2>No Posts Found</h2>";
			return;
		}

		// Define the fields explicitly as per your table structure
		$fields = [
			'id', 'pages', 'categories', 'tags', 'filename', 'detail_name',
			'title', 'client', 'description', 'size', 'media_type',
			'overstatestyle', 'href', 'index'
		];

		echo "<h2>All Posts</h2>";
		echo "<table border='1' cellpadding='5' cellspacing='0'><thead><tr>";
		foreach ($fields as $field) {
			echo "<th>" . htmlspecialchars($field) . "</th>";
		}
		echo "</tr></thead><tbody>";

		foreach ($posts as $post) {
			echo "<tr>";
			foreach ($fields as $field) {
				echo "<td>" . htmlspecialchars(isset($post->$field) ? $post->$field : '') . "</td>";
			}
			echo "</tr>";
		}
		echo "</tbody></table>";
	}
	public function refresh()
	{
		$this->load->model('token_model');
		
		//Load settings from config file
		$this->load->config('soundcloud');

		$client_id = $this->config->item('soundcloud_key');
		$client_secret = $this->config->item('soundcloud_secret');
		$refresh_token = $this->token_model->get_entry()[0]->refresh_token;

		$data = array();
		$data['client_id'] = $client_id;
		$data['client_secret'] = $client_secret;
		$data['grant_type'] = 'refresh_token';
		$data['refresh_token'] = $refresh_token;

		// Create a stream
		$opts = [
			"http" => [
				"method" => "POST",
				"content"=> http_build_query($data),
				"header" => "accept: application/json; charset=utf-8\r\n" .
					"Content-Type: application/x-www-form-urlencoded\r\n"
			]
		];

		// DOCS: https://www.php.net/manual/en/function.stream-context-create.php
		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		// DOCS: https://www.php.net/manual/en/function.file-get-contents.php
		$result = json_decode(file_get_contents($this->config->item('soundcloud_token_route'), false, $context));
		//print_r($this->token_model->get_entry());
		
		// $tempResult = new stdClass();
		// $tempResult->access_token = '2-300783--9uvp7iDGSISNsqL4YxYNjWL';
		// $tempResult->token_type = 'Bearer';
		// $tempResult->expires_in = 3599;
		// $tempResult->refresh_token = 'sNxwR24m0q9qi01Qh2IHoRCp5aXiZohm';
		// $tempResult->scope = '';
		$this->token_model->update_entry($result);

		$this->load->view('admin_view', array("tokens"=>$this->token_model->get_entry()));
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