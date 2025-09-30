<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ai extends CI_Controller {

  public function index($pageId = 1, $categoryId = "_all", $postId = "-1")
  {
    $params = array( 	"page_id"=>$pageId, 
                      "category_id"=>$categoryId,
                      "post_id"=>$postId
    );

    $this->load->view(	'ai_view', $params );
  }
}