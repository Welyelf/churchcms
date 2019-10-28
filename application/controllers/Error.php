<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MY_Controller
{

    public function not_found()
    {
        $this->load->view('layout/frontend/master', $this->data);
    }
}
