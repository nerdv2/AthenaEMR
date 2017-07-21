<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Doctor Controller Class
 *
 * control doctor management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class Doctor extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index() {
		redirect('/');
    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {

			// set validation rules
			$this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|alpha_dash|min_length[8]|is_unique[doctor.doctor_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('clinic_id', 'ClinicID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric');

			if ($this->form_validation->run() === false) {
				
				$data['id'] = $this->DoctorModel->generate_id();
				$data['clinic'] = $this->DoctorModel->getClinicID();

				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/users_active');
            	$this->load->view('navbar');
            	$this->load->view('doctor/doctor_add_view', $data);
            	$this->load->view('footer/footer');
			
			} else {
				// set variables from the form
				

				if ($this->DoctorModel->create_doctor()) {
				
					// user creation ok
					$this->DoctorModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data['error'] = 'There was a problem creating your new account. Please try again.';
					$data['id'] = $this->DoctorModel->generate_id();
					$data['clinic'] = $this->DoctorModel->getClinicID();
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/users_active');
            		$this->load->view('navbar');
            		$this->load->view('doctor/doctor_add_view', $data);
            		$this->load->view('footer/footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}


	public function editdata($doctor_id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {

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
				$data['query'] = $this->DoctorModel->Read_specific($doctor_id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/users_active');
        		$this->load->view('navbar');
				$this->load->view('doctor/doctor_edit_view',$data);
				$this->load->view('footer/footer');
			
			} else {
				// set variables from the form
				

				if ($this->DoctorModel->Update()) {
				
					// user creation ok
					$this->DoctorModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data['error'] = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/users_active');
            		$this->load->view('navbar');
            		$this->load->view('doctor/doctor_edit_view',$data);
            		$this->load->view('footer/footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($doctor_id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {
			$data['query'] = $this->DoctorModel->Read_specific($doctor_id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/users_active');
			$this->load->view('navbar');
			$this->load->view('doctor/doctor_data_view', $data);
			$this->load->view('footer/footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($doctor_id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {
			$data['doctor_id'] = $doctor_id;
			$this->DoctorModel->Delete($data);
			$this->DoctorModel->Redirect();
		} else {
            redirect('/');
        }
	}
}