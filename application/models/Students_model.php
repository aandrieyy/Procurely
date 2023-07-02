<?php

class Students_model extends CI_Model{

    public function get($id = ''){
        $this->db->select('d.*,a.*,a.id as id_for_select,CONCAT(a.last_name,", ",a.first_name) as name,CONCAT(a.last_name,", ",a.first_name) as text_for_select,c.role,e.category as level,f.category as section');
        $this->db->order_by('a.id','desc');
        if($id != ''){
            $this->db->where('b.id_user',$id);
        }
        $this->db->where('b.id_user_role',3);
        $this->db->where('b.del_status',1);
        $this->db->where('a.id !=',$_SESSION['id_user']);
        $this->db->join('users b','a.id = b.id_user');
        $this->db->join('user_role c','b.id_user_role = c.id');
        $this->db->join('students d','b.id_user = d.id_user');
        $this->db->join('categories e','d.id_level = e.id');
        $this->db->join('categories f','d.id_section = f.id');
        return $this->db->get('user_profile a');
    }

}