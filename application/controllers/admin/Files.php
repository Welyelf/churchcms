<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['files'] = $this->files->get_all();

        $this->load->view('layout/backend/master', $this->data);
    }

    public function upload()
    {
        $this->load->view('layout/backend/master', $this->data);
    }

    public function do_upload()
    {

        $config['upload_path'] = FCPATH . 'uploads';
        $config['overwrite'] = true;
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = '*';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            echo $config['upload_path'];
            var_dump($error);
            exit;
        } else {
            $upload_data = $this->upload->data();
            $this->files->upload($upload_data);
        }
    }

    public function delete($id)
    {
        $filename = $this->files->get_details($id, 'name');

        if ($this->files->delete($id)) {
            unlink(FCPATH . 'uploads/' . $filename);
            redirect('/admin/files/all');
        }
    }
}