<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_proposals extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('budget_proposals_model');
        $this->load->model('department_model');
        $this->load->model('categories_model');
        $this->load->model('notif_model');
        $this->load->model('user_model');
	}

	public function index($status = null)
	{
        $data['sidebar_active'] = 'side_budget_proposal';
        $data['sidebar_submenu_active'] = $status;
        $data['status'] = $status;

        if($status == 0){ $status_text = "Pending"; }
        if($status == 1){ $status_text = "Approved"; }
        if($status == 2){ $status_text = "Rejected"; }
        $data['status_text'] = $status_text;
        
        $data['departments'] = $this->department_model->get()->result();
        $data['years'] = $this->categories_model->get('years');
        $data['budget_proposals'] = $this->budget_proposals_model->get('',$status)->result();
		$this->load->view('dashboard/budget_proposals',$data);
    }
    
    public function save(){
        $path = 'public/uploads/budget_proposal/';
        $file_name = $_FILES["userfile"]['name'];
        $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        $_POST['proposal_file'] = $picture;

        $data = $this->input->post();
        $id = $this->budget_proposals_model->save($data);

        // WRITE NOTIFICATION
        $amount = $this->input->post('amount');
        $bp = $this->budget_proposals_model->get($id)->row();
        $department = $this->department_model->get()->row();
        $notif = "New Budget Proposal (".$bp->proposal_name.") amounting (₱".number_format($amount,2).") was created for department (".$department->name.")";

        //GET USERS
        $sectors = $this->user_model->get('',9)->result(); //budget_officer
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        $sectors = $this->user_model->get('',8)->result(); //sector_head
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        $sectors = $this->user_model->get('',1)->result(); //admin
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }

        
        // die($this->db->last_query());
        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->budget_proposals_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->budget_proposals_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        if($_FILES['userfile']['name']!=""){ //passenger_id_pic
            $path = 'public/uploads/budget_proposal/';
            $file_name = $_FILES["userfile"]['name'];
            $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
            $picture = $this->customlib->upload($path,$file_name,$allowed_types);
            $_POST['proposal_file'] = $picture;
        }

        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($_POST['id']);
        $this->budget_proposals_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_status(){
        $path = 'public/uploads/signature/';
        $file_name = $_FILES["userfile"]['name'];
        $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        $_POST['signature'] = $picture;
		$_POST['update_by'] = $_SESSION['id_user'];
		$_POST['updated_at'] = date("Y-m-d h:i:s");
        
        $id = $this->input->post('id');
        $data = $this->input->post();
        $this->budget_proposals_model->update_status($id,$data);

        // WRITE NOTIFICATION
        $amount = $this->input->post('amount');
        $bp = $this->budget_proposals_model->get($id)->row();
        $status = "approved";
        if($data->status == 2){
            $status = "rejected";
        }
        $notif = "Budget Proposal (".$bp->proposal_name.") amounting (₱".number_format($bp->amount,2).") was ".$status;
       
        //GET USERS
        $sectors = $this->user_model->get('',3)->result(); // DEPARTMENT
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        $sectors = $this->user_model->get('',1)->result(); // ADMIN
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }


}
