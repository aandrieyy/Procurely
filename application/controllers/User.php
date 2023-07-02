<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_user') == ''){
            redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->model('user_model');
        $this->load->model('report_model');
        $this->load->model('colleges_model');
        $this->load->model('sectors_model');
        // $this->load->model('department_model');
	}

	public function index()
	{
        $data['sidebar_active'] = 'dashboard';
        $data['sidebar_submenu_active'] = 'dashboard';
        $data['report'] = $this->report_model->statistics()->row();
        
        if($_SESSION['id_user_role'] == 3){ // DEPARTMENT 
            $data['budget_stats']  = $this->report_model->budget_stats_department()->row();
        }else{
            $data['budget_stats']  = $this->report_model->budget_stats()->row();
        }

        $data['purchase_bar_graph'] = $this->report_model->purchase_bar_graph()->result();

		$this->load->view('dashboard/index',$data);
    }
    
    public function exportformat()
    {
        $this->load->helper('download');
        $filepath = "./public/uploads/user-bulk-upload.csv";
        $data     = file_get_contents($filepath);
        $name     = 'user-bulk-upload.csv';

        force_download($name, $data);
    }

    public function user_types(){
        $data['sidebar_active'] = 'sb_user_types';
        $data['sidebar_submenu_active'] = 'sb_user_types';
        $data['title'] = "User Types";
        $data['datas'] = $this->user_model->get_user_types()->result();
        $this->load->view('dashboard/user_types',$data);
    }

    public function user_mngt($user_type){
        $data['sidebar_active'] = 'sb_sys_user';
        $data['sidebar_submenu_active'] = $user_type;
        $data['id_user_role'] = $this->customlib->get_id_user_role($user_type);
        $data['title'] = $user_type;
        $data['datas'] = $this->user_model->get('',$data['id_user_role'])->result();
        $data['colleges'] = $this->colleges_model->get()->result();
        $data['sectors'] = $this->sectors_model->get()->result();
        // $data['departments'] = $this->department_model->get()->result();
        $this->load->view('dashboard/users-management',$data);
    }


    public function profile()
	{
        $data['sidebar_active'] = 'account_settings';
        $data['sidebar_submenu_active'] = 'account_settings';
        $data['level'] = $this->categories_model->get('level');
        $data['sections'] = $this->categories_model->get('sections');
        $data['tracks'] = $this->categories_model->get('tracks');
        $data['strands'] = $this->categories_model->get('strands');
        // $data = $this->employee_model->view_account('');
		$this->load->view('dashboard/profile',$data);
    }

    public function update_display_profile(){

        $path = 'public/uploads/dp/';
        $file_name = $_FILES["userfile"]['name'];
        $allowed_types = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $picture = $this->customlib->upload($path,$file_name,$allowed_types);
        if($picture == false){
            $msg = "The filetype you are attempting to upload is not allowed.";
            $this->session->set_userdata('acctg_msg_type','error');
        }else{
            $this->user_model->update_display_profile($picture);
            $msg = "Display picture was succesfully updated";
            $this->session->set_userdata('status_type','success');
        }
       
        $this->session->set_userdata('status_msg',$msg);
        redirect('user/profile');
    }

    public function update_user_account(){
        $result = $this->user_model->update_user_account($update);
        $_SESSION['accounts_id'] = $this->input->post('accounts_id');
        $_SESSION['first_name'] = $this->input->post('first_name');
        $_SESSION['middle_name'] = $this->input->post('middle_name');
        $_SESSION['last_name'] = $this->input->post('last_name');
        $_SESSION['email'] = $this->input->post('email');
        $_SESSION['contact'] = $this->input->post('contact');
        $_SESSION['username'] = $this->input->post('username');
        $_SESSION['address'] = $this->input->post('address');

        $msg = "Your account was succesfully updated";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_account_password(){
        $new_password = $this->input->post('new_password');
        $result = $this->user_model->update_account_password($new_password);
        $msg = "Account password was succesfully updated";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function edit_profile($id)
	{
        if($this->input->post()){
            $this->form_validation->set_rules('name','Name is required','required');
            $this->form_validation->set_rules('contact','Contact is required','required');
            $this->form_validation->set_rules('email','Email is required','required');
            $this->form_validation->set_rules('username','Usrname is required','required');
            $this->form_validation->set_rules('password','Password is required','required');
            $this->form_validation->set_rules('picture','Picture is required','required');
            $this->form_validation->set_rules('status','Status is required','required');

            $this->upload->do_upload('userfile');
            $data = array('upload_data' => $this->upload->data());
            $_POST['picture'] = $data['upload_data']['file_name'];
    
            //  print_r($this->input->post());die();

            $this->user_model->edit_user($this->input->post(),$id);

            redirect('user/profile');
        }
	}

    public function save(){
        $this->user_model->save();
        $status_msg = "New record was created succesfully!";
        $this->session->set_userdata('status_msg',$status_msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function bulk_save(){
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			if ($ext == 'csv') {
				$file = $_FILES['file']['tmp_name'];
				$this->load->library('CSVReader');
				$raw_datas = $this->csvreader->parse_file($file);

				foreach($raw_datas as $data){
                    // CHECK RFID || STUDENT ID
                    $result = $this->user_model->get('',$data['rfid'],$data['student_id']);
                    // print_r($result);die();
                    if ($result->num_rows()) {

                    }else{
                        $this->user_model->bulk_save($data);
                    }
				}

                $msg = "Book/s was successfully encoded in bulk ";
                $this->session->set_userdata('acctg_msg',$msg);
                $this->session->set_userdata('acctg_msg_type','success');
                redirect($_SERVER['HTTP_REFERER']);

				
			} else {
                die('Error, please select csv a file');
                $msg = "Error, please select csv a file";
                $this->session->set_userdata('acctg_msg',$msg);
                $this->session->set_userdata('acctg_msg_type','success');
			}
		}else{
            die('CSV is Empty');
		}
    }

    public function update(){
        $this->user_model->update();
        $msg = "Record was updated succesfully!";
        $this->session->set_userdata('status_msg',$msg);
        $this->session->set_userdata('status_type','success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function user_management($user_role)
    { 
        $data['title'] = 'Customers';
        $data['id_user_role'] = 3;
        $data['datas'] = $this->user_model->getUsers($this->customlib->identifyUserRole($user_role));
        $this->load->view('dashboard/admin/users-management',$data);
    }

    public function validateEmail(){
        $email = $this->input->post('email');
        $operation = $this->input->post('operation');
        $id = $this->input->post('id');
        echo $this->customlib->validateEmail($email,$operation,$id);
    }

    public function validatePhone(){
        $contact = $this->input->post('contact');
        $operation = $this->input->post('operation');
        $id = $this->input->post('id');
        echo $this->customlib->validatePhone($contact,$operation,$id);
    }

    public function validatePassword(){
        $password = $this->input->post('password');
        // die($password.'x');
        echo $this->customlib->validatePassword($password);
    }

    public function edit(){
        $data = $this->user_model->edit();
        echo json_encode($data);
    }
 
    public function delete(){
        $this->user_model->delete();
    }

    public function excel(){
        header("Content-Type: application/xls");    
        header("Content-Disposition: attachment; filename=filename.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
        
        
        echo '<table border="1">';
        //make the column headers what you want in whatever order you want
        echo '
        <tr>
            <th>Book</th>
            <th>Publisher</th>
            <th>Author</th>
            <th>Year Publication</th>
            <th>Dewey Category</th>
            <th>Category</th>
            <th>Page</th>
            <th>Price</th>
        </tr>';
        //loop the query data to the table in same order as the headers
        // $data = $this->transactions_model->get();
        $data = $this->library_model->get_books_list();
        foreach($data as $row){
            echo "
            <tr>
                <td>$row->book_title</td>
                <td>$row->publisher</td>
                <td>$row->author</td>
                <td>$row->date_published</td>
                <td>$row->dewey</td>
                <td>$row->category</td>
                <td>$row->pages</td>
                <td>$row->price</td>
            </tr>";
        }
        echo '</table>';
    }

}
