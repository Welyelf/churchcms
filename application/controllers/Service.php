<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function transcription()
    {
        $input = $this->input->post();

        if ($input) {
            $input['type'] = "transcription";
            $input['amount'] = 50.00;
            $input['status'] = 'paid';
            $input['date'] = now();

            /* VIDEO UPLOAD*/
            if (!empty($_FILES['video_file']['name'])) {
                $config['upload_path'] = FCPATH . 'uploads/orders/transcription';
                $config['overwrite'] = true;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('video_file')) {
                    $upload_data = $this->upload->data();
                    $input['video_link'] = '/uploads/orders/transcription/' . $upload_data["file_name"];
                    //var_dump($upload_data); exit;
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo $config['upload_path'];
                    var_dump($error);
                    exit;
                }
            }

            $this->orders->add($input);

            if (empty($input['youtube_link'])) {
                $link = 'http:' . base_url() . $input['video_link'];
            } else {
                $link = $input['youtube_link'];
            }

            $this->email->from($this->settings['admin_email'], $this->settings['site_name']);
            $this->email->to('philip@kedrasoft.com');
            $this->email->subject('New Transcription Order');
            $this->email->message('A new transcription order has been received. Here\'s the link to the video: ' . $link);
            $this->email->send();

            redirect('/service/transcription-order-success');
        }

        $this->data['heading'] = "Sermon Transcription";
        $this->data['subheading'] = "We offer sermon transcription service for a minimal fee.<br/>You only pay for the transcriptions you actually need and not for a fixed monthly fee.";
        $this->data['button_text'] = "Get Started!!";
        $this->data['button_link'] = "#";

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function transcription_order_success()
    {
        $this->load->view('layout/frontend/master', $this->data);
    }


}
