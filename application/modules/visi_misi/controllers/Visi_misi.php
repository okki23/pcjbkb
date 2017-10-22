<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi_misi extends MY_Controller {
	public function __construct(){
		parent ::__construct();
	}
	public function index()
	{
		$data['content'] = 'visi_misi/view_visi_misi'; 
		$data['title'] = $this->data['meta_title'];
		$this->load->view('template_frontend',$data);
	}
}
