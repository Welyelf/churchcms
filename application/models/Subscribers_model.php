<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers_model extends CI_Model
{

    protected $table = "subscribers";

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Subscribers_model::get_details({$key}, {$field}).");

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
            log_message('info', "No details found with key {$key}.");
            return $query->row();
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        log_message('debug', "Executing Subscribers_model::get_all().");

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Subscribers_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Subscribers_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Subscribers Added with email {$input['email']}.");
            return $this->db->insert_id();
        } else {
            log_message('error', "Database Error: Canont Add Subscriber.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Subscribers_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Subscribers_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Subscribers Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Subscribers with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function get_unsubscribe_details($key)
    {
        log_message('debug', "Executing Subscribers_model::get_unsubscribe_details({$key}).");
        if ($query = $this->db->get_where($this->table, array('email' => $key), 1)) {

            if ($query->num_rows() > 0) {
                return true;
            }
        } else {
            log_message('error', "Database Error: Cannot Get Details with key {$key}.", json_encode($this->db->error()));
            return false;
        }

    }

    public function unsubscribe($key)
    {
        $this->db->where('email', $key);

        $log_array = array(
            "input" => $key,
            "user" => $this->session->user,
            "class" => 'Subscribers_model',
            "method" => "unsubscribe");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Subscribers_model::unsubscribe({$key}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Subscribers Deleted with email {$key}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Subscribers with email {$key}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        $log_array = array("user" => $this->session->user, "class" => 'Subscribers_model', "method" => "update");
        $log_data = json_encode($log_array);
        log_message('debug', $log_data);

        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "Subscribers Updated with email {$input['email']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Subscribers with email {$input['email']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function get_new_subscribers($date_from, $is_count = TRUE)
    {

        log_message('debug', "Executing Subscribers_model::get_new_subscribers({$date_from}, {$is_count}).");

        // Check date from.
        $this->db->where('date >', $date_from);
        // Count all numrows.
        $query = $this->db->count_all_results($this->table);
        // Return result.
        return $query;
    }

    public function get_row_count()
    {
        log_message('debug', "Executing Subscribers_model::get_row_count().");

        $this->db->from($this->table);
        $query = $this->db->count_all_results();

        return $query;
    }
}