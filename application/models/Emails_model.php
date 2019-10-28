<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_model extends CI_Model
{

    protected $table = "emails";

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Emails_model::get_details({$key}, {$field}).");

        if (is_numeric($key)) {
            $query = $this->db->get_where($this->table, array('id' => $key), 1);
        } else {
            $query = $this->db->get_where($this->table, array('slug' => $key), 1);
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

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        log_message('debug', 'Executing Emails_model::get_all().');

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Emails_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Emails_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Email Added with name {$input['name']} by {$this->session->user->id}");
            return true;
        } else {
            log_message('error', "Database Error: Cannot add email with name {$input['name']} by {$this->session->user->id}", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array("user" => $this->session->user, "class" => 'Emails_model', "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Emails_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Email Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Emails with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Emails_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Email_model::update()', $log_data);

        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "Email Updated with name {$input['name']} by {$this->session->user->id}");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Email with name {$input['name']} by {$this->session->user->id}", json_encode($this->db->error()));
            return false;
        }
    }

}