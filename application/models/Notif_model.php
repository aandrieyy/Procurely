<?php

class Notif_model extends CI_Model{

    public function get($id = null){
        $this->db->where('user_id',$_SESSION['id_user']);
        return $this->db->get('notifications a');
    }

    public function save_notif($notif,$user_id){
        $this->db->insert('notifications',array("notif"=>$notif,"user_id"=>$user_id));
    }

    public function mark_as_seen(){
        $this->db->where('user_id',$_SESSION['id_user']);
        $this->db->where('status',0);
        $this->db->update('notifications',array("status"=>1));
    }

}