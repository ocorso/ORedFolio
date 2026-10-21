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
     * @param $tokens
     */
    public function update_entry($tokens)
    {
        if (empty($tokens) || empty($tokens->access_token)) {
            log_message('error', 'Token_model::update_entry aborted: payload missing access_token.');
            return false;
        }

        $createdAtTimestamp = time(); // Get the current Unix timestamp
        $expiresIn = isset($tokens->expires_in) ? (int)$tokens->expires_in : 3600;
        $expirationTimestamp = $createdAtTimestamp + $expiresIn;

        $this->id = 1;
        $this->created_at = date("Y-m-d H:i:s", $createdAtTimestamp);
        $this->access_token = $tokens->access_token;
        $this->token_type = isset($tokens->token_type) ? $tokens->token_type : 'Bearer';
        $this->expires_in = $expiresIn;
        $this->expires_at = date("Y-m-d H:i:s", $expirationTimestamp);
        $this->refresh_token = isset($tokens->refresh_token) ? $tokens->refresh_token : '';
        $this->user_agent = isset($this->agent) ? $this->agent->agent_string() : (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'cron');
        $this->scope = isset($tokens->scope) ? $tokens->scope : '';

        $this->db->where('id', 1);
        return $this->db->update('tokens', $this);
    }

    public function get_entry()
    {
        $query = $this->db->get('tokens');
        return $query->result();
    }
}
?>