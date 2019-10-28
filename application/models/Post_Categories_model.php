<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post_Categories_model extends CI_Model
{

    protected $table = "post_categories";

    public function __construct()
    {
        parent::__construct();
    }

    public function count_posts($cat_id)
    {
        log_message('debug', "Executing Post_Categories_model::count_posts({$cat_id}).");

        $query = $this->db->get_where($this->table, array('category_id' => $cat_id));
        return $query->num_rows();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Posts_Categories_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Post_Categories_model::add().', $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Post Categories Added with post_id {$input['post_id']} by {$this->session->user->id}.");
            return $this->db->insert_id();
        } else {
            log_message('error', "Database Error: Cannot add category with post_id {$input['post_id']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function get_all($limit = FALSE, $start = 0, $sort = "ASC", $sort_by = 'id')
    {
        log_message('debug', "Executing Post_Categories_model::get_all({$limit}, {$start}, {$sort}).");

        $this->db->order_by($sort_by, $sort);
        $query = $this->db->get($this->table, $limit, $start);
        return $query->result();
    }

    public function get_all_by_post_id($post_id, $limit = FALSE, $start = 0, $sort = "ASC")
    {
        log_message('debug', "Executing Post_Categories_model::get_all_post_by_id({$post_id}, {$limit}, {$start}, {$sort}).");

        $this->db->join('categories', 'categories.id = category_id');
        $this->db->order_by('post_categories.id', $sort);
        $query = $this->db->get_where($this->table, array('post_id' => $post_id), $limit, $start);
        return $query->result();
    }


    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Post_Categories_model::get_details({$key}, {$field}).");

        $query = $this->db->get_where($this->table, array('id' => $key), 1);

        if ($query->num_rows() > 0) {
            if (!$field) {
                log_message('info', "No details found with {$key}");
                return $query->row();
            } else {
                $result = $query->row();
                log_message('info', "{$result} details found with {$key} = {$field}.");
                return $result->$field;
            }
        }

        return false;
    }

    public function get_details_by_slug($key, $field = false)
    {
        log_message('debug', "Executing Post_Categories_model::get_details_by_slug({$key}, {$field}).");

        $query = $this->db->get_where($this->table, array('slug' => $key), 1);

        if ($query->num_rows() > 0) {
            if (!$field) {
                log_message('info', "No details found with {$key}");
                return $query->row();
            } else {
                $result = $query->row();
                log_message('info', "{$result} details found with {$key} = {$field}.");
                return $result->$field;
            }
        }

        return false;
    }

    public function update($input)
    {
        $this->db->where('id', $input['id']);
        unset($input['id']);

        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Posts_Categories_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Post_Categories_model::update().', $log_data);

        if ($this->db->update($this->table, $input)) {
            log_message('info', "Post Categories Updated with post_id {$input['post_id']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot update Post Categories with post_id {$input['post_id']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Posts_Categories_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Post_Categories_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Post Categories Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Post Categories with id {$id} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete_by_post_id($id)
    {
        $this->db->where('post_id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Posts_Categories_model',
            "method" => "delete_by_post_id");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Post_Categories_model::delete_by_post_id({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Post Categories By Post ID Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Post Category by post id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }
}
