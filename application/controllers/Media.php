<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

    public function __construct(){
      parent::__construct();
      if($this->session->userdata('id_user') == ''){
          redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->helper(array('form'));
      $this->load->model('media_model');
	}

    public function get($usage,$id_main){
        if($usage == 'cars-media'){
            $id_image_category = 2; //cars-media
        }
        if($usage == 'projects-media'){
            $id_image_category = 1; //projects-media
        }
        $data = $this->media_model->get($id_image_category,$id_main);
        echo json_encode($data);
    }

    public function delete($id,$id_main,$usage){
        $this->media_model->deleteMedia($id);
        if($usage == 'cars-media'){
            $id_image_category = 2; //cars-media
        }
        if($usage == 'projects-media'){
            $id_image_category = 1; //projects-media
        }
        $data = $this->media_model->get($id_image_category,$id_main);
        echo json_encode($data);
        
      }

}
