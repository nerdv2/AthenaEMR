<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SettingsModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class SettingsModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/"));
        }

        public function getData(){
            $this->db->select('*');
            $this->db->from('app_settings');
            $this->db->where('id', 1);
            return $this->db->get();
        }

        public function saveData(){

            $data = array('hospital_name' => $this->input->post('hospital_name'),
                'hospital_address' => $this->input->post('hospital_address'),
                'hospital_phone' => $this->input->post('hospital_phone'),
                'hospital_email' => $this->input->post('hospital_email'),
                'worker_id_prefix' => $this->input->post('worker_id_prefix'),
                'doctor_id_prefix' => $this->input->post('doctor_id_prefix'),
                'register_id_prefix' => $this->input->post('register_id_prefix'),
                'clinic_id_prefix' => $this->input->post('clinic_id_prefix'),
                'payment_id_prefix' => $this->input->post('payment_id_prefix'),
                'patient_id_prefix' => $this->input->post('patient_id_prefix'),
                'record_id_prefix' => $this->input->post('record_id_prefix'),
                'lab_id_prefix' => $this->input->post('lab_id_prefix'),
                'result_id_prefix' => $this->input->post('result_id_prefix'),
                'prescription_id_prefix' => $this->input->post('prescription_id_prefix'),
                'medicine_id_prefix' => $this->input->post('medicine_id_prefix'),
                'medicine_type_prefix' => $this->input->post('medicine_type_prefix')
            );

            $this->db->where("id", 1);
            $this->db->update("app_settings",$data);
            $this->Redirect();
        }

    }
?>