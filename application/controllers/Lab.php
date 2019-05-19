<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Lab Controller Class
 *
 * control lab management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class Lab extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true && $_SESSION['status'] !== "ADMIN") {
            redirect('/');
        }

        $this->load->model('LabModel');
    }

    public function index()
    {
        redirect('/');
    }


    public function adddata()
    {
        // set validation rules
        $this->form_validation->set_rules('lab_id', 'Lab ID', 'trim|required|alpha_dash|max_length[8]|is_unique[lab.lab_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Lab Name', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('tariff', 'Tariff', 'trim|required|numeric');
            
        if ($this->form_validation->run() === false) {
            
                // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('lab/lab_add_view');
            $this->load->view('footer/footer');
        } else {
            // set variables from the form

            if ($this->LabModel->create_lab()) {
                
				// user creation ok
                $this->LabModel->Redirect();
            } else {
                
				// user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new data. Please try again.';
                    
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('lab/lab_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }


    public function editdata($lab_id)
    {
        // set validation rules
        $this->form_validation->set_rules('lab_id', 'Lab ID', 'trim|required|alpha_dash|max_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Lab Name', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('tariff', 'Tariff', 'trim|required|numeric');

        if ($this->form_validation->run() === false) {
            
			// validation not ok, send validation errors to the view
            $data['query'] = $this->LabModel->Read_specific($lab_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('lab/lab_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            // set variables from the form
            if ($this->LabModel->Update()) {
                
				// user creation ok
                $this->LabModel->Redirect();
            } else {
                
				// user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('lab/lab_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function viewdata($lab_id)
    {
        $data['query'] = $this->WorkersModel->Read_specific($lab_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('workers/workers_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function deletedata($lab_id)
    {
        $data['lab_id'] = $lab_id;
        $this->LabModel->Delete($data);
        $this->LabModel->Redirect();
    }
}
