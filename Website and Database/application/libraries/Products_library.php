<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Products_library
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('products_model');
    }

    public function getProductNameById($id_product){
        $result = $this->CI->products_model->get($id_product);
        if ($result->num_rows()) {
            $data = $result->row();
            echo '('.$data->code.') - '.$data->product_name;
        }else{
            echo 'n/a';
        }
    }


}
