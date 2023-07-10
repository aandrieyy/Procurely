<?php

class Categories_model extends CI_Model{

    public function get($category_type){
        $this->db->select('a.*');
        $this->db->where('a.del_status',1);
        $this->db->where('b.type',$category_type);
        $this->db->join('category_types b','a.id_category_type  = b.id');
        $result = $this->db->get('categories a');
        return $result->result();
    }

    public function getCategoryTypeId($category_type){
        $this->db->where('type',$category_type);
        $data = $this->db->get('category_types');
        return $data;
    }

    public function getCategoryById($id_role){
        $this->db->where('id',$id_role);
        $data = $this->db->get('categories');
        return $data;
    }

    public function save($data){
        $this->db->insert('categories',$data);
        return  $this->db->insert_id();
    }

    public function save_in_sys_feature($data){
        $data = array(
            'id_system_module'  => 14,
            'code'  => preg_replace('/\s+/', '_', $data['category']),
            'feature'  => $data['category']
        );
        $this->db->insert('system_feature',$data);
        return  $this->db->insert_id();
    }
    
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('categories',array('del_status' => 0));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("categories");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('categories',$data);
    }

}