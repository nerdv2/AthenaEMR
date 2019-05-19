<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Prescription Controller Class
 *
 * control prescription management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class Prescription extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if ($_SESSION['status'] !== "ADMIN" or $_SESSION['status'] !== "PHARMACIST" or $_SESSION['status'] !== "DOCTOR") {
                redirect('/');
            }
        } else {
            redirect('/');
        }

        $this->load->model('PrescriptionModel');
    }

    public function index()
    {
        redirect('/');
    }

    public function pre_adddata()
    {
        $this->form_validation->set_rules('prescription_id', 'PrescriptionID', 'trim|required|alpha_dash|min_length[8]|is_unique[prescription.prescription_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('description', 'Info', 'trim');
        $this->form_validation->set_rules('medicine_total', 'Medicine Total', 'required');

        if ($this->form_validation->run() === false) {
            // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('prescription/prescription_pre_add_view');
            $this->load->view('footer/footer');
        } else {
            $this->add_newdata();
        }
    }

    public function add_newdata()
    {
        $this->form_validation->set_rules('prescription_id', 'PrescriptionID', 'trim|required|alpha_dash|min_length[8]|is_unique[prescription.prescription_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('description', 'Info', 'trim');

        if ($this->form_validation->run() === false) {
            $data['prescription_id'] = $this->input->post('prescription_id');
            $data['record_id'] = $this->input->post('record_id');
            $data['worker_id'] = $this->input->post('worker_id');
            $data['description'] = $this->input->post('description');
            $data['medicine_total'] = $this->input->post('medicine_total');

            // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('prescription/prescription_add_view', $data);
            $this->load->view('footer/footer');
        } else {
            $data['prescription_id'] = $this->input->post('prescription_id');
            $data['record_id'] = $this->input->post('record_id');
            $data['worker_id'] = $this->input->post('worker_id');
            $data['description'] = $this->input->post('description');
            $data['medicine_total'] = $this->input->post('medicine_total');

            // validation not ok, send validation errors to the view
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('prescription/prescription_add_view', $data);
            $this->load->view('footer/footer');
        }
    }

    public function process_adddata()
    {
        $prescription_id = $this->input->post('prescription_id');
        $record_id    = $this->input->post('record_id');
        $worker_id = $this->input->post('worker_id');
        $description = $this->input->post('description');
        $medicine_id = $this->input->post('medicine_id');
        $dosage = $this->input->post('dosage');
        $amount = $this->input->post('amount');
        $total = $this->input->post('total');
        $usage = $this->input->post('usage');

        if ($this->PrescriptionModel->create_prescription(
                    $prescription_id,
                    $record_id,
                    $worker_id,
                    $description
                )) {
            if ($this->PrescriptionModel->create_prescription_detail_batch($prescription_id, $medicine_id, $dosage, $amount, $total, $usage)) {
                if ($this->PrescriptionModel->update_medicalrecord($record_id, $prescription_id)) {
                    // user creation ok
                    $this->PrescriptionModel->Redirect();
                } else {
                    // user creation failed, this should never happen
                    $data->error = 'There was a problem creating your new account. Please try again.';
                        
                    // send error to the view
                    $this->load->view('header');
                    $this->load->view('sidebar/management_active');
                    $this->load->view('navbar');
                    $this->load->view('prescription/prescription_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } else {
                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';
                    
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('prescription/prescription_add_view', $data);
                $this->load->view('footer/footer');
            }
        } else {
                
            // user creation failed, this should never happen
            $data->error = 'There was a problem creating your new account. Please try again.';
                    
            // send error to the view
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('prescription/prescription_add_view', $data);
            $this->load->view('footer/footer');
        }
    }


    public function adddata()
    {
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
            $this->load->view('footer/footer');
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

            if ($this->PrescriptionModel->create_prescription(
                        $prescription_id,
                        $record_id,
                        $worker_id,
                        $description
                    )) {
                if ($this->PrescriptionModel->create_prescription_detail($prescription_id, $medicine_id, $dosage, $amount, $total, $usage)) {
                    if ($this->PrescriptionModel->update_medicalrecord($record_id, $prescription_id)) {
                        // user creation ok
                        $this->PrescriptionModel->Redirect();
                    } else {
                        // user creation failed, this should never happen
                        $data['error'] = 'There was a problem creating your new account. Please try again.';
                            
                        // send error to the view
                        $this->load->view('header');
                        $this->load->view('sidebar/management_active');
                        $this->load->view('navbar');
                        $this->load->view('prescription/prescription_add_view', $data);
                        $this->load->view('footer/footer');
                    }
                } else {
                    // user creation failed, this should never happen
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                        
                    // send error to the view
                    $this->load->view('header');
                    $this->load->view('sidebar/management_active');
                    $this->load->view('navbar');
                    $this->load->view('prescription/prescription_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } else {
                    
                // user creation failed, this should never happen
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                        
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('prescription/prescription_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }


    public function editdata($prescription_id)
    {
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
            $data['query'] = $this->PrescriptionModel->Read_specific($prescription_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('prescription/prescription_edit_view', $data);
            $this->load->view('footer/footer');
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

            if ($this->PrescriptionModel->Update(
                        $prescription_id,
                        $record_id,
                        $worker_id,
                        $description
                    )) {
                    
                        // user creation ok
                if ($this->PrescriptionModel->UpdateDetail($prescription_id, $medicine_id, $dosage, $amount, $total, $usage)) {
                    $this->PrescriptionModel->Redirect();
                } else {
                    // user creation failed, this should never happen
                    $data->error = 'There was a problem creating your new account. Please try again.';
                            
                    // send error to the view
                    $this->load->view('header');
                    $this->load->view('sidebar/management_active');
                    $this->load->view('navbar');
                    $this->load->view('prescription/prescription_edit_view', $data);
                    $this->load->view('footer/footer');
                }
            } else {
                    
                        // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';
                        
                // send error to the view
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('prescription/prescription_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function viewdata($prescription_id)
    {
        $data['query'] = $this->PrescriptionModel->Read_specific($prescription_id);
        $data['medicine'] = $this->PrescriptionModel->getMedicineInfo($prescription_id);
        $data['usage'] = $this->PrescriptionModel->getMedicineUsage($prescription_id);
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('prescription/prescription_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function deletedata($prescription_id)
    {
        if ($_SESSION['status'] === "ADMIN") {
            $data['prescription_id'] = $prescription_id;
            $this->PrescriptionModel->Delete($data);
            $this->PrescriptionModel->Redirect();
        } else {
            redirect('/');
        }
    }
}
