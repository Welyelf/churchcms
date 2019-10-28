<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sermons_model extends CI_Model
{

    protected $table = "sermons";
    protected $scriptures_table = "sermon_scriptures";

    public function __construct()
    {
        parent::__construct();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Sermons_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Sermons_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Sermons Added with title {$input['title']} by {$this->session->user->id}.");
            return $this->db->insert_id();
        } else {
            log_message('error', "Database Error: Cannot Add Sermons with title {$input['title']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    // This function is already deprecated. Please use get_sermons() function below for future references.
    public function get_all($limit = FALSE, $start = 0, $sort = "DESC")
    {
        log_message('debug', "Executing Sermons_model::get_all({$limit}, {$start}, {$sort}).");

        $this->db->order_by('date', $sort);
        if (is_int($limit) && $limit > 0) {
            if (!is_int($start) || $start < 0) {
                log_message('debug', "An invalid start data :({$start})");
            } else {
                $this->db->limit($limit, $start);
            }
        } else {
            log_message('debug', "An invalid limit data :({$limit})");
        }
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_row_count($browse = FALSE, $slug = FALSE, $is_active = TRUE)
    {
        log_message('debug', "Executing Sermons_model::get_row_count($browse, $slug).");

        if ($browse) {
            $this->db->where('book', $slug);
        }

        if (!$is_active) {
            $this->db->where('is_active', TRUE);
        }

        $this->db->from($this->table);
        $query = $this->db->count_all_results();

        //$query = $this->db->get($this->table);
        return $query;
        //return $query->num_rows();
    }

    public function search($keyword, $limit = FALSE, $start = 0, $sort = "DESC")
    {
        log_message('debug', "Executing Sermons_model::search({$keyword}, {$limit}, {$start}, {$sort})");

        $this->db->where('title LIKE', '%' . $keyword . '%');
        $this->db->or_where('book LIKE', '%' . $keyword . '%');
        $this->db->or_where('transcript LIKE', '%' . $keyword . '%');
        $this->db->or_where('pastor LIKE', '%' . $keyword . '%');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Sermons_model::get_details({$key}, {$field})");

        $query = $this->db->get_where($this->table, array('id' => $key), 1);

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

        return false;
    }

    public function get_last()
    {
        log_message('debug', "Executing Sermons_model::get_last()");
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }


    }


    public function get_details_by_slug($key, $field = false)
    {
        log_message('debug', "Executing Sermons_model::get_details_by_slug({$key}, {$field}).");

        $query = $this->db->get_where($this->table, array('slug' => $key), 1);

        if ($query->num_rows() > 0) {
            if (!$field) {
                log_message('info', "No details by slug found with key {$key}.");
                return $query->row();
            } else {
                $result = $query->row();
                log_message('info', "{$result} details by slug found with key {$key}.");
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
            "class" => 'Sermons_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Sermons_model::update().', $log_data);

        if ($this->db->update($this->table, $input)) {
            log_message('info', "Sermons Updated with title {$input['title']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Sermons with title {$input['title']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Sermons_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Sermons_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Sermons with id {$id} was DELETED by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Sermons with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    /**
     *   Get Sermons by browse.
     *   return result->array
     */
    public function get_sermons_by_browse($slug, $limit = FALSE, $start = 0, $sort = "DESC")
    {

        log_message('debug', "Executing Sermons_model::get_sermons_by_browse({$slug}).");

        $this->db->order_by('date', $sort);
        $this->db->where('book', $slug);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_book_count($keys)
    {

        log_message('debug', "Executing Sermons_model::get_book_count().");
        // Select sermons row to prevent id to be overwritten by join.
        $this->db->select('sermons.*');
        // Get only sermons by book_id in sermon_scriptures.
        $this->db->where('book_id', $keys);
        $this->db->from($this->table);
        $this->db->join($this->scriptures_table . ' as ss', 'ss.sermon_id = sermons.id');
        // Get the number of results.
        $query = $this->db->count_all_results();

        return $query;
    }

    /**
     *   Get Sermons function.
     *   Can be used to pages using sermons.
     * @params $keyword = for sermons search.
     * @params $browse = for choosing a book in sermons browse.
     * @return result->array
     */
    public function get_sermons($keyword = FALSE, $browse = FALSE, $limit = FALSE, $start = 0, $sort = "DESC", $is_active = TRUE)
    {

        log_message('debug', "Executing Sermons_model::get_sermons({$keyword}, {$browse}, {$limit}, {$start}, {$sort}).");

        // Query for search.
        if ($keyword) {
            // Display only active sermons in sermons page.
            $this->db->where('title LIKE', '%' . $keyword . '%');
            // $this->db->or_where('book LIKE', '%' . $keyword . '%');
            $this->db->or_where('sermon_scriptures.book_id LIKE', '%' . $keyword . '%'); // Update where clause for multiple books using sermon_scriptures table.
            $this->db->or_where('transcript LIKE', '%' . $keyword . '%');
            $this->db->or_where('pastor LIKE', '%' . $keyword . '%');

            // Join query sermon_scriptures model to check in multiple books.
            $this->db->group_by('sermons.id');
            $this->db->join($this->scriptures_table . ' as ss', 'ss.sermon_id = sermons.id');

        }

        // Query for browse book.
        if ($browse) {
            $this->db->where('book_id', $browse);
        }

        // Display only active sermons in sermons page.
        if (!$is_active)
            $this->db->where('is_active', TRUE);

        // Added Select to prevent id to be overwritten sermons_scriptures table.
        $this->db->select('sermons.*');

        // For pagination limit.
        $this->db->limit($limit, $start);
        $this->db->order_by('date', $sort);
        $this->db->group_by('sermons.id');
        $this->db->join($this->scriptures_table, 'sermon_scriptures.sermon_id = sermons.id', 'left');

        // Added log for pagination.
        if (is_int($limit) && $limit > 0) {
            if (!is_int($start) || $start < 0) {
                log_message('debug', "An invalid start data :({$start})");
            } else {
                $this->db->limit($limit, $start);
            }
        } else {
            log_message('debug', "An invalid limit data :({$limit})");
        }

        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     *   Get the Sermon detail by slug. Used in Dashboard.
     */
    public function get_sermon_by_slug($slug)
    {

        log_message('debug', "Executing Sermons_model::get_sermon_by_slug({$slug}).");
        // Check slug if name.
        $this->db->where('slug', $slug);
        $query = $this->db->get($this->table);
        // Return only the row.
        return $query->row();
    }

    /**
     *   Get the Sermon by id.
     */
    public function get_sermon_by_id($id)
    {

        log_message('debug', "Executing Sermons_model::get_sermon_by_id({$id}).");
        // Set where ID.
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        // Return only the row.
        return $query->row();
    }

    public function get_new_sermons($date_from, $is_count = TRUE)
    {

        log_message('debug', "Executing Sermons_model::get_new_sermons({$date_from}, {$is_count}).");
        // Check date from.
        $this->db->where('date >', $date_from);
        // Count all numrows.
        $query = $this->db->count_all_results($this->table);
        // Return result.
        return $query;
    }

    /**
     *   Get the auto increment value of sermons table.
     */
    public function get_auto_increment_val()
    {

        log_message('debug', "Executing Sermons_model::get_auto_increment_val().");

        $this->db->select('AUTO_INCREMENT');
        $this->db->where('TABLE_SCHEMA', $this->db->database);
        $this->db->where('TABLE_NAME', $this->table);

        //$query = $this->db->get_compiled_select('INFORMATION_SCHEMA.TABLES');
        $query = $this->db->get('INFORMATION_SCHEMA.TABLES');

        return $query->row();
    }

    /**
     *   Get sermons by date. Used in Events.
     */
    public function get_sermons_by_date($start = FALSE, $end = FALSE, $is_active = TRUE)
    {

        log_message('debug', "Executing Sermons_model::get_sermons_by_date({$start}, {$end}, {$is_active}).");

        $this->db->where('date >', $start);

        if ($end)
            $this->db->where('date <', $end);

        $this->db->where('is_active', $is_active);
        $query = $this->db->get($this->table);

        return $query->result();
    }
}