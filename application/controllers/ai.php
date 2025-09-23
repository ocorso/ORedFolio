<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ai extends CI_Controller {

  public function index()
  {
    $this->load->view(	'ai_view' 
              );
  }
}