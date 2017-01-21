<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Payment controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control payment management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Payment extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('PaymentModel');
	}
	/*
	public function index()
	{
		$data['query'] = $this->CRUD->getData();
		$this->load->view('homepage',$data);
	}
	*/

	public function index() {

    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
			//create the data object
			$data = new stdClass();

			// set validation rules
			$this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/management_active');
            	$this->load->view('navbar');
            	$this->load->view('payment/payment_add_view');
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$payment_id = $this->input->post('payment_id');
				$register_id    = $this->input->post('register_id');
				$worker_id = $this->input->post('worker_id');
				$type = $this->input->post('type');
				$amount = $this->input->post('amount');

				if ($this->PaymentModel->create_payment($payment_id, $register_id, 
				$worker_id, $type, $amount)) {
				
					// user creation ok
					$this->PaymentModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('payment/payment_add_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['query'] = $this->PaymentModel->Read_specific($id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/users_active');
			$this->load->view('navbar');
			$this->load->view('workers/workers_data_view', $data);
			$this->load->view('footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['payment_id'] = $ID;
			$this->PaymentModel->Delete($data);
			$this->PaymentModel->Redirect();
		} else {
            redirect('/');
        }
	}
}