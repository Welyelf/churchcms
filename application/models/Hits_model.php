<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hits_model extends CI_Model
{

    protected $table = "hits";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_daily_totals($date_range = FALSE, $sort = 'DESC')
    {
        log_message('debug', "Executing Hits_model::get_daily_totals().");

        if ($date_range) {
            $this->db->where('date >=', $date_range['from']);
            $this->db->where('date <=', $date_range['to']);
        }

        $this->db->where('is_total', 1);
        $this->db->order_by('date', $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_all($date_range = FALSE, $sort = 'DESC')
    {
        log_message('debug', "Executing Hits_model::get_all().");

        if ($date_range) {
            $this->db->where('date >=', $date_range['from']);
            $this->db->where('date <=', $date_range['to']);
        }

        $this->db->order_by('date', $sort);
        $this->db->order_by('is_total', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_totals($date_range = FALSE)
    {
        log_message('debug', "Executing Hits_model::get_totals().");

        $this->db->select('SUM(count) as page_views, SUM(sessions) as sessions');
        if ($date_range) {
            $this->db->where('date >=', $date_range['from']);
            $this->db->where('date <=', $date_range['to']);
        }
        $this->db->where('is_total', 1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function add($uri, $status_code = 200)
    {
        log_message('debug', "Executing Hits_model::add({$uri}).");

        $input['uri'] = $uri;
        $input['date'] = strtotime(date('d-M-Y'));
        $input['count'] = 1;
        $input['sessions'] = 1;

        if (!$this->db->field_exists('status', 'hits'))
            $input['status_code'] = $status_code;

        $this->db->insert($this->table, $input);

        $this->update_totals(TRUE);

        return true;
    }

    public function increment($uri, $is_unique = FALSE)
    {
        log_message('debug', "Executing Hits_model::increment({$uri}, {$is_unique}).");

        $hit = $this->get_hit_data($uri);

        $this->db->where(array('uri' => $uri, 'date' => strtotime(date('d-M-Y'))));

        if (TRUE == $is_unique) {
            $this->db->update($this->table, array('count' => $hit->count + 1, 'sessions' => $hit->sessions + 1));
            $this->update_totals();
        } else {
            $this->db->update($this->table, array('count' => $hit->count + 1));
            $this->update_totals();
        }

        return true;
    }

    public function update_status_code($uri, $status_code = 200)
    {

        log_message('debug', "Executing Hits_model::update_status_code({$uri}, {$status_code}).");

        $hit = $this->get_hit_data($uri);

        if ($hit != NULL) {
            $this->db->where(array('uri' => $uri, 'date' => strtotime(date('d-M-Y'))));
            $this->db->update($this->table, array('status_code' => $status_code));
        }
    }

    public function update_totals()
    {
        log_message('debug', 'Executing Hits_model::update_totals().');

        $uri = date('F d, Y') . ' Totals';

        $hit = $this->get_hit_data($uri);

        //var_dump($hit);exit;

        if ($hit != NULL) {
            $this->db->where(array('uri' => $uri, 'date' => strtotime(date('d-M-Y'))));
            $this->db->update($this->table, array('count' => $hit->count + 1));

            if (!$this->session->has_userdata('visited')) {
                $this->db->where(array('uri' => $uri, 'date' => strtotime(date('d-M-Y'))));
                $this->db->update($this->table, array('sessions' => $hit->sessions + 1));
            }
        } else {
            $data['uri'] = $uri;
            $data['date'] = strtotime(date('d-M-Y'));
            $data['count'] = 1;
            $data['sessions'] = 1;
            $data['is_total'] = 1;
            $this->db->insert($this->table, $data);
        }


    }

    public function get_hit_data($uri)
    {
        log_message('debug', "Executing Hits_model::get_hit_data({$uri}).");

        $query = $this->db->get_where($this->table, array('uri' => $uri, 'date' => strtotime(date('d-M-Y'))), 1);
        return $query->row();
    }

    public function get_todays_top()
    {
        log_message('debug', 'Executing Hits_model::get_today_stop().');

        $this->db->order_by('count', 'DESC');
        $this->db->where('date', strtotime(date('d-M-Y')));

        // Suppress this line if no status_code column in Hits table yet.
        if ($this->db->field_exists('status_code', 'hits')) {
            $this->db->group_start();
            $this->db->where('status_code !=', 404);
            $this->db->where('status_code !=', 410);
            $this->db->or_where('status_code', NULL);
            $this->db->group_end();
        }

        $this->db->limit(5);
        $query = $this->db->get_where($this->table);
        return $query->result();
    }

    /**
     *   Get the 5 Most Popular Sermons by views.
     */
    public function get_top_sermons()
    {

        log_message('debug', 'Executing Hits_model::get_top_sermons().');
        // Select all and add count.
        $this->db->select('*');
        $this->db->select_sum('count');
        // Get Top 5.
        $this->db->limit(5);
        // Order by highest to lowest.
        $this->db->order_by('count', 'DESC');
        // Get hits for sermon views.
        $this->db->like('uri', 'sermons/view/', 'left');
        // Do not get data with jpg file extension.
        $this->db->not_like('uri', '.jpg', 'right');
        // Group the URI if same.
        $this->db->group_by('uri');

        $query = $this->db->get($this->table);

        return $query->result();
    }
}