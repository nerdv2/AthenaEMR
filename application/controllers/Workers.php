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
        $data['query'] = $this->WorkersModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/workers_floatbar');
        $this->load->view('workers/workers_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('worker_id', 'WorkersID', 'trim|required|alpha_dash|min_length[8]|is_unique[worker.worker_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Workers Name', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['id'] = $this->WorkersModel->generate_id();
            
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('workers/workers_add_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->WorkersModel->create_workers()) {
                $this->WorkersModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                $data['id'] = $this->WorkersModel->generate_id();
                
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('workers/workers_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }


    public function edit($worker_id)
    {
        $this->form_validation->set_rules('worker_id', 'WorkersID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Workers Name', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('dob', 'D.O.B', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['query'] = $this->WorkersModel->Read_specific($worker_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('workers/workers_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->WorkersModel->Update()) {
                $this->WorkersModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                
                $this->load->view('header');
                $this->load->view('sidebar/users_active');
                $this->load->view('navbar');
                $this->load->view('workers/workers_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function view($worker_id)
    {
        $data['query'] = $this->WorkersModel->Read_specific($worker_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('workers/workers_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($worker_id)
    {
        $data['worker_id'] = $worker_id;
        $this->WorkersModel->Delete($data);
        $this->WorkersModel->redirect();
    }
}
