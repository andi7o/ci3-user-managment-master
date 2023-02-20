<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function _output($content)
	{
		// Load the base template with output content available as $content
		$data['content'] = &$content;
		$data['header'] = $this->load->view('layouts/header', [],true);
		$data['sidebar'] = $this->load->view('layouts/sidebar', [],true);
		$data['navbar'] = $this->load->view('layouts/navbar', [],true);
		$data['footer'] = $this->load->view('layouts/footer', [],true);
		echo($this->load->view('template', $data, true));
	}

}
