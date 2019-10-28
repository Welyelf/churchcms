<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sermons extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();


    }

    public function view($slug = null)
    {

        // Add logs for Sermon View.
        $log_array = array(
            "class" => 'Sermons',
            "method" => "view",
        );
        $log_data = json_encode($log_array);
        log_message('debug', "Executing Sermons::view({$slug})", $log_data);

        if ($slug == null) {
            redirect('/sermons');
        }

        // Get sermon_details.
        $sermon_details = $this->sermons->get_details_by_slug($slug);
        // Check if sermon is active. Then redirect to 404. Allow only admin users that are currently login to view the sermon.
        if (!$sermon_details->is_active && !$this->session->user) {
            redirect('/errors/not-found');
        }

        $this->data['sermon'] = $sermon_details;
        // Get the passages associated with the sermon.
        $this->data['passages'] = $this->sermon_scriptures_model->get_sermon_scriptures($sermon_details->id);
        // Get sermon attachments. Check first if file attachments have data (Sermon Attachment is already using the new json column) then decode.
        $this->data['sermon_attachments'] = isset($sermon_details->file_attachments) ? json_decode($sermon_details->file_attachments) : '';

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function sermons($slug = null)
    {
        $limit_per_page = 12;
        if (isset($this->settings['sermon_pagination']) || $limit_per_page > 0) {
            $limit_per_page = whole_number($this->settings['sermon_pagination'], $limit_per_page);
        } else {
            log_message('error', "sermon_pagination must be a positive integer and not less than 0. {$this->settings['sermon_pagination']} Using default value of {$limit_per_page}.");
        }
        $total_records = $this->sermons->get_row_count($browse = FALSE, $slugs = "", $is_active = FALSE);

        if (empty($this->settings['sermon-display'])) {
            $this->data['sermon_display'] = "thumbnail";
            log_message('error', "Sermon display is not set.Using default value of 'thumbnail'.");
        } else {
            $this->data['sermon_display'] = $this->settings['sermon-display'];
        }

        if ($limit_per_page > $total_records) {
            $limit_per_page = $total_records;
        }

        if ( isset($slug) && $this->uri->segment(2) != null && $slug != "all" ) {
            // Show sermons of chosen book.
            if ($this->uri->segment(2) == "browse" && $this->uri->segment(3)  != null ) {
                $book_slug = get_book_slug($slug, FALSE);
                $this->data['book_name'] = $book_slug;
                //Get sermons with keyword and slug.
                $this->data['paginate'] = $limit_per_page;
                $sermons = $this->sermons->get_sermons($keyword = FALSE, $book_slug, $limit_per_page = 0, $limit_per_page = 0, 'DESC', $is_active = FALSE);

                // Initialize a new sermon array.
                $sermons_new = array();

                // Loop each sermon data to get their passages/scriptures.
                foreach ($sermons as $sermon) {
                    // Get all the passages of the sermon from the scriptures table.
                    $sermon->passages = $this->sermon_scriptures_model->get_sermon_scriptures($sermon->id);
                    //Push the new sermon with passages to the new sermon array.
                    array_push($sermons_new, $sermon);
                }
                // Set Sermons with the new sermon array generated.
                $this->data['sermons'] = $sermons_new;
            } // Browse all books.
            else {
                // Initialize books array.
                $books = array();

                $bible_books = get_bible_books();
                // Array counter.
                $i = 1;
                foreach ($bible_books as $book) {
                    // Set values for book name and available sermons.
                    $books[$i]['name'] = $book['short_name'];
                    $books[$i]['count'] = $this->sermons->get_book_count($book['short_name']);
                    // Increment count.
                    $i++;
                }
                // Set books for views.
                $this->data['books'] = $books;
            }
        } else {
            if ($total_records > 0) {
                // Get sermons data.
                if ($this->uri->segment(2) == "all") {
                    $this->data['paginate'] = $limit_per_page;
                    $sermons = $this->sermons->get_sermons($keyword = FALSE, $browse = FALSE, $limit_per_page = 0, $limit_per_page = 0, 'DESC', $is_active = FALSE);
                } else {
                    $this->data['start'] = "1";
                    $this->data['end'] = $limit_per_page;
                    $this->data['total'] = $total_records;
                    $sermons = $this->sermons->get_sermons($keyword = FALSE, $browse = FALSE, $limit_per_page, $limit_per_page = 0, 'DESC', $is_active = FALSE);
                }
                // Initialize a new sermon array.
                $sermons_new = array();
                // Loop each sermon data to get their passages/scriptures.
                foreach ($sermons as $sermon) {
                    // Get all the passages of the sermon from the scriptures table.
                    $sermon->passages = $this->sermon_scriptures_model->get_sermon_scriptures($sermon->id);
                    // Push the new sermon with pa$sermon_displayssages to the new sermon array.
                    array_push($sermons_new, $sermon);
                }
                // Set Sermons with the new sermon array generated.
                $this->data['sermons'] = $sermons_new;
            }
        }
        $this->load->view('layout/frontend/master', $this->data);
    }


    public function request_transcript()
    {

        $input = $this->input->post();
        $input['datetime'] = now();

        $sermon = $this->sermons->get_details($input['sermon_id']);
        $site_name = $this->settings['site_name'];

        $to = 'philip@kedrasoft.com';
        $subject = "[{$site_name}] New Sermon Transcript Request";
        $message = 'A transcript has been requested for the sermon: ' . $sermon->title . '(' . date('F d, Y', $sermon->date) . '). Please notify ' . $input['email'] . ' when the transcript is available.';
        $headers = "From: {$site_name} CMS <noreply@kedrasoft.com> \r\n";
        $headers .= 'Content-type: text/html; charset=utf-8\r\n';

        if (mail($to, $subject, $message, $headers)) {
            $this->transcript_requests->add($input);
            redirect('/sermons/request-transcript-success/');
        }
    }

    public function request_transcript_success()
    {
        $this->load->view('layout/frontend/master', $this->data);
    }
}
