<?php

class User_model extends MY_Model{

    public function get($id = null, $id_user_role = null){
        $this->db->select('a.*,CONCAT(a.last_name,", ",a.first_name) as name');
        $this->db->order_by('a.id','desc');
        if($id != ''){
            $this->db->where('a.id',$id);
        }
        if($id_user_role != ''){
            $this->db->where('b.id_user_role',$id_user_role);
        }
        $this->db->where('b.del_status',1);
        $this->db->join('users b','a.id = b.id_user');
        $result = $this->db->get('user_profile a');
        return $result;
    }

    public function get_user_types(){
        $this->db->where('a.del_status',1);
        $result = $this->db->get('user_role a');
        return $result;
    }

    public function edit_user($data,$id){

        $post = $data;
        $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        unset($post['passwordconf']);

        $this->db->where('id_user',$id);
        if($this->db->update('users',$post)){
            return true;
        }else{
            return false;
        }
    }

    public function update_display_profile($picture){
        $_SESSION['picture'] = $picture;
        $query = $this->db->query("UPDATE user_profile SET picture='$picture' WHERE id='$_SESSION[id_user]'");
    }

    function check_duplicate_staff($operation){//FOR STAFF, STUDENT AND OUTSIDERS
        $email = $this->input->post('email');
        $contact = $this->input->post('contact');
        if($operation == 'update'){
            $this->db->where('id !=',$_SESSION['id_user']);
        }
        $this->db->where('contact',$contact);
        $this->db->or_where('email',$email);
        $result = $this->db->get('user_profile');
        if($result-> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function update_user_account(){
        $array = array(
            'picture' => $this->input->post('picture'),
            'signature' => $this->input->post('signature'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'contact' => $this->input->post('contact'),
            'address' => $this->input->post('address')
        );
        $this->db->where('id',$_SESSION['id_user']);
        $this->db->update("user_profile",$array);
    }

    public function update_account_password($new_password){
        $new_hash_password = password_hash($new_password, PASSWORD_DEFAULT);
        $_SESSION['password'] = $new_hash_password;
        $this->db->query("UPDATE users SET password='$new_hash_password' WHERE id_user ='$_SESSION[id_user]' ");
    }

    public function validateEmail($email,$operation = null,$id = null){
        if($operation == 'update'){
            $this->db->where('id !=',$id);
        }
        $this->db->where('id !=',$_SESSION['id_user']);
        $this->db->where('email',$email);
        $result = $this->db->get('user_profile');
        return $result;
    }

    public function validatePhone($contact,$operation = null,$id = null){
        if($operation == 'update'){
            $this->db->where('id !=',$id);
        }
        $this->db->where('contact',$contact);
        $result = $this->db->get('user_profile');
        return $result;
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->db->where('id_user',$id);
        $this->db->UPDATE('users',array('del_status' => 0));
    }


}