<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_picture_ajax extends CI_Controller {

    public function __construct(){
      parent::__construct();
      if($this->session->userdata('id_user') == ''){
          redirect('login');
      }
      $this->load->library('form_validation');
      $this->load->helper(array('form'));
      $this->load->model('media_model');
	}

    public function upload_picture($usage, $temp_photo_arr = NULL){
        if($usage == 'dp'){
            $path = 'public/uploads/dp/';
        }
        if($usage == 'signature'){
            $path = 'public/uploads/signature/';
        }

        $raw_name = explode('.', $_FILES["file"]["name"]);
        $ext = end($raw_name);
        $code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10);
        $name = $code.rand(10000, 99999) . '.' . $ext;
        $location = $path.$name;  
        move_uploaded_file($_FILES["file"]["tmp_name"], $location);
        echo '<img src="'.base_url().$location.'" style="width:100%" upload_pic_and_saveclass="img-thumbnail" />,'.$name;
    }

    public function upload_pic_and_save($usage,$id_main){
        if($usage == 'projects-media'){
            $path = 'public/uploads/project-media/';
        }

        if($usage == 'cars-media'){
            $path = 'public/uploads/cars-image/pms/';
        }

        $raw_name = explode('.', $_FILES["file"]["name"]);
        $ext = end($raw_name);
        $code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10);
        $name = $code.rand(10000, 99999) . '.' . $ext;
        $location = $path.$name;  
        move_uploaded_file($_FILES["file"]["tmp_name"], $location);

        if($usage == 'projects-media'){
            $id_image_category = 1; //projects-media
            $this->media_model->save($name,$id_image_category,$id_main);

            $data = $this->media_model->get($id_image_category,$id_main);
            echo json_encode($data);
        }

        if($usage == 'cars-media'){
            $id_image_category = 2; //cars-media
            $this->media_model->save($name,$id_image_category,$id_main);

            $data = $this->media_model->get($id_image_category,$id_main);
            echo json_encode($data);
        }
    }

}
