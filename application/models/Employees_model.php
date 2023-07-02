<?php

class Employees_model extends CI_Model{

    public function get($id_category_employee_position = null){
        $this->db->select('a.*,CONCAT(a.first_name," ",a.middle_name," ",a.last_name) as name,a.email,a.contact,c.role,e.category as department,f.category as role,g.category as position,d.employee_actual_id');
        $this->db->order_by('a.id','desc');
        $this->db->where('b.id_user_role',6);
        if($id_category_employee_position != ""){
            $this->db->where('g.id',$id_category_employee_position);
        }
        $this->db->where('b.del_status',1);
        $this->db->join('users b','a.id = b.id_user');
        $this->db->join('user_role c','b.id_user_role = c.id');
        $this->db->join('employees d','a.id = d.id_employee');
        $this->db->join('categories e','d.id_category_employee_department = e.id'); // Department
        $this->db->join('categories f','d.id_category_employee_role = f.id'); // Role
        $this->db->join('categories g','d.id_category_employee_position = g.id'); // Position
        return $this->db->get('user_profile a')->result();
    }

}