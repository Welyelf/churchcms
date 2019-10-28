<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model
{

    protected $table = "roles";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($limit = FALSE, $start = 0, $sort = "DESC")
    {
        log_message('debug', "Executing Roles_model::get_all().");

        $this->db->order_by('order', $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

}