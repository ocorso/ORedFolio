<?php

class Token_model extends CI_Model {
    function __construct() { $this->Tokens_Model(); }

    public function Tokens_Model()
    {
        parent::__construct();
        $this->load->database();
    }

    public $id;
    public $access_token;
    public $token_type;
    public $created_at;
    public $expires_in;
    public $expires_at;
    public $refresh_token;
    public $user_agent;
    public $scope;

    public function update_entry()
    {
        $this->created_at = time();
        $this->access_token = $_POST['access_token'];
        $this->token_type = $_POST['token_type'];
        $this->expires_in = $_POST['expires_in'];
        $this->refresh_token = $_POST['refresh_token'];
        $this->scope = $_POST['scope'];

        $this->db->insert('tokens', $this);
    }

    public function get_entry()
    {
        $query = $this->db->get('tokens');
        return $query->result();
    }
}
?>