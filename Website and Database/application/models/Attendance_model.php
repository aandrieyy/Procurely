<?php

class Attendance_model extends CI_Model {

    public function get($id_student = null,$date_today = null, $date_from = null, $date_to = null, $id_level = null, $id_section = null){
        $this->db->select('b.*,a.*,CONCAT(aa.last_name,", ",aa.first_name) as name, c.category as level, d.category as section,aa.picture');
        $this->db->order_by('a.id','desc');
        if($id_student != ''){
            $this->db->where('a.id_student',$id_student);
        }
        if($date_today != ''){
            $this->db->where('a.date',$date_today);
        }
        if($date_from != '' && $date_to != ''){
            $this->db->where('a.date BETWEEN "'. date('Y-m-d', strtotime($date_from)). '" and "'. date('Y-m-d', strtotime($date_to)).'"');
        }
        if($id_level != ''){
            $this->db->where('b.id_level',$id_level);
        }
        if($id_section != ''){
            $this->db->where('b.id_section',$id_section);
        }
        if($this->session->userdata("id_user_role") == 3){
            $this->db->where('a.id_student',$_SESSION['id_user']);
        }
        $this->db->join('user_profile aa','a.id_student = aa.id','left');
        $this->db->join('students b','aa.id = b.id_user','left');
        $this->db->join('categories c','b.id_level = c.id','left');
        $this->db->join('categories d','b.id_section = d.id','left');
        $result = $this->db->get('attendance a');
        return $result;
    }

    public function filter_by($record_count,$date_from,$date_to,$status){

        if($record_count != ''){
            $this->db->limit($record_count);
        }

        if($date_from != ''){
            $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($date_from)). '" and "'. date('Y-m-d', strtotime($date_to)).'"');
        }

        if($status != ''){
            $this->db->where('status',$status);
        }

        $result = $this->db->get('appointments a')->result();
        return $result;
    }


    public function save($account_details,$last_attendance,$date_today,$time_today){
        $time_type = 'time_in';
        if(!empty($last_attendance)){
            if($last_attendance[0]->time_in != ""){
                $time_type = 'time_out';
            }
        }
        
        if($time_type == 'time_in'){
            $array = array(
                'id_student'    => $account_details[0]->id,
                'date'          => $date_today,
                $time_type      => $time_today
            );
            $this->db->insert('attendance',$array);
        }else{
            if($last_attendance[0]->time_out != ""){
                return "You already time-out at: ".$last_attendance[0]->time_out;
            }else{
                $time_interval = $this->interval_Checker($last_attendance[0]->time_in);
                if($time_interval >= 300){ // 300seconds or 5minutes
                    $array = array(
                        $time_type => $time_today
                    );
                    $this->db->where('id',$last_attendance[0]->id);
                    $this->db->update('attendance',$array);
                }else{
                    $time = '00:05:00';
                    return "Please wait ". date('i:s', strtotime($time) - ($time_interval));
                }
            }
        }
    }

    public function interval_Checker($time_inout)
    {

        date_default_timezone_set('Asia/Manila');
        $start = new DateTime($time_inout);
        $end = new DateTime(date("Y-m-d g:i:s a"));
        $diff = $end->diff($start);

        $daysInSecs = $diff->format('%r%a') * 24 * 60 * 60;
        $hoursInSecs = $diff->h * 60 * 60;
        $minsInSecs = $diff->i * 60;

        $seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;

        return $seconds;
    }

    public function changeStatus($id,$status){
        $this->db->where('id',$id);
        $this->db->update('appointments',array('status'=>$status));
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->UPDATE('products',array('del_status' => 0));
    }

    // public function edit($id){
    //     $this->db->where("id",$id);
    //     $query = $this->db->get("products");
    //     return $query->result();
    // }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->UPDATE('products',$data);
    }

    public function update_settings($data){
        $this->db->UPDATE('appointment_limit',$data);
    }

    public function appt_statistics(){
        return $this->db->query("SELECT  
                (SELECT COUNT(id) FROM appointments WHERE status = 1 AND DAY(date)=DAY(NOW())) as 'appt_today',
                (SELECT limit_ FROM appointment_limit ) as 'limit'
                FROM appointment_limit a")->row();
      }


}