<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transcript_requests_model extends CI_Model
{

    protected $table = "transcript_requests";

    public function __construct()
    {
        parent::__construct();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Transcript_Requests_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Trasncript_request_model::add().", $log_data);

        if ($this->db->insert($this->table, $input)) {
            log_message('info', "New Transcript Requests Added with email {$input['email']} by {$this->session->user->id}.");
            return $this->db->insert_id();
        } else {
            log_message('error', "Database Error: Cannot Add Transcript Request with email {$input['email']} by {$this->session->user->id}.", json_encode($this->db->error()));
            return false;
        }
    }

}