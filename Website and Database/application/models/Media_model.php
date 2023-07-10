<?php

class Media_model extends CI_Model{

    public function get($id_media_category,$id_main){
        $this->db->order_by('id','desc');
        $this->db->where('del_status',1);
        $this->db->where('id_main',$id_main);
        $this->db->where('id_media_category',$id_media_category);
        $result = $this->db->get('media');
        return $result->result();
    }

    public function save($media,$id_media_category,$id_main){
        $array = array(
            'id_media_category'=>$id_media_category,
            'id_main'=>$id_main,
            'media'=>$media
        );
        $this->db->insert('media',$array);
    }

    public function deleteMedia($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('media',array('del_status' => 0));
    }

}