<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('user_model');
        $this->load->model('categories_model');
	}

    public function check_login(){
        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
    }
    
    public function index()
	{
        // $data = $this->employee_model->view_account('');
        $this->check_login();
        $data['sidebar_active'] = 'profile';
        $data['sidebar_submenu_active'] = 'profile';
        
        $id_user_role = $this->session->userdata('id_user_role');
        $data['menu_categories'] = $this->categories_model->get('menu_categories');
        $data['mechant_categories'] = $this->categories_model->get('mechant_categories');
        if($id_user_role == 6 || $id_user_role == 7){
            $this->load->view('users/profile',$data);
        }
        if($id_user_role == 1 || $id_user_role == 2 || $id_user_role == 3 || $id_user_role == 4){
            $this->load->view('staffs/profile',$data);
        }
        if($id_user_role == 5){ //merchants
            $this->load->view('merchants/profile',$data);
        }
    }

    public function upload_profile_pic($temp_photo_arr = NULL)
    {
        // if($temp_photo_arr != NULL){
        //     unlink('public/uploads/dp/'.$temp_photo_arr);
        // }

        $raw_name = explode('.', $_FILES["file"]["name"]);
        $ext = end($raw_name);
        $name = rand(100, 999) . '.' . $ext;
        $location = 'public/uploads/dp/' . $name;  
        move_uploaded_file($_FILES["file"]["tmp_name"], $location);
        echo '<img src="'.base_url().$location.'" style="width:100%" class="img-thumbnail" />,'.$name;
    }

    public function update(){
        $this->user_model->update_user_account();
        $_SESSION['picture'] = $this->input->post('picture');
        $_SESSION['signature'] = $this->input->post('signature');
        // $_SESSION['rfid'] = $this->input->post('rfid');
        $_SESSION['first_name'] = $this->input->post('first_name');
        $_SESSION['middle_name'] = $this->input->post('middle_name');
        $_SESSION['last_name'] = $this->input->post('last_name');
        $_SESSION['email'] = $this->input->post('email');
        $_SESSION['contact'] = $this->input->post('contact');
        // $_SESSION['username'] = $this->input->post('username');
        $_SESSION['address'] = $this->input->post('address');

        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        if($current_password != '' && $new_password != '' && $confirm_password != ''){
            if(!password_verify($current_password,$_SESSION['password'])){
                $msg = "Please check your current password";
                $this->session->set_userdata('status_type','error');
            }else{
                if($new_password != $confirm_password){
                    $msg = "Password didnt match";
                    $this->session->set_userdata('status_type','error');
                }else{
                    $result = $this->user_model->update_account_password($new_password);
                    $_SESSION['password'] = $new_password;
                    $msg = "Account was succesfully updated";
                    $this->session->set_userdata('status_type','success');
                }
            }
        }else{
            $msg = "Account was succesfully updated";
            $this->session->set_userdata('status_type','success');
        }
       
        $this->session->set_userdata('status_msg',$msg);
        redirect($_SERVER['HTTP_REFERER']);
    }

}
