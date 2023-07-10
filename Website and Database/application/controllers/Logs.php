<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

    public function __construct(){
      parent::__construct();
      if($this->session->userdata('id_user') == ''){
          redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->helper(array('form'));
      $this->load->model('employees_model');
	}

  public function index()
  {
    $data['sidebar_active'] = 'inventories';
    $data['sidebar_submenu_active'] = 'inventory_logs';
    $data['table_title'] = 'User Logs | Inventory';
    $data['datas'] = $this->logs_model->get('inventories')->result();
    // print_r($data['datas']);die();
    $this->load->view('dashboard/logs',$data);
  }


}
