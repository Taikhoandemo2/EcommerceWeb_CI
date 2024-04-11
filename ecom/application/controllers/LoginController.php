<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('login/index');
		$this->load->view('template/footer');
	}
	public function register_admin(){
		$this->load->view('template/header');
		$this->load->view('register_admin/index');
		$this->load->view('template/footer');
	}
	public function register_insert(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('LoginModel');	
			$data=[
				'username'=>$username,
				'email'=> $email,
				'password'=> $password,
				'status'=> 1,

			];
			$result=$this->LoginModel->RegisterAdmin($data);
			
			if ($result)
			{
				$this->session->set_flashdata('success','Register for admin successfully!');
				redirect(base_url('/register-admin'));
			}
			else{
				$this->session->set_flashdata('error','Failed to register, please try again!');
				redirect(base_url('/register-admin'));
			}
		}
		else
		{
			$this->index();
		}
	}
	public function login(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('LoginModel');	
			$result = $this->LoginModel->checkLogin($email,$password);  
			
			if (count($result)>0)
			{
				$session_array=array(
					'id'=>$result[0]->id,
					'username'=>$result[0]->username,
					'email'=>$result[0]->email,
			);
				$this->session->set_userdata('LoggedIn',$session_array);
				$this->session->set_flashdata('success','Login Successfully!');
				redirect(base_url('/dashboard'));
			}
			else{
				$this->session->set_flashdata('error','Login Failed!');
				redirect(base_url('login'));
			}
		}
		else
		{
			$this->index();
		}
	}

	
}
