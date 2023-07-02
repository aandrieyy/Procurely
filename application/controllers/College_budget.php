<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class College_budget extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('college_budget_model');
        $this->load->model('sectors_model');
        $this->load->model('report_model');
        $this->load->model('colleges_model');
        $this->load->model('notif_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'side_college_budget';
        $data['sidebar_submenu_active'] = 'side_college_budget';

        $data['sectors'] = $this->sectors_model->get()->result();
        $data['college_budget'] = $this->college_budget_model->get()->result();
        $data['funds_type'] = $this->categories_model->get('funds_type');

        // $data['report'] = $this->report_model->statistics()->row();
        if($_SESSION['id_user_role'] == 3){ // DEPARTMENT 
            // die('x');
            $data['budget_stats']  = $this->report_model->budget_stats_department()->row();
        }else{
            // die('y');
            $data['budget_stats']  = $this->report_model->budget_stats()->row();
        }
        // print_r($data['budget_stats']);die("x");
        $data['colleges'] = $this->colleges_model->get()->result();
		$this->load->view('dashboard/college_budget',$data);
    }

    public function department_budget_details($sector_id){
        $data['sidebar_active'] = 'side_department_budget';
        $data['sidebar_submenu_active'] = 'side_department_budget';

        $data['sectors'] = $this->sectors_model->get()->result();
        $data['budget_allocated'] = $this->college_budget_model->get_budget_allocations('',$sector_id)->result();
        $data['funds_type'] = $this->categories_model->get('funds_type');

        $data['report'] = $this->report_model->statistics($sector_id)->row();
		$this->load->view('dashboard/department_budget_details',$data);
    }
    
    public function save(){
        // $path = 'public/uploads/signature/';
        // $file_name = $_FILES["userfile"]['name'];
        // $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        // $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        // $_POST['signature'] = $picture;
		// $_POST['created_by'] = $_SESSION['id_user'];
        // $_POST['type'] = "in";
        $data = $this->input->post();

        $budget_stats = $this->report_model->budget_stats()->row();
        // print_r($budget_stats);die();

        // $remaining_sector_budget = $budget_stats->remaining_sector_budget;
        // if(!isset($budget_stats->remaining_sector_budget)){
        //     $remaining_sector_budget = 0;
        // }
        // die($remaining_sector_budget.'x'.$data['funds']);
        if($budget_stats->remaining_sector_budget < $data['funds']){
            $msg = "Insufficient sector budget to allocate";
            $this->session->set_userdata('status_msg',$msg);
            $this->session->set_userdata('status_type','error');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->college_budget_model->save($data);

        // // WRITE NOTIFICATION
        // $department_id = $this->input->post('department_id');
        // $funds = $this->input->post('funds');
        // $department = $this->department_model->get($department_id)->row();
        // $notif = "Department (".$department->name.") receives a new budget (₱".number_format($funds,2).")";

        // //GET USERS
        // $sectors = $this->user_model->get('',8)->result(); // SECTOR
        // foreach($sectors as $row){
        //     //SAVE NOTIF
        //     $this->notif_model->save_notif($notif,$row->id);
        // }
        // $sectors = $this->user_model->get('',3)->result(); // DEPARTMENT
        // foreach($sectors as $row){
        //     //SAVE NOTIF
        //     $this->notif_model->save_notif($notif,$row->id);
        // }
        // $sectors = $this->user_model->get('',1)->result(); // ADMIN
        // foreach($sectors as $row){
        //     //SAVE NOTIF
        //     $this->notif_model->save_notif($notif,$row->id);
        // }

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->college_budget_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->college_budget_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($_POST['id']);
        unset($_POST['id_category_type']);
        $this->college_budget_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
