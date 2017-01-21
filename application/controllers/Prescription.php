<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * Prescription controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control prescription management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class Prescription extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('PrescriptionModel');
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
			$this->form_validation->set_rules('prescription_id', 'PrescriptionID', 'trim|required|alpha_dash|min_length[8]|is_unique[prescription.prescription_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('description', 'Info', 'trim');
			$this->form_validation->set_rules('medicine_id', 'MedicineID', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('dosage', 'Dosage', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('total', 'Total Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('usage', 'Usage Info', 'trim|required');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$this->load->view('header');
            	$this->load->view('sidebar/management_active');
            	$this->load->view('navbar');
            	$this->load->view('prescription/prescription_add_view');
            	$this->load->view('footer');
			
			} else {
				// set variables from the form
				$prescription_id = $this->input->post('prescription_id');
				$record_id    = $this->input->post('record_id');
				$worker_id = $this->input->post('worker_id');
				$description = $this->input->post('description');
				$medicine_id = $this->input->post('medicine_id');
                $dosage = $this->input->post('dosage');
                $amount = $this->input->post('amount');
                $total = $this->input->post('total');
                $usage = $this->input->post('usage');

				if ($this->PrescriptionModel->create_prescription($prescription_id, $record_id, 
				$worker_id, $description)) {
				
					
					if($this->PrescriptionModel->create_prescription_detail($prescription_id, $medicine_id, $dosage, $amount, $total, $usage)){
						
						if($this->PrescriptionModel->update_medicalrecord($record_id, $prescription_id)){
							// user creation ok
							$this->PrescriptionModel->Redirect();
						} else {
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('prescription/prescription_add_view',$data);
						$this->load->view('footer');
						}
						
					} else {
						// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('prescription/prescription_add_view',$data);
            		$this->load->view('footer');
					}

					
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('prescription/prescription_add_view',$data);
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
			$this->form_validation->set_rules('prescription_id', 'PrescriptionID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
			$this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('description', 'Info', 'trim');
			$this->form_validation->set_rules('medicine_id', 'MedicineID', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('dosage', 'Dosage', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('total', 'Total Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('usage', 'Usage Info', 'trim|required');

			if ($this->form_validation->run() === false) {
			
				// validation not ok, send validation errors to the view
				$data['query'] = $this->PrescriptionModel->Read_specific($id)->row();
				$this->load->view('header');
    			$this->load->view('sidebar/management_active');
        		$this->load->view('navbar');
				$this->load->view('prescription/prescription_edit_view',$data);
				$this->load->view('footer');
			
			} else {
				// set variables from the form
				$prescription_id = $this->input->post('prescription_id');
				$record_id    = $this->input->post('record_id');
				$worker_id = $this->input->post('worker_id');
				$description = $this->input->post('description');
				$medicine_id = $this->input->post('medicine_id');
                $dosage = $this->input->post('dosage');
                $amount = $this->input->post('amount');
                $total = $this->input->post('total');
                $usage = $this->input->post('usage');

				if ($this->PrescriptionModel->Update($prescription_id, $record_id, 
				$worker_id, $description)) {
				
					// user creation ok
					if ($this->PrescriptionModel->UpdateDetail($prescription_id, $medicine_id, $dosage, $amount, $total, $usage)){
						$this->PrescriptionModel->Redirect();
					} else {
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('prescription/prescription_edit_view',$data);
						$this->load->view('footer');
					}
					
				} else {
				
					// user creation failed, this should never happen
					$data->error = 'There was a problem creating your new account. Please try again.';
					
					// send error to the view
					$this->load->view('header');
            		$this->load->view('sidebar/management_active');
            		$this->load->view('navbar');
            		$this->load->view('prescription/prescription_edit_view',$data);
            		$this->load->view('footer');
					
				}

			}

        } else {
            redirect('/');
        }
	}

	public function viewdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['query'] = $this->PrescriptionModel->Read_specific($id)->row();
			$this->load->view('header');
			$this->load->view('sidebar/management_active');
			$this->load->view('navbar');
			$this->load->view('prescription/prescription_data_view', $data);
			$this->load->view('footer');
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['prescription_id'] = $ID;
			$this->PrescriptionModel->Delete($data);
			$this->PrescriptionModel->Redirect();
		} else {
            redirect('/');
        }
	}
}