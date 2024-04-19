<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {
	// public function __construct() {
    //     parent::__construct();
    //     if ( $this->session->userdata('LoggedIn')){
    //         redirect(base_url('/login'));
    //     }
    // }
    public function checkLogin(){
        
            if (!$this->session->userdata('LoggedIn')){
                redirect(base_url('/login'));
            }
    }

	public function index()
	{
        $this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        //get model
       
        
        $this->load->model('ProductModel');
        $data['product']=$this->ProductModel->selectAllProduct();
        if ($data['product'] == true) {
            // convert to json
            $ok_data = [
                'status' => 200,
                'message' => 'Show List product',
            ];
            header("HTTP/1.0 Show List product");
            //$this->session->set_flashdata('success', json_encode($ok_data));

            $json_data = json_encode($data['product']);
            $this->load->view("product/list",['json_data'=>$json_data] );

            
        } else {
            $error_data = [
                'status' => 404,
                'message' => 'Not Found product',
            ];
            header("HTTP/1.0 404 Not Found");

            echo json_encode($error_data);
        }
		$this->load->view('admin_template/footer');
	}
    public function create()
	{
        $this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        //get brand
        $this->load->model('BrandModel');
        $data['brand']=$this->BrandModel->selectBrand();
        //get category
        $this->load->model('CategoryModel');
        $data['category']=$this->CategoryModel->selectCategory();
		$this->load->view('product/create', $data);
		$this->load->view('admin_template/footer');
	}
    public function store()
	{
        $this->form_validation->set_rules('title', 'Title', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('price', 'Price', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('description', 'Description', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
            //upload image
            $ori_filename = $_FILES['image']['name'];
            $new_name=time()."".str_replace (" ","-", $ori_filename);
            $config=[
                'upload_path'=>'./uploads/product',
                'allowed_types'=>'gif|jpg|png|jpeg',
                'file_name'=>$new_name,
            ];
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('admin_template/header');
                        $this->load->view('admin_template/navbar');
                        $this->load->view('product/create',$error);
                        $this->load->view('admin_template/footer');
                       
                }
            else{
                $filename=$this->upload->data('file_name');
                $data=[
                    'title'=>$this->input->post('title'),
                    'price'=>$this->input->post('price'),
                    'quantity'=> $this->input->post('quantity'),
                    'description'=> $this->input->post('description'),
                    'slug'=> $this->input->post('slug'),
                    'brand_id'=> $this->input->post('brand_id'),
                    'category_id'=> $this->input->post('category_id'),
                    'status'=> $this->input->post('status'),
                    'image'=>$filename
                ];
                $this->load->model('ProductModel');
                $this->ProductModel->insertProduct($data);
                $this->session->set_flashdata('success','Add Success Product');
                redirect(base_url('product/list'));
            }
            
	    }
        else{
            $error_data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($error_data);
            $this->create();
        }
    
	
}
    public function edit($id)
    {
        $this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        
        //get brand
        $this->load->model('BrandModel');
        $data['brand']=$this->BrandModel->selectBrand();
        //get category
        $this->load->model('CategoryModel');
        $data['category']=$this->CategoryModel->selectCategory();

        //get product by id
        $this->load->model('ProductModel');
        $data['product']=$this->ProductModel->selectProductById($id);

		$this->load->view('product/edit', $data);
		$this->load->view('admin_template/footer');
    }
    public function update($id){
        $this->form_validation->set_rules('title', 'Title', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('price', 'Price', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('description', 'Description', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
            if(!empty($_FILES['image']['name'])){
            //upload image
            $ori_filename = $_FILES['image']['name'];
            $new_name=time()."".str_replace (" ","-", $ori_filename);
            $config=[
                'upload_path'=>'./uploads/product',
                'allowed_types'=>'gif|jpg|png|jpeg',
                'file_name'=>$new_name,
            ];
            $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('image'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                            $this->load->view('admin_template/header');
                            $this->load->view('admin_template/navbar');
                            $this->load->view('product/edit/'.$id,$error);
                            $this->load->view('admin_template/footer');
                        
                    }
                else{
                    $filename=$this->upload->data('file_name');
                    $data=[
                        'title'=>$this->input->post('title'),
                        'price'=>$this->input->post('price'),
                        'quantity'=> $this->input->post('quantity'),
                        'description'=> $this->input->post('description'),
                        'slug'=> $this->input->post('slug'),
                        'brand_id'=> $this->input->post('brand_id'),
                        'category_id'=> $this->input->post('category_id'),
                        'status'=> $this->input->post('status'),
                        'image'=>$filename
                    ];
                 
                }
            }else{
                $data=[
                    'title'=>$this->input->post('title'),
                    'price'=>$this->input->post('price'),
                    'quantity'=> $this->input->post('quantity'),
                    'description'=> $this->input->post('description'),
                    'slug'=> $this->input->post('slug'),
                    'brand_id'=> $this->input->post('brand_id'),
                    'category_id'=> $this->input->post('category_id'),
                    'status'=> $this->input->post('status'),
                ];
            }
            $this->load->model('ProductModel');
            $data['product'] =$this->ProductModel->updateProduct($id,$data);
            if ($data['product'] == true) {
                $ok_data = [
                    'status' => 200,
                    'message' => "Update Success product",
                ];
                header("HTTP/1.0 200 Upadte Success product");
                $this->session->set_flashdata('success', json_encode($ok_data));

                //return json_encode($ok_data);
            }
            $this->session->set_flashdata('success','Update Success Product');
            redirect(base_url('product/list'));
	    }
        else{
            $error_data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($error_data);
            $this->edit($id);
        }
    
    }
    public function delete($id){
        $this->load->model('ProductModel');
        $this->ProductModel->deleteProduct($id);
        $this->session->set_flashdata('success','Delete Success Product');
        redirect(base_url('product/list'));
    }
}
