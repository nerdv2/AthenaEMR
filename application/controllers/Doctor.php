<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Doctor controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control doctor management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Doctor extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('DoctorModel');
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
			$this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|alpha_dash|min_length[8]|is_unique[doctor.doctor_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('clinic_id', 'ClinicID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/users_active');
            	$this->load->view('navbar');
            	$this->load->view('doctor/doctor_add_view');
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$doctor_id = $this->input->post('doctor_id');
				$clinic_id    = $this->input->post('clinic_id');
				$name = $this->input->post('name');
				$gender = $this->input->post('gender');
				$dob = $this->input->post('dob');
				$address = $this->input->post('address');
				$phone = $this->input->post('phone');

				if ($this->DoctorModel->create_doctor($doctor_id, $clinic_id, 
				$name, $gender, $dob, $address, $phone)) {
				
					// user creation ok
					$this->DoctorModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/users_active');
            		$this->load->view('navbar');
            		$this->load->view('doctor/doctor_add_view',$data);
            		$this->load->view('footer');
					
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
			$this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('clinic_id', 'ClinicID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->DoctorModel->Read_specific($id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/users_active');
        		$this->load->view('navbar');
				$this->load->view('doctor/doctor_edit_view',$data);
				$this->load->view('footer');
			
			} else {
				// set variables from the form
				$doctor_id = $this->input->post('doctor_id');
				$clinic_id    = $this->input->post('clinic_id');
				$name = $this->input->post('name');
				$gender = $this->input->post('gender');
				$dob = $this->input->post('dob');
				$address = $this->input->post('address');
				$phone = $this->input->post('phone');

				if ($this->DoctorModel->Update($doctor_id, $clinic_id, 
				$name, $gender, $dob, $address, $phone)) {
				
					// user creation ok
					$this->DoctorModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/users_active');
            		$this->load->view('navbar');
            		$this->load->view('doctor/doctor_edit_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['query'] = $this->DoctorModel->Read_specific($id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/users_active');
			$this->load->view('navbar');
			$this->load->view('doctor/doctor_data_view', $data);
			$this->load->view('footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['doctor_id'] = $ID;
			$this->DoctorModel->Delete($data);
			$this->DoctorModel->Redirect();
		} else {
            redirect('/');
        }
	}
}