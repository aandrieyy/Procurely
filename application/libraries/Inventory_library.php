<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory_library
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('inventories_model');
    }

    // public function getCurrentInventoryQty($id_product){
    //     $product_IN = $this->CI->inventories_model->product_IN($id_product);
    //     $product_OUT = $this->CI->inventories_model->product_OUT($id_product);
    //     return ($product_IN->total_qty - $product_OUT->total_qty);
    // }

    public function getAtcostAve($id_product){
        $result = $this->CI->inventories_model->getAtcostAve($id_product);
        if ($result->num_rows()) {
            $data = $result->row();
            return $data->atcost_ave;
        }else{
            return 'n/a';
        }
    }

    public function getSerials($id_product){
        $is_sold = '0';
        $data = $this->CI->inventories_model->get_items($id_product,$is_sold)->result();
        return $data;
    }

    // public function get_sellingprice($id_product){
    //     $result = $this->CI->inventories_model->get_sellingprice($id_product);
    //     if ($result->num_rows()) {
    //         $data = $result->row();
    //         return $data->selling_price;
    //     }else{
    //         return 'n/a';
    //     }
    // }


}
