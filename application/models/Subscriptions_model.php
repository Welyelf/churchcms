<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions_model extends CI_Model
{

    protected $table = "donations";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_details($key, $field = false)
    {
        if (is_numeric($key)) {
            $query = $this->db->get_where($this->table, array('id' => $key), 1);
        } else {
            $query = $this->db->get_where($this->table, array('username' => $key), 1);
        }

        if ($field) {
            $result = $query->row();
            return $result->$field;
        } else {
            return $query->row();
        }
    }

    public function get_all($limit = FALSE, $start = 0, $sort = "DESC")
    {
        $this->db->order_by('id', $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_email($email)
    {
        $this->db->order_by('timestamp', "DESC");
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array("input" => $input, "user" => $this->session->user, "class" => 'Subscriptions_model', "method" => "add");
        $msg = json_encode($log_array);
        log_message('debug', $msg);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Subscriptions Added with name " . $input['name'] . 'by' . $this->session->user->id);
            return $this->db->insert_id();
        } else {
            log_message('error', json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        $log_array = array("input" => $input, "user" => $this->session->user, "class" => 'Subscriptions_model', "method" => "update");
        $msg = json_encode($log_array);
        log_message('debug', $msg);


        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "Subscribers Updated with name " . $input['name'] . 'by' . $this->session->user->id);
            return true;
        } else {
            log_message('error', json_encode($this->db->error()));
            return false;
        }
    }

}