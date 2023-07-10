<?php

class Report_model extends CI_Model{

  public function statistics($id_sector = null){
    $date_today = date("Y-m-d");
    $where_id_sector = "";
    if($id_sector != ""){
        $where_id_sector = "sector_id = ".$id_sector." AND";
    }

    return $this->db->query("SELECT  

    (SELECT SUM(funds) FROM college_budget WHERE $where_id_sector deleted_at is NULL AND YEAR(created_at)=YEAR(NOW())) as total_budget_allocated,

    -- BUDGET PROPOSAL
    (SELECT COUNT(id) FROM budget_proposals WHERE deleted_at is NULL) as count_budget_proposal,
    (SELECT COUNT(id) FROM purchase_requests WHERE deleted_at is NULL) as count_purchase_requests,
    (SELECT COUNT(id) FROM ppmp WHERE del_status = 1 AND status = 1) as count_document,

    (SELECT COUNT(id) FROM ppmp WHERE del_status = 1) as ppmp,
    (SELECT COUNT(id) FROM ppmp WHERE status = 0 AND del_status = 1) as pending_ppmp,
    (SELECT COUNT(id) FROM ppmp WHERE status = 1 AND del_status = 1) as approved_ppmp,
    (SELECT COUNT(id) FROM ppmp WHERE status = 2 AND del_status = 1) as rejected_ppmp

    FROM users a");
  }

  public function ppmp_stats($status){
    return $this->db->query("SELECT  

    (SELECT SUM((a.quantity*b.unit_price)) FROM ppmp a INNER JOIN items b ON a.item_id = b.id
    WHERE a.del_status = 1 AND a.status=$status) as total
    
    FROM users a");
  }


  public function budget_stats_department(){
    return $this->db->query("SELECT  *

    -- (SELECT IFNULL(SUM(funds), 0) FROM college_budget a INNER JOIN assigned_department b ON a.department_id = b.department_id WHERE b.id_department_head = $_SESSION[id_user] AND a.deleted_at is NULL AND b.deleted_at is NULL) as college_budget,
    -- (SELECT IFNULL(SUM(total), 0)  FROM purchase_requests WHERE status = 1 AND deleted_at is NULL) as allocated_pr,
    -- ((SELECT IFNULL(SUM(funds), 0) FROM college_budget a INNER JOIN assigned_department b ON a.department_id = b.department_id WHERE b.id_department_head = $_SESSION[id_user] AND a.deleted_at is NULL AND b.deleted_at is NULL) - (SELECT IFNULL(SUM(total), 0)  FROM purchase_requests WHERE status = 1 AND deleted_at is NULL)) as remaining_college_budget
    
    FROM users a LIMIT 1");
  }

  public function college_budget_stats(){
    return $this->db->query("SELECT  
    (SELECT IFNULL(SUM(funds), 0) FROM college_budget WHERE deleted_at is NULL AND college_id = $_SESSION[college_id]) as total_budget,
    (SELECT IFNULL(SUM(a.total), 0)  FROM ppmp_item a INNER JOIN ppmp b ON a.ppmp_id = b.id INNER JOIN departments c ON b.department_id = c.id WHERE a.status != 2 AND a.deleted_at is NULL AND c.college_id = $_SESSION[college_id]) as allocated_budget,
    ((SELECT IFNULL(SUM(funds), 0) FROM college_budget WHERE deleted_at is NULL AND college_id = $_SESSION[college_id]) - (SELECT IFNULL(SUM(a.total), 0)  FROM ppmp_item a INNER JOIN ppmp b ON a.ppmp_id = b.id INNER JOIN departments c ON b.department_id = c.id WHERE a.status != 2 AND a.deleted_at is NULL AND c.college_id = $_SESSION[college_id])) as remaining_budget
    
    FROM users a LIMIT 1");
    //  die($this->db->last_query());
  }


  public function annual_budget_stats(){
    return $this->db->query("SELECT   

    (SELECT IFNULL(SUM(amount), 0) FROM annual_budget WHERE deleted_at is NULL) as total_budget,
    (SELECT IFNULL(SUM(amount), 0) FROM sector_budget WHERE deleted_at is NULL) as allocated_budget,
    ((SELECT IFNULL(SUM(amount), 0) FROM annual_budget WHERE deleted_at is NULL) - (SELECT IFNULL(SUM(amount), 0) FROM sector_budget WHERE deleted_at is NULL)) as remaining_budget
    
    FROM users a LIMIT 1");
    // die($this->db->last_query());
  }

  public function sector_budget_stats(){
    return $this->db->query("SELECT   
    ((SELECT IFNULL(SUM(amount), 0) FROM annual_budget WHERE deleted_at is NULL) - (SELECT IFNULL(SUM(amount), 0) FROM sector_budget WHERE deleted_at is NULL)) as annual_remaining_budget,
    (SELECT IFNULL(SUM(amount), 0) FROM sector_budget WHERE deleted_at is NULL) as total_budget,
    (SELECT IFNULL(SUM(funds), 0) FROM college_budget WHERE deleted_at is NULL) as allocated_budget,
    ((SELECT IFNULL(SUM(amount), 0) FROM sector_budget WHERE deleted_at is NULL) - (SELECT IFNULL(SUM(funds), 0) FROM college_budget WHERE deleted_at is NULL)) as remaining_budget
    
    FROM users a LIMIT 1");
    // die($this->db->last_query());
  }

  public function notif($id = null){
    // $this->db->select('*,a.topic as title');
    // if($id != ''){
    //     $this->db->where('a.id',$id);
    // }
    // $result = $this->db->get('meetings a');
    // return $result;

      // $result = $this->db->query('SELECT CONCAT("Dept. Budget(",b.name,"): ",a.funds) as title,a.created_at as description,CONCAT("#9D0823") as color FROM college_budget a 
      // INNER JOIN departments b ON a.department_id = b.id WHERE notif = 0

      // ');


    $this->db->where('user_id',$_SESSION['id_user']);
    $this->db->where('status',0);
    $this->db->order_by('id','desc');
    return $this->db->get('notifications');
    
    

                              // die($this->db->last_query());
    
  }

  public function purchase_bar_graph(){
    // $where = '';
    // if($_SESSION['id_user_role'] == 5){ // merchant
    //     $where = 'AND id_merchant = '. $_SESSION["id_user"];
    // }

    $this->db->select("a.date,
    (SELECT COUNT(id) FROM purchase_requests WHERE MONTH(date) = MONTH(a.date)  GROUP BY MONTH(a.date), YEAR(a.date) LIMIT 1) as count");
    $this->db->group_by("MONTH(a.date), YEAR(a.date)");
    $this->db->where("a.deleted_at",NULL);
    $result = $this->db->get('purchase_requests a');
    // die($this->db->last_query());
    return $result;
  }

}