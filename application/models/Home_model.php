<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{

    protected $table = "customizations";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_widgets()
    {
        log_message('debug', 'Executing Home_model::get_all_widgets().');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_widget_details($key, $field = false)
    {
        log_message('debug', "Executing Home_model::get_widget_details({$key}, {$field}).");

        if ($query = $this->db->get_where($this->table, array('id' => $key), 1)) {

            if ($query->num_rows() > 0) {

                if (!$field) {
                    log_message('debug', "No widget found with {$key} = {$field}.");
                    return $query->row();
                } else {
                    $result = $query->row();
                    log_message('debug', "{$result} widget found with {$key} = {$field}.");
                    return $result->$field;
                }
            }
        } else {

            log_message('error', "Database Error: Cannot Get Widget Detail with key {$key}", json_encode($this->db->error()));
            return false;

        }
    } // End get_details()

    public function get_active_widgets()
    {
        log_message('debug', "Executing Home_model::get_active_widgets().");

        $this->db->order_by('ordering', 'DESC');
        $query = $this->db->get_where($this->table, array('is_enabled' => 1));
        return $query->result();
    }

    public function install_script($input)
    {
        log_message('debug', "Executing Home_model::install_script().");

        // Load built-in CI dbforge library.
        $this->load->dbforge();

        // Write SQL Script below. --------------------------
        $success_counter = 0;
        // Custom SQL Script.
        if ($input) {
            $this->db->query($input);
            $success_counter++;
        }

        // END ---------------------------------------------------

        if ($success_counter > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function install_table($input)
    {
        log_message('debug', "Executing Home_model::install_table().");

        if ($input) {
            return $this->db->query($input);
        }
    }

    public function install_field($table = null, $fields)
    {
        log_message('debug', "Executing Home_model::install_field().");
        // Load built-in CI dbforge library.
        $this->load->dbforge();
        return $this->dbforge->add_column($table, $fields);
    }

}
