<?php
defined('BASEPATH') or exit('No direct script access allowed!');

/**
 * AthenaMain Controller Class
 *
 * control auth(login, logout), user type session check and view management.
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class AthenaMain extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // check user authentication status
        if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true) {
            redirect('auth/login');
        }

        $this->load->model('DashModel');
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


    public function index()
    {
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
    }

    public function users_view()
    {
        if ($_SESSION['status'] === "ADMIN") {
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
    }

    public function workers_view()
    {
        if ($_SESSION['status'] === "ADMIN") {
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
    }

    public function lab_view()
    {
        if ($_SESSION['status'] === "ADMIN") {
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
    }

    public function doctor_view()
    {
        if ($_SESSION['status'] === "ADMIN") {
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
    }

    public function patient_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION") {
            $data['query'] = $this->PatientModel->getData();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('floatnav/patient_floatbar');
            $this->load->view('patient/patient_view', $data);
            $this->load->view('footer/table_footer');
        } elseif ($_SESSION['status'] === "DOCTOR") {
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
    }

    public function clinic_view()
    {
        if ($_SESSION['status'] === "ADMIN") {
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
    }

    public function payment_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT") {
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
    }

    public function registration_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "REGISTRATION") {
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
    }

    public function emr_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "DOCTOR") {
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
    }

    public function medicine_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST") {
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
    }

    public function medicine_type_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST") {
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
    }

    public function labresult_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "LAB") {
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
    }

    public function prescription_view()
    {
        if ($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST" or $_SESSION['status'] === "DOCTOR") {
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
    }

    public function settings()
    {
        if ($_SESSION['status'] === "ADMIN") {

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
                if ($this->SettingsModel->saveData()) {

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
    }

    public function access_denied($message)
    {
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
    }
}
