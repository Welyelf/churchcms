<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers_model extends CI_Model
{

    protected $table = "volunteers";

    public function __construct()
    {
        parent::__construct();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Volunteers_model',
            "method" => "add");
        $log_data = json_encode($log_array);
        log_message('debug', "Executing Volunteers_model::add().", $log_data);
        // Insert into volunteers table.
        $this->db->insert($this->table, $input);
        return true;
    }

    public function update($input, $id)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Volunteers_model',
            "method" => "update");
        $log_data = json_encode($log_array);
        log_message('debug', "Executing Volunteers_model::update({$id}).", $log_data);
        //Update volunteers table by id.
        if ($this->db->update($this->table, $input, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all()
    {
        log_message('debug', "Executing Volunteers_model::get_all().");
        // Get all data from volunteers table.
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_details($key)
    {
        log_message('debug', "Executing Volunteers_model::get_details({$key}).");
        // Get the detail of specific volunteer schedule by id.
        $query = $this->db->get_where($this->table, array('id' => $key), 1);
        return $query->row();
    }

    public function delete($key)
    {
        log_message('debug', "Executing Volunteers_model::delete({$key}).");
        // Set the volunteer schedule id/row to delete.
        $this->db->where('id', $key);
        // Execute delete.
        if ($this->db->delete($this->table))
            return true;
        else
            return false;
    }

    public function get_schedules($end, $type = FALSE)
    {

        $to = strtotime($end . '0:00');

        $this->db->where('datetime <', $to);

        if ($type) {
            $this->db->where('volunteer_type', $type);
        }

        $this->db->order_by('datetime', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
}