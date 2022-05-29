<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/Mproduct');
		$this->load->model('backend/Mcategory');
		$this->load->model('backend/Muser');
		$this->load->model('backend/Mproducer');
		$this->load->model('backend/Morderdetail');
    $this->load->model('backend/Morders');
		if(!$this->session->userdata('sessionadmin')){
			redirect('admin/user/login','refresh');
		}
		$this->data['user']=$this->session->userdata('sessionadmin');
		$this->data['com']='product';
	}

	public function index(){
		$this->load->library('phantrang');
		$this->load->library('session');
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mproduct->product_sanpham_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/product');
		$this->data['list']=$this->Mproduct->product_sanpham($limit,$first);
		$this->data['view']='index';
		$this->data['title']='Danh mục sản phẩm';
		$this->load->view('backend/layout', $this->data);
	}

	public function insert(){
    $user_role=$this->session->userdata('sessionadmin');
    if($user_role['role']==2){
      redirect('admin/E403/index','refresh');
    }
    $user_role=$this->session->userdata('sessionadmin');
    if($user_role['role']==2){
      redirect('admin/E403/index','refresh');
    }
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('alias');
		$this->form_validation->set_rules('name', 'Tên sản phẩm', 'required|is_unique[db_product.name]');
		$this->form_validation->set_rules('catid', 'Loại sản phẩm', 'required');
		$this->form_validation->set_rules('producer', 'Nhà cung cấp', 'required');
		$this->form_validation->set_rules('price_buy','Giá bán','required|callback_check');
		if ($this->form_validation->run() == TRUE){
      $target_dir = "public/images/products/";
      $target_file = $target_dir . basename($_FILES["img"]["name"]);
      if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
       // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
       // echo "Sorry, there was an error uploading your file.";
      }
      $name_list= '';
      if (isset($_FILES["image_list"])) {
        $file=$_FILES["image_list"];
        $file_name=$file["name"];
        foreach ($file_name as $key => $value) {
          move_uploaded_file($file["tmp_name"][$key], 'public/images/products/'.$value);
          $name_list .= $value . '#';
        }
      }
     
			$mydata= array(
				'catid'=>$_POST['catid'],
				'producer'=>$_POST['producer'],
				'name' =>$_POST['name'], 
				'alias' =>$string=$this->alias->str_alias($_POST['name']),
        'avatar'=>$_FILES["img"]["name"],
        'img'=>$name_list,
				'detail'=>$_POST['detail'], 
				'sortDesc'=>$_POST['sortDesc'], 
				'number'=>$_POST['number'],
				'sale'=>$_POST['sale_of'],
				'price'=>$_POST['price_root'],
				'price_sale'=>$_POST['price_buy'],
				'created'=>$today,
				'created_by'=>$this->session->userdata('id'),
				'modified'=>$today,
				'modified_by'=>$this->session->userdata('id'),
				'trash'=>1,
				'status'=>$_POST['status']
			);

              $this->Mproduct->product_insert($mydata);
              $this->session->set_flashdata('success', 'Thêm sản phẩm thành công');
              redirect('admin/product','refresh');
            }else{
             $this->data['view']='insert';
             $this->data['title']='Thêm sản phẩm mới';
             $this->load->view('backend/layout', $this->data);
           }
         }

         function check(){
           $giaban= $this->input->post('price_buy');
           $giagoc= $this->input->post('price_root');
           if($giaban>$giagoc){
            $this->form_validation->set_message(__FUNCTION__,'Bạn phải nhập giá bán nhỏ hơn hoặc bằng giá gốc');
            return FALSE;
          }else{
            return true;
          }
        }

        public function update($id){
          $user_role=$this->session->userdata('sessionadmin');
    if($user_role['role']==2){
      redirect('admin/E403/index','refresh');
    }
         $this->data['row']=$this->Mproduct->product_detail($id);
         $d=getdate();
         $today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
         $this->load->library('form_validation');
         $this->load->library('session');
         $this->load->library('alias');
         $this->form_validation->set_rules('name', 'Tên sản phẩm', 'required');
         $this->form_validation->set_rules('catid', 'Loại sản phẩm', 'required');
         $this->form_validation->set_rules('producer', 'Nhà cung cấp', 'required');
         $this->form_validation->set_rules('price_buy','Giá bán','required|callback_check');
         if ($this->form_validation->run() == TRUE){
          $mydata= array(
           'catid'=>$_POST['catid'],
           'producer'=>$_POST['producer'],
           'name' =>$_POST['name'], 
           'alias' =>$string=$this->alias->str_alias($_POST['name']),
           'detail'=>$_POST['detail'], 
           'sortDesc'=>$_POST['sortDesc'],
           'sale'=>$_POST['sale_of'],
           'price'=>$_POST['price_root'],
           'price_sale'=>$_POST['price_buy'],
           'modified'=>$today,
           'modified_by'=>$this->session->userdata('id'),
           'status'=>$_POST['status']
         );
              $this->Mproduct->product_update($mydata, $id);
              $this->session->set_flashdata('success', 'Cập nhật sản phẩm thành công');
              redirect('admin/product','refresh');
            } 
            $this->data['view']='update';
            $this->data['title']='Cập nhật sản phẩm';
            $this->load->view('backend/layout', $this->data);
          }

          public function status($id){
           $row=$this->Mproduct->product_detail($id);
           $status=($row['status']==1)?0:1;
           $mydata= array('status' => $status,'modified_by'=>$this->session->userdata('id'),);
           $this->Mproduct->product_update($mydata, $id);
           $this->session->set_flashdata('success', 'Cập nhật sản phẩm thành công');
           redirect('admin/product/','refresh');
         }

         public function recyclebin(){
           $this->load->library('phantrang');
           $limit=10;
           $current=$this->phantrang->PageCurrent();
           $first=$this->phantrang->PageFirst($limit, $current);
           $total=$this->Mproduct->product_trash_count();
           $this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/product/recyclebin');
           $this->data['list']=$this->Mproduct->product_trash($limit, $first);
           $this->data['view']='recyclebin';
           $this->data['title']='Thùng rác sản phẩm';
           $this->load->view('backend/layout', $this->data);
         }

         public function trash($id){
           $row = $this->Morderdetail->orderdetail_detail($id);
           if(count($row) > 0){
            $this->session->set_flashdata('error', 'Đã có khách hàng đặt mua, không thể xóa !');
            redirect('admin/product','refresh');
          }else{
            $mydata= array('trash' => 0,'modified_by'=>$this->session->userdata('id'),);
            $this->Mproduct->product_update($mydata, $id);
            $this->session->set_flashdata('success', 'Xóa sản phẩm vào thùng rác thành công');
            redirect('admin/product','refresh');
          }
        }

        public function restore($id){
         $this->Mproduct->product_restore($id);
         $this->session->set_flashdata('success', 'Khôi phục sản phẩm thành công');
         redirect('admin/product/recyclebin','refresh');
       }

       public function delete($id){
         $this->load->helper('file');
        //  $row = $this->Mproduct->product_delete_detail($id);
        //  delete_files(base_url("public/images/products" . $row['img']));
         $this->Mproduct->product_delete($id);
         $this->session->set_flashdata('success', 'Xóa sản phẩm thành công');
         redirect('admin/product/recyclebin','refresh');
       }

       public function import($id){
         $row=$this->Mproduct->product_detail($id);
         $d=getdate();
         $today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
         $this->load->library('form_validation');
         $this->load->library('session');
         $this->load->library('alias');
         $this->form_validation->set_rules('number', 'Số lượng', 'required');
         if ($this->form_validation->run() == TRUE){
          $mydata= array(
           'number'=>$row['number']+$_POST['number'],
           'modified'=>$today,
           'modified_by'=>$this->session->userdata('id')
         );
          $this->Mproduct->product_update($mydata, $id);
          $this->session->set_flashdata('success', 'Cập nhật sản phẩm thành công');
          redirect('admin/product','refresh');
        }
        $this->data['row']=$row;
        $this->data['view']='import';
        $this->data['title']='Cập nhật sản phẩm';
        $this->load->view('backend/layout', $this->data);
      }
      // public function quicksearch(){
      // 	$query = '';
      // 	if($this->input->post('query'))
      // 	{
      // 		$query = $this->input->post('query');
      // 	}
      // 	$data = $this->Mproduct->get_data_search($query);
      // 	if($data->num_rows() > 0)
      // 	{
      // 		foreach($data->result() as $row)
      // 		{
      // 			$this->data['get'] = $row;
      // 			$this->data['view']='index';
      // 			$this->load->view('backend/layout', $this->data);

      // 		}
      // 	}


      // }
    }