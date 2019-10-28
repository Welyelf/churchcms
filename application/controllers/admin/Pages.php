<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->directory = $this->router->fetch_directory();

        // Required Models
        if (!class_exists('Pages_model')) {
            $this->load->model('Pages_model', 'pages');
        }

        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['pages'] = $this->pages->get_all();
        $this->load->view('layout/backend/master', $this->data);
        //$this->load->view(THEME . '/main', $data);
    }

    public function add($id = NULL)
    {
        if (isset($id)) {
            $this->data['page'] = $this->pages->get_details($id);
        }
        $input = $this->input->post();
        if ($input) {
            // Do not use XSS Filtering
            $input['content'] = $this->input->post('content', FALSE);

            if ($input['slug'] == $this->data['page']->slug) {
                $rule_set = 'page_edit';
            } else {
                $rule_set = 'page_add';
            }

            if ($this->form_validation->run($rule_set) == TRUE) {
                //$input['date'] = now();
                $input['slug'] = strtolower($input['slug']);

                if (isset($id)) {
                    $this->pages->update($input);
                } else {
                    $this->pages->add($input);
                }
                redirect('/admin/pages/');
            }
        }
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        $this->data['page'] = $this->pages->get_details($id);
        $input = $this->input->post();

        if ($input) {

            // Do not use XSS Filtering 
            $input['content'] = $this->input->post('content', FALSE);

            if ($input['slug'] == $this->data['page']->slug) {
                $rule_set = 'page_edit';
            } else {
                $rule_set = 'page_add';
            }

            if ($this->form_validation->run($rule_set) == TRUE) {
                $input['slug'] = strtolower($input['slug']);

                if ($this->pages->update($input)) {
                    redirect('/admin/pages/success/' . $id);
                }
            }
        }


        $this->load->view('layout/backend/master', $this->data);
    }


    public function success($page_id = FALSE)
    {
        $this->data['page_id'] = $page_id;
        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete($id)
    {

        if ($this->pages->delete($id)) {
            redirect('/admin/pages');
        }
    }
}
