<?php

class College_budget_model extends CI_Model{

    public function get($id = null,$get_new_amount = null){
        $this->db->select('a.*, c.name as college,d.category as fund_type,d.description as fund_type_desc,
        CONCAT(h.last_name,", ",h.first_name) as created_by, h.signature');
        $this->db->where('a.deleted_at',NULL);
        $this->db->group_by('a.id');
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($get_new_amount != ""){
            $this->db->order_by('a.id','desc');
            $this->db->limit(1);
        }
        if($_SESSION['id_user_role'] == 3){
            $this->db->where('i.deleted_at',NULL);
            $this->db->where('i.id_department_head',$_SESSION['id_user']);
        }
        $this->db->join('colleges c','a.college_id = c.id');
        $this->db->join('categories d','a.id_funds_type = d.id');
        $this->db->join('user_profile h','a.created_by = h.id','left');
        $result = $this->db->get('college_budget a');
        // die($this->db->last_query());
        return $result;
    }

    public function get_sector_budget(){
        $this->db->select('a.*,(SELECT SUM(funds) FROM college_budget WHERE sector_id = a.id AND deleted_AT is NULL) as budget_allocated');
        $this->db->where('a.deleted_at',NULL);
        return $this->db->get('sectors a');
    }

    public function get_college_budget($id = null, $sector_id = null){
        $this->db->select('a.*, b.name as sector, c.name as department,d.category as fund_type,d.description as fund_type_desc');
        $this->db->where('a.deleted_at',NULL);
        if($sector_id != ""){
            $this->db->where('a.sector_id',$sector_id);
        }
        $this->db->join('sectors b','a.sector_id = b.id');
        $this->db->join('departments c','a.sector_id = c.id');
        $this->db->join('categories d','a.id_funds_type = d.id');
        return $this->db->get('college_budget a');
    }

    public function save($data){
        $this->db->insert('college_budget',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('college_budget',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("college_budget");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('college_budget',$data);
    }

}