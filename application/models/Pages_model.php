<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model
{

    protected $table = "pages";


    public function __construct()
    {

        parent::__construct();

    } // End __construct()


    public function add($input)
    {

        $log_array = array(
            'input' => $input,
            'user' => $this->session->user,
            'class' => 'Pages_model',
            'method' => 'add');

        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Pages_model::add()', $log_data);

        if ($this->db->insert($this->table, $input)) {

            log_message('info', "New Page Added with ID {$this->db->insert_id()} by USER ID {$this->session->user->id}");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Add Page.", json_encode($this->db->error()));
            return false;

        }

    } // End add()


    public function get_all($limit = FALSE, $start = 0, $sort = "ASC", $is_active = TRUE)
    {
        log_message('debug', "Executing Pages_model::get_all({$limit}, {$start}, {$sort}).");

        // Display only active pages.
        if (!$is_active)
            $this->db->where('is_active', TRUE);

        $this->db->select('*, pages.id');
        $this->db->join('users', 'users.id = pages.author_id', 'left');
        $this->db->order_by('pages.id', $sort);

        if ($query = $this->db->get($this->table)) {

            log_message('info', 'All pages found.');
            return $query->result();

        } else {

            log_message('error', "Database Error: Cannot Get All Pages.", json_encode($this->db->error()));
            return false;

        }

    } // End get_all()


    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Pages_model::get_details({$key}, {$field}).");

        if ($query = $this->db->get_where($this->table, array('id' => $key), 1)) {

            if ($query->num_rows() > 0) {

                if (!$field) {
                    log_message('info', "No details found with {$key} = {$field}");
                    return $query->row();
                } else {
                    $result = $query->row();
                    log_message('info', "{$result} details found with {$key} = {$field}.");
                    return $result->$field;
                }

            }

        } else {

            log_message('error', "Database Error: Cannot Get Details with key {$key}.", json_encode($this->db->error()));
            return false;

        }
    } // End get_details()


    public function get_details_by_slug($key, $field = false)
    {
        log_message('debug', "Executing get_details_by_slug({$key}, {$field}).");

        if ($query = $this->db->get_where($this->table, array('slug' => $key), 1)) {

            if ($query->num_rows() > 0) {

                if (!$field) {
                    log_message('info', "No details found with {$key} = {$field}");
                    return $query->row();
                } else {
                    $result = $query->row();
                    log_message('info', "Details found with {$key} = {$field}.");
                    return $result->$field;
                }

            }

        } else {

            log_message('error', "Database Error: Cannot Get Details by Slug with key {$key}.", json_encode($this->db->error()));
            return false;

        }

    } // get_details_by_slug()


    public function update($input)
    {

        $this->db->where('id', $input['id']);
        unset($input['id']);

        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Pages_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Pages_model::update().', $log_data);

        if ($this->db->update($this->table, $input)) {

            log_message('info', " Page Updated with title {$input['title']} by {$this->session->user->id}.");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Update Pages with id {$input['id']}", json_encode($this->db->error()));
            return false;

        }

    } // update()

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Pages_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Pages_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {

            log_message('info', " Page Deleted with id {$id} by {$this->session->user->id}.");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Delete Pages with id {$id}.", json_encode($this->db->error()));
            return false;

        }

    } // delete()

}
