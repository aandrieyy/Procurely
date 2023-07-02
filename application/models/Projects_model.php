<?php

class Projects_model extends CI_Model{

    public function get($id = null){
        $this->db->select('a.*');
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        $this->db->where('a.deleted_at',NULL);
        $result = $this->db->get('projects a');
        return $result->result();
    }

    public function save($data){
        $this->db->insert('projects',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('projects',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("projects");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('projects',$data);
    }

}