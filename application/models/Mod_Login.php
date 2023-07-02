<?php

class Mod_Login extends CI_Model{

    public function verify_username($username){
        $this->db->select('b.*,a.id_user_role,a.username,a.password,a.college_id,a.sector_id,d.name as sector_name,e.name as college_name,c.role');
        $this->db->where('a.del_status',1);
        $this->db->where('username',$username);
        $this->db->join('user_role c','c.id = a.id_user_role');
        $this->db->join('user_profile b','a.id_user = b.id');
        $this->db->join('sectors d','a.sector_id = d.id','left');
        $this->db->join('colleges e','a.college_id = e.id','left');
        $query = $this->db->get('users a');
        return $query->result();
    }

}