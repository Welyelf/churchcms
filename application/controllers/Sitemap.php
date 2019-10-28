<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends MY_Controller
{

    public function index()
    {
        // Get All Pages.
        $this->data['pages'] = $this->pages->get_all(FALSE, 0, 'ASC', FALSE);
        // Get All Sermons.
        $this->data['sermons'] = $this->sermons->get_sermons(FALSE, FALSE, FALSE, 0, "DESC", FALSE);
        // Get All Posts
        $this->data['posts'] = $this->posts->get_all(FALSE, 0, 'ASC', FALSE);
        // Get All Post Categories
        $this->data['post_categories'] = $this->categories->get_all();

        $this->load->view('layout/frontend/master', $this->data);
    }

    // Function to get sitemap with XML.
    public function sitemap_xml()
    {
        // Get All Pages.
        $this->data['pages'] = $this->pages->get_all(FALSE, 0, 'ASC', FALSE);
        // Get All Sermons.
        $this->data['sermons'] = $this->sermons->get_sermons(FALSE, FALSE, FALSE, 0, "DESC", FALSE);
        // Get All Posts
        $this->data['posts'] = $this->posts->get_all(FALSE, 0, 'ASC', FALSE);
        // Get All Post Categories
        $this->data['post_categories'] = $this->categories->get_all();

        // Set page content to xml.
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap/sitemap", $this->data);
    }
}
