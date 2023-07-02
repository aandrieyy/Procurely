<?php

class Sectors_model extends CI_Model{

    public function get($id = null){
        $this->db->select('a.*');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        return $this->db->get('sectors a');
    }

    public function save($data){
        $this->db->insert('sectors',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('sectors',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("sectors");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('sectors',$data);
    }

}