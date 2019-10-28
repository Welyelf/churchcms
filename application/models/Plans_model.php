<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Plans_model extends CI_Model
{

    protected $table = "plans";

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Plans_model::get_details({$key}, {$field}).");

        if (is_numeric($key)) {
            $query = $this->db->get_where($this->table, array('id' => $key), 1);
        } else {
            $query = $this->db->get_where($this->table, array('name' => $key), 1);
        }

        if ($field) {
            $result = $query->row();
            log_message('info', "{$result} details found with {$key} = {$field}.");
            return $result->$field;
        } else {
            log_message('info', "No details found with {$key} = {$field}.");
            return $query->row();
        }
    }

    public function get_all($limit = FALSE, $start = 0, $sort = "ASC")
    {
        log_message('debug', "Executing Plans_model::get_all({$limit}, {$start}, {$sort}).");

        $this->db->order_by('order', $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        log_message('debug', 'Executing Plans_model::add()');

        if ($this->db->insert($this->table, $input)) {
            log_message('info', 'Plan successfully added.');
            return true;
        } else {
            log_message('error', 'Database Error: Cannot Add Plan.', json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        log_message('debug', "Executing Plans_model::update({$id})");

        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "Plan successfully updated with id {$id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Plan with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        log_message('debug', "Executing Plans_model::delete({$id})");

        $this->db->where('id', $id);
        if ($this->db->delete($this->table)) {
            log_message('info', "Plan successfully deleted with id = {$id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Plan with id {$id}", json_encode($this->db->error()));
            return false;
        }
    }
}