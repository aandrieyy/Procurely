<?php

class Items_model extends CI_Model{

    public function get($id = null,$item_type_id = null, $project_id = null){
        $this->db->select('a.*, b.category as item_type,c.category as item_category, d.category as unit');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($item_type_id != ""){
            $this->db->where('a.item_type_id',$item_type_id);
        }
        if($project_id != ""){
            $this->db->where('a.project_id',$project_id);
        }
        $this->db->join('categories b','a.item_type_id = b.id');
        $this->db->join('categories c','a.item_categories_id = c.id');
        $this->db->join('categories d','a.unit_id = d.id');

        $this->db->join('projects e','a.project_id = e.id');

        $result = $this->db->get('items a');
        return $result;
    }

    public function save($data){
        $this->db->insert('items',$data);
        return  $this->db->insert_id();
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('items',array('deleted_at' => date("Y-m-d")));
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("items");
        return $query->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('items',$data);
    }

}