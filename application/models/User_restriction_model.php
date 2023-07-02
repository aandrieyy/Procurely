<?php

class User_restriction_model extends CI_Model{

    public function get_module(){
        $result = $this->db->get('system_modules a');
        return $result->result();
    }

    public function get_system_features($id_module){
        $this->db->where('id_system_module',$id_module);
        $result = $this->db->get('system_feature a');
        return $result;
    }

    public function get_user_restriction($id_category_positions){
        $this->db->select('a.code,a.feature,b.view,b.add_,b.edit_,b.delete_');
        // $this->db->where('b.id_category_positions',$id_category_positions);
        $this->db->join('user_restrictions b','ON a.id = b.id_sys_feature AND id_category_positions ='.$id_category_positions,'left');
        $result = $this->db->get('system_feature a');
        // die($this->db->last_query());
        return $result;
    }

    public function get_system_features_with_restrictions($id_module,$id_category_positions){
        $this->db->select('a.*,b.view,b.add_,b.edit_,b.delete_');
        $this->db->where('a.id_system_module',$id_module);
        // $this->db->where('b.id_category_positions',$id_category_positions);
        $this->db->join('user_restrictions b','a.id = b.id_sys_feature AND b.id_category_positions ='.$id_category_positions,'left');
        $result = $this->db->get('system_feature a');
        return $result;
    }

    public function update($updated_restrictions,$id_category_positions){


        if($updated_restrictions['data_table'] != ''){
            for($x = 0; $x < count($updated_restrictions['data_table']); $x++){
                $id_sys_module = $updated_restrictions['data_table'][$x]['id_sys_module'];
                $id_sys_feature = $updated_restrictions['data_table'][$x]['id_sys_feature'];
                $restrictions[] = array(
                    'id_category_positions' => $id_category_positions,
                    'id_sys_module' => $updated_restrictions['data_table'][$x]['id_sys_module'],
                    'id_sys_feature' => $updated_restrictions['data_table'][$x]['id_sys_feature'],
                    'view' => $updated_restrictions['data_table'][$x]['view'],
                    'add_' => $updated_restrictions['data_table'][$x]['add_'],
                    'edit_' => $updated_restrictions['data_table'][$x]['edit_'],
                    'delete_' => $updated_restrictions['data_table'][$x]['delete_']
                );

                //DELETE RESTRICTION FIRST, TO RESET
                $this->db->where("id_category_positions",$id_category_positions);
                $this->db->where("id_sys_module",$id_sys_module);
                $this->db->where("id_sys_feature",$id_sys_feature);
                $this->db->delete("user_restrictions");
                //THEN INSERT THE UPDATED RESTRICTION
                $this->db->insert("user_restrictions",$restrictions[$x]);
            }
        }
    }
}