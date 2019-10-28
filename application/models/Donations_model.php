<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Donations_model extends CI_Model
{

    protected $table = "donations";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Donations_model::get_details({$key}, {$field}).");

        if (is_numeric($key)) {
            $query = $this->db->get_where($this->table, array('id' => $key), 1);
        } else {
            $query = $this->db->get_where($this->table, array('username' => $key), 1);
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

    public function get_all($limit = FALSE, $start = 0, $sort = "DESC")
    {
        log_message('debug', "Executing Donations_model::get_all({$limit}, {$start}, {$sort}).");

        $this->db->order_by('id', $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_email($email)
    {
        log_message('debug', "Executing Donations_model::get_by_email({$email}.");

        $this->db->order_by('timestamp', "DESC");
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Donations_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Donations_model::add()', $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Donations Added with email {$input['email']} and amount of $ {$input['amount']} by {$this->session->user->id }");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Add Donations by with email {$input['email']} and amount of $ {$input['amount']}  {$this->session->user->id }.", json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Donations_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Donations_model::update()', $log_data);

        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "Donations Updated with email {$input['email']} and amount of $ {$input['amount']} by {$this->session->user->id}");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Donations with email {$input['email']} and amount of $ {$input['amount']} by {$this->session->user->id}", json_encode($this->db->error()));
            return false;
        }
    }

}