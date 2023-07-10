<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sectors extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('sectors_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'sectors';
        $data['sidebar_submenu_active'] = 'sectors';
        
        $data['sectors'] = $this->sectors_model->get()->result();
		$this->load->view('dashboard/sectors',$data);
    }
    
    public function save(){
        $data = $this->input->post();
        $id = $this->sectors_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->sectors_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->sectors_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->sectors_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
