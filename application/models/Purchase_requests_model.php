<?php

class Purchase_requests_model extends CI_Model{

    public function get($id = null,$status = null,$project_id = null){
        $this->db->select('a.*, b.name as project,
        CONCAT(h.last_name,", ",h.first_name) as update_by');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($status != ""){
            $this->db->where('a.status',$status);
        }
        if($project_id != ""){
            $this->db->where('a.project_id',$project_id);
        }
        $this->db->join('projects b','a.project_id = b.id');
        $this->db->join('user_profile h','a.update_by = h.id','left');
        $result = $this->db->get('purchase_requests a');
        return $result;
    }

    public function save($data){
        $this->db->insert('purchase_requests',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('purchase_requests',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("purchase_requests");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('purchase_requests',$data);
    }

    public function update_status($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('purchase_requests',$data);
    }

}