<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('categories_model');
	}

	public function index($category_type)
	{
        $data['sidebar_active'] = 'general_settings';
        // if($category_type == "funds_type"){ $data['sidebar_active'] = 'side_budgeting'; }

        if($category_type == "item_type"){ $data['sidebar_active'] = 'sb_sys_item'; }
        if($category_type == "item_categories"){ $data['sidebar_active'] = 'sb_sys_item'; }
        if($category_type == "units"){ $data['sidebar_active'] = 'sb_sys_item'; }

        if($category_type == "ppmp_status"){ $data['sidebar_active'] = 'side_ppmp'; }
        if($category_type == "mode_of_procurements"){ $data['sidebar_active'] = 'side_ppmp'; }
        if($category_type == "years"){ $data['sidebar_active'] = 'side_ppmp'; }

        $data['sidebar_submenu_active'] = $category_type;
        $data['category_type'] = $category_type;
        
        $data['categories'] = $this->categories_model->get($category_type);
		$this->load->view('dashboard/categories',$data);
    }

    
    public function get(){
        $category_type = $this->input->post("category_type");
        $data = $this->categories_model->get($category_type);
        echo json_encode($data);
    }
    
    public function save(){
        $data = $this->input->post();
        $id = $this->categories_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->categories_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->categories_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($_POST['id']);
        unset($_POST['id_category_type']);
        $this->categories_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
