<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Required Models
        if (!class_exists('Posts_model')) {
            $this->load->model('Posts_model', 'posts');
        }

        $this->data['is_blog'] = TRUE;
    }

    public function view($slug)
    {
        $this->data['post'] = $this->posts->get_details_by_slug($slug);

        if ($post = $this->data['post']) {
            // Check if post is active. Then redirect to 404. Allow only admin users that are currently login to view the post.
            if (!$post->is_active && !$this->session->user)
                redirect('/errors/not-found');

            $this->data['author'] = $this->users->get_details($this->data['post']->author_id);

        }
        if ($this->data['post'] == NULL) {
            redirect('/errors/not-found');
        }

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function blog($id = null)
    {

        $limit_per_page = 3;

        //$total_records = $this->db->get('posts')->num_rows();
        $total_records = $this->posts->get_row_count();

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if (isset($this->settings['post_pagination']) || $limit_per_page > 0) {
            $limit_per_page = whole_number($this->settings['post_pagination'], $limit_per_page);
        } else {
            log_message('error', "post_pagination must be a positive integer and not less than 0. {$this->settings['post_pagination']} Using default value of {$limit_per_page}.");
        }

        if ($total_records > 0) {
            $this->load->library('pagination');

            $this->data['posts'] = $this->posts->get_all($limit_per_page, $page * $limit_per_page, $is_active = FALSE, 'DESC');
            //$this->data['posts'] = array(); 
            $config['base_url'] = '/blog/page/';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['num_links'] = 2;
            $config['use_global_url_suffix'] = FALSE;
            $config['use_page_numbers'] = TRUE;
            $config['uri_segment'] = 3;

            $this->pagination->initialize($config);
            $this->data['link'] = $this->pagination->create_links();
        }

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function category_archive($slug)
    {
        //$posts = $this->posts->get_all($config['per_page'],$this->uri->segment(2),'DESC');
        $category = $this->categories->get_details_by_slug($slug);
        $posts = $this->posts->get_all_by_category($category->id, FALSE, 1, 'DESC', $is_active = FALSE);
        $this->data['posts'] = array();

        foreach ($posts as $post) {
            $categories = array();
            $post_categories = $this->post_categories->get_all_by_post_id($post->id);

            foreach ($post_categories as $post_category) {
                $category_str = "<a href='/blog/category/{$post_category->slug}'>{$post_category->name}</a>";
                array_push($categories, $category_str);
            }

            $post = (array)$post;
            $post['categories'] = implode(",", $categories);
            $post = (object)$post;
            array_push($this->data['posts'], $post);
        }

        $this->data['category_name'] = $category->name;
        $this->data['category'] = $category;

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function browse_category()
    {

        $this->data['categories'] = array();
        $categories = (array)$this->categories->get_all(FALSE, 0, 'DESC');

        foreach ($categories as $category) {
            $category = (array)$category;
            $category['count'] = $this->post_categories->count_posts($category['id']);
            array_push($this->data['categories'], (object)$category);
        }

        $this->load->view('layout/frontend/master', $this->data);

    }
}
