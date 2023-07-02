<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('attendance_model');
        $this->load->model('categories_model');
        $this->load->model('report_model');
        $this->load->library('Pdf');
        $this->load->library('Ciqrcode');
        date_default_timezone_set('Asia/Manila');
	}
    
	public function index($type = null)
	{
        // $res = $this->itexmo();
        // print_r($res);die($res);
       
        $date_today = date("Y-m-d");
        $data['recent_attendance'] = $this->attendance_model->get('',$date_today)->result();
        $data['announcements'] = $this->categories_model->get('announcements');
        $data['report'] = $this->report_model->statistics()->row();
		$this->load->view('attendance-window',$data);
    }

    function itexmo() {
        try { 
           $ch = curl_init();
           $itexmo = array(
               'Email'         => 'nmcanonoy@gmail.com', 
               'Password'      => 'MISPM627761_J4F7T', //078Awh#u
               'ApiCode'       => 'PR-MISPM627761_J4F7T', 
               'Recipients'    => ["09352477540"], 
               'Message'       => 'Test Message' 
           );
           curl_setopt($ch, CURLOPT_URL,"https://api.itexmo.com/api/broadcast"); 
           curl_setopt($ch, CURLOPT_POST, 1); 
           curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($itexmo)); 
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
           $response = curl_exec ($ch); 
           curl_close ($ch); 
           
           return $response; 
       } catch (Exception $ex) {
           return $ex->getMessage(); 
       } 
   } 

    public function history($type = null)
	{
        $data['date_from'] = $this->input->post('date_from');
        $data['date_to'] = $this->input->post('date_to');
        $data['id_level'] = $this->input->post('id_level');
        $data['id_section'] = $this->input->post('id_section');

        $data['level'] = $this->categories_model->get('level');
        $data['sections'] = $this->categories_model->get('sections');

        $data['datas'] = $this->attendance_model->get('','',$data['date_from'],$data['date_to'],$data['id_level'],$data['id_section'])->result();
        
        $data['sidebar_active'] = 'attendance';
        $data['sidebar_submenu_active'] = 'attendance';
        $data['title'] = 'Attendance History';
		$this->load->view('dashboard/admin/attendance.php',$data);
    }

    public function filter_by(){
        $record_count = $this->input->post('record_count');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $status = $this->input->post('status');

        $data = $this->attendance_model->filter_by($record_count,$date_from,$date_to,$status);
        echo json_encode($data);
    }

    public function manage_appt($status)
	{
        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }

        $data['sidebar_active'] = 'appointments';
        $data['sidebar_submenu_active'] = 'appointments';
        $data['status'] = $status;
        $data['appt'] = $this->attendance_model->get('',$status)->result();
        $data['report'] = $this->attendance_model->appt_statistics();
		$this->load->view('dashboard/appointments',$data);
    }


    public function get_time()
    {
    	echo date("h:i:s A",strtotime(date("h:i:sa")));
    }

    public function changeStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $email = $this->input->post('email');
        $this->attendance_model->changeStatus($id,$status);
        $msg = "Appointment status was succesfully updated!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');

        if($status == 1){  $status_txt = "Approved"; }
        if($status == 2){  $status_txt = "Disapproved"; }
        if($status == 3){  $status_txt = "Discharged"; }

        $this->sendMail_updateStatus($email,$id,$status_txt);
    }

    public function sendMail_updateStatus($email,$id,$status_txt){
        $link = base_url().'appointments/appointment_summary/'.$id;
        // Email Sender order placed
        $to =  $email;  // User email pass here
        $subject = 'Appointment Update | Coerpa Builders Corp';
        $from = 'no-reply@coerpa.net';              // Pass here your mail id
                  
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'smtp.hostinger.com'; // ssl://smtp.gmail.com //hostinger
        $config['smtp_port']    = '587'; //465 //587
        $config['smtp_timeout'] = '60';
    
        $config['smtp_user']    = 'no-reply@coerpa.net';    //Important
        $config['smtp_pass']    = '8rM*1EWB$n';  //Important
    
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
    
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        
        $this->email->message("Your appointment is now $status_txt, click this <a href=".$link.">link.</a> ");
        $this->email->send();
        // show_error($this->email->print_debugger());
        // Email Sender order placed
    
    }


    public function save(){
        $error = '';
        $time_in = '';
        $time_out = '';
        $date_today = date("Y-m-d");
        $time_today = date("h:i:s A");
        $rfid = $this->input->post('rfid');

        $account_details = $this->user_model->get('',$rfid)->result();
        if(!empty($account_details)){
            $last_attendance = $this->attendance_model->get($account_details[0]->id,$date_today)->result();
          
            $error = $this->attendance_model->save($account_details,$last_attendance,$date_today,$time_today);

            $last_attendance = $this->attendance_model->get($account_details[0]->id,$date_today)->result();
            if(isset($last_attendance)){
                $time_in = isset($last_attendance[0]->time_in) ? $last_attendance[0]->time_in : '';
                $time_out = isset($last_attendance[0]->time_out) ? $last_attendance[0]->time_out : '';
            }else{
                $time_in = '';
                $time_out = '';
            }
        }else{
            $error = "Account doesn't exists";
        }

        $recent_attendance = $this->attendance_model->get('',$date_today)->result();
        
        if($error == ""){
            //SEND SMS
            //OUT
            $message = "MISP Update: Your child ". $account_details[0]->name ." has just left at the school premises at ". $time_today . " on ". $date_today ;
            if($time_in != ""){
                //IN
                $message = "MISP Update: Your child ". $account_details[0]->name ." has just arrived at the school premises at ". $time_today . " on ". $date_today ;
            }
            $recipients = $account_details[0]->g_contact;
            $this->customlib->itexmo($message,$recipients);
            //SEND SMS
        }


        $array = array(
            "error" => $error,
            "account_details" => $account_details,
            "recent_attendance" => $recent_attendance,
            "date" => $date_today,
            "time_in" => $time_in,
            "time_out" => $time_out,
            "report" =>$this->report_model->statistics()->row()
        );
        echo json_encode($array);
    }

    public function sendMail_new_appt($email,$insert_id){
        $link = base_url().'appointments/appointment_summary/'.$insert_id;
        // Email Sender order placed
        $to =  $email;  // User email pass here
        $subject = 'Appointment Notification | Coerpa Builders Corp';
        $from = 'no-reply@coerpa.net';              // Pass here your mail id
                  
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'smtp.hostinger.com'; // ssl://smtp.gmail.com //hostinger
        $config['smtp_port']    = '587'; //465 //587
        $config['smtp_timeout'] = '60';
    
        $config['smtp_user']    = 'no-reply@coerpa.net';    //Important
        $config['smtp_pass']    = '8rM*1EWB$n';  //Important
    
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
    
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message("Hi, <br><br>

        Your appointment has been submitted and is currently pending. 
        Please take note of this reference number: AR-1000$insert_id. You may visit our <a href='coerpa.net'>website</a>  to check the status of your appointment.
        You will also receive another email once your appointment is approved.
        <br><br>
        COERPA BUILDERS CORP ");
        $this->email->send();
        // show_error($this->email->print_debugger());
        // Email Sender order placed
    
    }


    public function downloadPDF($id){
        $appt = $this->attendance_model->get($id)->row();
        $status = '';
        if($appt->status == 0){
            $status = '<div style="color:#fff;background-color:#6861CE">PENDING</div> ';
            $status_text = "PENDING";
        }else if($appt->status == 1){
            $status=  '<div style="color:#fff;background-color:#31CE36">APPROVED</div> ';
            $status_text = "APPROVED";
        }else if($appt->status == 2){
            $status=  '<div style="color:#fff;background-color:#31CE36">DISAPPROVED</div> ';
            $status_text = "DISAPPROVED";
        }else{
            $status= '<div style="color:#fff;background-color:#FFAD46">DISCHARGE</div> ';
            $status_text = "DISCHARGE";
        }


        // QRcode::png('Hello','filename.png');
        $codeContents = $appt->name.';'.$appt->mobile_nos.';'.$appt->address;
        $filename = 'filename';
        $tempDir = '';
        QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5, 1);
        // $text = 'haha';
        // QRcode::png  (
        //     $text,
        //     $outfile = false,
        //     $level = QR_ECLEVEL_L,
        //     $size = 1,
        //     $margin = 1,
        //     $saveandprint = false 
        // ); 

        $name = 'John Rey';
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Coerpa Builders Corp');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        $content = '
        <div align="center">
        <b>Coerpa Builders Corp</b> <br>
        Procurely
       
        </div>
        <hr>
        <div align="center">
            <span style="font-size:11px;">Appointment Certificate</span>
        </div>

        <br>
        <table style="">
            <tr>
                <td width="75%">
                    <br>
                    <br>
                    <b>Appointment Request #:</b> AR-1000'.$appt->id.'<br>
                    <b>Name:</b> '.$appt->name.' <br>
                    <b>Address:</b> '.$appt->address.' <br>
                    <b>Mobile Number:</b>  '.$appt->mobile_nos.' <br>
                    <b>Telephone:</b>  '.$appt->telephone.' <br>
                    <b>Email:</b>  '.$appt->email.' <br>
                    <b>Appointment Status:</b>  '.$status_text.' <br>
                    <b>Appointment Date & Time:</b>  '.$appt->date.' '.$appt->time.' <br>
                    <b>Type:</b>  '.$appt->type.' <br>
                    <b>Appointment Status:</b>  '.$status_text.' <br>
                    <br><br> <br>
                    <b>Appointment Details:</b> '. $appt->reason.'
                    <br>
                    <br>
                </td>
            

                <td width="19%" align="center" style="">
                
                   
                </td>

            </tr>
        </table>

        <div style="border:1px solid #000; color:red;padding:115px;font-size:9px;">
            <br>
            &nbsp;&nbsp; REMINDERS
            <br> &nbsp;&nbsp; 1. Present this appointment certificate when entering to the establishment 
            <br> &nbsp;&nbsp; 1. The no face mask, no entry policy shall be strictly implemented. You are required to wear protective mask upon entry and while 
            <br> &nbsp;&nbsp; inside the Coerpa Builders Corp. 
            <br> &nbsp;&nbsp; 2. Proper use of face mask must be observed at all the times. Both nose and mouth must be covered. 
            <br> &nbsp;&nbsp; 3. You must undergo hand disinfection provided at entrance of the establishment. 
            <br> &nbsp;&nbsp; 4. Refusal to cooperate and comply with these health/sanitary protocols shall be unable to enter the establishment.
            <br>
        </div>
        ';
        // set some text to print
        // $html = <<<EOD
        //     $content
        // EOD;

        // Print text using writeHTMLCell()
        // $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
        
    }

    public function report_appointment_pdf($status_text = null,$status_value = null,$record_count = null,$date_from = null,$date_to = null){
        // die($status1 .'|'. $record_count .'|'. $date_from .'|'. $date_to .'|'. $status );

        if($record_count != ''){
            $data = $this->attendance_model->filter_by($record_count,$date_from,$date_to,$status_value);
        }else{
            $data = $this->attendance_model->get('',$status_value)->result();
        }

        $table_data = '';
        foreach($data as $row){
            $table_data .= "
                <tr>
                    <td>AR-1000".$row->id."</td>
                    <td>".$row->name." (".$row->mobile_nos.")</td>
                    <td>".$row->address."</td>
                    <td>".$row->date." ".$row->time."</td>
                </tr>
            ";
        }
  
        

        // $appt = $this->attendance_model->get($id)->row();

        $name = 'John Rey';
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Coerpa Builders Corp');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetTopMargin(2);
        $pdf->SetLeftMargin(0);
        $pdf->SetRightMargin(0);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        $content = '
            <div align="center">
            <b>Coerpa Builders Corp</b> <br>
       
            </div>
            <hr>
            <div align="center">
                <span style="font-size:11px;">Masterlist of '.$status_text.' Appointment</span>
            </div>

            <br>
            <table border="1" cellpadding="2">
                <tr>
                    <td width="14%"><b>Reference #</b></td>
                    <td width="30%"><b>Visitor Info</b></td>
                    <td width="37%"><b>Address</b></td>
                    <td width="18%"><b>Date/Time</b></td>
                </tr>
                '.$table_data.'
            </table>
        ';
        // set some text to print
        // $html = <<<EOD
        //     $content
        // EOD;

        // Print text using writeHTMLCell()
        // $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
        
    }
    
}
