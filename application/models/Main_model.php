<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{

    public function index()
    {
    }
    public function insert_image($data)
    {
        $this->db->insert('tbl_images', $data);
    }

    public function fetch_image()
    {
        $output = '';
        $this->db->select('name');
        $this->db->from('tbl_images');
        $this->db->order_by('tbl_images.id', 'DESC');
        $query = $this->db->get();
        foreach ($query->result() as $key => $row) {
            $output .= ' <div class="col-md-3"> 
        <img src="' . base_url() . 'upload/' . $row->name . '" class="img-responsive img-thumbnail" /> </div> ';
        }

        return $output;
    }

    public function is_email_available($email)
    {
        $this->db->where('register.email', $email);
        $query = $this->db->get('register');
        if ($query->num_rows() > 0) { 
            return true;
        } else {
            return false;
        }
    }
}
