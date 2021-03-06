<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Labresult extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck('admin,lab');

        $this->load->model('LabResultModel');
    }

    public function index()
    {
        $data['query'] = $this->LabResultModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/labresult_floatbar');
        $this->load->view('labresult/labresult_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('result_id', 'LabResultID', 'trim|required|alpha_dash|min_length[8]|is_unique[lab_result.result_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('worker_id', 'WorkerID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('record_id', 'RecordID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('lab_id', 'LabID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('result_data', 'Result Data', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('labresult/labresult_add_view');
            $this->load->view('footer/footer');
        } else {
            if ($this->LabResultModel->create_labresult()) {
                if ($this->LabResultModel->update_medicalrecord()) {
                    $this->LabResultModel->redirect();
                } else {
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                            
                    
                    $this->load->view('header');
                    $this->load->view('sidebar/management_active');
                    $this->load->view('navbar');
                    $this->load->view('labresult/labresult_add_view', $data);
                    $this->load->view('footer/footer');
                }
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                        
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('labresult/labresult_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function edit($result_id)
    {
        $this->form_validation->set_rules('result_id', 'LabResultID', 'trim|required|alpha_dash|min_length[8]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('worker_id', 'LabID', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('result_data', 'WorkerID', 'trim|required|min_length[4]');

        if ($this->form_validation->run() === false) {
            $data['query'] = $this->LabResultModel->Read_specific($result_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('labresult/labresult_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->LabResultModel->Update()) {
                $this->LabResultModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                        
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('labresult/labresult_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function view($result_id)
    {
        $data['query'] = $this->LabResultModel->Read_specific($result_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('labresult/labresult_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($result_id)
    {
        $data['result_id'] = $result_id;
        $this->LabResultModel->Delete($data);
        $this->LabResultModel->redirect();
    }
}
