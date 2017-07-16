<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		#Load flickr model
		$this->load->model('flickr_model');
		
		# Load View
		$this->load->view('welcome_message');
	}
}
