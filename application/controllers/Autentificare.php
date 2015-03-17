<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentificare extends CI_Controller {
	 function __construct(){
		parent::__construct();
		$this->load->helper('url', 'cookie');
		$this->load->database();
	} 

	
	public function index($error = NULL) {
		if ($this->input->cookie('email_concept') || $this->input->cookie('password_concept')) { 
			$query = $this->db->get_where('concept', array( 'email' => $this->input->cookie('email_concept'), 'parola' => $this->input->cookie('password_concept')));
			if($query->num_rows() != 0) { redirect('autentificare/home'); }
		}
	
		$data['title'] = 'Autentificare | Landing Office - Concept | Title';
		$data['description'] = 'Autentificare | Landing Office - Concept | Description';
		$data['error'] = $error;
		
		$this->load->view('inc/header', $data);
		$this->load->view('inc/menu', $data);
		$this->load->view('autentificare', $data);
		$this->load->view('inc/footer', $data);		
		
	}
	
	public function activare() {
		if ($this->input->get('cod')) {
			$data = array('confirm' => '');
			$this->db->where('confirm', $this->input->get('cod'));
			$this->db->update('concept', $data);
			
			$dataP['title'] = 'Activare | Landing Office - Concept | Title';
			$dataP['description'] = 'Activare | Landing Office - Concept | Description';
			$this->load->view('inc/header', $dataP);
			$this->load->view('inc/menu', $dataP);
			$this->load->view('activare');
			$this->load->view('inc/footer', $dataP);					
		
		} else { redirect('autentificare'); }
	}
	
	public function autentificare_process() {
		if ($this->input->cookie('email_concept') || $this->input->cookie('password_concept')) { 
			$query = $this->db->get_where('concept', array( 'email' => $this->input->cookie('email_concept'), 'parola' => $this->input->cookie('password_concept')));
			if($query->num_rows() != 0) { redirect('autentificare/home'); }
		}	
		if ($this->input->post('email') && $this->input->post('parola')) {
		$query = $this->db->get_where('concept', array( 'email' => $this->input->post('email'), 'parola' => md5($this->input->post('parola')) ));
			if($query->num_rows() == 0) { 
				$this->index('Emailul ori parola sunt tastate gresit.');
			} else {
				if ($query->row()->confirm == NULL) {
					
					 $cookie_email = array(
					   'name'   => 'email_concept',
					   'value'  => $query->row()->email,
					   'expire' => '1800',
					   'path'   => '/'
					);
					 $cookie_password = array(
					   'name'   => 'password_concept',
					   'value'  => $query->row()->parola,
					   'expire' => '1800',
					   'path'   => '/'
					);
					$this->input->set_cookie($cookie_email);
					$this->input->set_cookie($cookie_password);						
					redirect('autentificare/home');
					
				} else { $this->index('Acest email trebuie confirmat!'); }
			}
		} else { $this->index('Ai nevoie de email si parola? :)'); }
	}
	
	public function home() {
		if (!$this->input->cookie('email_concept') || !$this->input->cookie('password_concept')) { redirect('autentificare'); exit; }
		$query = $this->db->get_where('concept', array( 'email' => $this->input->cookie('email_concept'), 'parola' => $this->input->cookie('password_concept')));
			if($query->num_rows() != 0) { 
				//print_r ($query->row());
				$data['title'] = 'Home Autentificare | Landing Office - Concept | Title';
				$data['description'] = 'Home Autentificare | Landing Office - Concept | Description';
				$data['nume'] = $query->row()->nume;
			
				$this->load->view('inc/header', $data);
				$this->load->view('inc/menu', $data);
				$this->load->view('autentificare_home', $data);
				$this->load->view('inc/footer', $data);
				
			} else { $this->index('Email si parola nu apar inregistrate! :D'); } 
	}

	public function iesire() { 
		unset($_COOKIE['email_concept']);
		unset($_COOKIE['password_concept']);
		$this->input->set_cookie('email_concept', null);
		$this->input->set_cookie('password_concept', null);	
		redirect('autentificare');
	}	
}