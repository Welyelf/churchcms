<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sermon_scriptures_model extends CI_Model
{

    protected $table = "sermon_scriptures";

    public function __construct()
    {
        parent::__construct();
    }

    public function add($input)
    {
        $this->db->insert($this->table, $input);
        return true;
    }

    public function get_sermon_scriptures($sermon_id)
    {
        $this->db->where('sermon_id', $sermon_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function sermon_linked_delete($sermon_id)
    {
        $this->db->where('sermon_id', $sermon_id);
        $this->db->delete($this->table);
        return true;
    }

    public function get_top_books_by_sermons()
    {

        $this->db->select('*, (SELECT COUNT(*) FROM sermon_scriptures WHERE book_id = ss.book_id) AS total_sermons');
        $this->db->limit(5);
        $this->db->order_by('total_sermons', 'DESC');
        $this->db->group_by('book_id');
        $query = $this->db->get($this->table . ' AS ss');

        return $query->result();
    }
}