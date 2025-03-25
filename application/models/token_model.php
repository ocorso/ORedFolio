class Token_model extends CI_Model {
    public $date;
    public $access_token;
    public token_type;
    public expires_in
    public refresh_token;
    public scope;

    public function insert_entry()
    {
        $this->date = time();
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