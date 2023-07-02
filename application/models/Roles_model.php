<?php

class Roles_model extends CI_Model{

    public function get($id_user_role = null){
        if($id_user_role != ''){
            $this->db->where('a.id',$id_user_role);
        }
        $data = $this->db->get('user_role a');
        return $data;
    }

}