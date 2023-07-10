<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_requests extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('purchase_requests_model');
        $this->load->model('projects_model');
        $this->load->model('sectors_model');
        $this->load->model('notif_model');
        $this->load->library('Pdf');
        $this->load->library('Ciqrcode');
	}

	public function index($status = null)
	{
        $data['sidebar_active'] = 'side_pr';
        $data['status'] = $status;
        $data['sidebar_submenu_active'] = 'purchase_requests';

        if($status == 0){ $status_text = "Pending"; }
        if($status == 1){ $status_text = "Approved"; }
        if($status == 2){ $status_text = "Rejected"; }
        $data['status_text'] = $status_text;
        
        $data['purchase_requests'] = $this->purchase_requests_model->get('',$status)->result();
		$this->load->view('dashboard/purchase_request',$data);
    }

	public function downloadPDF($id){
		$pr = $this->purchase_requests_model->get($id)->row();
		$status = '';
		if($pr->status == 0){
			$status = '<span style="color:#fff;background-color:#6861CE">PENDING</span> ';
		}else if($pr->status == 1){
			$status=  '<span style="color:#fff;background-color:#31CE36">APPROVED</span> ';
		}else if($pr->status == 2){
			$status=  '<span style="color:#fff;background-color:#31CE36">DISAPPROVED</span> ';
		}


		// // QRcode::png('Hello','filename.png');
		// $codeContents = $appt->name.';'.$appt->mobile_nos.';'.$appt->address;
		// $filename = 'filename';
		// $tempDir = '';
		// QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5, 1);
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
		$pdf->SetTitle('PROCURELY');
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
		
			</div>
			<hr>
			<br>
			<table border="1">
				<tr>
					<td width="15%">
						<img src="'.base_url().'public/assets/img/logoo.png"  style="width:100px;margin:100px">
					</td>
					<td width="85%" align="center">
						<h2><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</b></h2>
						<br>
						Ayala Blvd., Ermita, Manila, 1000, Philippines 
						<br>
						Website: www.tup.edu.ph
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">
						<span style="font-size:13px;"><b>PURCHASE REQUEST DOCUMENT</b></span>
					</td>
				</tr>
			</table>
			<div align="left">
				<br>	<br>
				<span style="font-size:13px;"><b> Project:</b> '.$pr->project.' <br></span>
			</div>

			<table style="" border="1" align="center">
				<tr>
					<td> PR NUMBER</td>
					<td> DATE</td>
					<td> PURPOSE</td>
					<td> TOTAL</td>
				</tr>
				<tr>
					<td>'.$pr->pr_number.'</td>
					<td>'.$pr->date.'</td>
					<td>'.$pr->purpose.'</td>
					<td>'.number_format($pr->total,2).'</td>
				</tr>
			</table>

			<br></br><br></br></br></br>
			<table border="1">
				<tr>
					<td>
						<br>
						<b> Status:</b> '. $status.'
					</td>
				</tr>
				<tr>
					<td>
						<b> Status Remarks:</b> '. $pr->status_remarks.'
					</td>
				</tr>
				<tr align="left">
					<td >
						<br>
						<b> Update By:</b> '. $pr->update_by.'
						<br>
						<b> Update At:</b> '. date("F j, Y H:i A",strtotime($pr->updated_at)).'
						<br>
						<b> Signature:</b>
						<img src="'.base_url().'public/uploads/signature/'.$pr->signature.'" alt="">

					</td>
				</tr>
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

    public function create_pr()
	{
        $data['sidebar_active'] = 'side_pr';
        $data['sidebar_submenu_active'] = 'create_pr';
        
        $data['projects'] = $this->projects_model->get();
		$this->load->view('dashboard/create_pr',$data);
    }
    
    public function save(){
        $data = $this->input->post();
        $this->purchase_requests_model->save($data);

        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->purchase_requests_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->purchase_requests_model->edit($id);
        echo json_encode($data);
    }

    public function update(){
        $id = $this->input->post('id');
        $_POST['updated_at'] = date("Y-m-d");
        $data = $this->input->post();
        unset($_POST['id']);
        $this->purchase_requests_model->update($id,$data);
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_department(){
        $sector_id = $this->input->post('sector_id');
        $data = $this->purchase_requests_model->get('',$sector_id)->result();
        echo json_encode($data);
    }

    public function update_status(){
		$path = 'public/uploads/signature/';
        $file_name = $_FILES["userfile"]['name'];
        $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        $_POST['signature'] = $picture;
		$_POST['update_by'] = $_SESSION['id_user'];
		$_POST['updated_at'] = date("Y-m-d h:i:s");

        $id = $this->input->post('id');
        $data = $this->input->post();
        $this->purchase_requests_model->update_status($id,$data);

		// WRITE NOTIFICATION
		$pr = $this->purchase_requests_model->get($id)->row();
		$project = $this->projects_model->get($pr->project_id);
		$status = "approved";
		// print_r($data);die($data['status']);
		if($data['status'] == 2){
			$status = "rejected";
		}
		$notif = "Purchase request for project (".$project[0]->name.") was ".$status;
		
		//GET USERS
		$sectors = $this->user_model->get('',3)->result(); // DEPARTMENT
		foreach($sectors as $row){
			//SAVE NOTIF
			$this->notif_model->save_notif($notif,$row->id);
		}
		$sectors = $this->user_model->get('',1)->result(); // ADMIN
		foreach($sectors as $row){
			//SAVE NOTIF
			$this->notif_model->save_notif($notif,$row->id);
		}

        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
