<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

    public function __construct(){
      parent::__construct();
      if($this->session->userdata('id_user') == ''){
          redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->helper(array('form'));
      $this->load->model('students_model');
      $this->load->model('categories_model');
	}

  public function index()
  {
    $data['title'] = 'Students';
    $data['id_user_role'] = 3;
    $data['sidebar_active'] = 'students';
    $data['sidebar_submenu_active'] = '';
    $data['datas'] = $this->students_model->get()->result();
    $this->load->view('dashboard/users-management',$data);
  }

  public function excel(){
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=students.xls");  
    header("Pragma: no-cache"); 
    header("Expires: 0");
    
    
    echo '<table border="1">';
    //make the column headers what you want in whatever order you want
    echo '
    <tr>
      <th>RFID</th>
      <th>Student ID</th>
      <th>Level</th>
      <th>Section</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Guardian</th>
      <th>Guardian Contact #</th>
      <th>Guardian Address</th>
    </tr>';
    //loop the query data to the table in same order as the headers
    // $data = $this->transactions_model->get();
    $data = $this->students_model->get()->result();
    foreach($data as $row){
        echo "
        <tr>
          <td>$row->rfid</td>
          <td>$row->student_id</td>
          <td>$row->level</td>
          <td>$row->section</td>
          <td>$row->name</td>
          <td>$row->email</td>
          <td>$row->contact</td>
          <td>$row->g_full_name</td>
          <td>$row->g_contact</td>
          <td>$row->g_address</td>
        </tr>";
    }
    echo '</table>';
  }

}
