<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 */
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
	} 

	
	public function index() {
		$data['title'] = 'Landing Office - Concept | Title';
		$data['description'] = 'Landing Office - Concept | Description';
		
		$this->load->view('inc/header', $data);
		$this->load->view('inc/menu', $data);
		$this->load->view('home', $data);
		$this->load->view('inc/footer', $data);
		
	}
	
}