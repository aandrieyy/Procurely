<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class College_departments extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('colleges_model');
        $this->load->model('department_model');
        $this->load->model('college_department_model');
	}

	public function index($college_id)
	{
        $data['sidebar_active'] = 'colleges';
        $data['sidebar_submenu_active'] = 'colleges';
        $data['college_id'] = $college_id;
        $data['college'] = $this->colleges_model->get($college_id)->row();
        $data['departments'] = $this->department_model->get()->result();
        $data['college_departments'] = $this->college_department_model->get($college_id)->result();
        $this->load->view('dashboard/college_departments',$data);
    }
    
    public function save(){
        $data = $this->input->post();
        $id = $this->college_department_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->college_department_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->college_department_model->get($id)->result();
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->college_department_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
