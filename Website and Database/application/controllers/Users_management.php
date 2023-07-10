<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_management extends CI_Controller {

    public function __construct(){
      parent::__construct();
      if($this->session->userdata('id_user') == ''){
          redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->helper(array('form'));
      $this->load->model('user_model');
      $this->load->model('categories_model');
      $this->load->model('employees_model');
	}

  public function index($user_role)
  { 
    $data['users'] = $this->user_model->getUsers($this->customlib->identifyUserRole($user_role));
    $this->load->view('dashboard/admin/users-management',$data);
  }

  public function teachers()
  {
    $this->load->view('dashboard/admin/users-management');
  }

  public function system_users()
  {
    $data['sidebar_active'] = 'general_settings';
    $data['sidebar_submenu_active'] = 'system_users';
    $data['system_users'] = $this->user_model->system_users();
    $data['employees'] = $this->employees_model->get();
    $this->load->view('dashboard/system_users',$data);
  }

  public function delete_sys_user(){
    $id = $this->input->post('id');
    $this->user_model->delete_sys_user($id);
  }

  public function UpdateSystemUser(){
    $id = $this->input->post('id');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    unset($_POST['id']);
    unset($_POST['username']);
    unset($_POST['password']);
    $data = array(
      'username' => $username,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    );
    $this->user_model->UpdateSystemUser($id,$data);

    $msg = "Login credential was updated succesfully!";
    $this->session->set_userdata('status_msg',$msg);
    $this->session->set_userdata('status_type','success');

    $data = $this->user_model->get($id)->row();
    // print_r($data);die($data->email);
    $this->sendMail($data->email, $username, $password);
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function sendMail($email, $username, $password){
    // Email Sender order placed
    $to =  $email;  // User email pass here
    $subject = 'Account Created |Login Credentials | Coerpa Builders Corp';
    $from = 'no-reply@coerpa.net';              // Pass here your mail id
              
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'smtp.hostinger.com'; // ssl://smtp.gmail.com //hostinger
    $config['smtp_port']    = '587'; //465 //587
    $config['smtp_timeout'] = '60';

    $config['smtp_user']    = 'no-reply@coerpa.net';    //Important
    $config['smtp_pass']    = '8rM*1EWB$n';  //Important

    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not

    $this->load->library('email', $config);
    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message("Use this login credentials to access the portal. <br> Username: $username <br> Password: $password <br> Login Link: http://localhost/cm72/login ");
    $this->email->send();
    // show_error($this->email->print_debugger());
    // Email Sender order placed

  }


}
