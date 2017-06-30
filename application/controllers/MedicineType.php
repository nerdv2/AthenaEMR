<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	 * AthenaEMR - Gema Aji Wardian
     * MedicineType controller.
     * <gema_wardian@hotmail.com>
     * ----------------------------------------------
     * control medicine type management(view, add, edit, delete)
     * ----------------------------------------------
	 */
class MedicineType extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('MedicineTypeModel');
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

			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('type_id', 'Medicine Type ID', 'trim|required|alpha_dash|max_length[11]|is_unique[medicine_type.type_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('name', 'Medicine Type Name');
				
				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('medicine_type/medicine_type_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
					$type_id    = $this->input->post('type_id');
					$name = $this->input->post('name');	

					if ($this->MedicineTypeModel->create_medicine($type_id,$name)) {
					
						// user creation ok
						$this->MedicineTypeModel->Redirect();
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new data. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('medicine_type/medicine_type_add_view',$data);
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

	public function editdata($id){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
				//create the data object
				$stddata = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('type_id', 'Medicine Type ID', 'trim|required|alpha_dash|max_length[11]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('name', 'Medicine Type Name');
				
				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$data['query'] = $this->MedicineTypeModel->Read_specific($id)->row();
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('medicine_type/medicine_type_edit_view',$data);
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
					$type_id    = $this->input->post('type_id');
					$name = $this->input->post('name');	
					
					if ($this->MedicineTypeModel->Update($type_id,$name)) {
					
						// user creation ok
						$this->MedicineTypeModel->Redirect();
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('medicine_type/medicine_type_edit_view',$data);
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

			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
				$data['query'] = $this->MedicineTypeModel->Read_specific($id)->row();
				$this->load->view('header');
				$this->load->view('sidebar/users_active');
				$this->load->view('navbar');
				$this->load->view('medicine_type/medicine_type_data_view', $data);
				$this->load->view('footer/footer');
			} else {
				
				redirect('/');
				
			}
			
		} else {
            redirect('/');
        }
	}

	public function deletedata($ID){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
				$data['type_id'] = $ID;
				$this->MedicineTypeModel->Delete($data);
				$this->MedicineTypeModel->Redirect();
			} else {
				
				redirect('/');
				
			}
			
		} else {
            redirect('/');
        }
	}
}