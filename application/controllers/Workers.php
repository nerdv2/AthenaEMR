<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Workers Controller Class
 *
 * control workers management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Workers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true && $_SESSION['status'] !== "ADMIN") {
            redirect('/');
        }

        $this->load->model('WorkersModel');
    }

    public function index()
    {
        redirect('/');
    }

    public function adddata()
    {
        // set validation rules
        $this->form_validation->set_rules('worker_id', 'WorkersID', 'trim|required|alpha_dash|min_length[8]|is_unique[worker.worker_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Workers Name', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['id'] = $this->WorkersModel->generate_id();
            // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('workers/workers_add_view', $data);
            $this->load->view('footer/footer');
        } else {
            // set variables from the form

            if ($this->WorkersModel->create_workers()) {
                
                // user creation ok
                $this->WorkersModel->Redirect();
            } else {
                
                // user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                $data['id'] = $this->WorkersModel->generate_id();
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('workers/workers_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }


    public function editdata($worker_id)
    {
        // set validation rules
        $this->form_validation->set_rules('worker_id', 'WorkersID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Workers Name', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() === false) {
            // validation not ok, send validation errors to the view
            $data['query'] = $this->WorkersModel->Read_specific($worker_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('workers/workers_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            // set variables from the form
            if ($this->WorkersModel->Update()) {
                // user creation ok
                $this->WorkersModel->Redirect();
            } else {
                
                // user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('workers/workers_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function viewdata($worker_id)
    {
        $data['query'] = $this->WorkersModel->Read_specific($worker_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('workers/workers_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function deletedata($worker_id)
    {
        $data['worker_id'] = $worker_id;
        $this->WorkersModel->Delete($data);
        $this->WorkersModel->Redirect();
    }
}
