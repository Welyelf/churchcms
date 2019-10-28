<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model
{

    protected $table = "logs";

    public function __construct()
    {
        parent::__construct();
    }

    public function get($date_range = FALSE, $sort = 'DESC')
    {
        log_message('debug', "Executing Logs_model::date_range().");

        if ($date_range) {
            $this->db->where('datetime >=', $date_range['from']);
            $this->db->where('datetime <=', $date_range['to']);
        }

        $this->db->order_by('datetime', $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Logs_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Pages_model::add().", $log_data);


        $this->db->insert($this->table, $input);
        return true;
    }

    // Get full details of the Log.
    public function get_detail($key)
    {

        log_message('debug', "Executing Logs_model::get_detail({$key}).");

        $query = $this->db->get_where($this->table, array('id' => $key), 1);

        return $query->row();
    }

}