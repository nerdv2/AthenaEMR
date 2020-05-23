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
        $this->authentication->sessionCheck('' ,'auth/login');

        $this->load->model('DashModel');
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

    public function settings()
    {
        $this->authentication->sessionCheck('admin');

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
                $this->SettingsModel->redirect();
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
