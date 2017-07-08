<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Patient Controller Class
 *
 * control patient type management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Patient extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('PatientModel');
		$this->load->model('EMRModel');
	}

	public function index() {
		redirect('/');
    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|alpha_dash|min_length[10]|is_unique[patient.patient_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('name', 'Patient Name', 'trim|required|min_length[6]');
				$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('state', 'State', 'trim');
				$this->form_validation->set_rules('country', 'Country', 'trim|required');
				$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|numeric');
				$this->form_validation->set_rules('mother_name', 'Mother Name', 'trim');
				$this->form_validation->set_rules('emergency_contact', 'Emergency Contact', 'trim|numeric');
				$this->form_validation->set_rules('home_phone', 'Home Phone', 'trim|numeric');
				$this->form_validation->set_rules('work_phone', 'Work Phone', 'trim|numeric');
				$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|numeric');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim');
				$this->form_validation->set_rules('religion', 'Religion', 'trim|alpha_dash');
				$this->form_validation->set_rules('language', 'Language', 'trim');
				$this->form_validation->set_rules('race', 'Race', 'trim');
				$this->form_validation->set_rules('ethnicity', 'Ethnicity', 'trim');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('patient/patient_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
					

					if ($this->PatientModel->create_patient()) {
					
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
						$this->load->view('footer/footer');
						
					}

				}

			} else {
				redirect('/');
			}
          
        } else {
            redirect('/');
        }
	}


	public function editdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION"){
				//create the data object
				$stddata = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|alpha_dash|min_length[10]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('name', 'Patient Name', 'trim|required|min_length[6]');
				$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('state', 'State', 'trim');
				$this->form_validation->set_rules('country', 'Country', 'trim|required');
				$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|numeric');
				$this->form_validation->set_rules('mother_name', 'Mother Name', 'trim');
				$this->form_validation->set_rules('emergency_contact', 'Emergency Contact', 'trim|numeric');
				$this->form_validation->set_rules('home_phone', 'Home Phone', 'trim|numeric');
				$this->form_validation->set_rules('work_phone', 'Work Phone', 'trim|numeric');
				$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|numeric');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim');
				$this->form_validation->set_rules('religion', 'Religion', 'trim|alpha_dash');
				$this->form_validation->set_rules('language', 'Language', 'trim');
				$this->form_validation->set_rules('race', 'Race', 'trim');
				$this->form_validation->set_rules('ethnicity', 'Ethnicity', 'trim');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$data['query'] = $this->PatientModel->Read_specific($id)->row();
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('patient/patient_edit_view',$data);
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
					

					if ($this->PatientModel->Update()) {
					
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
						$this->load->view('footer/footer');
						
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
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION" or $_SESSION['status'] === "DOCTOR"){
				$data['query'] = $this->PatientModel->Read_specific($id)->row();
				$data['emr'] = $this->EMRModel->getPatientEMR($id);
				$data['lab'] = $this->PatientModel->getPatientLab($id);
				$data['prescription'] = $this->PatientModel->getPatientPrescription($id);
				$this->load->view('header');
				$this->load->view('sidebar/management_active');
				$this->load->view('navbar');
				$this->load->view('patient/patient_data_view', $data);
				$this->load->view('footer/footer');
			} else {
				
				redirect('/');
				
			}
			
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {

			$data['patient_id'] = $ID;
			$this->PatientModel->Delete($data);
			$this->PatientModel->Redirect();
			
		} else {
            redirect('/');
        }
	}
}