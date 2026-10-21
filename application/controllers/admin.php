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
		$existing = $this->token_model->get_entry();
		$refresh_token = (!empty($existing) && !empty($existing[0]->refresh_token)) ? $existing[0]->refresh_token : null;

		$result = null;

		// 1. Try refresh_token grant if we have one
		if (!empty($refresh_token)) {
			$data = array(
				'client_id'     => $client_id,
				'client_secret' => $client_secret,
				'grant_type'    => 'refresh_token',
				'refresh_token' => $refresh_token
			);

			$opts = [
				"http" => [
					"method"        => "POST",
					"content"       => http_build_query($data),
					"header"        => "accept: application/json; charset=utf-8\r\n" .
					                   "Content-Type: application/x-www-form-urlencoded\r\n",
					"ignore_errors" => true
				]
			];

			$context = stream_context_create($opts);
			$raw = @file_get_contents($this->config->item('soundcloud_token_route'), false, $context);
			$res = json_decode($raw);
			if (!empty($res->access_token)) {
				$result = $res;
			}
		}

		// 2. Fallback to client_credentials if refresh_token was empty or rejected
		if (empty($result) || empty($result->access_token)) {
			$encoded_auth = base64_encode($client_id . ':' . $client_secret);
			$data = array('grant_type' => 'client_credentials');

			$opts = [
				"http" => [
					"method"        => "POST",
					"content"       => http_build_query($data),
					"header"        => "accept: application/json; charset=utf-8\r\n" .
					                   "Content-Type: application/x-www-form-urlencoded\r\n" .
					                   "Authorization: Basic " . $encoded_auth . "\r\n",
					"ignore_errors" => true
				]
			];

			$context = stream_context_create($opts);
			$raw = @file_get_contents($this->config->item('soundcloud_token_route'), false, $context);
			$res = json_decode($raw);
			if (!empty($res->access_token)) {
				$result = $res;
			}
		}

		// 3. Only update DB if a valid token was actually received
		if (!empty($result) && !empty($result->access_token)) {
			$this->token_model->update_entry($result);
		} else {
			log_message('error', 'SoundCloud token refresh failed completely: ' . (isset($raw) ? $raw : 'no response'));
		}

		$this->load->view('admin_view', array("tokens" => $this->token_model->get_entry()));
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