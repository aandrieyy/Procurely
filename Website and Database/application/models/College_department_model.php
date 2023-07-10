<?php

class College_department_model extends CI_Model{

    public function get($college_id = null){
        $this->db->select('a.*, b.name as department, b.id as department_id');
        $this->db->where('a.deleted_at',NULL);
        $this->db->group_by('a.department_id');
        if($college_id != ""){
            $this->db->where('a.college_id',$college_id);
        }
        $this->db->join('departments b','a.department_id = b.id');
        $result = $this->db->get('college_departments a');
        return $result;
    }

    public function save($data){
        $this->db->insert('college_departments',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('college_departments',array('deleted_at' => date("Y-m-d")));
    }

    public function delete_dept_budget($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('department_budget',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("departments");
        return $query->result();
    }

    public function edit_dept_budget($id){
        $this->db->where("id",$id);
        $query = $this->db->get("department_budget");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('departments',$data);
    }

    public function update_dept_budget($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('department_budget',$data);
    }

}