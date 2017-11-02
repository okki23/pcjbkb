<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {
    
    var $parsing_form_input = array('id','title','slug','pubdate','body','category','tags','created','modified');
    var $tablename = 'articles';
    var $pk = 'id';
    
    public function __construct(){
		parent ::__construct();
		$this->load->model('m_article','ma');
	}
	public function index()
	{
         
	    $data['content'] = 'article/view_article'; 
		$data['title'] = $this->data['meta_title'];
        
        //session
        $data['article'] = $this->ma->get($this->tablename,$this->pk)->result();
        //var_dump($data['article']);
        $data['username'] = $this->session->userdata('username');
        $data['user_group'] = strtoupper(level_help($this->session->userdata('user_group')));
        $data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('template_admin',$data); 
	}

	public function edit($id = NULL) {
        $data['content'] = 'article/edit_article'; 
		$data['title'] = $this->data['meta_title'];
        
        if($id == '' || empty($id) || $id == NULL){
            $data['article'] = $this->ma->get_new($this->parsing_form_input);
              
          }else{
          
            $data['article'] = $this->ma->get($this->tablename,$this->pk,$id)->row();
  
          }
         
        //session
        $data['username'] = $this->session->userdata('username');
        $data['user_group'] = strtoupper(level_help($this->session->userdata('user_group')));
        $data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('template_admin',$data); 
        // if ($id) {
        //     $this->data['article'] = $this->m_article->get($id);
        //     count($this->data['article']) || $this->data['errors'][] = "article could not be found";
        // } else {
        //     $this->data['article'] = $this->m_article->get_new();
        // }
        
        // $data = $this->m_article->array_from_post(array('title', 'slug', 'body', 'pubdate'));
        // $id == NULL || $this->data['article'] = $this->m_article->get($id);
        // $data['content'] = 'article/form_article'; 
        // $this->data['title'] = $this->data['title'];
		// $data['username'] = $this->session->userdata('username');
        // $data['user_group'] = strtoupper(level_help($this->session->userdata('user_group')));
        // $data['user_id'] = $this->session->userdata('user_id');
        // $this->load->view('template_admin', $this->data);
	}
	
	public function delete() {
        $id = $this->uri->segment(3);
        
        $sql = $this->ma->delete($this->pk,$this->tablename,$id);

        redirect(base_url('article'));
    }

    public function save() {
        
        $data = $this->ma->array_from_post(array('id', 'title', 'slug', 'pubdate', 'body'));
        $id = isset($data['id']) ? $data['id'] : NULL;
        // echo $id;
        // echo '<hr>';
        // var_dump($data);
        // exit();
       
        $exe = $this->ma->save($data,$this->tablename,$this->pk, $id);
        // exit();
        redirect(base_url('article'));
    }
}
