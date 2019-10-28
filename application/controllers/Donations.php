<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donations extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['plans'] = $this->plans->get_all();
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function addUser()
    {

    }


}