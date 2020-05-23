<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Users Controller Class
 *
 * control users management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck('admin');

        $this->load->model('UsersModel');
    }

    public function index()
    {
        $data['query'] = $this->UsersModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/users_floatbar');
        $this->load->view('users/users_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[user.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|alpha_dash');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|alpha_dash');
        $this->form_validation->set_rules('photo', 'Photo', 'trim');

        if ($this->form_validation->run() === false) {
            $data['doctor'] = $this->UsersModel->getDoctorID();
            $data['worker'] = $this->UsersModel->getWorkerID();

            
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('users/users_add_view', $data);
            $this->load->view('footer/footer');
        } else {
            $doctor_id = $this->input->post('doctor_id');
            $worker_id = $this->input->post('worker_id');
            
            if ($doctor_id == "" && $worker_id == "") {
                if ($this->UsersModel->create_user()) {
                    $this->UsersModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                        
                    $data['doctor'] = $this->UsersModel->getDoctorID();
                    $data['worker'] = $this->UsersModel->getWorkerID();
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/users_active');
                    $this->load->view('navbar');
                    $this->load->view('users/users_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } elseif ($doctor_id == "" && $worker_id !== "") {
                if ($this->UsersModel->create_user_worker()) {
                    $this->UsersModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                    $data['doctor'] = $this->UsersModel->getDoctorID();
                    $data['worker'] = $this->UsersModel->getWorkerID();
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/users_active');
                    $this->load->view('navbar');
                    $this->load->view('users/users_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } elseif ($doctor_id !== "" && $worker_id == "") {
                if ($this->UsersModel->create_user_doctor()) {
                    $this->UsersModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                    $data['doctor'] = $this->UsersModel->getDoctorID();
                    $data['worker'] = $this->UsersModel->getWorkerID();
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/users_active');
                    $this->load->view('navbar');
                    $this->load->view('users/users_add_view', $data);
                    $this->load->view('footer/footer');
                }
            }
        }
    }


    public function edit($user_id)
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|alpha_dash');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|alpha_dash');
        $this->form_validation->set_rules('photo', 'Photo', 'trim');

        if ($this->form_validation->run() === false) {
            $data['query'] = $this->UsersModel->Read_specific($user_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/users_active');
            $this->load->view('navbar');
            $this->load->view('users/users_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            $id_user = $this->input->post('id_user');
            $username = $this->input->post('username');
            $password    = $this->input->post('password');
            $status = $this->input->post('status');
            $doctor_id = $this->input->post('doctor_id');
            $worker_id = $this->input->post('worker_id');
            $photo = $this->input->post('photo');

            if ($doctor_id == "" && $worker_id == "") {
                if ($this->UsersModel->update_user($username, $password, $status, $doctor_id, $worker_id, $photo)) {
                    $this->UsersModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/users_active');
                    $this->load->view('navbar');
                    $this->load->view('users/users_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } elseif ($doctor_id == "" && $worker_id !== "") {
                if ($this->UsersModel->update_user_worker($username, $password, $status, $worker_id, $photo)) {
                    $this->UsersModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/users_active');
                    $this->load->view('navbar');
                    $this->load->view('users/users_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } elseif ($doctor_id !== "" && $worker_id == "") {
                if ($this->UsersModel->update_user_doctor($username, $password, $status, $doctor_id, $photo)) {
                    $this->UsersModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/users_active');
                    $this->load->view('navbar');
                    $this->load->view('users/users_add_view', $data);
                    $this->load->view('footer/footer');
                }
            }
        }
    }

    public function delete($user_id)
    {
        $data['id_user'] = $user_id;
        $this->UsersModel->Delete($data);
        $this->UsersModel->redirect();
    }
}
