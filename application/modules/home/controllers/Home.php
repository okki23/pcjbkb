<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent ::__construct();
	}
	public function index()
	{
		$data['content'] = 'home/view_home'; 
		$data['title'] = $this->data['meta_title'];
		$this->load->view('template_frontend',$data);
	}
}
