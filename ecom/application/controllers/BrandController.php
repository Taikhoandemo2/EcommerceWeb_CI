<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandController extends CI_Controller {
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

        $this->load->model('BrandModel');
        $data['brand']=$this->BrandModel->selectBrand();

		$this->load->view('brand/list',$data);
		$this->load->view('admin_template/footer');
	}
    public function create()
	{
        $this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		$this->load->view('brand/create');
		$this->load->view('admin_template/footer');
	}
    public function store()
	{
        $this->form_validation->set_rules('title', 'Title', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('description', 'Description', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
            //upload image
            $ori_filename = $_FILES['image']['name'];
            $new_name=time()."".str_replace (" ","-", $ori_filename);
            $config=[
                'upload_path'=>'./uploads/brand',
                'allowed_types'=>'gif|jpg|png|jpeg',
                'file_name'=>$new_name,
            ];
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('admin_template/header');
                        $this->load->view('admin_template/navbar');
                        $this->load->view('brand/create',$error);
                        $this->load->view('admin_template/footer');
                       
                }
            else{
                $brand_filename=$this->upload->data('file_name');
                $data=[
                    'title'=>$this->input->post('title'),
                    'description'=> $this->input->post('description'),
                    'slug'=> $this->input->post('slug'),
                    'status'=> $this->input->post('status'),
                    'image'=>$brand_filename
                ];
                $this->load->model('BrandModel');
                $this->BrandModel->insertBrand($data);
                $this->session->set_flashdata('success','Add Success Brand');
                redirect(base_url('brand/list'));
            }
            
	    }
        else{
            $this->create();
        }
    
	
}
    public function edit($id)
    {
        $this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

        $this->load->model('BrandModel');
        $data['brand']=$this->BrandModel->selectBrandById($id);

		$this->load->view('brand/edit', $data);
		$this->load->view('admin_template/footer');
    }
    public function update($id){
        $this->form_validation->set_rules('title', 'Title', 'trim|required',['required'=>'Bạn cần điền %s']);
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('description', 'Description', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
            if(!empty($_FILES['image']['name'])){
            //upload image
            $ori_filename = $_FILES['image']['name'];
            $new_name=time()."".str_replace (" ","-", $ori_filename);
            $config=[
                'upload_path'=>'./uploads/brand',
                'allowed_types'=>'gif|jpg|png|jpeg',
                'file_name'=>$new_name,
            ];
            $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('image'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                            $this->load->view('admin_template/header');
                            $this->load->view('admin_template/navbar');
                            $this->load->view('brand/create',$error);
                            $this->load->view('admin_template/footer');
                        
                    }
                else{
                    $brand_filename=$this->upload->data('file_name');
                    $data=[
                        'title'=>$this->input->post('title'),
                        'description'=> $this->input->post('description'),
                        'slug'=> $this->input->post('slug'),
                        'status'=> $this->input->post('status'),
                        'image'=>$brand_filename
                    ];
                 
                }
            }else{
                $data=[
                    'title'=>$this->input->post('title'),
                    'description'=> $this->input->post('description'),
                    'slug'=> $this->input->post('slug'),
                    'status'=> $this->input->post('status')
                ];
            }
            $this->load->model('BrandModel');
            $this->BrandModel->updateBrand($id,$data);
            $this->session->set_flashdata('success','Update Success Brand');
            redirect(base_url('brand/list'));
	    }
        else{
            $this->edit($id);
        }
    
    }
    public function delete($id){
        $this->load->model('BrandModel');
        $this->BrandModel->deleteBrand($id);
        $this->session->set_flashdata('success','Delete Success Brand');
        redirect(base_url('brand/list'));
    }
}
