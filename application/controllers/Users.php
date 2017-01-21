<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Users controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control users management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Users extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('UsersModel');
	}
	/*
	public function index()
	{
		$data['query'] = $this->CRUD->getData();
		$this->load->view('homepage',$data);
	}
	*/

	public function index() {

    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
			//create the data object
			$data = new stdClass();

			// set validation rules
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[user.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
			$this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|alpha_dash');
			$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|alpha_dash');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/users_active');
            	$this->load->view('navbar');
            	$this->load->view('users/users_add_view');
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$username = $this->input->post('username');
				$password    = $this->input->post('password');
				$status = $this->input->post('status');
				$doctor_id = $this->input->post('doctor_id');
				$worker_id = $this->input->post('worker_id');

				if($doctor_id == "" && $worker_id == ""){
					if ($this->UsersModel->create_user($username, $password, $status, $doctor_id, $worker_id)) {
				
						// user creation ok
						$this->UsersModel->Redirect();
								
						} else {
							
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
								
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/users_active');
						$this->load->view('navbar');
						$this->load->view('users/users_add_view',$data);
						$this->load->view('footer');
								
					}
				} else if($doctor_id == "" && $worker_id !== ""){
					if ($this->UsersModel->create_user_worker($username, $password, $status, $worker_id)) {
				
						// user creation ok
						$this->UsersModel->Redirect();
								
						} else {
							
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
								
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/users_active');
						$this->load->view('navbar');
						$this->load->view('users/users_add_view',$data);
						$this->load->view('footer');
								
					}
				} else if($doctor_id !== "" && $worker_id == ""){
					if ($this->UsersModel->create_user_doctor($username, $password, $status, $doctor_id)) {
				
						// user creation ok
						$this->UsersModel->Redirect();
								
						} else {
							
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
								
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/users_active');
						$this->load->view('navbar');
						$this->load->view('users/users_add_view',$data);
						$this->load->view('footer');
								
					}
				}

				

				

			}

        } else {
            redirect('/');
        }
	}


	public function editdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
			//create the data object
			$stddata = new stdClass();

			// set validation rules
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]', array('is_unique' => 'This username already exists. Please choose another one.'));
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
			$this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|alpha_dash');
			$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|alpha_dash');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->UsersModel->Read_specific($id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/users_active');
        		$this->load->view('navbar');
				$this->load->view('users/users_edit_view',$data);
				$this->load->view('footer');
			
			} else {
				// set variables from the form
				$id_user = $this->input->post('id_user');
				$username = $this->input->post('username');
				$password    = $this->input->post('password');
				$status = $this->input->post('status');
				$doctor_id = $this->input->post('doctor_id');
				$worker_id = $this->input->post('worker_id');

				if($doctor_id == "" && $worker_id == ""){
					if ($this->UsersModel->update_user($username, $password, $status, $doctor_id, $worker_id)) {
				
						// user creation ok
						$this->UsersModel->Redirect();
								
						} else {
							
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
								
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/users_active');
						$this->load->view('navbar');
						$this->load->view('users/users_add_view',$data);
						$this->load->view('footer');
								
					}
				} else if($doctor_id == "" && $worker_id !== ""){
					if ($this->UsersModel->update_user_worker($username, $password, $status, $worker_id)) {
				
						// user creation ok
						$this->UsersModel->Redirect();
								
						} else {
							
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
								
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/users_active');
						$this->load->view('navbar');
						$this->load->view('users/users_add_view',$data);
						$this->load->view('footer');
								
					}
				} else if($doctor_id !== "" && $worker_id == ""){
					if ($this->UsersModel->update_user_doctor($username, $password, $status, $doctor_id)) {
				
						// user creation ok
						$this->UsersModel->Redirect();
								
						} else {
							
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
								
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/users_active');
						$this->load->view('navbar');
						$this->load->view('users/users_add_view',$data);
						$this->load->view('footer');
								
					}
				}

			}

        } else {
            redirect('/');
        }
	}



	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['id_user'] = $ID;
			$this->UsersModel->Delete($data);
			$this->UsersModel->Redirect();
		} else {
            redirect('/');
        }
	}
}