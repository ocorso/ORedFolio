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

    /**
     * @param $access_token
     * @param $token_type
     * @param $expires_in
     * @param $refresh_token
     * @param $scope
     */
    public function update_entry($tokens)
    {
        $createdAtTimestamp = time(); // Get the current Unix timestamp
        $expirationTimestamp = $createdAtTimestamp + $tokens->expires_in;
        $this->expires_at = date("Y-m-d H:i:s", $expirationTimestamp);
        
        $this->id = 1;
        $this->created_at = date("Y-m-d H:i:s", $createdAtTimestamp);
        $this->access_token = $tokens->access_token;
        $this->token_type = $tokens->token_type;
        $this->expires_in = $tokens->expires_in;
        $this->expires_at = date("Y-m-d H:i:s", $expirationTimestamp);
        $this->refresh_token = $tokens->refresh_token;
        $this->user_agent = $this->agent->agent_string();
        $this->scope = $tokens->scope;

        $this->db->where('id', 1);
        $this->db->update('tokens', $this);
    }

    public function get_entry()
    {
        $query = $this->db->get('tokens');
        return $query->result();
    }
}
?>