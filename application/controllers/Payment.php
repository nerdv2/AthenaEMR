<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Payment Controller Class
 *
 * control payment management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck('admin,payment');

        $this->load->model('PaymentModel');
    }

    public function index()
    {
        $data['query'] = $this->PaymentModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/payment_floatbar');
        $this->load->view('payment/payment_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function pre_add()
    {
        $this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');

        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('payment/payment_pre_add_view');
            $this->load->view('footer/footer');
        } else {
            $type = $this->input->post('type');

            switch ($type) {
                        case "clinic":
                            redirect('/payment/add');
                        break;

                        case "lab":
                            redirect('/payment/addlabdata');
                        break;

                        case "medicine":
                            redirect('/payment/addmedicinedata');
                        break;

                        default:
                            $this->load->view('header');
                            $this->load->view('sidebar/management_active');
                            $this->load->view('navbar');
                            $this->load->view('payment/payment_pre_add_view');
                            $this->load->view('footer/footer');
                    }
        }
    }


    public function addmedicinedata()
    {
        $this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('prescription_id', 'PrescriptionID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
        //$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('payment/payment_medicine_add_view');
            $this->load->view('footer/footer');
        } else {
            if ($this->PaymentModel->create_payment_medicine()) {
                $this->PaymentModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                        
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('payment/payment_medicine_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function addlabdata()
    {
        $this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('result_id', 'ResultID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
        //$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('payment/payment_lab_add_view');
            $this->load->view('footer/footer');
        } else {
            if ($this->PaymentModel->create_lab_payment()) {
                $this->PaymentModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('payment/payment_lab_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
        //$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('payment/payment_add_view');
            $this->load->view('footer/footer');
        } else {
            if ($this->PaymentModel->create_payment()) {
                if ($this->PaymentModel->update_register()) {
                    $this->PaymentModel->redirect();
                }
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('payment/payment_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function view($payment_id)
    {
        $data['query'] = $this->PaymentModel->Read_specific($payment_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('workers/workers_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($payment_id)
    {
        if ($_SESSION['role'] == "admin") {
            $data['payment_id'] = $payment_id;
            $this->PaymentModel->Delete($data);
            $this->PaymentModel->redirect();
        } else {
            redirect('/');
        }
    }
}
