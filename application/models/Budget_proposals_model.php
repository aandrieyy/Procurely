<?php

class Budget_proposals_model extends CI_Model{

    public function get($id = null,$status = null){
        $this->db->select('a.*,b.name as department,c.category as year,
        CONCAT(h.last_name,", ",h.first_name) as update_by');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($status != ""){
            $this->db->where('a.status',$status);
        }
        $this->db->join('departments b','a.department_id = b.id');
        $this->db->join('categories c','a.year_id = c.id');
        $this->db->join('user_profile h','a.update_by = h.id','left');
        return $this->db->get('budget_proposals a');
        //  die($this->db->last_query());
    }

    public function save($data){
        $this->db->insert('budget_proposals',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('budget_proposals',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("budget_proposals");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('budget_proposals',$data);
    }

    public function update_status($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('budget_proposals',$data);
        // die($this->db->last_query());
    }

}