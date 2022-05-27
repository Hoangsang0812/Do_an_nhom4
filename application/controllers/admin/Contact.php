<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/Mcontact');
        $this->load->model('backend/Muser');
        $this->load->model('backend/Morders');
		$this->load->model('backend/Mconfiguration');
		if(!$this->session->userdata('sessionadmin')){
			redirect('admin/user/login','refresh');
		}
		$this->data['user']=$this->session->userdata('sessionadmin');
		$this->data['com']='contact';
	}
	public function index(){
		$this->load->library('phantrang');
		$limit=8;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mcontact->contact_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/contact');
		$this->data['list']=$this->Mcontact->contact_all($limit,$first);
		$this->data['view']='index';
		$this->data['title']='Quản lý liên hệ ';
		$this->load->view('backend/layout', $this->data);
	}
		public function status($id)
	{
		$row=$this->Mcontact->contact_detail($id);

		$status=($row['status']==0)?1:0;
		$mydata= array('status' => $status);
		$this->Mcontact->contact_update($mydata, $id);
		$this->session->set_flashdata('success', 'Cập nhật trạng thái thành công');
		redirect('admin/contact/','refresh');
	}
	  public function detail($id)
    {
        $this->data['view']='detail';
		$this->data['title']='mail ';
		$this->data['row']=$this->Mcontact->contact_status($id);
		$this->data['row']=$this->Mcontact->contact_detail($id);
		$row2=$this->Mconfiguration->configuration_detail();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tl', 'Câu trả lời', 'required');	
		if($this->form_validation->run() ==TRUE){
			$tl=$this->input->post('tl');
			$content=$this->input->post('content');
			$email = $this->input->post('email');
            $this->load->library('parser');
            $this->email->clear();
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '60';
            // $config['smtp_user']    = '9orangeshopbn@gmail.com';
			$config['smtp_user']    = $row2['mail_smtp'];
            // $config['smtp_pass']    = 'Sanged123';
			$config['smtp_pass']    = $row2['mail_smtp_password'];
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $config['validation'] = TRUE;   
            $this->email->initialize($config);
            $this->email->from('9orangeshopbn@gmail.com', '(9 Orange store)');
            $this->email->to($email);
            $this->email->subject('Hệ thống 9 Orange ');
            $this->email->message('Câu hỏi: '.$content.', Câu trả lời của shop : '.$tl.'');
            $this->email->send();
			$mydata = array(
                'tl'     => $this->input->post('tl'),
				'status' => '1'
            );
			$this->Mcontact->contact_update($mydata,$id);
		}

		$this->data['title']='Quản lý liên hệ ';
		$this->load->view('backend/layout', $this->data);
    }
    public function delete($id)
	{
		$this->Mcontact->contact_delete($id);
		$this->session->set_flashdata('success', 'Xóa thành công');
		redirect('admin/contact/recyclebin','refresh');
	}
	public function trash($id)
	{
		$mydata= array('trash' => 0);
		$this->Mcontact->contact_update($mydata,$id);
		$this->session->set_flashdata('success', 'Xóa vào thùng rác thành công');
		redirect('admin/contact','refresh');
	}
	public function recyclebin()
	{
		$this->load->library('phantrang');
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mcontact->contact_trash_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/contact/recyclebin');
		$this->data['list']=$this->Mcontact->contact_trash($limit, $first);
		$this->data['view']='recyclebin';
		$this->data['title']='Thùng rác liên hệ';
		$this->load->view('backend/layout', $this->data);
	}
	public function restore($id)
	{
		$this->Mcontact->contact_restore($id);
		$this->session->set_flashdata('success', 'Khôi phục thành công');
		redirect('admin/contact/recyclebin','refresh');
	}

}