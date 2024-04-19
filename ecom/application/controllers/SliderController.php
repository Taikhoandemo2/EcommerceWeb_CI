<?php
defined('BASEPATH') or exit('No direct script access allowed');


class SliderController extends CI_Controller
{
    // public function __construct() {
    //     parent::__construct();
    //     if ( $this->session->userdata('LoggedIn')){
    //         redirect(base_url('/login'));
    //     }
    // }


    public function checkLogin()
    {

        if (!$this->session->userdata('LoggedIn')) {
            redirect(base_url('/login'));
        }
    }
    public function index_get()
    {
        $slider = new SliderModel();
        $result_emp = $slider->selectSlider();
        // $this->respon($result_emp,200);
    }

    public function edit($id)
    {
        $this->checkLogin();
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

        $this->load->model('SliderModel');
        $data['slider'] = $this->SliderModel->selectSliderById($id);

        $this->load->view('slider/edit', $data);
        $this->load->view('admin_template/footer');
    }
    
    public function create()
    {
        $this->checkLogin();
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        $this->load->view('slider/create');
        $this->load->view('admin_template/footer');
    }
    public function index()
    {
        $this->checkLogin();
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

        // $this->load->model('SliderModel');
        // $data['slider']=$this->SliderModel->selectSlider();

        // $this->load->view('slider/index',$data);

        $this->load->model('SliderModel');
        $data['slider'] = $this->SliderModel->selectSlider();

        if ($data['slider'] == true) {
            // convert to json
            $ok_data = [
                'status' => 200,
                'message' => 'Show List Slider',
            ];
            header("HTTP/1.0 Show List Slider");
            $this->session->set_flashdata('success', json_encode($ok_data));

            $json_data = json_encode($data['slider']);
            $this->load->view("slider/index", ["json_data" => $json_data]);

            
            //echo json_encode($ok_data);
        } else {
            // $this->load->view("slider/index");
            $error_data = [
                'status' => 404,
                'message' => 'Not Found Slider',
            ];
            header("HTTP/1.0 404 Not Found");

            echo json_encode($error_data);
        }


        $this->load->view('admin_template/footer');
    }
    public function store()
    {

        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'Bạn cần điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'Bạn cần điền %s']);
        if ($this->form_validation->run() == true) {
            //upload image
            $ori_filename = $_FILES['image']['name'];
            $new_name = time() . "" . str_replace(" ", "-", $ori_filename);
            $config = [
                'upload_path' => './uploads/sliders',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'file_name' => $new_name,
            ];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_template/header');
                $this->load->view('admin_template/navbar');
                $this->load->view('slider/create', $error);
                $this->load->view('admin_template/footer');

                // $error_data = [
                //     'status' => 500,
                //     'message' => "Internal Server Error",
                // ];
                // header("HTTP/1.0 500 Internal Server Error");
                // echo json_encode($error_data);
            } else {
                $slider_filename = $this->upload->data('file_name');
                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
                    'image' => $slider_filename
                ];
                $this->load->model('SliderModel');
                $data['slider'] = $this->SliderModel->insertSlider($data);

                if ($data['slider'] == true) {
                    $ok_data = [
                        'status' => 200,
                        'message' => "Add Success Slider",
                    ];
                    header("HTTP/1.0 200 Add Success Slider");
                    $this->session->set_flashdata('success', json_encode($ok_data));

                    //return json_encode($ok_data);
                }
                redirect(base_url('slider/list'));
            }
        } else {
            $error_data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($error_data);

            $this->create();
        }
    }
    public function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required', ['required' => 'Bạn cần điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required', ['required' => 'Bạn cần điền %s']);
        if ($this->form_validation->run() == true) {
            if (!empty($_FILES['image']['name'])) {
                //upload image
                $ori_filename = $_FILES['image']['name'];
                $new_name = time() . "" . str_replace(" ", "-", $ori_filename);
                $config = [
                    'upload_path' => './uploads/sliders',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'file_name' => $new_name,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('admin_template/header');
                    $this->load->view('admin_template/navbar');
                    $this->load->view('slider/edit/' . $id, $error);
                    $this->load->view('admin_template/footer');

                    // $error_data = [
                    //     'status' => 500,
                    //     'message' => "Internal Server Error",
                    // ];
                    // header("HTTP/1.0 500 Internal Server Error");
                    // echo json_encode($error_data);

                } else {
                    $filename = $this->upload->data('file_name');
                    $data = [
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'status' => $this->input->post('status'),
                        'image' => $filename
                    ];
                }
            } else {
                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
                ];
            }
            $this->load->model('SliderModel');
            $data['slider'] = $this->SliderModel->updateSlider($id, $data);

            if($data['slider'] == true){
                
                $ok_data = [
                    'status' => 200,
                    'message' => "Update Slider Successfully",
                ];
                header("HTTP/1.0 200 Update Slider Successfully");
                $this->session->set_flashdata('success', json_encode($ok_data));
                redirect(base_url('slider/create'));
            }
            redirect(base_url('slider/list'));
        } else {
            $error_data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($error_data);
            $this->edit($id);
        }
    }
    public function delete($id)
    {
        $this->load->model('SliderModel');
        $data['slider'] = $this->SliderModel->deleteSlider($id);
        if ($data['slider'] == true) {
            $ok_data = [
                'status' => 200,
                'message' => "Delete Slider Successfully",
            ];
            header("HTTP/1.0 200 Delete Slider Successfully");
            $this->session->set_flashdata('success', json_encode($ok_data));
        }else{
            $error_data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($error_data);

        }

        redirect(base_url('slider/list'));
    }
}
