<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Doctor Controller Class
 *
 * Manage doctor related stuff (view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class Doctor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck('admin');
        
        $this->load->model('DoctorModel');
    }

    public function index()
    {
        $data['query'] = $this->DoctorModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/doctor_floatbar');
        $this->load->view('doctor/doctor_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
        $data = array();
        $this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|alpha_dash|min_length[8]|is_unique[doctor.doctor_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('clinic_id', 'ClinicID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric');

        if ($this->form_validation->run() === false) {

            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('doctor/doctor_add_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->DoctorModel->create_doctor()) {
                $this->DoctorModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                $data['id'] = $this->DoctorModel->generate_id();
                $data['clinic'] = $this->DoctorModel->getClinicID();
                
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('doctor/doctor_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function edit($doctor_id)
    {
        $this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('clinic_id', 'ClinicID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric');

        if ($this->form_validation->run() === false) {
            $data['query'] = $this->DoctorModel->Read_specific($doctor_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('doctor/doctor_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->DoctorModel->Update()) {
                $this->DoctorModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('doctor/doctor_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function view($doctor_id)
    {
        $data['query'] = $this->DoctorModel->Read_specific($doctor_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('doctor/doctor_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($doctor_id)
    {
        $data['doctor_id'] = $doctor_id;
        $this->DoctorModel->Delete($data);
        $this->DoctorModel->redirect();
    }
}
