<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'CODEIGNITER AJAX CURD WITH DATA TABLES AND BOOTSTRAP MODALS';
        $this->load->view('crud_view', $data);
    }
    public function fetch_user(){  
        $this->load->model("Crud_model");  
        $fetch_data = $this->Crud_model->make_datatables();  
        $data = array();  
        foreach($fetch_data as $row)  
        {  
             $sub_array = array();  
             $sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" >';  
             $sub_array[] = $row->first_name;  
             $sub_array[] = $row->last_name;  
             $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</button>';  
             $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';  
             $data[] = $sub_array;  
        }  
        $output = array(  
             "draw"                    =>     intval($_POST["draw"]),  
             "recordsTotal"          =>      $this->Crud_model->get_all_data(),  
             "recordsFiltered"     =>     $this->Crud_model->get_filtered_data(),  
             "data"                    =>     $data  
        );  
        echo json_encode($output);  
   }

   public function user_action(){
    if($_POST['action'] == "Add")
    {
        $insert_data = array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'image' => $this->upload_image()
        );
        $this->load->model("Crud_model");
        $this->Crud_model->insert_crud($insert_data);
        echo 'Data Inserted';
    }
   }
   public function upload_image(){
    if(isset($_FILES["image"]))
    {
        $extension = explode('.', $_FILES["image"]["name"]);
        $new_name = rand(). '.' .$extension[1];
        $destination = './upload/'.$new_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
        return $new_name;
    }
   }
}  
   
?>