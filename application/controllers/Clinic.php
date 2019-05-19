<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Clinic Controller Class
 *
 * control clinic management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class Clinic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true && $_SESSION['status'] !== "ADMIN") {
            redirect('/');
        }

        $this->load->model('ClinicModel');
    }
    
    public function index()
    {
        redirect('/');
    }

    public function adddata()
    {
        // set validation rules
        $this->form_validation->set_rules('clinic_id', 'Clinic ID', 'trim|required|alpha_dash|max_length[8]|is_unique[clinic.clinic_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Clinic Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('tariff', 'Tariff', 'trim|required|numeric');
            
        if ($this->form_validation->run() === false) {
            
            // validation not ok, send validation errors to the view
            $data['id'] = $this->ClinicModel->generate_id();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('clinic/clinic_add_view', $data);
            $this->load->view('footer/footer');
        } else {
            // set variables from the form
            if ($this->ClinicModel->create_clinic()) {
                
                // user creation ok
                $this->ClinicModel->Redirect();
            } else {
                
                // user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new data. Please try again.';
                $data['id'] = $this->ClinicModel->generate_id();
                    
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('clinic/clinic_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }


    public function editdata($clinic_id)
    {
        // set validation rules
        $this->form_validation->set_rules('clinic_id', 'Clinic ID', 'trim|required|alpha_dash|max_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Clinic Name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('tariff', 'Tariff', 'trim|required|numeric');

        if ($this->form_validation->run() === false) {
            
                // validation not ok, send validation errors to the view
            $data['query'] = $this->ClinicModel->Read_specific($clinic_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('clinic/clinic_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            // set variables from the form

            if ($this->ClinicModel->Update()) {
                
                // user creation ok
                $this->LabModel->Redirect();
            } else {
                
                // user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new data. Please try again.';
                $data['id'] = $this->ClinicModel->generate_id();

                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('clinic/clinic_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function viewdata($clinic_id)
    {
        $data['query'] = $this->ClinicModel->Read_specific($clinic_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('clinic/clinic_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function deletedata($clinic_id)
    {
        $data['clinic_id'] = $clinic_id;
        $this->ClinicModel->Delete($data);
        $this->ClinicModel->Redirect();
    }
}
