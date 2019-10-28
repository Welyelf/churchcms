<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $data = array();
    protected $settings = array();

    function __construct()
    {
        parent::__construct();
        $settings = $this->settings_model->get_all();
        foreach ($settings as $setting) {
            $this->settings[$setting->name] = $setting->value;
        }
        $timezones = get_timezones();
        if (isset($this->settings['timezone']) && array_key_exists($this->settings['timezone'], $timezones)) {
            date_default_timezone_set($this->settings['timezone']);
        } else {
            log_message('error', 'Timezone not set. Defaulting to America/Los_Angeles.  Possible values are: '
                . implode(", ", array_keys($timezones)) . '.');
            date_default_timezone_set('America/Los_Angeles');
        }


        $uri = uri_string() == NULL ? '/' : uri_string();

        //HIT COUNTER CODE
        if (strpos($uri, 'admin') === FALSE && strpos($uri, 'auth') === FALSE && strpos($uri, 'assets') === FALSE) {

            if ($this->hits->get_hit_data($uri)) {
                if (!$this->session->has_userdata('url_' . $uri)) {
                    $this->hits->increment($uri, TRUE);

                    $this->output->set_status_header(200);

                    if ($this->db->field_exists('status_code', 'hits'))
                        $this->hits->update_status_code($uri, http_response_code());

                } else {
                    $this->hits->increment($uri);

                    if ($uri == 'errors/not-found') {

                        $this->output->set_status_header(404);

                        if ($this->db->field_exists('status_code', 'hits'))
                            $this->hits->update_status_code($uri, http_response_code());

                    }
                }
            } else {
                $this->hits->add($uri);
            }

            $this->session->set_userdata('url_' . $uri, '1');
            $this->session->set_userdata('visited', '1');
        }
        //END HIT COUNTER

        $this->data['settings'] = (object)$this->settings;

        //FORM ERROR WRAPPER
        $this->form_validation->set_error_delimiters('<div class="form-error"><small>', '</small></div>');

    }
}