<?php

class Posts_Model extends C3X_Model
{
	function __construct() { $this->Posts_Model(); }
	public function Posts_Model()
	{
		$this->table 	= "posts_".SITE;
		$this->pk 		= "id";
    	$this->fields 	= array(
    		'index' 						=> array("shown"=>false, 	"label"=>"Index"),
			'id' 							=> array("shown"=>true, 	"label"=>"Id"),
			'media_type' 					=> array("shown"=>true, 	"label"=>"Media Type"),
			'size'							=> array("shown"=>true, 	"label"=>"Size"),
			'title'							=> array("shown"=>true, 	"label"=>"Title"),
			'client'						=> array("shown"=>true, 	"label"=>"Client"),
			'description'					=> array("shown"=>true, 	"label"=>"Description"),
			'detail_name'					=> array("shown"=>true, 	"label"=>"Detail Name"),
			'filename'						=> array("shown"=>true, 	"label"=>"File Name"),
			'tags'							=> array("shown"=>true, 	"label"=>"Tags"),
			'categories'					=> array("shown"=>true, 	"label"=>"Categories"),
			'pages'							=> array("shown"=>true, 	"label"=>"Pages"),
			'overstatestyle'				=> array("shown"=>true, 	"label"=>"Over-State Style"),
			'href'							=> array("shown"=>true, 	"label"=>"Link")
		);
	}
}

?>