<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Patient controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control patient management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Patient extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('PatientModel');
		$this->load->model('EMRModel');
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
			$this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|alpha_dash|min_length[10]|is_unique[patient.patient_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('name', 'Patient Name', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/management_active');
            	$this->load->view('navbar');
            	$this->load->view('patient/patient_add_view');
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$patient_id = $this->input->post('patient_id');
				$name    = $this->input->post('name');
				$dob = $this->input->post('dob');
				$gender = $this->input->post('gender');
				$address = $this->input->post('address');
				$phone = $this->input->post('phone');

				if ($this->PatientModel->create_patient($patient_id, $name, 
				$dob, $gender, $address, $phone)) {
				
					// user creation ok
					$this->PatientModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('patient/patient_add_view',$data);
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
			$this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|alpha_dash|min_length[10]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('name', 'Patient Name', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phones', 'Phone', 'trim');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->PatientModel->Read_specific($id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/management_active');
        		$this->load->view('navbar');
				$this->load->view('patient/patient_edit_view',$data);
				$this->load->view('footer');
			
			} else {
				// set variables from the form
				$patient_id = $this->input->post('patient_id');
				$name    = $this->input->post('name');
				$dob = $this->input->post('dob');
				$gender = $this->input->post('gender');
				$address = $this->input->post('address');
				$phone = $this->input->post('phone');

				if ($this->PatientModel->Update($patient_id, $name, 
				$dob, $gender, $address, $phone)) {
				
					// user creation ok
					$this->PatientModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('patient/patient_edit_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['query'] = $this->PatientModel->Read_specific($id)->row();
			$data['emr'] = $this->EMRModel->getPatientEMR($id);
			$this->load->view('header');
			$this->load->view('sidebar/management_active');
			$this->load->view('navbar');
			$this->load->view('patient/patient_data_view', $data);
			$this->load->view('footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['patient_id'] = $ID;
			$this->PatientModel->Delete($data);
			$this->PatientModel->Redirect();
		} else {
            redirect('/');
        }
	}
}