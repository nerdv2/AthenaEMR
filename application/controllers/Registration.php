<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck('admin,registration');

        $this->load->model('RegistrationModel');
    }

    public function index()
    {
        $data['query'] = $this->RegistrationModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/registration_floatbar');
        $this->load->view('registration/registration_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|alpha_dash|min_length[11]|is_unique[registration.register_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('clinic_id', 'Type', 'trim|required');
        $this->form_validation->set_rules('doctor_id', 'ClinicID', 'trim|alpha_dash');
        $this->form_validation->set_rules('category', 'ClinicID', 'trim');
        $this->form_validation->set_rules('patient_type', 'Patient Type', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('registration/registration_add_view');
            $this->load->view('footer/registration_footer');
        } else {
            $register_id = $this->input->post('register_id');
            if ($_SESSION['role'] == "admin") {
                $worker_id = null;
            } else {
                $worker_id    = $this->input->post('worker_id');
            }
            $patient_id = $this->input->post('patient_id');
            $clinic_id = $this->input->post('clinic_id');
            $doctor_id = $this->input->post('doctor_id');
            $category = $this->input->post('category');
            $patient_type = $this->input->post('patient_type');

            if ($this->RegistrationModel->create_registration(
                $register_id,
                $worker_id,
                $patient_id,
                $clinic_id,
                $doctor_id,
                $category,
                $patient_type
            )) {
                $this->RegistrationModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';

                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('registration/registration_add_view', $data);
                $this->load->view('footer/registration_footer');
            }
        }
    }

    public function getDoctor()
    {
        $doctor_id = $this->input->post('id');

        header('Content: application/json');
        echo(json_encode($this->RegistrationModel->getDoctorID($doctor_id)));
        exit();
    }

    public function view($register_id)
    {
        $data['query'] = $this->RegistrationModel->Read_specific($register_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('patient/patient_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($register_id)
    {
        if ($_SESSION['role'] == "admin") {
            $data['register_id'] = $register_id;
            $this->RegistrationModel->Delete($data);
            $this->RegistrationModel->redirect();
        } else {
            redirect('/');
        }
    }
}
