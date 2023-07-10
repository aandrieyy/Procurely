<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('items_model');
        $this->load->model('sectors_model');
        $this->load->model('report_model');
        $this->load->model('projects_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'sb_sys_item';
        $data['sidebar_submenu_active'] = 'items';
        
        $data['item_type'] = $this->categories_model->get('item_type');
        $data['item_categories'] = $this->categories_model->get('item_categories');
        $data['units'] = $this->categories_model->get('units');

        $data['items'] = $this->items_model->get()->result();
        $data['projects'] = $this->projects_model->get();
		$this->load->view('dashboard/items',$data);
    }
    
    public function save(){
        $data = $this->input->post();
        $id = $this->items_model->save($data);
        // die($this->db->last_query());
        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->items_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->items_model->edit($id);
        echo json_encode($data);
    }

    public function get_project_items(){
        $project_id = $this->input->post('project_id');
        $selected_project_items = $this->input->post('selected_project_items');
        // print_r($selected_project_items['data_table']);die('x');
        $selected_id = array();
        if(!empty($selected_project_items)){
            for($x = 0; $x < count($selected_project_items['data_table']); $x++){
                array_push($selected_id,$selected_project_items['data_table'][$x]['project_item_id']);
            }
        }

        $data = $this->items_model->get('','',$project_id,$selected_id)->result();
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($_POST['id']);
        unset($_POST['id_category_type']);
        $this->items_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_items(){
        $item_id = $this->input->post('item_id');
        $item_type_id = $this->input->post('item_type_id');
        $data = $this->items_model->get($item_id,$item_type_id)->result();
        echo json_encode($data);
    }
}
