<?php
class MY_Router extends CI_Router {

	/**
	 * Validate request
	 *
	 * Attempts validate the URI request and determine the controller path.
	 *
	 * @used-by CI_Router::_set_request()
	 * @param   array   $segments   URI segments
	 * @return  mixed   URI segments
	 */
	protected function _validate_request($segments)
	{
		$c = count($segments);
		$directory_override = isset($this->directory);
        // Loop through our segments and return as soon as a controller
		// is found or when such a directory doesn't exist
		while ($c-- > 0)
		{
			$test = $this->directory.ucfirst($this->translate_uri_dashes === TRUE ? str_replace('-', '_', $segments[0]) : $segments[0]);

			if (!file_exists(APPPATH.'controllers/'.$test.'.php') && $directory_override === FALSE && is_dir(APPPATH.'controllers/'.$this->directory.$segments[0])) {
				$this->set_directory(array_shift($segments), TRUE);
				continue;
			}
			else if (file_exists(APPPATH.'controllers/'.$test.'.php')){
				return $segments;
			}
		}
    }
}