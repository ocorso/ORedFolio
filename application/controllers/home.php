<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($pageId, $categoryId = "_all", $postId = "-1")
	{
		//echo $postId;

		$playlist = file_get_contents("http://api.soundcloud.com/playlists/10225031.json?client_id=e865c40cd8e163918594db283501b306");
	//	print_r(json_decode($playlist));
		$main_data_s 	= file_get_contents( base_url()."data/".SITE."/main.json");
		$main_data_json = json_decode( $main_data_s, true );
		$pages 			= $main_data_json["pages"];
		$suggestions 	= $main_data_json["suggestions"];
		$posts 			= $this->posts(0,$pageId,$categoryId);

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

	public function music(){ 
		echo "music"; 
		print_r($this);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/welcome.php */