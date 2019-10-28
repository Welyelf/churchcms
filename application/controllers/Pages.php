<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Required Models
        if (!class_exists('Pages_model')) {
            $this->load->model('Pages_model', 'pages');
        }
    }

    public function view($slug)
    {

        $this->data['page'] = $this->pages->get_details_by_slug($slug);

        if ($page = $this->data['page']) {
            // Check if page is active. Then redirect to 404. Allow only admin users that are currently login to view the page.
            if (!$page->is_active && !$this->session->user)
                redirect('/errors/not-found');
            // Check if page is still draft. Redirect to 404 if yes.
            if (!$page->status && !$this->session->user)
                redirect('/errors/not-found');

            $this->data['author'] = $this->users->get_details($this->data['page']->author_id);

        }

        if (empty($this->data['page'])) {
            redirect('/errors/not-found');
        }

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function override_404()
    {
        $uri = uri_string();

        //Returns HTTP status code 410 for this set of URLS; routing rules apply for everything else.
        $paths_to_http_410 = array(
            'Calendar_temp/action~',
            'calendar-temp/action~',
            'Assets/plugins',
            'Wp_content/',
            'wp-content/',
            'Wp_includes/',
            'wp-includes/',
            'Wp-admin/',
            'wp-admin/',
        );

        foreach ($paths_to_http_410 as $path) {
            if (strpos($uri, $path) === 0) {
                show_error('The page you are looking for is no longer available.', 410, 'Error 410 - Page Deleted or is now Gone.');
                exit;
            }
        }

        //log_message('error', '404 Page Not Found. Requested URI: ' . $uri);

        redirect('/errors/not-found');
    }

    public function send()
    {
        $input = $this->input->post();
        $this->data['error'] = FALSE;
        $this->data['success'] = FALSE;
        if ($input) {
            $this->load->library('email');
            $message = $input['message'];
            $this->email->set_newline("\r\n");
            $this->email->from($input['email'], $input['name']);
            $this->email->to($this->settings['admin_email']);
            $this->email->subject($input['subject']);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->data['success'] = TRUE;
                redirect('/contact-us');
            } else {
                log_message('Error', "{$this->email->print_debugger()}");
                $this->data['error'] = TRUE;
                redirect('/contact-us');
            }
        }

    }

    public function watch_live()
    {

        $this->load->view('layout/frontend/master', $this->data);
    }
}
