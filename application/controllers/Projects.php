<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('projects_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'side_projects';
        $data['sidebar_submenu_active'] = 'projects';
        
        $data['projects'] = $this->projects_model->get();
		$this->load->view('dashboard/projects',$data);
    }
    
    public function save(){
        $data = $this->input->post();
        $id = $this->projects_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->projects_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->projects_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($_POST['id']);
        unset($_POST['id_category_type']);
        $this->projects_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
