<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customizations_model extends CI_Model
{

    protected $table = "customizations";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_widgets($field = FALSE, $value = FALSE)
    {
        log_message('debug', "Executing customizations_model::get({$field}, {$value}).");

        if ($field != FALSE && $value != FALSE) {
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where($this->table, array($field => $value));
        } else {
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get($this->table);
        }

        $rows = $query->num_rows();

        if ($rows != 0) {
            if ($rows > 1) {
                log_message('debug', "{$rows} widgets found with {$field} = {$value}.");
                return $query->result();
            } else {
                log_message('debug', "{$rows} widget found with {$field} = {$value}.");
                return $query->row();
            }
        } else {
            log_message('debug', "No widgets found with {$field} = {$value}.");
        }

    }

    public function add_widget($input)
    {
        $log_array = array(
            'input' => $input,
            'user' => $this->session->user,
            'class' => 'Customizations_model',
            'method' => 'add');

        $log_Data = json_encode($log_array);
        log_message('debug', "Executing customizations_model::add_widget().", $log_Data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Widget Added with ID {$this->db->insert_id()} by USER ID {$this->session->user->id}");
            return true;
        } else {
            log_message('error', 'Database Error: Cannot Add Widget', json_encode($this->db->error()));
            return false;

        }

    } // End add()

    public function update_widget($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Customizations_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing customizations_model::update_widget().", $log_data);

        $this->db->where('id', $input['id']);
        unset($input['id']);

        if ($this->db->update($this->table, $input)) {
            log_message('info', "{$input['name']} widget was updated by user id {$this->session->user->id}", json_encode($input));
            return true;

        } else {
            log_message('error', 'Database Error: Cannot Update Widget', json_encode($this->db->error()));
            return false;
        }

    } // update()

    public function delete($id)
    {

        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Customizations_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Customizations_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {

            log_message('info', " Widget Deleted with id {$id} by {$this->session->user->id}.");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Delete Widget with id {$id}.", json_encode($this->db->error()));
            return false;

        }

    } // delete()
}
