<?php

class Colleges_model extends CI_Model{

    public function get($id = null,$sector_id = null){
        $this->db->select('a.*,b.name as sector');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($sector_id != ""){
            $this->db->where('a.sector_id',$sector_id);
        }
        $this->db->join('sectors b','a.sector_id = b.id');
        return $this->db->get('colleges a');
    }

    public function getCollegeByAssignedDept($id_department_head = null){
        $this->db->select('c.college_id,d.name,d.id');
        $this->db->group_by('c.college_id');
        $this->db->where('a.deleted_at',NULL);
        if($id_department_head != ""){
            $this->db->where('a.id_department_head',$id_department_head);
        }
        // $this->db->join('departments b','a.department_id = b.id');
        $this->db->join('college_departments c','a.department_id = c.department_id');
        $this->db->join('colleges d','c.college_id = d.id');
        $result = $this->db->get('assigned_department a');
        return $result;
    }

    public function save($data){
        $this->db->insert('colleges',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('colleges',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("colleges");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('colleges',$data);
    }

}