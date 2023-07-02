<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sector_budget extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('sector_budget_model');
        $this->load->model('sectors_model');
        $this->load->model('annual_budget_model');
        $this->load->model('report_model');
        $this->load->model('notif_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'side_sector_budget';
        $data['sidebar_submenu_active'] = 'side_sector_budget';
        
        $data['data'] = $this->sector_budget_model->get()->result();
        $data['stats'] = $this->sector_budget_model->stats()->row();
        $data['sectors'] = $this->sectors_model->get()->result();

        // $data['annual_stats'] = $this->annual_budget_model->stats()->row();
        // $data['annual_remaining_budget'] =  $data['annual_stats']->tab - $data['annual_stats']->ba;
        // print_r($data['stats']);die();
        $data['budget_stats']  = $this->report_model->budget_stats()->row();
		$this->load->view('dashboard/sector_budget',$data);
    }

    public function save(){
        $path = 'public/uploads/signature/';
        $file_name = $_FILES["userfile"]['name'];
        $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        $_POST['signature'] = $picture;
		$_POST['created_by'] = $_SESSION['id_user'];
        
        // $_POST['type'] = "in";
        $data = $this->input->post();
        
        // $last_annual_budget = $this->annual_budget_model->budget_stats('',1)->row();
        // $new_amt = isset($last_annual_budget) ? $last_annual_budget->new_amt : 0;
        // if($new_amt < $data['amount']){
        //     $msg = "Insufficient annual budget to allocate";
        //     $this->session->set_userdata('status_msg',$msg);
        //     $this->session->set_userdata('status_type','error');
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        $budget_stats = $this->report_model->budget_stats()->row();
        if($budget_stats->remaining_annual_budget < $data['amount']){
            $msg = "Insufficient sector budget to allocate";
            $this->session->set_userdata('status_msg',$msg);
            $this->session->set_userdata('status_type','error');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // $data['new_amt'] = $new_amt + $data['amount'];
        $this->sector_budget_model->save($data);

        // WRITE NOTIFICATION
        $sector_id = $this->input->post('sector_id');
        $amount = $this->input->post('amount');
        $sector = $this->sectors_model->get($sector_id)->row();
        $notif = "Sector (".$sector->name.") receives a new budget (₱".number_format($amount,2).")";

        //GET USERS
        $sectors = $this->user_model->get('',8)->result();
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        $sectors = $this->user_model->get('',1)->result();
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        
        // LESS IN ANNUAL BUDGET
        // $sectors = $this->sectors_model->get($data['sector_id'])->row();
        // $this->annual_budget_model->less($data,$sectors,$new_amt);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function save_dept_budget(){
        $data = $this->input->post();
        $id = $this->sector_budget_model->save_dept_budget($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->sector_budget_model->delete($id);
    }

    public function delete_dept_budget(){
        $id = $this->input->post('id');
        $this->sector_budget_model->delete_dept_budget($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->sector_budget_model->edit($id);
        echo json_encode($data);
    }

    public function edit_dept_budget(){
        $id = $this->input->post('id');
        $data = $this->sector_budget_model->edit_dept_budget($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->sector_budget_model->update($id,$data);
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
        $this->sector_budget_model->update_dept_budget($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_department(){
        $sector_id = $this->input->post('sector_id');
        $data = $this->sector_budget_model->get('',$sector_id)->result();
        echo json_encode($data);
    }

}
