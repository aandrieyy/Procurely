<?php

class Annual_budget_model extends CI_Model{

    public function get($id = null,$get_new_amount = null,$type = null){
        $this->db->select('a.*,
        CONCAT(h.last_name,", ",h.first_name) as created_by, h.signature');
        $this->db->where('a.deleted_at',NULL);
        if($get_new_amount != ""){
            $this->db->order_by('a.id','desc');
            $this->db->limit(1);
        }
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($type != ""){
            $this->db->where('a.type',$type);
        }
        $this->db->join('user_profile h','a.created_by = h.id','left');
        $result = $this->db->get('annual_budget a');
        return $result;
    }

    public function stats($id = null){
        return $this->db->query("SELECT  

        (SELECT SUM(amount) FROM annual_budget 
        WHERE type = 'in' AND deleted_at is NULL) as tab,
        (SELECT SUM(amount) FROM annual_budget 
        WHERE type = 'out' AND deleted_at is NULL) as ba

        
        FROM users a");
    
    }


    public function save($data){
        $this->db->insert('annual_budget',$data);
    }

    public function less($data,$sector,$new_amt){
        $array = array(
            'date'      => $data['date'],
            'amount'    => $data['amount'],
            'new_amt'   => ($new_amt - $data['amount']),
            'type'      => 'out',
            'transaction_description'   => 'Budget is allocated to this sector: '.$sector->name,
        );
        $this->db->insert('annual_budget',$array);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('annual_budget',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("annual_budget");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('annual_budget',$data);
    }

}