<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{

    protected $table = "users";

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Users_model::get_details({$key}, {$field}).");

        if (is_numeric($key)) {
            $query = $this->db->get_where($this->table, array('id' => $key), 1);
        } else {
            $query = $this->db->get_where($this->table, array('username' => $key), 1);
        }

        if ($field) {
            $result = $query->row();
            log_message('info', "{$result} details found with key {$key}.");
            return $result->$field;
        } else {
            log_message('info', "No details found with key {$key}");
            return $query->row();
        }
    }

    public function get_details_by_email($key, $field = false)
    {
        log_message('debug', "Executing Users_model::get_details_by_email({$key}, {$field}).");

        $query = $this->db->get_where($this->table, array('email' => $key), 1);

        if ($field) {
            $result = $query->row();
            log_message('info', "{$result} details found with key {$key}.");
            return $result->$field;
        } else {
            log_message('info', "No details found with key {$key}.");
            return $query->row();
        }
    }

    public function update_password($password)
    {

        log_message('debug', "Executing Users_model::update_password({$password}).");

        $this->db->set('password', $password);
        $this->db->where("id", $this->session->user->id);
        $this->db->update($this->table);
    }

    public function get_all()
    {
        log_message('debug', "Executing Users_model::get_all().");

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Users_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Users_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {

            if (isset($this->session->user->id))
                log_message('info', "New User Added with email {$input['email']} by {$this->session->user->id}.");
            else
                log_message('info', "New User Added with email {$input['email']}");

            return $this->db->insert_id();

        } else {
            log_message('error', "Database Error: Cannot Add New User.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Users_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Users_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "User Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete User with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Users_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Users_model::update().", $log_data);

        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "User Updated with email {$input['email']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update User with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

}