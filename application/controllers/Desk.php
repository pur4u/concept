<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desk extends CI_Controller {
	 function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url', 'captcha', 'cookie'));
		$this->load->library('form_validation');
		 $this->load->library('email', NULL, 'ci_email');
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->load->database();
	} 

	public function index() {
		if ($this->input->cookie('email_concept') || $this->input->cookie('password_concept')) { 
			$query = $this->db->get_where('concept', array( 'email' => $this->input->cookie('email_concept'), 'parola' => $this->input->cookie('password_concept')));
			if($query->num_rows() != 0) { redirect('autentificare/home'); }
		}	

		$data['title'] = 'Desk | Landing Office - Concept | Title';
		$data['description'] = 'Desk | Landing Office - Concept | Description';
		
		$data['captcha'] = $this->generate_captcha();

		$this->load->view('inc/header', $data);
		$this->load->view('inc/menu', $data);
		$this->load->view('desk', $data);
		$this->load->view('inc/footer', $data);		
		
	}

	private function generate_string($min, $max) {
		$pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$pool = str_shuffle($pool);
		$str = '';
		for ($i = 0; $i < 5; $i++) { $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1); }
		return $str;
	}	
		
	private function generate_captcha() {
		$this->load->helper('captcha');
		//$this->load->library('session');
		$word = $this->generate_string(2,5);
		$vals = array(
			'word' => $word,
			'img_path' => './captcha/',
			'img_url'=> base_url().'captcha',
			'img_width' => '150',
			'img_height' => 40,
			'border' => 0, 
			'expiration' => 3600 //1h
		);

		$cap = create_captcha($vals);
		if($this->cache->get('image_data') && file_exists("./captcha/".$this->cache->get('image_data'))) { unlink("./captcha/".$this->cache->get('image_data')); }
//		$this->session->set_userdata(array('captcha'=>$cap['word'], 'image' => $cap['time'].'.jpg'));
		$this->cache->save('captcha_data', $cap['word'], 300);
		$this->cache->save('image_data', $cap['time'].'.jpg', 300);
		return $cap['image'];
	}	

 
    public function refresh_captcha() {
		$new_captcha = $this->generate_captcha();
		echo "".$new_captcha;	
    }
	
    public function inregistrare() {
	$code = $this->input->post('captcha');
	if (strtoupper($code) == strtoupper($this->cache->get('captcha_data'))) {
		if($this->cache->get('image_data') && file_exists("./captcha/".$this->cache->get('image_data'))) { unlink("./captcha/".$this->cache->get('image_data')); }

		$this->load->library('form_validation', 'encrypt', 'email');
		$this->form_validation->set_rules('nume', 'Nume', 'trim|required');
		$this->form_validation->set_rules('prenume', 'Prenume', 'trim|required');
		$this->form_validation->set_rules('telefon', 'Telefon', 'trim|required|max_length[10]|regex_match[/^[0-9-+]+$/]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('parola', 'Parola', 'trim|required|min_length[8]|regex_match[/[0-9]/]');
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[concept.email]');

		if(!$this->form_validation->run()){
			$data = array( 'result' => 0, 'msg' => 'Datele nu sunt valide.');
			echo json_encode($data);
			exit;
		} else {
				$email = $this->input->post('email');	
                $this->db->select('email');
                $this->db->from('concept');
                $this->db->where('email', $email);
                $this->db->limit(2);
                $query = $this->db->get();
					if ($query->num_rows() == 0) {
						$key = md5(microtime().rand());
						$data_sql = array(
							'nume' => $this->input->post('nume'),
							'prenume' => $this->input->post('prenume'),
							'telefon' => $this->input->post('telefon'),
							'email' => $email,
							'parola' => md5($this->input->post('parola')),
							'confirm' => $key,
						);			
						$this->db->insert('concept', $data_sql);

						
						$header = 'From: contact@pur4u.ro' . "\r\n" .
									'Reply-To: contact@pur4u.ro' . "\r\n" .
									'X-Mailer: PHP/' . phpversion();
						$mesaj = 'Salutare, <br>' . "\r\n";
						$mesaj .= 'Linkul de activare este  <a href="' . base_url('/autentificare/activare/?cod=') . $key . '" target="_blank">' . base_url('/autentificare/activare/?cod=') . $key . '</a><br><br>' . "\r\n";
						$mesaj .= 'Multumesc.<br>' . "\r\n";
						$mesaj .= 'Ovidiu L.<br>' . "\r\n";
						//mail($email, 'Activare cont | Concept', $mesaj, $header);

						$this->ci_email->initialize(array(
							'protocol' => 'smtp',
							'smtp_host' => isset($_SERVER['smtpHost']) ? $_SERVER['smtpHost'] : '',
							'smtp_user' => isset($_SERVER['smtpUser']) ? $_SERVER['smtpUser'] : '',
							'smtp_pass' => isset($_SERVER['smtpPass']) ? $_SERVER['smtpPass'] : '',
							'smtp_port' => isset($_SERVER['smtpPort']) ? $_SERVER['smtpPort'] : '',
							'mailtype' => "html",
							//'crlf' => "\r\n",
							'newline' => "\r\n"
						));

						$this->ci_email->from('contact@pur4u.ro', 'Pur4u.ro');
						$this->ci_email->to($email);
						$this->ci_email->subject('Activare cont | Concept');
						$this->ci_email->message($mesaj);
						$this->ci_email->send();

						$data = array( 'result' => 1, 'msg' => 'Inregistrat. Te rugam sa activezi adresa de email.');
						//$data = array( 'result' => 1, 'msg' => $this->ci_email->send());
							echo json_encode($data);
							exit;	
	
					} else {
						$data = array( 'result' => 0, 'msg' => 'Adresa de email exista in baza de date.');
						echo json_encode($data);	
						exit;					
					}
		}	
		
	} else {
			$data = array( 'result' => 0, 'msg' => 'Codul captcha nu este valid.');
			echo json_encode($data);
			exit;
	}		
   }	
	
}