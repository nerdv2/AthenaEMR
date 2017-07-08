<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
class Payment extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('PaymentModel');
	}

	public function index() {
		redirect('/');
    }

	public function pre_adddata(){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT"){
				$this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');

				if ($this->form_validation->run() === false) {
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('payment/payment_pre_add_view');
					$this->load->view('footer/footer');
				} else {
					$type = $this->input->post('type');

					switch($type) {
						case "clinic":
							redirect('/payment/adddata');
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
			} else {
				
				redirect('/');
				
			}
			
		} else {
			redirect('/');
		}
	}


	public function addmedicinedata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('prescription_id', 'PrescriptionID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
				//$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('payment/payment_medicine_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
					
					if ($this->PaymentModel->create_payment_medicine()) {
						$this->PaymentModel->Redirect();
						
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('payment/payment_medicine_add_view',$data);
						$this->load->view('footer/footer');
						
					}

				}
			} else {
				redirect('/');
			}
			

        } else {
            redirect('/');
        }
	}

	public function addlabdata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('result_id', 'ResultID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
				//$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('payment/payment_lab_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form

					if ($this->PaymentModel->create_lab_payment()) {
						$this->PaymentModel->Redirect();
						
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('payment/payment_lab_add_view',$data);
						$this->load->view('footer/footer');
						
					}

				}
			} else {
				redirect('/');
			}
			

        } else {
            redirect('/');
        }
	}

	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('payment_id', 'PaymentID', 'trim|required|alpha_dash|is_unique[payment.payment_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('register_id', 'RegisterID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('type', 'Type of Payment', 'trim|required');
				//$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('payment/payment_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form

					if ($this->PaymentModel->create_payment()) {
						if($this->PaymentModel->update_register()){
							// user creation ok
							$this->PaymentModel->Redirect();
						}
						
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('payment/payment_add_view',$data);
						$this->load->view('footer/footer');
						
					}

				}
			} else {
				redirect('/');
			}
			

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PAYMENT"){
				$data['query'] = $this->PaymentModel->Read_specific($id)->row();
				$this->load->view('header');
				$this->load->view('sidebar/users_active');
				$this->load->view('navbar');
				$this->load->view('workers/workers_data_view', $data);
				$this->load->view('footer/footer');
			} else {
				redirect('/');
			}
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['status'] === "ADMIN") {
			$data['payment_id'] = $ID;
			$this->PaymentModel->Delete($data);
			$this->PaymentModel->Redirect();
		} else {
            redirect('/');
        }
	}
}