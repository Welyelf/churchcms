<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model
{

    protected $table = "posts";

    public function __construct()
    {
        parent::__construct();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Posts_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Posts_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Post Added with title {$input['title']} by {$this->session->user->id}.");
            return $this->db->insert_id();
        } else {
            log_message('error', "Database Error: Cannot Add Post with title {$input['title']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function get_blogs_widget($limit = FALSE, $char_count = 0, $sort = "DESC")
    {
        log_message('debug', "Executing Posts_model::get_all_by_customization({$limit}, {$char_count}).");

        $this->db->select('title,LEFT(content,' . $char_count . ') as content,date,slug,posts.id');
        $this->db->join('users', 'users.id = posts.author_id');
        $this->db->order_by('date', $sort);
        $query = $this->db->get($this->table, $limit, 0);
        return $query->result();
    }

    public function get_row_count()
    {
        log_message('debug', "Executing Posts_model::get_row_count().");

        $this->db->from($this->table);
        $query = $this->db->count_all_results();
        return $query;

    }

    public function get_all($limit = FALSE, $start = 0, $is_active = TRUE, $sort = "DESC")
    {
        log_message('debug', "Executing Posts_model::get_all({$limit}, {$start}, {$sort}).");

        // Display only active posts in blog page.
        if (!$is_active) {
            $this->db->where('is_active', TRUE);
        }

        $this->db->order_by('date', $sort);
        $this->db->group_by('posts.id');
        $this->db->limit($limit, $start);

        //$this->db->select('*,posts.id');
        //$this->db->join('users', 'users.id = posts.author_id', 'left');
        //$query = $this->db->get($this->table,$limit,$start);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Posts_model::get_details({$key}, {$field}).");

        $query = $this->db->get_where($this->table, array('id' => $key), 1);

        if ($query->num_rows() > 0) {
            if (!$field) {
                log_message('info', "No details found with key {$key}");
                return $query->row();
            } else {
                $result = $query->row();
                log_message('info', "{$result} details found with key {$key} = {$field}.");
                return $result->$field;
            }
        } else {
            log_message('error', "Database Error: Cannot Get Details with key {$key}.", json_encode($this->db->error()));
            return false;
        }

    }

    public function get_all_by_category($category_id, $limit = FALSE, $start = 0, $sort = "ASC", $is_active = TRUE)
    {
        log_message('debug', "Executing Posts_model::get_all_by_category({$category_id}, {$limit}, {$start}, {$sort}).");

        // Display only active posts in blog category page.
        if (!$is_active)
            $this->db->where('is_active', TRUE);

        $this->db->join($this->table, 'posts.id = post_categories.post_id');
        $this->db->order_by('posts.date', $sort);
        //$query = $this->db->get_where($this->table, array('post_id' => $post_id),$limit,$start);
        $query = $this->db->get_where('post_categories', array('category_id' => $category_id), $limit, $start);
        return $query->result();
    }

    public function get_details_by_slug($key, $field = false)
    {
        log_message('debug', "Executing Posts_model::get_details_by_slug({$key},{$field}).");

        $query = $this->db->get_where($this->table, array('slug' => $key), 1);

        if ($query->num_rows() > 0) {
            if (!$field) {
                log_message('info', "No Details found with key {$key}.");
                return $query->row();
            } else {
                $result = $query->row();
                log_message('info', "{$result} details found with key {$key}.");
                return $result->$field;
            }
        } else {
            log_message('error', "Database Error: Cannot Get Details by Slug with key {$key}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input)
    {
        $this->db->where('id', $input['id']);
        unset($input['id']);

        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Posts_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Posts_model::update().", $log_data);

        if ($this->db->update($this->table, $input)) {
            log_message('info', "Post Updated with title {$input['title']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Posts with id {$input['id']}", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Posts_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Posts_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Post Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Posts with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function get_new_posts($date_from, $is_count = TRUE)
    {

        log_message('debug', "Executing Posts_model::get_new_posts({$date_from}, {$is_count}).");

        // Check date from.
        $this->db->where('date >', $date_from);
        // Count all numrows.
        $query = $this->db->count_all_results($this->table);
        // Return result.
        return $query;
    }
}
