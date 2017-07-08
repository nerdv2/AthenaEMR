<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Registration Controller Class
 *
 * control registration management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Registration extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('RegistrationModel');
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
				$this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|alpha_dash|min_length[11]|is_unique[registration.register_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('clinic_id', 'Type', 'trim|required');
				$this->form_validation->set_rules('doctor_id', 'ClinicID', 'trim|alpha_dash');
				$this->form_validation->set_rules('category', 'ClinicID', 'trim');
				$this->form_validation->set_rules('patient_type', 'Patient Type', 'required');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('registration/registration_add_view');
					$this->load->view('footer/registration_footer');
				
				} else {
					// set variables from the form
					$register_id = $this->input->post('register_id');
					if($_SESSION['status'] == "ADMIN"){
						$worker_id = null;
					} else {
						$worker_id    = $this->input->post('worker_id');
					}
					$patient_id = $this->input->post('patient_id');
					$clinic_id = $this->input->post('clinic_id');
					$doctor_id = $this->input->post('doctor_id');
					$category = $this->input->post('category');
					$patient_type = $this->input->post('patient_type');

					if ($this->RegistrationModel->create_registration($register_id, $worker_id, 
					$patient_id, $clinic_id, $doctor_id, $category, $patient_type)) {

						$this->RegistrationModel->Redirect();

					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('registration/registration_add_view',$data);
						$this->load->view('footer/registration_footer');
						
					}

				}
			} else {
				redirect('/');
			}

        } else {
            redirect('/');
        }
	}

	function getDoctor(){
        $id = $this->input->post('id');
        echo(json_encode($this->RegistrationModel->getDoctorID($id)));
    }


	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION"){
				$data['query'] = $this->RegistrationModel->Read_specific($id)->row();
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
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN"){
				$data['register_id'] = $ID;
				$this->RegistrationModel->Delete($data);
				$this->RegistrationModel->Redirect();
			} else {
				redirect('/');
			}
			
		} else {
            redirect('/');
        }
	}
}