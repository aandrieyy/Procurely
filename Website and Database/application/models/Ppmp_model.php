<?php

class Ppmp_model extends CI_Model{

    public function get($id = null,$status = null, $project_id = null,$array = null,$ppmp_category = null){

        $this->db->select('a.*,d.name as project,g.category as year,j.name as department,
        ,CONCAT(h.last_name,", ",h.first_name) as update_by, h.signature,
        (SELECT SUM(total) FROM ppmp_item WHERE ppmp_id = a.id) as total
        ');
        $this->db->where('a.del_status',1);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($status != ""){
            $this->db->where('a.status',$status);
        }
        if($project_id != ""){
            $this->db->where('a.project_id',$project_id);   
        }
        if($ppmp_category != ""){
            $this->db->where('a.ppmp_category',$ppmp_category);
        }
        if($_SESSION['id_user_role'] == 8){ // sector head
            $this->db->where('j.sector_id',$_SESSION['sector_id']);
            // $this->db->where_in('a.department_id', $array);
        }
        if($_SESSION['id_user_role'] == 11){ // COLLEGE
            $this->db->where('j.college_id',$_SESSION['college_id']);
            // $this->db->where_in('a.department_id', $array);
        }
        if($_SESSION['id_user_role'] == 3){ // DEPARTMENT HEAD
            $this->db->where_in('a.department_id', $array);
        }
        if($_SESSION['id_user_role'] == 9){ // BUDGET OFFICIER
            $this->db->where('a.docu_generate_by !=', 0);
        }
        // $this->db->join('categories b','a.year_id = b.id');
        $this->db->join('projects d','a.project_id = d.id');
        $this->db->join('categories g','a.year_id = g.id');
        $this->db->join('user_profile h','a.update_by = h.id','left');
        // $this->db->join('colleges i','a.college_id = i.id');
        $this->db->join('departments j','a.department_id = j.id');
        $result = $this->db->get('ppmp a');
        // die($this->db->last_query());
        return $result;
    }

    public function get_ppmp_item($id = null,$ppmp_id = null,$array_ppmp = null,$ppmp_item_status = null,$year_id = null){
        // die($ppmp_item_status.'x');
        if($_SESSION['id_user_role'] == 10){ //bacsec
            $ppmp_item_status = 1;
        }
        $this->db->select("b.*,a.*,c.category as mop,c.id as mop_id, d.id as ppmp_ids, a.project_item_id,e.name as department_name,f.name as college_name,
        (SELECT SUM(qty) FROM ppmp_item WHERE a.project_item_id = project_item_id AND status = $ppmp_item_status) as total_qty,
        (SELECT SUM(qty * unit_price) FROM ppmp_item WHERE a.project_item_id = project_item_id AND status = $ppmp_item_status) as total_amt,
        (SELECT bb.name FROM ppmp aa INNER JOIN departments bb ON aa.department_id = bb.id WHERE a.ppmp_id = aa.id) as department,
        (SELECT aa.generated_docu_type FROM ppmp aa WHERE a.ppmp_id = aa.id) as generated_docu_type,
        (SELECT cc.name FROM ppmp aa INNER JOIN departments bb ON aa.department_id = bb.id INNER JOIN sectors cc ON bb.sector_id = cc.id WHERE a.ppmp_id = aa.id) as sector
        ");
        $this->db->group_by('a.project_item_id');
        $this->db->where('a.deleted_at',NULL);
        if($id != ""){
            $this->db->where('a.id',$id);
        }
        if($ppmp_id != ""){
            $this->db->where('a.ppmp_id',$ppmp_id);
        }

        // if($_SESSION['id_user_role'] != 9){ // NOT BUDGET OFFICIER
            // if(!empty($array_ppmp)){
            //     // $array_ppmp = array(0111122200);
            //     $this->db->where_in('a.ppmp_id', $array_ppmp);
            // }
        // }
        if($year_id != ""){
            $this->db->where('d.year_id',$year_id);
        }
        if($ppmp_item_status != ""){
            $this->db->where('a.status',$ppmp_item_status);
        }
        if($_SESSION['id_user_role'] == 9){ // BUDGET OFFICIER
            $this->db->where('d.docu_generate_by !=', 0); // NAGENERATE NA NANG COLLEGE OR DEPT
        }
        if($_SESSION['id_user_role'] != 3){ // NOT DEPT
            $this->db->where('d.is_send_by_dept !=', 0); // NASEND NA NG DEPT
        }
        if($_SESSION['id_user_role'] == 3){ // DEPT
            $this->db->where('d.created_by', $this->session->userdata("id_user")); // NASEND NA NG DEPT
            $this->db->where('d.is_send_by_dept', 0); // NASEND NA NG DEPT
        }
        $this->db->join('items b','a.project_item_id = b.id');
        $this->db->join('categories c','a.mop = c.id','left');
        $this->db->join('ppmp d','a.ppmp_id = d.id','left');
        $this->db->join('departments e','d.department_id = e.id','left');
        $this->db->join('colleges f','e.college_id = f.id','left');
        $result = $this->db->get('ppmp_item a');
        // die($this->db->last_query());
        return $result;
    }

    public function send($data){ 
        if($data['ppmp_item']['data_table'] != ''){
            for($x = 0; $x < count($data['ppmp_item']['data_table']); $x++){
                $this->db->where('id',$data['ppmp_item']['data_table'][$x]['ppmp_id']);
                $this->db->update("ppmp",array('is_send_by_dept'=>1));
                // die($this->db->last_query());
            }
        }
    }

    public function save($data){
        $array = array(
            'department_id'             =>      $data['department_id'],
            'ppmp_category'             =>      $data['ppmp_category'],
            'year_id'                   =>      $data['year_id'],
            'project_id'                =>      $data['project_id'],
            'created_by'                =>      $_SESSION['id_user'],
            // 'mode_of_procurement_id'    mp=> $data['mode_of_procurement_id'],
        );
        $this->db->insert('ppmp',$array);
        $ppmp_id = $this->db->insert_id();

        if($data['ppmp_item']['data_table'] != ''){
            for($x = 0; $x < count($data['ppmp_item']['data_table']); $x++){
                $ppmp_items[] = array(
                    'ppmp_id'           => $ppmp_id,
                    'project_item_id'   => $data['ppmp_item']['data_table'][$x]['project_item_id'],
                    'qty'               => $data['ppmp_item']['data_table'][$x]['qty'],
                    'unit_price'        => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['unit_price'] ),
                    'total'             => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['total'] ),
                    'mop'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['mop'] ),
                    'jan'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['jan'] ),
                    'feb'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['feb'] ),
                    'mar'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['mar'] ),
                    'apr'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['apr'] ),
                    'may'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['may'] ),
                    'jun'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['jun'] ),
                    'jul'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['jul'] ),
                    'aug'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['aug'] ),
                    'sep'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['sep'] ),
                    'oct'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['oct'] ),
                    'nov'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['nov'] ),
                    'december'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['december'] )
                );
                $this->db->insert("ppmp_item",$ppmp_items[$x]);
            }
        }

        return $ppmp_id;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('ppmp',array('del_status' => 0));
    }

    public function update_docu_generate_by($ppmp_id){
        $this->db->where('id',$ppmp_id);
        $this->db->UPDATE('ppmp',array('docu_generate_by' => $_SESSION['id_user']));
    }

    public function update_docu_generated_by_budget_offiicer($ppmp_id, $docu_type = null){
        $this->db->where('id',$ppmp_id);
        $this->db->UPDATE('ppmp',array('generated_by_budget_offiicer' => $_SESSION['id_user'], 'generated_docu_type' => $docu_type));
    }

    public function get_docu_generate_by($id){
        // if(empty($array_ppmp)){
        //     $array_ppmp = array(0111122200);
        // }
        $this->db->select('c.name as college, a.generated_docu_type');
        // $this->db->limit(1);
        $this->db->where_in('a.id',$id);
        $this->db->join("users b","a.docu_generate_by = b.id_user",'left');
        $this->db->join("colleges c","b.college_id = c.id",'left');
        $query = $this->db->get("ppmp a");
        return $query->row();
    }

    public function edit($id){
        $this->db->where("id",$id);
        $query = $this->db->get("ppmp");
        return $query->result();
    }

    public function update($ppmp_id,$data){
        $array = array(
            'department_id'             =>      $data['department_id'],
            'ppmp_category'             =>      $data['ppmp_category'],
            'year_id'                   =>      $data['year_id'],
            'project_id'                =>      $data['project_id'],
        );
        $this->db->where("id",$ppmp_id);
        $this->db->update('ppmp',$array);
        // print_r($data);die($this->db->last_query());

        $this->db->delete("ppmp_item",array("ppmp_id"=>$ppmp_id));
      
        if($data['ppmp_item']['data_table'] != ''){
            for($x = 0; $x < count($data['ppmp_item']['data_table']); $x++){
                $ppmp_items[] = array(
                    'ppmp_id'           => $ppmp_id,
                    'project_item_id'   => $data['ppmp_item']['data_table'][$x]['project_item_id'],
                    'qty'               => $data['ppmp_item']['data_table'][$x]['qty'],
                    'unit_price'        => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['unit_price'] ),
                    'total'             => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['total'] ),
                    'mop'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['mop'] ),
                    'jan'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['jan'] ),
                    'feb'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['feb'] ),
                    'mar'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['mar'] ),
                    'apr'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['apr'] ),
                    'may'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['may'] ),
                    'jun'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['jun'] ),
                    'jul'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['jul'] ),
                    'aug'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['aug'] ),
                    'sep'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['sep'] ),
                    'oct'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['oct'] ),
                    'nov'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['nov'] ),
                    'december'               => str_replace( ',', '', $data['ppmp_item']['data_table'][$x]['december'] )
                );
                $this->db->insert("ppmp_item",$ppmp_items[$x]);
            }
        }

        return $ppmp_id;
    }

    public function update_status($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('ppmp',$data);
    }

    public function update_ppmp_item_status($ppmp_id,$project_item_id,$data){
        $this->db->where('status',0);
        $this->db->where('project_item_id',$project_item_id);
        // if($ppmp_id !=""){
        //     $this->db->where('ppmp_id',$ppmp_id);
        // }
        $this->db->UPDATE('ppmp_item',$data);
        // die($this->db->last_query());
    }
}