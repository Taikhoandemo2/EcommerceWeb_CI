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
        if ($data['brand'] == true) {
            // convert to json
            $ok_data = [
                'status' => 200,
                'message' => 'Show List Brand',
            ];
            header("HTTP/1.0 Show List Brand");
            //$this->session->set_flashdata('success', json_encode($ok_data));

            $json_data = json_encode($data['brand']);
            $this->load->view("brand/list",['json_data'=>$json_data] );

            
        } else {
            $error_data = [
                'status' => 404,
                'message' => 'Not Found Brand',
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
                $data['brand'] = $this->BrandModel->insertBrand($data);
                if ($data['brand'] == true) {
                    $ok_data = [
                        'status' => 200,
                        'message' => "Add Success Brand",
                    ];
                    header("HTTP/1.0 200 Add Success Brand");
            $this->session->set_flashdata('success','Add Success Brand');
                    
                }

                redirect(base_url('brand/list'));
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
            $data['brand']  =  $this->BrandModel->updateBrand($id,$data);
            // $json_data['json_data'] = json_encode($data);

            

                if ($data['brand'] == true) {
                    $ok_data = [
                        'status' => 200,
                        'message' => "Add Update Brand",
                    ];
                    header("HTTP/1.0 200 Add Update Brand");
                    $this->session->set_flashdata('success', json_encode($ok_data));

                    //return json_encode($ok_data);
                }

            $this->session->set_flashdata('success','Update Success Brand');
            redirect(base_url('brand/list'));
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
        $this->load->model('BrandModel');
        $this->BrandModel->deleteBrand($id);
        $this->session->set_flashdata('success','Delete Success Brand');
        redirect(base_url('brand/list'));
    }
}
