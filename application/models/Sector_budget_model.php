<?php

class Sector_budget_model extends CI_Model{

    public function get($id = null,$get_new_amount = null){
        $this->db->select('a.*, b.name as sector,
        CONCAT(h.last_name,", ",h.first_name) as created_by, h.signature');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($get_new_amount != ""){
            $this->db->order_by('a.id','desc');
            $this->db->limit(1);
        }
        $this->db->join('sectors b','a.sector_id = b.id');
        $this->db->join('user_profile h','a.created_by = h.id','left');
        $result = $this->db->get('sector_budget a');
        return $result;
    }

    public function stats($id = null){
        $this->db->select('SUM(amount) as tab');
        $this->db->where('a.deleted_at',NULL);
        $result = $this->db->get('sector_budget a');
        return $result;
    }


    public function save($data){
        $this->db->insert('sector_budget',$data);
        return  $this->db->insert_id();
    }

    public function save_notif(){
        // $notif = "Budget officer";
        $this->db->insert('notifications',$data);
    }


    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('sector_budget',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("sector_budget");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('sector_budget',$data);
    }

}