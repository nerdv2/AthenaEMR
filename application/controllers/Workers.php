<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Workers controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control workers management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Workers extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('WorkersModel');
	}
	/*
	public function index()
	{
		$data['query'] = $this->CRUD->getData();
		$this->load->view('homepage',$data);
	}
	*/

	public function index() {
		redirect('/');
    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {

			// set validation rules
			$this->form_validation->set_rules('worker_id', 'WorkersID', 'trim|required|alpha_dash|min_length[8]|is_unique[worker.worker_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('name', 'Workers Name', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');

			if ($this->form_validation->run() === false) {
				$data['id'] = $this->WorkersModel->generate_id(); 
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/users_active');
            	$this->load->view('navbar');
            	$this->load->view('workers/workers_add_view', $data);
            	$this->load->view('footer/footer');
			
			} else {
				// set variables from the form
				$worker_id = $this->input->post('worker_id');
				$name    = $this->input->post('name');
				$gender = $this->input->post('gender');
				$role = $this->input->post('role');
				$dob = $this->input->post('dob');
				$address = $this->input->post('address');

				if ($this->WorkersModel->create_workers($worker_id, $name, 
				$gender, $role, $dob, $address)) {
				
					// user creation ok
					$this->WorkersModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data['error'] = 'There was a problem creating your new account. Please try again.';
					$data['id'] = $this->WorkersModel->generate_id(); 
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/users_active');
            		$this->load->view('navbar');
            		$this->load->view('workers/workers_add_view', $data);
            		$this->load->view('footer/footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}


	public function editdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {
            
			//create the data object
			$stddata = new stdClass();

			// set validation rules
			$this->form_validation->set_rules('worker_id', 'WorkersID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('name', 'Workers Name', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->WorkersModel->Read_specific($id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/users_active');
        		$this->load->view('navbar');
				$this->load->view('workers/workers_edit_view',$data);
				$this->load->view('footer/footer');
			
			} else {
				// set variables from the form
				$worker_id = $this->input->post('worker_id');
				$name    = $this->input->post('name');
				$gender = $this->input->post('gender');
				$role = $this->input->post('role');
				$dob = $this->input->post('dob');
				$address = $this->input->post('address');

				if ($this->WorkersModel->Update($worker_id, $name, 
				$gender, $role, $dob, $address)) {
				
					// user creation ok
					$this->WorkersModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/users_active');
            		$this->load->view('navbar');
            		$this->load->view('workers/workers_edit_view',$data);
            		$this->load->view('footer/footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {
			$data['query'] = $this->WorkersModel->Read_specific($id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/users_active');
			$this->load->view('navbar');
			$this->load->view('workers/workers_data_view', $data);
			$this->load->view('footer/footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {
			$data['worker_id'] = $ID;
			$this->WorkersModel->Delete($data);
			$this->WorkersModel->Redirect();
		} else {
            redirect('/');
        }
	}
}