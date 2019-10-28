<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->directory = $this->router->fetch_directory();

        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['posts'] = $this->posts->get_all(FALSE, 0, 'DESC');
        $this->load->view('layout/backend/master', $this->data);
        //$this->load->view(THEME . '/main', $data);
    }

    public function add()
    {
        if ($this->form_validation->run('post_add') == TRUE) {
            $input = $this->input->post();
            $input['date'] = now();
            $categories = FALSE;


            if (isset($input['categories'])) {
                $categories = $input['categories'];
                unset($input['categories']);
            }

            $input['slug'] = strtolower($input['slug']);

            // Do not use XSS Filtering 
            $input['content'] = $this->input->post('content', FALSE);

            $post_id = $this->posts->add($input);

            if ($post_id) {
                if ($categories) {
                    foreach ($categories as $category_id) {
                        $data['category_id'] = $category_id;
                        $data['post_id'] = $post_id;
                        $this->post_categories->add($data);
                    }
                }
                redirect('/admin/posts/success/');
            }
        }

        $this->data['categories'] = $this->categories->get_all(FALSE, 0, 'DESC');
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        $this->data['post'] = $this->posts->get_details($id);
        $input = $this->input->post();

        if ($input) {

            // Do not use XSS Filtering 
            $input['content'] = $this->input->post('content', FALSE);

            if ($input['slug'] == $this->data['post']->slug) {
                $rule_set = 'post_edit';
            } else {
                $rule_set = 'post_add';
            }

            if ($this->form_validation->run($rule_set) == TRUE) {

                $categories = FALSE;

                if (isset($input['categories'])) {
                    $categories = $input['categories'];
                    unset($input['categories']);
                }

                $input['slug'] = strtolower($input['slug']);

                if ($this->posts->update($input)) {

                    $this->post_categories->delete_by_post_id($input['id']);
                    if ($categories) {
                        foreach ($categories as $category_id) {
                            $data['category_id'] = $category_id;
                            $data['post_id'] = $input['id'];
                            $this->post_categories->add($data);
                        }
                    }
                    redirect('/admin/posts/success/' . $id);
                }
            }
        }

        $this->data['categories'] = $this->categories->get_all(FALSE, 0, 'DESC');
        $post_categories = $this->post_categories->get_all_by_post_id($this->data['post']->id);
        $this->data['post_categories'] = array();

        foreach ($post_categories as $category) {
            array_push($this->data['post_categories'], $category->category_id);
        }

        $this->load->view('layout/backend/master', $this->data);
    }

    public function success($post_id = FALSE)
    {
        $data['post_id'] = $post_id;
        $this->load->view('layout/backend/master', $data);
    }

    public function delete($id)
    {

        if ($this->posts->delete($id)) {
            $this->post_categories->delete_by_post_id($id);
            redirect('admin/posts/all');
        }
    }

    public function all_category()
    {
        $this->data['categories'] = array();
        $categories = $this->categories->get_all(FALSE, 0, 'DESC', 'name');

        foreach ($categories as $category) {
            $category = (array)$category;
            $category['count'] = $this->post_categories->count_posts($category['id']);
            array_push($this->data['categories'], (object)$category);
        }

        $this->load->view('layout/backend/master', $this->data);
    }

    public function add_category()
    {
        if ($this->form_validation->run('post_category_add') == TRUE) {
            $input = $this->input->post();

            if ($input) {
                $input['slug'] = strtolower($input['slug']);
                if ($this->categories->add($input)) {
                    redirect('/admin/posts/all-category');
                }
            }
        }
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit_category($id)
    {
        $this->data['category'] = $this->categories->get_details($id);
        $input = $this->input->post();

        if ($input) {

            if ($input['slug'] == $this->data['category']->slug) {
                $rule_set = 'post_category_edit';
            } else {
                $rule_set = 'post_category_add';
            }

            if ($this->form_validation->run($rule_set) == TRUE) {
                if ($input) {
                    $input['slug'] = strtolower($input['slug']);
                    if ($this->categories->update($input)) {
                        redirect('/admin/posts/all-category');
                    }
                }
            }
        }


        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete_category($id)
    {

        if ($this->categories->delete($id)) {
            redirect('/admin/posts/all-category');
        }
    }
}
