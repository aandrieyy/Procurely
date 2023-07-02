<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customlib
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('upload'); 
        $this->CI->load->library('Ciqrcode');
        $this->CI->load->library('Zend');
        $this->CI->load->model('user_model');
        $this->CI->load->model('categories_model');
        $this->CI->load->model('roles_model');
        $this->CI->load->model('report_model');
    }

    public function product_qr($id)
    {
        QRcode::png(
            $id = base_url().'products/index/'.$id,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 1
        );
    }

    public function product_barcode($id = '12345')
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code123','image',array('text' => $id));
    }

    public function upload($path,$file_name,$allowed_types){
        if(!empty($file_name)){
            $config['upload_path']          = $path;
            $config['allowed_types']        = $allowed_types;
            $config['max_size']             = 0; // INFINIT 0
            $config['max_width']            = 0; // INFINIT 0
            $config['max_height']           = 0; // INFINIT 0
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_name                       = time().substr(md5(microtime()),rand(0,26),5).".".$file_ext;
            $config['file_name']            = $new_name;
    
            $this->CI->upload->initialize($config); 
          
            if($this->CI->upload->do_upload())
            {
                $data = array('upload_data' => $this->CI->upload->data());
                return $new_name;
            }else{
                print_r($this->CI->upload->display_errors());die($this->CI->upload->display_errors());
                return false;
            }
        }else{
            return  '';
        }
    }

    public function identifyUserRole($user_type){
        if($user_type == 'customers'){
            return 3;
        }
        if($user_type == 'suppliers'){
            return 4;
        }
    }

    public function validateEmail($email,$operation,$id){
        //CHECK EMAIL IF EXIST
        $result = $this->CI->user_model->validateEmail($email,$operation,$id);
        if ($result->num_rows()) {
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function validatePhone($contact,$operation,$id){
        //CHECK PHONE IF EXIST
        $result = $this->CI->user_model->validatePhone($contact,$operation,$id);
        if ($result->num_rows()) {
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function validatePassword($password){
        if(password_verify($password,$_SESSION['password'])){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function getCategoryTypeId($category_type){
        $result = $this->CI->categories_model->getCategoryTypeId($category_type);
        if ($result->num_rows()) {
            $data = $result->row();
            return $data->id;
        }else{
            return 0;
        }
    }

    public function getClientName($id_client_type, $id_client){
        $result = $this->CI->clients_model->get($id_client_type, $id_client);
        if ($result->num_rows()) {
            $data = $result->row();
            return $data->name;
        }else{
            return 'n/a';
        }
    }

    public function saveLogs($process,$action,$id_transaction){
        $array = array(
            'id_user' => $_SESSION['id_user'],
            'process' => $process,
            'action' => $action,
            'id_transaction' => $id_transaction
        );
        $this->CI->logs_model->saveLogs($array);
    }


    public function sidebar_active($sidebar_menu, $sidebar_active){
        if($sidebar_menu == $sidebar_active){
            return 'active';
        }
    }

    public function sidebar_show($sidebar_menu, $sidebar_active){
        if($sidebar_menu == $sidebar_active){
            return 'show';
        }
    }


    public function sidebar_submenu_active($sidebar_menu, $sidebar_active){
        if($sidebar_menu == $sidebar_active){
            return 'active';
        }
    }


    public function get_category_by_id($id_category){
        $category = $this->CI->categories_model->getCategoryById($id_category)->row();
        return $category->category;
    }

    public function get_user_role($id_user_role){
        $roles = $this->CI->roles_model->get($id_user_role)->row();
        return ucfirst($roles->role);
    }

    public function get_user_log_description($id_category,$action,$id_transaction,$table_name){
        if($id_category == 'inventories'){
            $inventory = $this->CI->inventories_model->history('',$id_transaction)->row();
            return ucfirst($action).' <span class="text-info"><b>'.$inventory->qty.'pcs</b></span> of <span class="text-info"><b>'.$inventory->code.'-'.$inventory->product_name.'</b></span>';
        }
    }

    public function itexmo($message, $recipients) {
        try { 
            $ch = curl_init();
            $itexmo = array(
                'Email'         => 'nmcanonoy@gmail.com', 
                'Password'      => 'MISPM627761_J4F7T', //078Awh#u
                'ApiCode'       => 'PR-MISPM627761_J4F7T', 
                'Recipients'    => [$recipients], 
                'Message'       => $message 
            );
            curl_setopt($ch, CURLOPT_URL,"https://api.itexmo.com/api/broadcast"); 
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($itexmo)); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $response = curl_exec ($ch); 
            curl_close ($ch); 
            
            return $response; 
        } catch (Exception $ex) {
            return $ex->getMessage(); 
        } 
    } 

    public function get_id_user_role($user_type){
        if($user_type == "administrator"){ return 1;}
        if($user_type == "department_head"){ return 3;}
        if($user_type == "sector_head"){ return 8;}
        if($user_type == "budget_officer"){ return 9;}
        if($user_type == "bac_secretariat"){ return 10;}
        if($user_type == "college"){ return 11;}
    }

    public function notif(){
        return $this->CI->report_model->notif()->result();
    }

    public function get_ppmp_categories(){
        return $this->CI->categories_model->get('item_categories');
    }

}
