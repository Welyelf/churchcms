<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customizations extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function index()
    {
        $this->data['customizations'] = $this->home_model->get_all_widgets();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function widgets()
    {
        $this->data['widgets'] = $this->customizations_model->get_all_widgets();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function add_widgets($id = NULL)
    {
        if ($this->form_validation->run('widget_edit') == TRUE) {
            $input = $this->input->post();

            if (!isset($id)) {
                if ($input['function_name'] == "custom_widget") {
                    $input['view_parameters'] = json_encode(array('content' => $input['view_parameters']));
                    unset($input['content']);
                }
                $post_id = $this->customizations_model->add_widget($input);
                if ($post_id) {
                    redirect('/admin/customizations/widgets/');
                }
            } else {
                if ($input['function_name'] == "custom_widget") {
                    $input['view_parameters'] = json_encode(array('content' => html_entity_decode($input['content'])));
                    unset($input['content']);
                }

                $post_id = $this->customizations_model->update_widget($input);

                if ($post_id) {
                    redirect('/admin/customizations/widgets/');
                }
            }
        } else {
            if (isset($id)) {
                $this->data['widget'] = $this->customizations_model->get_all_widgets('id', $id);
                $this->load->view('layout/backend/master', $this->data);
            } else {
                $this->load->view('layout/backend/master', $this->data);
            }

        }
    }

    public function delete_widgets($id)
    {

        if ($this->customizations_model->delete($id)) {
            redirect('/admin/customizations/widgets/');
        }
    }
}
