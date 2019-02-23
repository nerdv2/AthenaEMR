<?php
defined('BASEPATH') or exit('No direct script access allowed!');

/**
 * Auth Controller Class
 *
 * Control auth(login, logout), user type session check.
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function login()
    {

        //set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() === false) {
            //validation not ok, send validation error to view
            $this->load->view('header');
            $this->load->view('login/login_view');
        } else {
            //set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->AuthModel->resolve_user_login($username, $password)) {
                $user_id = $this->AuthModel->get_user_id_from_username($username);
                $user = $this->AuthModel->get_user($user_id);

                //set session user data
                $_SESSION['user_id']    = (int)$user->id_user;
                $_SESSION['username']   = (string)$user->username;
                $_SESSION['doctor_id']  = (string)$user->doctor_id;
                $_SESSION['worker_id']  = (string)$user->worker_id;
                $_SESSION['logged_in']  = (bool)true;
                
                $auth_status = $user->status;

                if ($auth_status === "admin") {
                    $_SESSION['status'] = "ADMIN";
                } elseif ($auth_status === "doctor") {
                    $_SESSION['status'] = "DOCTOR";
                } elseif ($auth_status === "payment") {
                    $_SESSION['status'] = "PAYMENT";
                } elseif ($auth_status === "registration") {
                    $_SESSION['status'] = "REGISTRATION";
                } elseif ($auth_status === "lab") {
                    $_SESSION['status'] = "LAB";
                } elseif ($auth_status === "pharmacist") {
                    $_SESSION['status'] = "PHARMACIST";
                }

                redirect('/');
            } else {
                //login failed
                $data['error'] = "Wrong Username or Password.";
                
                //send error to view
                $this->load->view('header');
                $this->load->view('login/login_view', $data);
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            
            // user logout ok
            redirect('/');
        } else {
            
            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('/');
        }
    }
}