<?php

class Clients_model extends CI_Model{

    public function get($id_user_role, $id_client = null){

        if($id_user_role == 4 || $id_user_role == 5){ // SUPPLIER OR BUSINESS
            $this->db->select('a.*,CONCAT(a.last_name,", ",a.first_name) as name,c.role, d.business_name,d.telephone as bs_telephone,d.phone as bs_phone,d.email as bs_email, d.address as bs_address,d.description as bs_description, d.id as id_business, d.logo');
        }else if($id_user_role == 3){ // CUSTOMER
            $this->db->select('a.*,CONCAT(a.last_name,", ",a.first_name) as name');
        }
        $this->db->order_by('a.id','desc');
        if($id_client != ''){
            $this->db->where('a.id',$id_client);
        }
        
        $this->db->where('b.id_user_role',$id_user_role);
        $this->db->where('a.del_status',1);
        $this->db->where('a.id !=',$_SESSION['id_user']);
        $this->db->join('users b','a.id = b.id_user');
        $this->db->join('user_role c','b.id_user_role = c.id');

        //BUSINESS
        if($id_user_role == 4 || $id_user_role == 5){
            $this->db->join('business_details d','a.id = d.id_owner');
        }
        
        return $this->db->get('user_profile a');
    }

}