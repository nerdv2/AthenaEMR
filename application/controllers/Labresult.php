<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Labresult controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control lab result management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Labresult extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('LabResultModel');
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
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$result_id = $this->input->post('result_id');
				$worker_id    = $this->input->post('worker_id');
				$record_id    = $this->input->post('record_id');
				$lab_id    = $this->input->post('lab_id');
				$result_data = $this->input->post('result_data');

				if ($this->LabResultModel->create_labresult($result_id, $worker_id, 
				$result_data)) {
					if($this->LabResultModel->update_medicalrecord($result_id, $record_id, $lab_id)) {
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
						$this->load->view('footer');
					}
										
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('labresult/labresult_add_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}


	public function editdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
			//create the data object
			$stddata = new stdClass();

			// set validation rules
			$this->form_validation->set_rules('result_id', 'LabResultID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('worker_id', 'LabID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('result_data', 'WorkerID', 'trim|required|min_length[4]');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->LabResultModel->Read_specific($id)->row();
				$this->load->view('header');
            	$this->load->view('sidebar/management_active');
            	$this->load->view('navbar');
            	$this->load->view('labresult/labresult_edit_view',$data);
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$result_id = $this->input->post('result_id');
				$worker_id    = $this->input->post('worker_id');
				$result_data = $this->input->post('result_data');

				if ($this->LabResultModel->Update($result_id, $worker_id, 
				$result_data)) {
				
					// user creation ok
					$this->LabResultModel->Redirect();
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('labresult/labresult_edit_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['query'] = $this->LabResultModel->Read_specific($id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/management_active');
			$this->load->view('navbar');
			$this->load->view('labresult/labresult_data_view', $data);
			$this->load->view('footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['result_id'] = $ID;
			$this->LabResultModel->Delete($data);
			$this->LabResultModel->Redirect();
		} else {
            redirect('/');
        }
	}
}