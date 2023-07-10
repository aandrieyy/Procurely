<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colleges extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('colleges_model');
        $this->load->model('sectors_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'colleges';
        $data['sidebar_submenu_active'] = 'colleges';
        $data['sectors'] = $this->sectors_model->get()->result();
        $data['colleges'] = $this->colleges_model->get()->result();
		$this->load->view('dashboard/colleges',$data);
    }
    
    public function assign_department($college_id){
        $data['sidebar_active'] = 'colleges';
        $data['sidebar_submenu_active'] = 'colleges';
        $data['college_id'] = $college_id;
        $data['departments'] = $this->department_model->get()->result();
        $data['get_assign_department'] = $this->department_model->get_assign_department($id_department_head)->result();
        $this->load->view('dashboard/assign_department',$data);
    }
    
    public function save(){
        $data = $this->input->post();
        $id = $this->colleges_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->colleges_model->delete($id);
    }

    public function get($sector_id = null){
        $data = $this->colleges_model->get('',$sector_id)->result();
        echo json_encode($data);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->colleges_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->colleges_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
