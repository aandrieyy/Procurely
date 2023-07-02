<?php

class Logs_model extends CI_Model{

    public function get($category = null){
        $id_category = $this->db->query("SELECT id FROM categories WHERE category = '$category' AND description = 'for_logs' AND del_status = 1 ")->row();

        $this->db->select('a.*,CONCAT(b.last_name,", ",b.first_name) as name,c.employee_actual_id');
        $this->db->order_by('id','desc');
        if($category != ''){
            $this->db->where('id_category',$id_category->id);
        }
        $this->db->join('user_profile b','a.id_user = b.id');
        $this->db->join('employees c','b.id = c.id_employee','left');
        $data = $this->db->get('logs a');
        // die($this->db->last_query());
        return $data;
    }

    public function saveLogs($array){
        $this->db->insert('logs',$array);
    }

}