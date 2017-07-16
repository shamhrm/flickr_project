<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		#Load flickr model
		$this->load->model('flickr_model');
		
		# Call model to get recent photos from Flickr
		$data['recentphotos'] = $this->flickr_model->getRecentphotos();
		
		# Load View
		$this->load->view('welcome_message', $data);
	}
}
