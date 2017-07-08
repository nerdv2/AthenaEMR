<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Medicine Controller Class
 *
 * control medicine management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Medicine extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('MedicineModel');
	}

	public function index() {
		redirect('/');
    }

public function adddata()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			if($_SESSION['status'] === "ADMIN" or $_SESSION['status'] === "PHARMACIST"){
				//create the data object
				$data = new stdClass();

				// set validation rules
				$this->form_validation->set_rules('medicine_id', 'Medicine ID', 'trim|required|alpha_dash|is_unique[medicine.medicine_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('type_id', 'Medicine Type ID', 'trim|required|alpha_dash');
				$this->form_validation->set_rules('name', 'Medicine Name', 'trim|required');
				$this->form_validation->set_rules('description', 'Description', 'trim|min_length[4]');
				$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
				$this->form_validation->set_rules('amount', 'Unit', 'trim|required|numeric');
				
				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('medicine/medicine_add_view');
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
			
					if ($this->MedicineModel->create_medicine()) {
					
						// user creation ok
						$this->MedicineModel->Redirect();
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new data. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('medicine/medicine_add_view',$data);
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
				$this->form_validation->set_rules('medicine_id', 'Medicine ID', 'trim|required|alpha_dash', array('is_unique' => 'This id already exists. Please choose another one.'));
				$this->form_validation->set_rules('type_id', 'Medicine Type ID', 'trim|required|alpha_dash');
				$this->form_validation->set_rules('name', 'Medicine Name', 'trim|required');
				$this->form_validation->set_rules('description', 'Description', 'trim|min_length[4]');
				$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
				$this->form_validation->set_rules('amount', 'Unit', 'trim|required|numeric');

				if ($this->form_validation->run() === false) {
				
					// validation not ok, send validation errors to the view
					$data['query'] = $this->MedicineModel->Read_specific($id)->row();
					$this->load->view('header');
					$this->load->view('sidebar/management_active');
					$this->load->view('navbar');
					$this->load->view('medicine/medicine_edit_view',$data);
					$this->load->view('footer/footer');
				
				} else {
					// set variables from the form
					

					if ($this->MedicineModel->Update()) {
					
						// user creation ok
						$this->MedicineModel->Redirect();
						
					} else {
					
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('header');
						$this->load->view('sidebar/management_active');
						$this->load->view('navbar');
						$this->load->view('medicine/medicine_edit_view',$data);
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
				$data['query'] = $this->MedicineModel->Read_specific($id)->row();
				$this->load->view('header');
				$this->load->view('sidebar/management_active');
				$this->load->view('navbar');
				$this->load->view('medicine/medicine_data_view', $data);
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
				$data['medicine_id'] = $ID;
				$this->MedicineModel->Delete($data);
				$this->MedicineModel->Redirect();
			} else {
				redirect('/');
			}
			
		} else {
            redirect('/');
        }
	}
}