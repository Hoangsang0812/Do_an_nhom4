<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('backend/Mintro');
        $this->load->model('backend/Muser');
        $this->load->model('backend/Morders');
		if(!$this->session->userdata('sessionadmin'))
		{
			redirect('admin/user/login','refresh');
		}
		$this->data['user']=$this->session->userdata('sessionadmin');
		$this->data['com']='intro';
	}

	public function index()
	{
		$this->data['view']='index';
		$this->data['title']='Chỉnh sửa giới thiệu';
		$this->load->view('backend/layout', $this->data);
	}


}
