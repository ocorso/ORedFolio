<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($pageId, $categoryId = "_all")
	{
		if( getenv("SECTION")  ) print_r(getenv("SECTION"));
		else 						print_r("poopoo");
		$main_data_s 	= file_get_contents( base_url()."data/".SITE."/main.json");
		$main_data_json = json_decode( $main_data_s, true );
		$pages 			= $main_data_json["pages"];
		$suggestions 	= $main_data_json["suggestions"];
		$posts 			= $this->posts(0,$pageId,$categoryId);

		$this->load->view(	'home_view', 
							array( 	"pages"=>$pages, 
									"suggestions"=>$suggestions, 
									"posts"=>$posts, 
									"fb_feed"=>array(),//$fb_posts_only, 
									"twitter_feed"=>array(),//$twitter_feed_json, 
									"page_id"=>$pageId, 
									"category_id"=>$categoryId 
								) 
							);
	}

	public function posts( $givemejson, $pages = "", $categories = ""){
		$this->load->model("posts_model");

		$result = $this->posts_model->get( array("pages"=>$pages, "categories"=>$categories) );

		if($givemejson){
			$result = json_encode($result);
		}

		return $result;
	}

	public function twitter_feed(){
		$token = TWITTER_TOKEN;
		$token_secret = TWITTER_TOKEN_SECRET;
		$consumer_key = TWITTER_CONSUMER_KEY;
		$consumer_secret = TWITTER_CONSUMER_SECRET;
		$screen_name = TWITTER_SCREEN_NAME;

		$query = array( // query parameters
		  'screen_name' => $screen_name,
		  'count' => '5',
		  'include_entities'  =>'true',
		  'include_rts'=> 'true',
		  "trim_user"=> 'true'
		);

		$host = 'api.twitter.com';
		$method = 'GET';
		$path = '/1.1/statuses/user_timeline.json'; // api call path

		$oauth = array(
		  'oauth_consumer_key' => $consumer_key,
		  'oauth_token' => $token,
		  'oauth_nonce' => (string)mt_rand(), // a stronger nonce is recommended
		  'oauth_timestamp' => time(),
		  'oauth_signature_method' => 'HMAC-SHA1',
		  'oauth_version' => '1.0'
		);

		$oauth = array_map("rawurlencode", $oauth); // must be encoded before sorting
		$query = array_map("rawurlencode", $query);

		$arr = array_merge($oauth, $query); // combine the values THEN sort

		asort($arr); // secondary sort (value)
		ksort($arr); // primary sort (key)

		// http_build_query automatically encodes, but our parameters
		// are already encoded, and must be by this point, so we undo
		// the encoding step
		$querystring = urldecode(http_build_query($arr, '', '&'));

		$url = "https://$host$path";

		// mash everything together for the text to hash
		$base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

		// same with the key
		$key = rawurlencode($consumer_secret)."&".rawurlencode($token_secret);

		// generate the hash
		$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

		// this time we're using a normal GET query, and we're only encoding the query params
		// (without the oauth params)
		$url .= "?".http_build_query($query);
		$url=str_replace("&amp;","&",$url); //Patch by @Frewuill

		$oauth['oauth_signature'] = $signature; // don't want to abandon all that work!
		ksort($oauth); // probably not necessary, but twitter's demo does it

		// also not necessary, but twitter's demo does this too
		function add_quotes($str) { return '"'.$str.'"'; }
		$oauth = array_map("add_quotes", $oauth);

		// this is the full value of the Authorization line
		$auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

		// if you're doing post, you need to skip the GET building above
		// and instead supply query parameters to CURLOPT_POSTFIELDS
		$options = array( CURLOPT_HTTPHEADER => array("Authorization: $auth"),
		                //CURLOPT_POSTFIELDS => $postfields,
		                CURLOPT_HEADER => false,
		                CURLOPT_URL => $url,
		                CURLOPT_RETURNTRANSFER => true,
		                CURLOPT_SSL_VERIFYPEER => false);

		// do our business
		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$json = curl_exec($feed);
		curl_close($feed);

		return $json;
	}

	public function user_likes_post($user_id, $post_id){
		$q = urlencode("SELECT user_id FROM like WHERE object_id=".$post_id);

	 	$fql_query_url = 'https://graph.facebook.com/fql?q='.$q;
		$fql_query_result = file_get_contents($fql_query_url);
		$fql_query_obj = json_decode($fql_query_result, true);
		
		$doeslike = count($fql_query_obj["data"]);

		echo $fql_query_result;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */