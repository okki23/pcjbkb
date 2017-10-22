<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contact extends MY_Controller {
	public function __construct(){
		parent ::__construct();
	}
	public function index()
	{
		$data['content'] = 'contact/view_contact'; 
		$data['title'] = $this->data['meta_title'];
		$this->load->view('template_frontend',$data);
	}
	public function sendmail(){
	 
		$this->load->library('email');
		
				$this->email->set_newline("\r\n");
		
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.pcj-bakaba.com';
				$config['smtp_port'] = '465';
				$config['smtp_user'] = 'info@pcj-bakaba.com';
				$config['smtp_from_name'] = 'INFO PCJ';
				$config['smtp_pass'] = 'pcjbkb2017';
				$config['wordwrap'] = TRUE;
				$config['newline'] = "\r\n";
				$config['mailtype'] = 'html';                       
		
				$this->email->initialize($config);
		
				$this->email->from($config['smtp_user'], $config['smtp_from_name']);
				$this->email->to($this->input->post('email'));
				// $this->email->cc($attributes['cc']);
				// $this->email->bcc($attributes['cc']);
				$this->email->subject('TES');
		
				$this->email->message('UYE');
		
				if($this->email->send()) {
					return true;        
				} else {
					return false;
				}       

	}
}
