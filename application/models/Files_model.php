<?php

class Files_model extends CI_Model
{


    protected $table = "files";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        log_message('debug', 'Executing Files_model::get_all().');

        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function upload($upload_data)
    {
        $now = mdate('%Y-%m-%d %h:%i:%s', time());

        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $data['name'] = $upload_data['file_name'];
        $data['ext'] = $upload_data['file_ext'];
        $data['size'] = $upload_data['file_size'];
        $data['mime_type'] = $upload_data['file_type'];
        $data['path'] = $upload_data['file_path'];

        $log_array = array("input" => $data, "user" => $this->session->user, "class" => 'Files_model', "method" => "upload");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing File_model::upload().', $log_data);

        if ($this->db->insert($this->table, $data)) {
            log_message('info', "New Files Uploaded with name {$data['name']} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', 'Database Error: Cannot Upload File.', json_encode($this->db->error()));
            return false;
        }
    }

    public function get_details($id, $field = false)
    {
        log_message('debug', "Executing Files_model::get_details({$id}, {$field}).");

        $query = $this->db->get_where($this->table, array('id' => $id), 1);

        if (!$field) {
            log_message('debug', "No details found with {$id} = {$field}.");
            return $query->row();
        } else {
            $result = $query->row();
            log_message('debug', "{$result} details found with {$id} = {$field}.");
            return $result->$field;
        }

    }

    public function delete($id)
    {
        $this->db->where('id', $id);

        $log_array = array(
            "user" => $this->session->user,
            "class" => 'Files_model',
            "method" => "delete");
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Files_model::delete().', $log_data);

        if ($this->db->delete($this->table)) {
            log_message('info', "Files Deleted with id {$id} by {$this->session->user->id}.");
            return true;
        } else {
            log_message('error', "Database Error: Cannot Delete File with id {$id}.", json_encode($this->db->error()));
            return false;
        }
    }
}