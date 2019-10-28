<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sermons extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['sermons'] = $this->sermons->get_sermons(); // Replaced get_all with get_sermons.
        $this->load->view('layout/backend/master', $this->data);
    }

    /**
     *
     */
    public function add($slug = null)
    {
        $this->data['mp3_error'] = FALSE;
        $this->data['transcript_error'] = FALSE;
        $this->data['bulletin_error'] = FALSE;

        if (isset($slug)) {
            $this->data['sermon'] = $this->sermons->get_details_by_slug($slug);
            $this->data['sermon']->scriptures = $this->sermon_scriptures_model->get_sermon_scriptures($this->data['sermon']->id);
        } else {
            $this->data['sermon'] = array();
        }

        // Get allowed file types in settings.
        if (isset($this->settings['sermons_file_types'])) {
            $allowed_types = $this->settings['sermons_file_types'];
            $this->data['allowed_types'] = str_replace('|', ', ', $allowed_types);
            // Set allowed file types to be used in js.
            $this->data['sermons_file_types'] = explode("|", $allowed_types);
            // Default file tags from config.
            $sermon_file_tags = $this->settings['sermons_file_tags'];
            // Change file tags to array.
            $this->data['sermons_file_tags'] = explode("|", $sermon_file_tags);
        }


        if ($this->form_validation->run('sermon') == TRUE) {
            $error = 0;

            $input = $this->input->post();
            $input['date'] = strtotime($input['date']);
            $input['slug'] = preg_replace("/[^A-Za-z0-9\s]/", '', trim($input['title']));
            $input['slug'] = preg_replace("/\s/", '-', $input['slug']);
            $input['slug'] .= "-" . date('F-d-Y', $input['date']);
            $input['slug'] = strtolower($input['slug']);

            // Do not use XSS Filtering 
            $input['transcript'] = $this->input->post('transcript', FALSE);

            // YOUTUBE URL PROCESSOR
            $url = $input['youtube_id'];
            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
                $input['youtube_id'] = $id[1];
            } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
                $input['youtube_id'] = $id[1];
            } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
                $input['youtube_id'] = $id[1];
            } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
                $input['youtube_id'] = $id[1];
            } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
                $input['youtube_id'] = $id[1];
            } else {
                $this->data['youtube_error'] = 1;
            }
            // END YOUTUBE URL PROCESSOR

            // START FILE UPLOAD SCRIPTS
            $this->load->library('upload');

            if (isset($slug)) {
                $id_sermon = $input['id'];
            } else {
                $get_last = $this->sermons->get_last();
                $id_sermon = $get_last->id + 1;
            }
            // Get the auto increment value from the table.
            $sermon_auto_increment_value = $this->sermons->get_auto_increment_val();

            // Different Directory for sermon files.
            $file_dir = '/sermons/' . $id_sermon . '-' . $input['slug'];

            $config['upload_path'] = FCPATH . 'uploads' . $file_dir;

            if (!isset($slug)) {
                // Check if path is a directory.
                if (!is_dir('uploads' . '/sermons/' . $input['slug'])) {
                    // Created directory if does not exist.
                    if (!mkdir('./uploads' . $file_dir, 0755, TRUE)) {
                        return FALSE;
                    }
                }
            } else {
                if (!is_dir('uploads' . '/sermons/' . $input['slug'])) {
                    // Created directory if does not exist.
                    if (!file_exists('uploads' . $file_dir)) {
                        if (!mkdir('./uploads' . $file_dir, 0755, TRUE)) {
                            return FALSE;
                        }
                    }

                }
            }

            $config['overwrite'] = true;
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = 'mp3';


            $this->upload->initialize($config);

            if ($_FILES && $_FILES['mp3']['name']) {
                if (!$this->upload->do_upload('mp3')) {
                    $error = 1;
                    $this->data['mp3_error'] = $this->upload->display_errors();
                } else {
                    $upload_data = $this->upload->data();
                    $this->files->upload($upload_data);
                    $input['mp3_link'] = '/uploads' . $file_dir . '/' . $upload_data['file_name'];
                }
            }

            // Set the allowed types to config, if none use default.
            $config['allowed_types'] = ($allowed_types) ? $allowed_types : 'doc|docx|txt|pdf|ppt|pptx|jpg|jpeg|png';

            $all_files = $this->upload_multiple_files($input, $config, $file_dir);
            $input['file_attachments'] = json_encode($all_files);

            if (array_key_exists('scriptures', $input)) {
                $scriptures = $input['scriptures'];
            } else {
                $scriptures = array();
            }
            unset($input['file_name']);
            unset($input['file_url']);
            unset($input['scriptures']);
            unset($input['file_tag']);
            // END FILE UPLOAD SCRIPTS
            if ($error == 0) {
                if (!isset($slug)) {
                    $input['id'] = $id_sermon;
                    $sermon_id = $this->sermons->add($input);
                    if ($sermon_id) {

                        // Add Data to Sermons_Scriptures Table
                        foreach ($scriptures as $scripture) {
                            $tmp_arr = explode("|", $scripture);

                            $input_data = array(
                                'sermon_id' => $sermon_id,
                                'book_id' => $tmp_arr[0],
                                'chapter_from' => $tmp_arr[1],
                                'verse_from' => $tmp_arr[2],
                                'chapter_to' => $tmp_arr[3],
                                'verse_to' => $tmp_arr[4]
                            );

                            $this->sermon_scriptures_model->add($input_data);
                        }

                        $this->email->from($this->settings['admin_email'], $this->settings['site_name']);
                        $this->email->to('philip@kedrasoft.com');
                        $this->email->cc('welyelf@kedrasoft.com');
                        $this->email->subject('A new sermon has been added');
                        $this->email->message('A new sermon has been added. Here\'s the link: https:' . base_url() . 'sermons/view/' . $input['slug']);
                        $this->email->send();
                        $this->data['success'] = "Sermon added successfully!";
                    } else {
                        $this->data['error'] = "An error occurred. We have logged the error. Please try again or reach out to philip@kedrasoft.com for support.";
                    }
                } else {
                    if ($this->sermons->update($input)) {

                        // Add Data to Sermons_Scriptures Table
                        $this->sermon_scriptures_model->sermon_linked_delete($input['id']);

                        foreach ($scriptures as $scripture) {
                            $tmp_arr = explode("|", $scripture);

                            $input_data = array(
                                'sermon_id' => $input['id'],
                                'book_id' => $tmp_arr[0],
                                'chapter_from' => $tmp_arr[1],
                                'verse_from' => $tmp_arr[2],
                                'chapter_to' => $tmp_arr[3],
                                'verse_to' => $tmp_arr[4]
                            );

                            $this->sermon_scriptures_model->add($input_data);
                        }
                        $this->data['success'] = "Sermon updated successfully!.";
                        redirect('/admin/sermons');

                    } else {
                        $this->data['error'] = "An error occurred. We have logged the error. Please try again or reach out to philip@kedrasoft.com for support.";
                    }

                }

            }
        }

        // Issue #89 - B. Use that value for the Default Sermon Speaker on Settings as the Default Speaker when adding sermons.
        $this->data['default_sermon_speaker'] = $this->settings['default_sermon_speaker'];
        // Default number of sermon attachments.
        $this->data['sermons_attachment_limit'] = $this->settings['sermons_attachment_limit'];
        // Default number of sermon attachments.
        $this->data['sermons_max_file_size'] = $this->settings['sermons_max_file_size'];


        $this->data['books'] = get_bible_books();
        if (isset($this->data['sermon']->book)) {
            $this->data['book_data'] = get_bible_books($this->data['sermon']->book);
        }
        $this->load->view('layout/backend/master', $this->data);
    }

    // Multiple File Upload
    public function upload_multiple_files($input, $config, $file_dir)
    {

        // Add logs for multiple file attachments in sermons.
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Files_model',
            "method" => "upload",
        );
        $log_data = json_encode($log_array);

        log_message('debug', 'Executing Sermons::upload_multiple_files()' . $log_data);


        // Initialize return value.
        $file_array = array();

        $this->upload->initialize($config);
        // File count.

        if (isset($_FILES['fileUpload']['name'])) {
            $file_count = count($_FILES['fileUpload']['name']);
        } else {
            $file_count = 0;
        }

        // Check if files have values.
        if (isset($_FILES['fileUpload'])) {
            for ($x = 0; $x < $file_count; $x++) {

                if (!empty($_FILES['fileUpload']['name'][$x])) {
                    $_FILES['file']['name'] = $_FILES['fileUpload']['name'][$x];
                    $_FILES['file']['type'] = $_FILES['fileUpload']['type'][$x];
                    $_FILES['file']['tmp_name'] = $_FILES['fileUpload']['tmp_name'][$x];
                    $_FILES['file']['error'] = $_FILES['fileUpload']['error'][$x];
                    $_FILES['file']['size'] = $_FILES['fileUpload']['size'][$x];
                    // Update return value.

                    if (isset($input['file_name'][$x])) {
                        $file_array[$x]['file_name'] = $input['file_name'][$x];
                    } else {
                        $file_array[$x]['file_name'] = "";
                    }
                    // Upload file.
                    if (!$this->upload->do_upload('file')) {
                        $this->data['file_error'] = $this->upload->display_errors();
                        $upload_data = array();
                    } else {
                        $upload_data = $this->upload->data();
                        $this->files->upload($upload_data);
                    }
                    // Update return value for file url.
                    $file_array[$x]['file_url'] = '/uploads' . $file_dir . '/' . $upload_data['file_name'];
                    // Update return value for file tag.
                    if (isset($input['file_tag'][$x])) {
                        $file_array[$x]['file_tag'] = $input['file_tag'][$x];
                    } else {
                        $file_array[$x]['file_tag'] = "";
                    }

                }
                // Included previously added files in array.
                if (isset($input['file_url'][$x])) {
                    // Update return value for file url.
                    $file_array[$x]['file_url'] = $input['file_url'][$x];

                    // Update return value.
                    if (isset($input['file_name'][$x])) {
                        $file_array[$x]['file_name'] = $input['file_name'][$x];
                    } else {
                        $file_array[$x]['file_name'] = "";
                    }

                    // Update return value for file tag.
                    if (isset($input['file_tag'][$x])) {
                        $file_array[$x]['file_tag'] = $input['file_tag'][$x];
                    } else {
                        $file_array[$x]['file_tag'] = "";
                    }
                }
            }
        }
        // Return.
        return $file_array;
    }


    public function delete($id)
    {
        // Get the Sermon Details.
        $sermon = $this->sermons->get_sermon_by_id($id);

        if ($this->sermon_scriptures_model->sermon_linked_delete($id))
            if ($this->sermons->delete($id)) {
                // Load the file helper.
                $this->load->helper('file');
                // Directory of the files.
                $file_dir = '/sermons/' . $id . '-' . $sermon->slug;
                // Set the path.
                $path = FCPATH . 'uploads' . $file_dir;

                // Delete all files and folders
                if (delete_files($path, true))
                    rmdir($path); // Delete current directory

                redirect('/admin/sermons');
            }
    }
}
