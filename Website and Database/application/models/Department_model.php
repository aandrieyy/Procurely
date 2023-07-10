<?php

class Department_model extends CI_Model{

    public function get($id = null,$sector_id = null){
        $this->db->select('a.*, b.name as sector, c.name as college');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($sector_id != ""){
            $this->db->where('a.sector_id',$sector_id);
        }
        $this->db->join('sectors b','a.sector_id = b.id');
        $this->db->join('colleges c','a.college_id = c.id');
        $result = $this->db->get('departments a');
        return $result;
    }

    public function get_departments_budget($id = null,$department_id = null){
        $this->db->select('a.*, b.name as department');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($department_id != ""){
            $this->db->where('a.department_id',$department_id);
        }
        $this->db->join('departments b','a.department_id = b.id');
        $result = $this->db->get('department_budget a');
        return $result;
    }

    public function get_assign_department($id_department_head){
        $this->db->select('a.*, b.name as department, c.name as sector, d.name as college');
        $this->db->where('a.deleted_at',NULL);
        if($id_department_head != ""){
            $this->db->where('a.id_department_head',$id_department_head);
        }
        $this->db->join('departments b','a.department_id = b.id');
        $this->db->join('sectors c','b.sector_id = c.id');
        $this->db->join('colleges d','b.college_id = d.id');
        $result = $this->db->get('assigned_department a');
        return $result;
    }

    public function save($data){
        $this->db->insert('departments',$data);
        return  $this->db->insert_id();
    }

    public function save_assign($data){
        $this->db->insert('assigned_department',$data);
        return  $this->db->insert_id();
    }


    public function save_dept_budget($data){
        $this->db->insert('department_budget',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('departments',array('deleted_at' => date("Y-m-d")));
    }

    public function delete_assign($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('assigned_department',array('deleted_at' => date("Y-m-d")));
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