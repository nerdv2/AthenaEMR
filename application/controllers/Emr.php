<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Emr Controller Class
 *
 * control EMR management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class Emr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if ($_SESSION['status'] !== "ADMIN" or $_SESSION['status'] !== "DOCTOR") {
                redirect('/');
            }
        } else {
            redirect('/');
        }

        $this->load->model('EMRModel');
    }

    public function index()
    {
        $data['query'] = $this->EMRModel->getDataSpecific($_SESSION['doctor_id']);
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/emr_floatbar');
        $this->load->view('emr/emr_view', $data);
        $this->load->view('footer/table_footer');
    }
    
    public function add()
    {
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
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('emr/emr_add_view');
            $this->load->view('footer/emr_footer');
        } else {
            $register_id 		= $this->input->post('register_id');

            $doctor_id 			= $this->EMRModel->getRegistrationDoctor($register_id);
            $patient_id 		= $this->EMRModel->getRegistrationPatient($register_id);

            if ($this->EMRModel->create_emr($doctor_id, $patient_id)) {
                $this->EMRModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';

                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('emr/emr_add_view', $data);
                $this->load->view('footer/emr_footer');
            }
        }
    }

    public function view($record_id)
    {
        $data['query'] = $this->EMRModel->Read_specific($record_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('emr/emr_data_view', $data);
        $this->load->view('footer/footer');
    }
}
