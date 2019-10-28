<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model
{

    protected $table = 'categories';

    public function __construct()
    {

        parent::__construct();

    }

    public function add($input)
    {

        $log_array = array(
            'input' => $input,
            'user' => $this->session->user,
            'class' => 'Categories_model',
            'method' => 'add');

        $log_data = json_encode($log_array);
        log_message('debug', 'Executing Categories_model::add()', $log_data);


        if ($this->db->insert($this->table, $input)) {

            log_message('info', "New category Added with id {$this->db->insert_id()} by USER ID {$this->session->user->id}");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Add Categories by USER ID {$this->session->user->id}", json_encode($this->db->error()));
            return false;

        }

    } // End add()


    public function get_all($limit = FALSE, $start = 0, $sort = 'ASC')
    {
        log_message('debug', "Executing Categories_model::get_all({$limit}, {$start}, {$sort}).");

        $this->db->order_by('id', $sort);

        if ($query = $this->db->get($this->table, $limit, $start)) {
            log_message('info', 'Successfully Get All Categories.');
            return $query->result();

        } else {

            log_message('error', "Database Error: Cannot Get All Categories.", json_encode($this->db->error()));
            return false;

        }

    } // End get_all


    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Categories_model::get_details({$key}, {$field}).");

        if ($query = $this->db->get_where($this->table, array('id' => $key), 1)) {

            if ($query->num_rows() > 0) {

                if (!$field) {
                    log_message('info', "No details found with key {$key}.");
                    return $query->row();
                } else {
                    $result = $query->row();
                    log_message('info', "{$result} details found with key {$key}.");
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
        log_message('debug', "Executing Categories_model::get_details_by_slug({$key}, {$field}).");

        if ($query = $this->db->get_where($this->table, array('slug' => $key), 1)) {

            if ($query->num_rows() > 0) {

                if (!$field) {
                    log_message('info', "No Details found with key {$key}.");
                    return $query->row();
                } else {
                    $result = $query->row();
                    log_message('debug', "{$result} details found with key {$key}");
                    return $result->$field;
                }
            }

        } else {

            log_message('error', "Database Error: Cannot Get Details by Slug with key {$key}.", json_encode($this->db->error()));
            return false;

        }

    } // End get_details_by_slug()


    public function update($input)
    {
        $id = $input['id'];
        unset($input['id']);

        $this->db->where('id', $id);

        $log_array = array(
            'input' => $input,
            'user' => $this->session->user,
            'class' => 'Categories_model',
            'method' => 'update');

        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Categories_model::update().', $log_data);

        if ($this->db->update($this->table, $input)) {

            log_message('info', "Category with id {$id} was UPDATED by USER ID {$this->session->user->id}");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Update Category with id {$id}.", json_encode($this->db->error()));
            return false;

        }

    } // End update()


    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            'user' => $this->session->user,
            'class' => 'Categories_model',
            'method' => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Categories_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {

            log_message('info', "Category with id {$id} was DELETED by USER ID {$this->session->user->id}");
            return true;

        } else {

            log_message('error', "Database Error: Cannot Delete Category with id {$id}.", json_encode($this->db->error()));
            return false;

        }
    } // End delete()

} // End Categories_model
