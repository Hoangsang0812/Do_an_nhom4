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
        $this->data['intro']=$this->Mintro->select_intro();
		$this->load->view('backend/layout', $this->data);
	}
    public function update()
	{
        $this->load->library('form_validation');
        $mydata=array(
            'intro'=>  $_POST['intro']
        );
        $this->Mintro->update_intro( $mydata);
        $this->session->set_flashdata('success', 'Cập nhật phần giới thiệu store thành công');
			redirect('admin/intro/index','refresh');
	}


}
