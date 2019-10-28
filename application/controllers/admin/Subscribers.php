<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['subscribers'] = $this->subscribers->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete($id)
    {
        if ($this->subscribers->delete($id)) {
            redirect('/admin/subscribers/all');
        }
    }

    public function send($id = null)
    {
        $input = $this->input->post();

        $this->data['email_templates'] = $this->emails->get_all();
        $this->data['sermons'] = $this->sermons->get_sermons();

        // Set a To email field for single email.
        if ($id)
            $this->data['subscriber'] = $this->subscribers->get_details($id);

        if ($input) {

            // Do not use XSS Filtering 
            $message = $this->input->post('message', FALSE);

            if (isset($input['sermon'])) {
                $message = $this->reconstruct_message($message, $input);
            }

            // Set the Site Name.
            $site_name = $this->settings['site_name'];
            $headers = "From: {$site_name} CMS <noreply@kedrasoft.com> \r\n";
            $headers .= 'Content-type: text/html; charset=utf-8\r\n';

            if (isset($input['email'])) {
                // Update the name.
                if ($input['subscriber_name'])
                    $message = str_replace("{subscribers:name}", $input['subscriber_name'], $message);
                // Send email.
                mail($input['email'], $input['subject'], $message, $headers);
            } else {
                // Get all subscribers.
                $subscribers = $this->subscribers->get_all();
                // Set the original message.
                $original_message = $message;
                // Send to all subscribers.
                foreach ($subscribers as $subscriber) {
                    // Update the name.
                    $message = str_replace("{subscribers:name}", $subscriber->name, $original_message);
                    // Send email.
                    mail($subscriber->email, $input['subject'], $input['message'], $headers);
                }
            }

            redirect('admin/subscribers/all');
        }

        $this->load->view('layout/backend/master', $this->data);
    }

    public function get_template()
    {

        $input = $this->input->post();
        if ($input) {
            $id = $input['id'];
            $template = $this->emails->get_details($id);

            echo json_encode($template);
        }

    }

    /**
     *   Reconstruct the message based from the snippets.
     **/
    public function reconstruct_message($message, $input)
    {

        $sermon_id = $input['sermon'];
        $sermon = $this->sermons->get_details($sermon_id);
        // Get the multiple scriptures of the sermon.
        $passages = $this->sermon_scriptures_model->get_sermon_scriptures($sermon_id);
        // Initialize the sermon passage.
        $sermon_passage = '';
        // Create a script from the passages.
        if ($passages)
            foreach ($passages as $passage) {
                $scripture = array(
                    $passage->book_id,
                    $passage->chapter_from,
                    $passage->verse_from,
                    $passage->chapter_to,
                    $passage->verse_to
                );

                $script = get_scripture_label($scripture);
                // Update the multiple script.
                $sermon_passage .= $script;
                // Add comma for multiple scriptures.
                if (next($passages))
                    $sermon_passage .= ', ';
            }
        else
            $sermon_passage = "No Passage";

        // Replace the data based on the sermon snippets.
        $message = str_replace("{sermons:title}", $sermon->title, $message);
        $message = str_replace("{sermons:passage}", $sermon_passage, $message);
        $message = str_replace("{sermons:pastor}", $sermon->pastor, $message);
        $message = str_replace("{sermons:transcript}", $sermon->transcript, $message);

        // Return the reconstructed message based on the snippets provided.
        return $message;
    }

}