<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Patient extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck('admin,registration,doctor');

        $this->load->model('PatientModel');
        $this->load->model('EMRModel');
    }

    public function index()
    {
        $data = array();
        if ($_SESSION['role'] === "admin" or $_SESSION['role'] === "registration") {
            $data['query'] = $this->PatientModel->getData();
        } elseif ($_SESSION['role'] === "doctor") {
            $data['query'] = $this->PatientModel->getDoctorPatientData($_SESSION['doctor_id']);
        }

        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/patient_floatbar');
        $this->load->view('patient/patient_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
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
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('patient/patient_add_view');
            $this->load->view('footer/footer');
        } else {
            if ($this->PatientModel->create_patient()) {
                $this->PatientModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('patient/patient_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }


    public function edit($patient_id)
    {
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
            $data['query'] = $this->PatientModel->Read_specific($patient_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('patient/patient_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->PatientModel->Update()) {
                $this->PatientModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('patient/patient_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function view($patient_id)
    {
        $data['query'] = $this->PatientModel->Read_specific($patient_id)->row();
        $data['emr'] = $this->EMRModel->getPatientEMR($patient_id);
        $data['lab'] = $this->PatientModel->getPatientLab($patient_id);
        $data['prescription'] = $this->PatientModel->getPatientPrescription($patient_id);
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('patient/patient_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($patient_id)
    {
        if ($_SESSION['role'] == "admin") {
            $data['patient_id'] = $patient_id;
            $this->PatientModel->Delete($data);
            $this->PatientModel->redirect();
        } else {
            redirect('/');
        }
    }
}
