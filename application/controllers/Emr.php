<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * EMR controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control EMR management(view, add, edit, delete)
     * ----------------------------------------------
	 */
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
		redirect('/');
    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "DOCTOR"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|alpha_dash|min_length[15]|is_unique[medical_record.record_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('additional_notes', 'Additional Notes', 'trim');
				$this->form_validation->set_rules('weight', 'Weight', 'trim|numeric');
				$this->form_validation->set_rules('height', 'Height', 'trim|numeric');
				$this->form_validation->set_rules('blood_pressure_systolic', 'Blood Pressure Systolic', 'trim|numeric');
				$this->form_validation->set_rules('blood_pressure_diastolic', 'Blood Pressure Diastolic', 'trim|numeric');
				$this->form_validation->set_rules('pulse', 'Pulse', 'trim|numeric');
				$this->form_validation->set_rules('respiration', 'Respiration', 'trim|numeric');
				$this->form_validation->set_rules('temperature', 'Temperature', 'trim|numeric');
				$this->form_validation->set_rules('temperature_location', 'Temperature Location', 'trim|numeric');
				$this->form_validation->set_rules('oxygen_saturation', 'Oxygen Saturation', 'trim|numeric');
				$this->form_validation->set_rules('head_circumference', 'Head Circumference', 'trim|numeric');
				$this->form_validation->set_rules('waist_circumference', 'Waist Circumference', 'trim|numeric');
				$this->form_validation->set_rules('bmi', 'BMI', 'trim|numeric');
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
					$this->load->view('footer/emr_footer');
				
				} else {
					// set variables from the form
					$record_id = $this->input->post('record_id');
					$register_id = $this->input->post('register_id');
					$additional_notes = $this->input->post('additional_notes');
					$weight = $this->input->post('weight');
					$height = $this->input->post('height');
					$blood_pressure_systolic = $this->input->post('blood_pressure_systolic');
					$blood_pressure_diastolic = $this->input->post('blood_pressure_diastolic');
					$pulse = $this->input->post('pulse');
					$respiration = $this->input->post('respiration');
					$temperature = $this->input->post('temperature');
					$temperature_location = $this->input->post('temperature_location');
					$oxygen_saturation = $this->input->post('oxygen_saturation');
					$head_circumference = $this->input->post('head_circumference');
					$waist_circumference = $this->input->post('waist_circumference');
					$bmi = $this->input->post('bmi');
					$complaint = $this->input->post('complaint');
					$symptoms = $this->input->post('symptoms');
					$diagnosis = $this->input->post('diagnosis');
					$handling = $this->input->post('handling');

					$doctor_id =   $this->EMRModel->getRegistrationDoctor($register_id);
					$patient_id =   $this->EMRModel->getRegistrationPatient($register_id);


					if ($this->EMRModel->create_emr($record_id, $doctor_id, $register_id, $patient_id, 
					$additional_notes, $complaint, $symptoms, $diagnosis, $handling, 
					$weight, $height, $blood_pressure_systolic, $blood_pressure_diastolic, $pulse, 
					$respiration, $temperature, $temperature_location, $oxygen_saturation, $head_circumference, 
					$waist_circumference, $bmi)) {
					
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
						$this->load->view('footer/emr_footer');
						
					}

				}
			} else {
				redirect('/');
			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "DOCTOR"){
				$data['query'] = $this->EMRModel->Read_specific($id)->row();
				$this->load->view('header');
				$this->load->view('sidebar/management_active');
				$this->load->view('navbar');
				$this->load->view('emr/emr_data_view', $data);
				$this->load->view('footer/footer');
			} else {
				redirect('/');
			}
			
		} else {
            redirect('/');
        }
	}

}