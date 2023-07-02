<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_budget extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('annual_budget_model');
        $this->load->model('report_model');
        $this->load->model('notif_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'side_annual_budget';
        $data['sidebar_submenu_active'] = 'side_annual_budget';
        
        $data['data'] = $this->annual_budget_model->get('','')->result();
        $data['stats'] = $this->annual_budget_model->stats()->row();
        $data['remaining_budget'] =  $data['stats']->tab - $data['stats']->ba;
        // print_r($data['stats']);die();
        $data['budget_stats']  = $this->report_model->budget_stats()->row();
		$this->load->view('dashboard/annual-budget',$data);
    }

    public function save(){
        $path = 'public/uploads/signature/';
        $file_name = $_FILES["userfile"]['name'];
        $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        $_POST['signature'] = $picture;
		$_POST['created_by'] = $_SESSION['id_user'];

        $_POST['type'] = "in";
        $data = $this->input->post();

        $last_annual_budget = $this->annual_budget_model->get('',1)->row();
        $new_amt = isset($last_annual_budget) ? $last_annual_budget->new_amt : 0;

        // print_r($last_annual_budget);die($data['amount']);
        $data['new_amt'] = $new_amt + $data['amount'];
        $this->annual_budget_model->save($data);
        

        //  // WRITE NOTIFICATION
        //  $department_id = $this->input->post('department_id');
        //  $funds = $this->input->post('funds');
        //  $department = $this->department_model->get($department_id)->row();
        //  $notif = "Department (".$department->name.") receives a new budget (₱".number_format($funds,2).")";
 
        //  //GET USERS
        //  $sectors = $this->user_model->get('',8)->result(); // SECTOR
        //  foreach($sectors as $row){
        //      //SAVE NOTIF
        //      $this->notif_model->save_notif($notif,$row->id);
        //  }
        //  $sectors = $this->user_model->get('',3)->result(); // DEPARTMENT
        //  foreach($sectors as $row){
        //      //SAVE NOTIF
        //      $this->notif_model->save_notif($notif,$row->id);
        //  }
        //  $sectors = $this->user_model->get('',1)->result(); // ADMIN
        //  foreach($sectors as $row){
        //      //SAVE NOTIF
        //      $this->notif_model->save_notif($notif,$row->id);
        //  }


        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function save_dept_budget(){
        $data = $this->input->post();
        $id = $this->annual_budget_model->save_dept_budget($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->annual_budget_model->delete($id);
    }

    public function delete_dept_budget(){
        $id = $this->input->post('id');
        $this->annual_budget_model->delete_dept_budget($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->annual_budget_model->edit($id);
        echo json_encode($data);
    }

    public function edit_dept_budget(){
        $id = $this->input->post('id');
        $data = $this->annual_budget_model->edit_dept_budget($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->annual_budget_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    
    public function update_dept_budget(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->annual_budget_model->update_dept_budget($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_department(){
        $sector_id = $this->input->post('sector_id');
        $data = $this->annual_budget_model->get('',$sector_id)->result();
        echo json_encode($data);
    }

}
