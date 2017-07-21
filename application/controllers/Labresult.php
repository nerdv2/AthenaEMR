<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Labresult Controller Class
 *
 * control lab result management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Labresult extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('LabResultModel');
	}

	public function index() {
		redirect('/');
    }


	public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "LAB"){

				// set validation rules
				$this->form_validation->set_rules('result_id', 'LabResultID', 'trim|required|alpha_dash|min_length[8]|is_unique[lab_result.result_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('lab_id', 'LabID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('result_data', 'Result Data', 'required');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('labresult/labresult_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form

					if ($this->LabResultModel->create_labresult()) {
						if($this->LabResultModel->update_medicalrecord()) {
							// user creation ok
							$this->LabResultModel->Redirect();
						} else {
							// user creation failed, this should never happen
							$data->error = 'There was a problem creating your new account. Please try again.';
							
							// send error to the view
							$this->load->view('header');
							$this->load->view('sidebar/management_active');
							$this->load->view('navbar');
							$this->load->view('labresult/labresult_add_view',$data);
							$this->load->view('footer/footer');
						}
											
					} else {
					
						// user creation failed, this should never happen
						$data['error'] = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('labresult/labresult_add_view',$data);
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


	public function editdata($result_id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "LAB"){

				// set validation rules
				$this->form_validation->set_rules('result_id', 'LabResultID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('worker_id', 'LabID', 'trim|required|min_length[4]');
				$this->form_validation->set_rules('result_data', 'WorkerID', 'trim|required|min_length[4]');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$data['query'] = $this->LabResultModel->Read_specific($result_id)->row();
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('labresult/labresult_edit_view',$data);
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form

					if ($this->LabResultModel->Update()) {
					
						// user creation ok
						$this->LabResultModel->Redirect();
						
					} else {
					
						// user creation failed, this should never happen
						$data['error'] = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('labresult/labresult_edit_view',$data);
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

	public function viewdata($result_id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "LAB"){
				$data['query'] = $this->LabResultModel->Read_specific($result_id)->row();
				$this->load->view('header');
				$this->load->view('sidebar/management_active');
				$this->load->view('navbar');
				$this->load->view('labresult/labresult_data_view', $data);
				$this->load->view('footer/footer');
			} else {
				redirect('/');
			}
			
		} else {
            redirect('/');
        }
	}

	public function deletedata($result_id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "LAB"){
				$data['result_id'] = $result_id;
				$this->LabResultModel->Delete($data);
				$this->LabResultModel->Redirect();
			} else {
				redirect('/');
			}
			
		} else {
            redirect('/');
        }
	}
}