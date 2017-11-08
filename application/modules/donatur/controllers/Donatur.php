<?php
date_default_timezone_set("Asia/Jakarta");
defined('BASEPATH') OR exit('No direct script access allowed');

class donatur extends MY_Controller {
    
    var $parsing_form_input = array('id','nama_donatur','jumlah_donasi','tanggal_donasi');
    var $tablename = 'm_donatur';
    var $pk = 'id';
    
    public function __construct(){
		parent ::__construct();
		$this->load->model('m_donatur','ma');
	}
	public function index()
	{
        $data['content'] = 'donatur/view_donatur'; 
		$data['title'] = $this->data['meta_title'];
        //session
        $data['donatur'] = $this->ma->get($this->tablename,$this->pk)->result();
        //var_dump($data['donatur']);
        $data['username'] = $this->session->userdata('username');
        $data['user_group'] = strtoupper(level_help($this->session->userdata('user_group')));
        $data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('template_admin',$data); 
	}

	public function edit($id = NULL) {
        $data['content'] = 'donatur/edit_donatur'; 
		$data['title'] = $this->data['meta_title'];       
        if($id == '' || empty($id) || $id == NULL){
            $data['donatur'] = $this->ma->get_new($this->parsing_form_input);
        }else{
            $data['donatur'] = $this->ma->get($this->tablename,$this->pk,$id)->row();
        }
        //session
        $data['username'] = $this->session->userdata('username');
        $data['user_group'] = strtoupper(level_help($this->session->userdata('user_group')));
        $data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('template_admin',$data);          
	}
	
	public function delete() {
        $id = $this->uri->segment(3);
        $sql = $this->ma->delete($this->pk,$this->tablename,$id);
        redirect(base_url('donatur'));
    }

    public function save() {       
        $data = $this->ma->array_from_post(array('id','nama_donatur','jumlah_donasi','tanggal_donasi'));
        $id = isset($data['id']) ? $data['id'] : NULL;
        $exe = $this->ma->save($data,$this->tablename,$this->pk, $id);
        redirect(base_url('donatur'));
    }
}
