<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gioithieu extends CI_Controller {
	// Hàm khởi tạo
    function __construct() {
        parent::__construct();
        $this->data['com']='gioithieu';
        $this->load->model('frontend/Mcategory');
        $this->load->model('frontend/Mproduct');
        $this->load->model('frontend/Mintro');
    }
    
	public function index(){
        $this->data['title']='9 Orange - Giới thiệu';
        $this->data['view']='index';
        $this->data['intro']=$this->Mintro->select_intro();
		$this->load->view('frontend/layout',$this->data);
	}
}
