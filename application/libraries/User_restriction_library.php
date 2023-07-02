<?php

if (!defined('BASEPATH')) {
exit('No direct script access allowed');
}

class User_restriction_library
{

public $CI;

public function __construct()
{
    $this->CI = &get_instance();
    $this->CI->load->model('user_restriction_model');
}

public function get_system_features_with_restrictions($id_module,$id_category_positions){
    return $this->CI->user_restriction_model->get_system_features_with_restrictions($id_module,$id_category_positions)->result();
}

}
