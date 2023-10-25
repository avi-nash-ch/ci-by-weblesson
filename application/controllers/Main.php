<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function index()
    {
        $this->load->view('main_view');
    }
    public function image_upload()
    {
        $data = [
            'title' => "Upload image using Ajax in Codeigniter"
        ];

        // Load the Main_model and fetch image data
        $this->load->model("Main_model");
        $data['image_data'] = $this->Main_model->fetch_image();
        $this->load->view('image_upload', $data);
    }


    public function ajax_upload()
    {
        // Check if the file is uploaded
        if (isset($_FILES["image_file"]["name"])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);

            // Attempt to upload the file
            if (!$this->upload->do_upload('image_file')) {
                echo $this->upload->display_errors();
            } else {
                // File uploaded successfully
                $data = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './upload/' . $data["file_name"];
                $config['create_thumb'] = 'FALSE';
                $config['maintain_ratio'] = 'FALSE';
                $config['quality'] = '60%';
                $config['width'] = 200;
                $config['height'] = 200;
                $config['new_image'] = './upload/' . $data["file_name"];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->load->model('Main_model');
                $image_data = array(
                    'name' => $data['file_name']
                );
                $this->Main_model->insert_image($image_data);
                echo $this->Main_model->fetch_image();

                // Get the image URL
                //$image_url = base_url().'upload/' .$data["file_name"];
                // Save the image URL to a database or any other storage method if needed
                // For demonstration purposes, we will just echo the image URL
                // Save the image URL in a session variable or database (for simplicity, using session here)
                // $this->session->set_userdata('uploaded_image', $image_url);
                // echo '<img src="' . $image_url . '" >';
            }
        }
    }


    public function email_availability()
    {
        $data = [
            'title' => "Codeigniter Tutorial - Check Email availibility using Ajax"
        ];
        $this->load->view("email_availability", $data);
    }
    public function check_email_availability()
    {
        // Check if the email is a valid email address
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</label>';
        } else {
            $this->load->model('Main_model');

            // Assuming the is_email_available method in your Main_model returns a boolean
            if ($this->Main_model->is_email_available($_POST['email'])) {
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already Registered</label>';
            } else {
                echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';
            }
        }
    }
}
