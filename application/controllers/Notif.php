<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('notif_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'notifications';
        $data['sidebar_submenu_active'] = 'notifications';
        
        $data['notifications'] = $this->notif_model->get()->result();
		$this->load->view('dashboard/notifications',$data);
    }
    
	public function mark_as_seen()
	{
        $this->notif_model->mark_as_seen();
    }
}
