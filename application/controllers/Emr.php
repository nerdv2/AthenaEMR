<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emr extends CI_Controller {


	public function __construct(){
		parent::__construct();
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
			$this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|alpha_dash|min_length[15]|is_unique[medical_record.record_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('complaint', 'Diagnosis', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('symptoms', 'Lab Recommendation', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('diagnosis', 'Handling', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('handling', 'Handling', 'trim');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/management_active');
            	$this->load->view('navbar');
            	$this->load->view('emr/emr_add_view');
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$record_id = $this->input->post('record_id');
				$register_id = $this->input->post('register_id');
				$complaint = $this->input->post('complaint');
				$symptoms = $this->input->post('symptoms');
				$diagnosis = $this->input->post('diagnosis');
				$handling = $this->input->post('handling');

				$doctor_id =   $this->EMRModel->getRegistrationDoctor($register_id);
				$patient_id =   $this->EMRModel->getRegistrationPatient($register_id);


				if ($this->EMRModel->create_emr($record_id, $doctor_id, $register_id, $patient_id, $complaint, $symptoms, $diagnosis, $handling)) {
				
					// user creation ok
					$this->EMRModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('emr/emr_add_view',$data);
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
			$this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|alpha_dash|min_length[15]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('lab_id', 'LabResultID', 'trim');
			$this->form_validation->set_rules('result_id', 'Complaints', 'trim');
			$this->form_validation->set_rules('prescription_id', 'Symptoms', 'trim');
			$this->form_validation->set_rules('complaint', 'Diagnosis', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('symptoms', 'Lab Recommendation', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('diagnosis', 'Handling', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('handling', 'Handling', 'trim');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->EMRModel->Read_specific($id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/management_active');
        		$this->load->view('navbar');
				$this->load->view('emr/emr_edit_view',$data);
				$this->load->view('footer');
			
			} else {
				// set variables from the form
				$record_id = $this->input->post('record_id');
				$doctor_id    = $this->input->post('doctor_id');
				$register_id = $this->input->post('register_id');
				$patient_id = $this->input->post('patient_id');
				$lab_id = $this->input->post('lab_id');
				$result_id = $this->input->post('result_id');
				$prescription_id = $this->input->post('prescription_id');
				$complaint = $this->input->post('complaint');
				$symptoms = $this->input->post('symptoms');
				$diagnosis = $this->input->post('diagnosis');
				$handling = $this->input->post('handling');

				if ($this->EMRModel->Update($record_id, $doctor_id, 
				$register_id,$patient_id, $lab_id, $result_id, $prescription_id, $complaint, $symptoms,$diagnosis,$handling)) {
				
					// user creation ok
					$this->EMRModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('emr/emr_edit_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['query'] = $this->EMRModel->Read_specific($id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/management_active');
			$this->load->view('navbar');
			$this->load->view('emr/emr_data_view', $data);
			$this->load->view('footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['record_id'] = $ID;
			$this->EMRModel->Delete($data);
			$this->EMRModel->Redirect();
		} else {
            redirect('/');
        }
	}
}