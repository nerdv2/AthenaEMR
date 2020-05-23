<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MedicineType Controller Class
 *
 * control medicine type management(view, add, edit, delete)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */
class MedicineType extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            if ($_SESSION['status'] !== "ADMIN" or $_SESSION['status'] !== "PHARMACIST") {
                redirect('/');
            }
        } else {
            redirect('/');
        }

        $this->load->model('MedicineTypeModel');
    }

    public function index()
    {
        $data['query'] = $this->MedicineTypeModel->getData();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('floatnav/medicine_type_floatbar');
        $this->load->view('medicine_type/medicine_type_view', $data);
        $this->load->view('footer/table_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('type_id', 'Medicine Type ID', 'trim|required|alpha_dash|max_length[11]|is_unique[medicine_type.type_id]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Medicine Type Name');
                
        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('medicine_type/medicine_type_add_view');
            $this->load->view('footer/footer');
        } else {
            if ($this->MedicineTypeModel->create_medicine()) {
                $this->MedicineTypeModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new data. Please try again.';
                        
                
                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('medicine_type/medicine_type_add_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function edit($type_id)
    {
        $this->form_validation->set_rules('type_id', 'Medicine Type ID', 'trim|required|alpha_dash|max_length[11]', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('name', 'Medicine Type Name');
                
        if ($this->form_validation->run() === false) {
            $data['query'] = $this->MedicineTypeModel->Read_specific($type_id)->row();
            $this->load->view('header');
            $this->load->view('sidebar/management_active');
            $this->load->view('navbar');
            $this->load->view('medicine_type/medicine_type_edit_view', $data);
            $this->load->view('footer/footer');
        } else {
            if ($this->MedicineTypeModel->Update()) {
                $this->MedicineTypeModel->redirect();
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';

                $this->load->view('header');
                $this->load->view('sidebar/management_active');
                $this->load->view('navbar');
                $this->load->view('medicine_type/medicine_type_edit_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function view($type_id)
    {
        $data['query'] = $this->MedicineTypeModel->Read_specific($type_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/users_active');
        $this->load->view('navbar');
        $this->load->view('medicine_type/medicine_type_data_view', $data);
        $this->load->view('footer/footer');
    }

    public function delete($type_id)
    {
        $data['type_id'] = $type_id;
        $this->MedicineTypeModel->Delete($data);
        $this->MedicineTypeModel->redirect();
    }
}
