<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
	 * AthenaEMR - Gema Aji Wardian
     * AthenaMain controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control auth(login, logout), user type session check and view management.
     * ----------------------------------------------
	 */

class AthenaMain extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('DashModel');
        $this->load->model('AuthModel');
        $this->load->model('UsersModel');
        $this->load->model('WorkersModel');
        $this->load->model('LabModel');
        $this->load->model('DoctorModel');
        $this->load->model('PatientModel');
        $this->load->model('ClinicModel');
        $this->load->model('PaymentModel');
        $this->load->model('RegistrationModel');
        $this->load->model('EMRModel');
        $this->load->model('MedicineModel');
        $this->load->model('MedicineTypeModel');
        $this->load->model('LabResultModel');
        $this->load->model('PrescriptionModel');
        $this->load->model('SettingsModel');
    }


    public function index(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            //get data from model for statistic
            $data['query'] = $this->DashModel->getRegisterEntry();
            $data['registertoday'] = $this->DashModel->getNewRegister();
            $data['patienttotal'] = $this->DashModel->getPatientTotal();
            $data['registrationtotal'] = $this->DashModel->getRegistrationTotal();
            
            $this->load->view('header');
            $this->load->view('sidebar/dashboard_active');
            $this->load->view('navbar');
            $this->load->view('floatnav/dashboard_floatbar');
            $this->load->view('admin_dashboard/dashboard_view', $data);
            $this->load->view('footer/footer');
        } else {
            $this->login();
        }
    }

    public function users_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN"){
                $data['query'] = $this->UsersModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/users_floatbar');
                $this->load->view('users/users_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("users");
            }
        } else {
            $this->login();
        }
    }

    public function workers_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN"){
                $data['query'] = $this->WorkersModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/workers_floatbar');
                $this->load->view('workers/workers_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("worker");
            }
        } else {
            $this->login();
        }
    }

    public function lab_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN"){
                $data['query'] = $this->LabModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/lab_floatbar');
                $this->load->view('lab/lab_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("lab");
            }
        } else {
            $this->login();
        }
    }

    public function doctor_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN"){
                $data['query'] = $this->DoctorModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/doctor_floatbar');
                $this->load->view('doctor/doctor_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("doctor");
            }
        } else {
            $this->login();
        }
    }

    public function patient_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION"){
                $data['query'] = $this->PatientModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/patient_floatbar');
                $this->load->view('patient/patient_view', $data);
                $this->load->view('footer/table_footer');
            } elseif($_SESSION['status'] === "DOCTOR") {
                $data['query'] = $this->PatientModel->getDoctorPatientData($_SESSION['doctor_id']);
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/patient_floatbar');
                $this->load->view('patient/patient_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("patient");
            }
            
        } else {
            $this->login();
        }
    }

    public function clinic_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN"){
                $data['query'] = $this->ClinicModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/clinic_floatbar');
                $this->load->view('clinic/clinic_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("clinic");
            }
        } else {
            $this->login();
        }
    }

    public function payment_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT"){
                $data['query'] = $this->PaymentModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/payment_floatbar');
                $this->load->view('payment/payment_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("payment");
            }
        } else {
            $this->login();
        }
    }

    public function registration_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION"){
                $data['query'] = $this->RegistrationModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/registration_floatbar');
                $this->load->view('registration/registration_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("registration");
            }
        } else {
            $this->login();
        }
    }

    public function emr_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "DOCTOR"){
                $data['query'] = $this->EMRModel->getDataSpecific($_SESSION['doctor_id']);
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/emr_floatbar');
                $this->load->view('emr/emr_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("medical record");
            }
        } else {
            $this->login();
        }
    }

    public function medicine_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
                $data['query'] = $this->MedicineModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/medicine_floatbar');
                $this->load->view('medicine/medicine_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("medicine");
            }
        } else {
            $this->login();
        }
    }

    public function medicine_type_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
                $data['query'] = $this->MedicineTypeModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/medicine_type_floatbar');
                $this->load->view('medicine_type/medicine_type_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("medicine type");
            }
        } else {
            $this->login();
        }
    }

    public function labresult_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "LAB"){
                $data['query'] = $this->LabResultModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/labresult_floatbar');
                $this->load->view('labresult/labresult_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("lab result");
            }
        } else {
            $this->login();
        }
    }

    public function prescription_view(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST" or $_SESSION['status'] === "DOCTOR"){
                $data['query'] = $this->PrescriptionModel->getData();
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('floatnav/prescription_floatbar');
                $this->load->view('prescription/prescription_view', $data);
                $this->load->view('footer/table_footer');
            } else {
                $this->access_denied("prescription");
            }
        } else {
            $this->login();
        }
    }

    public function settings(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN") {

                // set validation rules
                $this->form_validation->set_rules('hospital_name', 'Hospital Name', 'trim|required');
                $this->form_validation->set_rules('hospital_address', 'Hospital Address', 'trim|required');
                $this->form_validation->set_rules('hospital_phone', 'Hospital Phone', 'trim|required');
                $this->form_validation->set_rules('hospital_email', 'Hospital Email', 'trim|required');
                $this->form_validation->set_rules('worker_id_prefix', 'Worker ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('doctor_id_prefix', 'Doctor ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('register_id_prefix', 'Register ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('clinic_id_prefix', 'Clinic ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('payment_id_prefix', 'Payment ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('patient_id_prefix', 'Patient ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('record_id_prefix', 'Record ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('lab_id_prefix', 'Lab ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('result_id_prefix', 'Result ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('prescription_id_prefix', 'Prescription ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('medicine_id_prefix', 'Medicine ID Prefix', 'trim|required|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('medicine_type_prefix', 'Medicine Type Prefix', 'trim|required|min_length[3]|max_length[3]');
                
               if ($this->form_validation->run() === false) {
                    $data['query'] = $this->SettingsModel->getData()->row();
                    $this->load->view('header');
                    $this->load->view('sidebar/dashboard_active');
                    $this->load->view('navbar');
                    $this->load->view('settings/settings_view', $data);
                    $this->load->view('footer/footer');
               } else {
                   $inputdata['hospital_name'] = $this->input->post('hospital_name');
                   $inputdata['hospital_address'] = $this->input->post('hospital_address');
                   $inputdata['hospital_phone'] = $this->input->post('hospital_phone');
                   $inputdata['hospital_email'] = $this->input->post('hospital_email');
                   $inputdata['worker_id_prefix'] = $this->input->post('worker_id_prefix');
                   $inputdata['doctor_id_prefix'] = $this->input->post('doctor_id_prefix');
                   $inputdata['register_id_prefix'] = $this->input->post('register_id_prefix');
                   $inputdata['clinic_id_prefix'] = $this->input->post('clinic_id_prefix');
                   $inputdata['payment_id_prefix'] = $this->input->post('payment_id_prefix');
                   $inputdata['patient_id_prefix'] = $this->input->post('patient_id_prefix');
                   $inputdata['record_id_prefix'] = $this->input->post('record_id_prefix');
                   $inputdata['lab_id_prefix'] = $this->input->post('lab_id_prefix');
                   $inputdata['result_id_prefix'] = $this->input->post('result_id_prefix');
                   $inputdata['prescription_id_prefix'] = $this->input->post('prescription_id_prefix');
                   $inputdata['medicine_id_prefix'] = $this->input->post('medicine_id_prefix');
                   $inputdata['medicine_type_prefix'] = $this->input->post('medicine_type_prefix');

                   if ($this->SettingsModel->saveData($inputdata)) {

                       // input data success, redirect
                       $this->SettingsModel->Redirect();

                   } else {
                       $data['error'] = 'There was a problem updating data. Please try again.';

                       $data['query'] = $this->SettingsModel->getData()->row();
                       $this->load->view('header');
                       $this->load->view('sidebar/dashboard_active');
                       $this->load->view('navbar');
                       $this->load->view('settings/settings_view', $data);
                       $this->load->view('footer/footer');
                   }
               }

            } else {
                $this->access_denied("settings");
            }
        } else {
            $this->login();
        }
    }

    public function access_denied($message){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            $data['query']              = $this->DashModel->getRegisterEntry();
            $data['registertoday']      = $this->DashModel->getNewRegister();
            $data['patienttotal']       = $this->DashModel->getPatientTotal();
            $data['registrationtotal']  = $this->DashModel->getRegistrationTotal();

            $data['error'] = "Access Denied on accessing " . $message;
            
            $this->load->view('header');
            $this->load->view('sidebar/dashboard_active');
            $this->load->view('navbar');
            $this->load->view('floatnav/dashboard_floatbar');
            $this->load->view('admin_dashboard/dashboard_view', $data);
            $this->load->view('footer/footer');
        } else {
            $this->login();
        }
    }

    public function login(){
        //create the data object
        $data = new stdClass();

        //set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if($this->form_validation->run() === false){
            //validation not ok, send validation error to view
            $this->load->view('header');
            $this->load->view('login/login_view');
        } else {
            //set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($this->AuthModel->resolve_user_login($username, $password)){
                $user_id = $this->AuthModel->get_user_id_from_username($username);
                $user = $this->AuthModel->get_user($user_id);

                //set session user data
                $_SESSION['user_id']    = (int)$user->id_user;
                $_SESSION['username']   = (string)$user->username;
                $_SESSION['doctor_id']  = (string)$user->doctor_id;
                $_SESSION['worker_id']  = (string)$user->worker_id;
                $_SESSION['logged_in']  = (bool)true;
                
                $auth_status = $user->status;

                if($auth_status === "admin"){
                    $_SESSION['status'] = "ADMIN";
                } else if($auth_status === "doctor") {
                    $_SESSION['status'] = "DOCTOR";
                } else if($auth_status === "payment") {
                    $_SESSION['status'] = "PAYMENT";
                } else if($auth_status === "registration") {
                    $_SESSION['status'] = "REGISTRATION";
                } else if($auth_status === "lab") {
                    $_SESSION['status'] = "LAB";
                } else if($auth_status === "pharmacist") {
                    $_SESSION['status'] = "PHARMACIST";
                }

                $this->index();
            } else {
                //login failed
                $data->error = "Wrong Username or Password.";
                
                //send error to view
                $this->load->view('header');
                $this->load->view('login/login_view');
            }
        }
    }

    public function logout(){

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('login/logout_success_view');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
    }

}

?>