<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('department_model');
        $this->load->model('sectors_model');
        $this->load->model('colleges_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'side_budgeting';
        $data['sidebar_submenu_active'] = 'departments';
        
        $data['sectors'] = $this->sectors_model->get()->result();
        $data['departments'] = $this->department_model->get()->result();
		$this->load->view('dashboard/departments',$data);
    }
    
    public function budget()
	{
        $data['sidebar_active'] = 'department_budget';
        $data['sidebar_submenu_active'] = 'departments';
        
        $data['sectors'] = $this->sectors_model->get()->result();
        $data['departments'] = $this->department_model->get()->result();
        $data['departments_budget'] = $this->department_model->get_departments_budget()->result();
		$this->load->view('dashboard/department-budget',$data);
    }

    public function assign_department($id_department_head){
        $data['sidebar_active'] = 'sb_sys_user';
        $data['sidebar_submenu_active'] = 'department_head';
        $data['id_department_head'] = $id_department_head;
        $data['departments'] = $this->department_model->get()->result();
        $data['get_assign_department'] = $this->department_model->get_assign_department($id_department_head)->result();
        $this->load->view('dashboard/assign_department',$data);
    }

    public function save(){
        $data = $this->input->post();
        $id = $this->department_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function save_assign(){
        $data = $this->input->post();
        $id = $this->department_model->save_assign($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function save_dept_budget(){
        $data = $this->input->post();
        $id = $this->department_model->save_dept_budget($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->department_model->delete($id);
    }

    public function delete_assign(){
        $id = $this->input->post('id');
        $this->department_model->delete_assign($id);
    }

    public function delete_dept_budget(){
        $id = $this->input->post('id');
        $this->department_model->delete_dept_budget($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->department_model->edit($id);
        echo json_encode($data);
    }

    public function edit_dept_budget(){
        $id = $this->input->post('id');
        $data = $this->department_model->edit_dept_budget($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->department_model->update($id,$data);
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
        $this->department_model->update_dept_budget($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_department(){
        $sector_id = $this->input->post('sector_id');
        $data = $this->department_model->get('',$sector_id)->result();
        echo json_encode($data);
    }


}
