<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppmp extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('ppmp_model');
        $this->load->model('projects_model');
        $this->load->model('report_model');
        $this->load->model('notif_model');
        $this->load->model('items_model');
        $this->load->model('colleges_model');
        $this->load->model('college_department_model');
        $this->load->model('department_model');
        $this->load->library('Pdf');
        $this->load->library('Ciqrcode');
	}

	public function index($ppmp_category = null, $status = null)
	{
        $data['sidebar_active'] = 'side_ppmp';
        $data['sidebar_submenu_active'] = 'side_get_ppmp_categories'.$ppmp_category;
        $data['status'] = $status;

        if($status == 0){ $status_text = "Pending"; }
        if($status == 1){ $status_text = "Approved"; }
        if($status == 2){ $status_text = "Rejected"; }
        $data['status_text'] = $status_text;

		$ppmp_categories = $this->categories_model->get('item_categories');
		$data['ppmp_categories'] = $ppmp_categories[0]->category;

        $data['ppmp_category'] = $ppmp_category;

        $data['funds_type'] = $this->categories_model->get('funds_type');
        $data['units'] = $this->categories_model->get('units');
        $data['years'] = $this->categories_model->get('years');
        $data['item_type'] = $this->categories_model->get('item_type');
        $data['item_categories'] = $this->categories_model->get('item_categories');
        $data['mode_of_procurements'] = $this->categories_model->get('mode_of_procurements');
        $data['projects'] = $this->projects_model->get();
        
		$array = array();
		if($_SESSION['id_user_role'] == 11){ // COLLEGE
            $college_departments = $this->college_department_model->get($_SESSION['college_id'])->result();
			$array = array();
			foreach($college_departments as $row){
				array_push($array,$row->id);
			}
        }
		// die($_SESSION['id_user']);
		// if($_SESSION['id_user_role'] == 3){ // DEPARTMENT HEAD
        //     $get_assign_department = $this->department_model->get_assign_department($_SESSION['id_user'])->result();
		// 	$array = array();
		// 	foreach($get_assign_department as $row){
		// 		array_push($array,$row->department_id);
		// 	}
        // }
		// // print_r($array);die();
		if($status == 0){
			$status = '0';
		}
		$ppmp_item_status = $status;
		// // die($ppmp_item_status);
        // $data['ppmp'] = $this->ppmp_model->get('',$status,'',$array,$ppmp_category)->result();
		// // print_r($array);die($this->db->last_query());
		// if($_SESSION['id_user_role'] == 11 || $_SESSION['id_user_role'] == 8 || $_SESSION['id_user_role'] == 10 || $_SESSION['id_user_role'] == 9){ // college , sector head, bac sec, budget officer
		// 	$array_ppmp = array();
		// 	foreach($data['ppmp'] as $row){
		// 		array_push($array_ppmp,$row->id);
		// 	}
		// 	$data['ppmp_item'] = $this->ppmp_model->get_ppmp_item('','',$array_ppmp,$ppmp_item_status)->result();
        // }
		// die($ppmp_item_status);
		$array_ppmp = array();
		$data['ppmp_item'] = $this->ppmp_model->get_ppmp_item('','',$array_ppmp,$ppmp_item_status)->result();
		// GET WHO PREPARE THE DOCU
		foreach($data['ppmp_item'] as $row){
			$data['ppmp'] = $this->ppmp_model->get_docu_generate_by($row->id);
        }
		// die($this->db->last_query());
		
		// GET WHO PREPARE THE DOCU
		
		$data['users'] = $this->user_model->get()->result();

		// print_r($array_ppmp);die();
        // $data['report'] = $this->report_model->ppmp_stats($status)->row();
		$this->load->view('dashboard/ppmp',$data);
    }

	public function year($year_id = null)
	{
        $data['sidebar_active'] = 'side_ppmp';
        $data['sidebar_submenu_active'] = 'side_get_years'.$year_id;
        
		$array = array();
		if($_SESSION['id_user_role'] == 11){ // COLLEGE
            $college_departments = $this->college_department_model->get($_SESSION['college_id'])->result();
			$array = array();
			foreach($college_departments as $row){
				array_push($array,$row->id);
			}
        }
	
		$array_ppmp = array();
		$data['ppmp_item'] = $this->ppmp_model->get_ppmp_item('','',$array_ppmp,'',$year_id)->result();
		// GET WHO PREPARE THE DOCU
		foreach($data['ppmp_item'] as $row){
			$data['ppmp'] = $this->ppmp_model->get_docu_generate_by($row->id);
        }
		// die($this->db->last_query());
		
		// GET WHO PREPARE THE DOCU
		
		$data['users'] = $this->user_model->get()->result();

		// print_r($array_ppmp);die();
        // $data['report'] = $this->report_model->ppmp_stats($status)->row();
		$this->load->view('dashboard/ppmp',$data);
    }

	public function create_ppmp()
	{
        $data['sidebar_active'] = 'side_ppmp';
        $data['sidebar_submenu_active'] = 'create_ppmp';

		$data['title'] = 'Create PPMP';
        $data['action'] = 'save';
        
		$data['units'] = $this->categories_model->get('units');
        $data['years'] = $this->categories_model->get('years');
        $data['item_type'] = $this->categories_model->get('item_type');
        $data['ppmp_categories'] = $this->categories_model->get('item_categories');
        $data['mode_of_procurements'] = $this->categories_model->get('mode_of_procurements');

        $data['projects'] = $this->projects_model->get();
		// $data['colleges'] = $this->colleges_model->getCollegeByAssignedDept($_SESSION['id_user'])->result();
        $data['assign_departments'] = $this->department_model->get_assign_department($_SESSION['id_user'])->result();

		$this->load->view('dashboard/create-ppmp',$data);
    }
    
	public function update_ppmp($ppmp_id)
	{
        $data['sidebar_active'] = 'side_ppmp';
        $data['sidebar_submenu_active'] = 'create_ppmp';
        
		$data['title'] = 'Update PPMP';
        $data['action'] = 'update';
        $data['ppmp_id'] = $ppmp_id;

		$data['units'] = $this->categories_model->get('units');
        $data['years'] = $this->categories_model->get('years');
        $data['item_type'] = $this->categories_model->get('item_type');
        $data['item_categories'] = $this->categories_model->get('item_categories');
        $data['mode_of_procurements'] = $this->categories_model->get('mode_of_procurements');
		// print_r($data['mode_of_procurements']);die();
        $data['projects'] = $this->projects_model->get();

		$data['ppmp'] = $this->ppmp_model->get($ppmp_id)->row();
		// die($data['ppmp']->college_id);
		$data['ppmp_items_option'] = $this->items_model->get('','',$data['ppmp']->project_id)->result();
		$data['ppmp_items'] = $this->ppmp_model->get_ppmp_item('',$ppmp_id)->result();

		$data['colleges'] = $this->colleges_model->getCollegeByAssignedDept($_SESSION['id_user'])->result();
		$data['ppmp_categories'] = $this->categories_model->get('item_categories');

		$this->load->view('dashboard/create-ppmp',$data);
    }

    public function save(){
        unset($_POST['item_type_id']);
        unset($_POST['unit_price']);
        unset($_POST['est_Budget']);
		$_POST['created_by'] = $_SESSION['id_user'];
        $data = $this->input->post();
        $id = $this->ppmp_model->save($data);

		// WRITE NOTIFICATION
        $ppmp = $this->ppmp_model->get($id)->row();
        $project = $this->projects_model->get($ppmp->project_id);
        $notif = "New PPMP was created for project (".$project[0]->name.")";

        //GET USERS
        $sectors = $this->user_model->get('',9)->result(); //budget_officer
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        $sectors = $this->user_model->get('',8)->result(); //sector_head
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }
        $sectors = $this->user_model->get('',1)->result(); //admin
        foreach($sectors as $row){
            //SAVE NOTIF
            $this->notif_model->save_notif($notif,$row->id);
        }

        // die($this->db->last_query());
        $msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

	public function send(){
        $data = $this->input->post();
        $this->ppmp_model->send($data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->ppmp_model->delete($id);
    }

    public function edit(){
        $id = $this->input->post('id');
        $data = $this->ppmp_model->get($id)->result();
        echo json_encode($data);
    }

    public function update(){
        $ppmp_id = $this->input->post('ppmp_id');
        $data = $this->input->post();
        $this->ppmp_model->update($ppmp_id,$data);
        // die($this->db->last_query());
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
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
        $this->ppmp_model->update_status($id,$data);

		// WRITE NOTIFICATION
		$ppmp = $this->ppmp_model->get($id)->row();
		$project = $this->projects_model->get($ppmp->project_id);
		$status = "approved";
		if($data->status == 2){
			$status = "rejected";
		}
		$notif = "PPMP for project (".$project[0]->name.") was ".$status;
		
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

	public function update_ppmp_item_status(){
		// $path = 'public/uploads/signature/';
        // $file_name = $_FILES["userfile"]['name'];
        // $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        // $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        // $_POST['signature'] = $picture;
		$_POST['update_by'] = $_SESSION['id_user'];
		$_POST['updated_at'] = date("Y-m-d h:i:s");

        $status = $this->input->post('status');
        $ppmp_id = '';//$this->input->post('ppmp_id');
        $project_item_id = $this->input->post('project_item_id');
		// unset($_POST['status']);
		unset($_POST['ppmp_id']);
		unset($_POST['project_item_id']);
        $data = $this->input->post();
		// print_r($data);die();
        $this->ppmp_model->update_ppmp_item_status($ppmp_id,$project_item_id,$data,$status);

		// // WRITE NOTIFICATION
		// $ppmp = $this->ppmp_model->get($id)->row();
		// $project = $this->projects_model->get($ppmp->project_id);
		// $status = "approved";
		// if($data->status == 2){
		// 	$status = "rejected";
		// }
		// $notif = "PPMP for project (".$project[0]->name.") was ".$status;
		
		// //GET USERS
		// $sectors = $this->user_model->get('',3)->result(); // DEPARTMENT
		// foreach($sectors as $row){
		// 	//SAVE NOTIF
		// 	$this->notif_model->save_notif($notif,$row->id);
		// }
		// $sectors = $this->user_model->get('',1)->result(); // ADMIN
		// foreach($sectors as $row){
		// 	//SAVE NOTIF
		// 	$this->notif_model->save_notif($notif,$row->id);
		// }
		
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    
	public function downloadPDF($id){
		$appt = $this->ppmp_model->get($id)->row();
		$ppmp_items = $this->ppmp_model->get_ppmp_item('',$id)->result();
		// print_r($ppmp_items);
		$status = '';
		if($appt->status == 0){
			$status = '<span style="color:#fff;background-color:#6861CE">PENDING</span> ';
		}else if($appt->status == 1){
			$status=  '<span style="color:#fff;background-color:#31CE36">APPROVED</span> ';
		}else if($appt->status == 2){
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
		$pdf->AddPage('L');
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
						<span style="font-size:13px;"><b>PPMP DOCUMENT</b></span>
					</td>
				</tr>
			</table>
			<div align="left">
				<br>
				<span style="font-size:13px;"><b> Project:</b> '.$appt->project.' <br></span>
			</div>

			<table style="" border="1" align="center">
				<tr>
					<td> Code</td>
					<td> Description</td>
					<td> Qty</td>
					<td> Unit Price</td>
					<td> Est. Budget</td>
					<td> MOP</td>
					<td> Jan</td>
					<td> Feb</td>
					<td> Mar</td>
					<td> Apr</td>
					<td> May</td>
					<td> Jun</td>
					<td> Jul</td>
					<td> Aug</td>
					<td> Sept</td>
					<td> Oct</td>
					<td> Nov</td>
					<td> Dec</td>
				</tr>';
				foreach($ppmp_items as $row){
					$content .= '<tr>
						<td>'.$row->code.'</td>
						<td>'.$row->description.' </td>
						<td>'.$row->total_qty.'</td>
						<td>'.number_format($row->unit_price,2).'</td>
						<td>'.number_format(($row->total_qty * $row->unit_price),2).'</td>
						<td>'.$row->mop.'</td>
						<td>'; if($row->jan == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->feb == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->mar == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->apr == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->may == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->jun == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->jul == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->aug == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->sep == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->oct == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->nov == 1){ $content .='<i>/</i>'; } $content .= '</td>
						<td>'; if($row->december == 1){ $content .='<i>/</i>'; } $content .= '</td>
					</tr>';
				}
			
			$content .= '</table>

			<br></br><br></br></br></br>
			<table border="1">
				<tr>
					<td>
						<br>
						<span style="font-size:13px;"><b> Total:</b> Php '.number_format($appt->total,2).'</span>
					</td>
				</tr>
				<tr>
					<td>
						<br>
						<span style="font-size:13px;"><b> Total W/ Contingency(+20%):</b> Php '.number_format((($appt->total * 0.20) + $appt->total),2).'</span>
					</td>
				</tr>
				<tr>
					<td>
						<br>
						<b> Status:</b> '. $status.'
					</td>
				</tr>
				<tr>
					<td>
						<br>
						<b> Status Remarks:</b> '. $appt->status_remarks.'
					</td>
				</tr>
				<tr align="left">
					<td >
						<br>
						<b> Update By:</b> '. $appt->update_by.'
						<br>
						<b> Update At:</b> '. date("F j, Y H:i A",strtotime($appt->updated_at)).'
						<br>
						<b> Signature:</b>
						<img src="'.base_url().'public/uploads/signature/'.$appt->signature.'" alt="" style="width:150px;">

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
	

	public function generateDocu($ppmp_category = null,$docu_type = null,$status = null){

		// $array = array();
		// if($_SESSION['id_user_role'] == 11){ // COLLEGE
        //     $college_departments = $this->college_department_model->get($_SESSION['college_id'])->result();
		// 	$array = array();
		// 	foreach($college_departments as $row){
		// 		array_push($array,$row->id);
		// 	}
        // }
		
		// $status = '0';
        // $data['ppmp'] = $this->ppmp_model->get('',$status,'',$array,$ppmp_category)->result();

		// if($_SESSION['id_user_role'] == 11 || $_SESSION['id_user_role'] == 8 || $_SESSION['id_user_role'] == 10 || $_SESSION['id_user_role'] == 9){ // college , sector head, bac sec, budget officer
		// 	$array_ppmp = array();
		// 	foreach($data['ppmp'] as $row){
		// 		array_push($array_ppmp,$row->id);
		// 		// UPDATE GENERATED / PREPARED BY
		// 		if($_SESSION['id_user_role'] == 9){ // BUDGET OFFICER
		// 			$this->ppmp_model->update_docu_generated_by_budget_offiicer($row->id,$docu_type);
		// 		}else{
		// 			$this->ppmp_model->update_docu_generate_by($row->id);
		// 		}
				
		// 	}
		// // 	$ppmp_item = $this->ppmp_model->get_ppmp_item('','',$array_ppmp,$status)->result();
        // }
		$ppmp_item_status = $status;
		$array_ppmp = array();
		$ppmp_item = $this->ppmp_model->get_ppmp_item('','',$array_ppmp,$ppmp_item_status)->result();
		foreach($ppmp_item as $row){
			// UPDATE GENERATED / PREPARED BY
			if($_SESSION['id_user_role'] == 9){ // BUDGET OFFICER
				// die('xx');
				$this->ppmp_model->update_docu_generated_by_budget_offiicer($row->ppmp_ids,$docu_type);
				$ppmp = $this->ppmp_model->get_docu_generate_by($row->ppmp_ids);
			}else{
				// die($row->ppmp_ids);
				$this->ppmp_model->update_docu_generate_by($row->ppmp_ids);
				$ppmp = $this->ppmp_model->get_docu_generate_by($row->ppmp_ids);
			}
			
		}
		// print_r($array);die();

		// GET WHO PREPARE THE DOCU

		// die($this->db->last_query());
		// GET WHO PREPARE THE DOCU
		
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
		$pdf->AddPage('L');
		// $pdf->AddPage();
		// set text shadow effect
		// $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


		if($docu_type == "app"){
			$ppmp_item_status = 1;
			$prepared_by = $this->user_model->get($_SESSION['ppmp_prepared_by'])->row();
			$attested_by = $this->user_model->get($_SESSION['ppmp_attested_by'])->row();
			$president = $this->user_model->get($_SESSION['ppmp_president'])->row();
			
			$content = '
		
				<br>
				<table >
					<tr>
						<td width="15%">
							<img src="'.base_url().'public/assets/img/logoo.png"  style="width:100px;margin:100px">
						</td>
						<td width="70%" align="center">
							<h2><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</b></h2>
							<br>
							Ayala Blvd., Ermita, Manila, 1000, Philippines 
							<br>
							Website: www.tup.edu.ph
						</td>
						<td width="15%"></td>
					</tr>
					<tr>
						<td></td>
						<td align="center">';

							$title = '<span style="font-size:10px;"><b>CONSOLIDATED PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)</b></span> <br>';
							if(isset($ppmp)){
								if($ppmp->generated_docu_type == 'app'){
									$title = '<span style="font-size:10px;"><b>ANNUAL PROCUREMENT MANAGEMENT PLAN (APP)</b></span> <br>';
								}
							}
							$content .= $title;
							$content .= '<span style="font-size:8px;">Calendar Year :2023</span>
						</td>
						<td width="15%"></td>
					</tr>

				</table>
			

				<table style="" border="1" align="center">
					<tr>
						<th width="3%">No.</th>
						<th width="30%">Description</th>
						<th width="15%">End User</th>
						<th width="5%">Qty.</th>
						<th width="18%">Mode of Procurement</th>
						<th width="14%">Price Catalogue</th>
						<th width="14%">Total Amount</th>
					</tr>';
					$count = 0;
					$total_amt = 0;
					foreach($ppmp_item as $row){
						$count += 1;
						$total_amt += ($row->total_qty * $row->unit_price);
						$content .= '<tr>
							<td>'.$count.'</td>
							<td>'.$row->description.' </td>
							<td>'.$row->sector.' </td>
							<td>'.$row->total_qty.'</td>
							<td>'.$row->mop.'</td>

							<td>'.number_format($row->unit_price,2).'</td>
							<td>'.number_format(($row->total_qty * $row->unit_price),2).'</td>
						</tr>';
					}
				
				$content .= '<tr><td align="left" colspan="6">Total:</td><td align="center" colspan="1">'.number_format($total_amt,2).'</td></tr>
				</table>';
				
				if(isset($ppmp) && $_SESSION['id_user_role'] == 11){
					$content .= '<br></br>
					<p>Prepared By:</p>
					<p>'.$ppmp->college.'</p>';
				}

				$content .='
				<br></br><br></br><br></br>
				<table>
					<tr>
						<td><b>Prepared by:</b> <br> '.$prepared_by->name .' <br> Head, BAC Secretariat</td>
						<td><b>Attested by:</b> <br> '.$attested_by->name .' <br> Head, BAC Secretariat</td>
						<td><b>Recommending Approval:</b> <br> '.$president->name .' <br> Head, BAC Secretariat</td>
					</tr>
				</table>
				<br></br><br></br></br></br>

			
			';
		}else{
			$content = '
	
				<br>
				<table >
					<tr>
						<td width="15%">
							<img src="'.base_url().'public/assets/img/logoo.png"  style="width:100px;margin:100px">
						</td>
						<td width="70%" align="center">
							<h2><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</b></h2>
							<br>
							Ayala Blvd., Ermita, Manila, 1000, Philippines 
							<br>
							Website: www.tup.edu.ph
						</td>
						<td width="15%"></td>
					</tr>
					<tr>
						<td></td>
						<td align="center">';

							$title = '<span style="font-size:10px;"><b>CONSOLIDATED PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)</b></span> <br>';
							if(isset($ppmp)){
								if($ppmp->generated_docu_type == 'app'){
									$title = '<span style="font-size:10px;"><b>ANNUAL PROCUREMENT MANAGEMENT PLAN (APP)</b></span> <br>';
								}
							}
							$content .= $title;
							$content .= '<span style="font-size:8px;">Calendar Year :2023</span>
						</td>
						<td width="15%"></td>
					</tr>

				</table>
			

				<table style="" border="1" align="center">
					<tr>
						<th width="3%">No.</th>
						<th width="27%">Description</th>';
						if(isset($ppmp)){
							if($ppmp->generated_docu_type == 'app' && $_SESSION['id_user_role'] == 9){ // budget officier
								$content .= '<th width="15%">End User</th>';
							}
						}
						$content .= '
						<th width="5%">Qty.</th>
						<th width="4%">Jan</th>
						<th width="4%">Feb</th>
						<th width="4%">Mar</th>
						<th width="4%">Apr</th>
						<th width="4%">May</th>
						<th width="4%">Jun</th>
						<th width="4%">Jul</th>
						<th width="4%">Aug</th>
						<th width="4%">Sept</th>
						<th width="4%">Oct</th>
						<th width="4%">Nov</th>
						<th width="4%">Dec</th>
						<th width="9%">Price Catalogue</th>
						<th width="9%">Total Amount</th>
					</tr>';
					$count = 0;
					$total_amt = 0;
					foreach($ppmp_item as $row){
						$count += 1;
						$total_amt += ($row->total_qty * $row->unit_price);
						$content .= '<tr>
							<td>'.$count.'</td>
							<td>'.$row->description.' </td>';
							if(isset($ppmp)){
								if($ppmp->generated_docu_type == 'app' && $_SESSION['id_user_role'] == 9){ // budget officier
									$content .= '<td>'.$row->sector.' </td>';
								}
							}
							$content .= '
							
							<td>'.$row->total_qty.'</td>

							
							<td>'; if($row->jan == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->feb == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->mar == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->apr == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->may == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->jun == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->jul == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->aug == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->sep == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->oct == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->nov == 1){ $content .='*'; } $content .= '</td>
							<td>'; if($row->december == 1){ $content .='*'; } $content .= '</td>
							<td>'.number_format($row->unit_price,2).'</td>
							<td>'.number_format(($row->total_qty * $row->unit_price),2).'</td>
						</tr>';
					}
				
				$content .= '<tr><td align="left" colspan="16">Total:</td><td align="center" colspan="1">'.number_format($total_amt,2).'</td></tr>
				</table>';
				
				if(isset($ppmp) && $_SESSION['id_user_role'] == 11){
					$content .= '<br></br>
					<p>Prepared By:</p>
					<p>'.$ppmp->college.'</p>';
				}

				$content .='

				<br></br><br></br></br></br>
				
			';
		}

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

	public function save_app(){
		// $_SESSION['ppmp_funds_type_id'] = $_POST['funds_type_id'];
		$_SESSION['ppmp_prepared_by'] = $_POST['prepared_by'];
		$_SESSION['ppmp_attested_by'] = $_POST['attested_by'];
		$_SESSION['ppmp_president'] = $_POST['president'];


		$this->generateDocu($_POST['ppmp_category'],'app',1);
    }
	
}
