<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esignature extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
	}

	public function index()
	{
        $data['sidebar_active'] = 'notifications';
        $data['sidebar_submenu_active'] = 'notifications';
        
		$this->load->view('dashboard/create-e-sig.php',$data);
    }
    
}
