<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model
{

    protected $table = "events";

    public function get_details($key, $field = false)
    {
        log_message('debug', "Executing Events_model::get_details({$key}, {$field}).");

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

    public function get_all()
    {
        log_message('debug', 'Executing Events_model::get_all()');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_events_by_date($date)
    {
        log_message('debug', "Executing Events_model::get_events_by_date({$date}).");

        $from = strtotime($date . '0:00');
        //$to = strtotime($date . '23:59');

        $this->db->where('datetime <=', $from);
        //$this->db->where('end_date >=', $to);

        //$this->db->order_by('datetime','ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_active()
    {
        log_message('debug', 'Executing Events_model::get_active().');

        $from = strtotime(date('Y-m-d 0:00'));
        $this->db->where('end_date >', $from);

        $this->db->order_by('datetime', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_week_events($end, $is_month_view = FALSE)
    {
        log_message('debug', "Executing Events_model::get_week_events({$end}).");

        $to = strtotime($end . '0:00');
        $from = strtotime('-7 day', $to);

        if ($is_month_view)
            $from = strtotime('-1 month', $to);

        // Removed where clause to not display none recurrence.
        // $this->db->where('recurrence NOT LIKE', 'none');
        $this->db->where('datetime <=', $to);

        // Fixed issue where events with expired end date still showing as upcoming week event.
        $this->db->group_start();
        $this->db->where('end_date >=', $from);
        $this->db->or_where('end_date', 0);
        $this->db->or_where('end_date', NULL);
        $this->db->group_end();

        $this->db->order_by('datetime', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_weekly_recurring()
    {
        log_message('debug', 'Executing Events_model::get_week_recurring().');

        $today = now();

        /*$this->db->where('recurrence LIKE', 'weekly');
        $this->db->where('datetime <=', $today);
        $this->db->or_where('end_date >=', $today);*/

        $this->db->where("recurrence = 'weekly' AND (datetime <= '{$today}' || end_date >= '{$today}')");
        $this->db->order_by('datetime', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Events_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Events_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Events Added with title {$input['title']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Add Event with title {$input['title']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Events_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Events_model::delete({$id}).", $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Events Deleted with id {$id } by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete Events with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }

    public function update($input, $id)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Events_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Events_model::update({$id}).", $log_data);

        if ($this->db->update($this->table, $input, array('id' => $id))) {
            log_message('info', "Events Updated with title {$input['title']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Update Events with id {$id}", json_encode($this->db->error()));
            return false;
        }
    }

    public function get_row_count()
    {
        log_message('debug', "Executing Events_model::get_row_count().");

        $this->db->from($this->table);
        $query = $this->db->count_all_results();

        return $query;
    }
}