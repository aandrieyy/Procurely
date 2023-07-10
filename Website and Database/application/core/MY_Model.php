<?php
class MY_Model extends CI_Model { 
    
  function __construct(){
      parent::__construct();
  }

  public function save(){
    $id_user_role = $this->input->post('id_user_role');
    $college_id = $this->input->post('college_id');
    $sector_id = $this->input->post('sector_id');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $picture = $this->input->post('picture');
    $id = $this->input->post('id');
    unset($_POST['id_user_role']);
    unset($_POST['college_id']);
    unset($_POST['sector_id']);
    unset($_POST['username']);
    unset($_POST['password']);
    unset($_POST['id']);

    if($picture == ""){
      $_POST['picture'] = 'default_pic.png';
    }

    if($id_user_role == 3){
      $rfid = $this->input->post('rfid');
      $student_id = $this->input->post('student_id');
      $id_level = $this->input->post('id_level');
      $id_section = $this->input->post('id_section');
      $id_track = $this->input->post('id_track');
      $id_strand = $this->input->post('id_strand');
      $g_full_name = $this->input->post('g_full_name');
      $g_contact = $this->input->post('g_contact');
      $g_address = $this->input->post('g_address');
      unset($_POST['rfid']);
      unset($_POST['student_id']);
      unset($_POST['id_level']);
      unset($_POST['id_section']);
      unset($_POST['id_track']);
      unset($_POST['id_strand']);
      unset($_POST['g_full_name']);
      unset($_POST['g_contact']);
      unset($_POST['g_address']);
    }

    $this->db->insert("user_profile",$this->input->post());
    $last_id = $this->db->insert_id();

    if(!isset($college_id)){
      $college_id = 0;
    }
    if(!isset($sector_id)){
      $sector_id = 0;
    }

    $array = array(
      'id_user_role' => $id_user_role,
      'college_id' => $college_id,
      'sector_id' => $sector_id,
      'id_user' => $last_id,
      'username' => $username,
      'password' => password_hash($password, PASSWORD_DEFAULT),
    );
    $this->db->insert("users",$array);
    
    if($id_user_role == 3){
      $array = array(
        'id_user' => $last_id,
        'rfid' => $rfid,
        'student_id' => $student_id,
        'id_level' => $id_level,
        'id_section' => $id_section,
        'id_track' => $id_track,
        'id_strand' => $id_strand,
        'g_full_name' => $g_full_name,
        'g_contact' => $g_contact,
        'g_address' => $g_address,
      );
      $this->db->insert("students",$array);
    }

  }

  public function bulk_save($data){
    $id_user_role = $this->input->post('id_user_role');

    $array_user_profile = array(
      "picture" => 'default_pic.png',
      "first_name" => $data['first_name'],
      "middle_name" => $data['middle_name'],
      "last_name" => $data['last_name'],
      "birthday" => $data['birthday'],
      "gender" => $data['gender'],
      "email" => $data['email'],
      "contact" => $data['contact'],
      "address" => $data['address'],
    );
    $this->db->insert("user_profile",$array_user_profile);
    $last_id = $this->db->insert_id();

    $array = array(
      'id_user_role' => $id_user_role,
      'id_user' => $last_id,
      'username' => $data['student_id'],
      'password' => password_hash($data['student_id'], PASSWORD_DEFAULT),
    );
    $this->db->insert("users",$array);
    
    if($id_user_role == 3){
      $array_student = array(
        'id_user' => $last_id,
        'rfid' => $data['rfid'],
        'student_id' => $data['student_id'],
        'id_level' => $this->input->post('id_level'),
        'id_section' => $this->input->post('id_section'),
        'id_track' =>  $this->input->post('id_track'),
        'id_strand' =>  $this->input->post('id_strand'),
        'g_full_name' =>   $data['guardian_fullname'],
        'g_contact' =>   $data['guardian_contact_#'],
        'g_address' =>   $data['guardian_address'],
      );
      $this->db->insert("students",$array_student);
    }

  }

  public function edit(){
    $id = $this->input->post('id');

    $this->db->select("b.*,a.*");
    $this->db->where("a.id",$id);
    // $this->db->join("students b","a.id = b.id_user",'left');
    $this->db->join('users b','a.id = b.id_user');
    $query = $this->db->get("user_profile a");
    return $query->result();
  
  }

  public function update(){
    $id_user_role = $this->input->post('id_user_role');
    $college_id = $this->input->post('college_id');
    $sector_id = $this->input->post('sector_id');
 
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $picture = $this->input->post('picture');
    $id = $this->input->post('id');
    unset($_POST['id_user_role']);
    unset($_POST['college_id']);
    unset($_POST['sector_id']);
    unset($_POST['username']);
    unset($_POST['password']);
    unset($_POST['id']);

    if($picture == ""){
      $_POST['picture'] = $picture;
    }

    if($id_user_role == 3){
      $rfid = $this->input->post('rfid');
      $student_id = $this->input->post('student_id');
      $id_level = $this->input->post('id_level');
      $id_section = $this->input->post('id_section');
      $id_track = $this->input->post('id_track');
      $g_full_name = $this->input->post('g_full_name');
      $g_contact = $this->input->post('g_contact');
      $g_address = $this->input->post('g_address');
      unset($_POST['rfid']);
      unset($_POST['student_id']);
      unset($_POST['id_level']);
      unset($_POST['id_section']);
      unset($_POST['id_track']);
      unset($_POST['id_strand']);
      unset($_POST['g_full_name']);
      unset($_POST['g_contact']);
      unset($_POST['g_address']);
    }

    $this->db->where('id',$id);
    $this->db->update("user_profile",$this->input->post());

    if($username != '' && $password != ''){
      $array = array(
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'college_id' => $college_id,
      );
      $this->db->where('id_user',$id);
      $this->db->update("users",$array);
    }

    if(isset($college_id)){
      $array = array(
        'college_id' => $college_id,
      );
      $this->db->where('id_user',$id);
      $this->db->update("users",$array);
    }

    if(isset($sector_id)){
      $array = array(
        'sector_id' => $sector_id,
      );
      $this->db->where('id_user',$id);
      $this->db->update("users",$array);
    }

    
    if($id_user_role == 3){
      $array = array(
        'rfid' => $rfid,
        'student_id' => $student_id,
        'id_level' => $id_level,
        'id_section' => $id_section,
        'id_track' => $id_track,
        'id_strand' => $id_strand,
        'g_full_name' => $g_full_name,
        'g_contact' => $g_contact,
        'g_address' => $g_address,
      );
      $this->db->where('id_user',$id);
      $this->db->update("students",$array);
    }

  }

}
