<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * EMRModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class EMRModel extends CI_Model {

        public function redirect(){
            redirect(base_url("index.php/emr"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('medical_record');
            $query = $this->db->get();
            return $query->result();
        }

        public function getDataSpecific($doctor_id){
            $this->db->select("*");
            $this->db->where('doctor_id', $doctor_id);
            $this->db->from('getmedicalrecord_today');
            $query = $this->db->get();
            return $query->result();
        }

        public function getPatientEMR($patient_id){
            $this->db->select("*");
            $this->db->where('patient_id', $patient_id);
            $this->db->from('medical_record');
            $query = $this->db->get();
            return $query->result();
        }

        public function getDoctorID(){
            $data = array();
            $query = $this->db->get('doctor');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function getRegisterID($doctor_id){
            $data = array();
            $this->db->select("*");
            $this->db->where('doctor_id', $doctor_id);
            $this->db->from('getregistertoday');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function getPatientID(){
            $data = array();
            $query = $this->db->get('patient');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function getLabID(){
            $data = array();
            $query = $this->db->get('lab');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function getLabResultID(){
            $data = array();
            $query = $this->db->get('lab_result');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function getPrescriptionID(){
            $data = array();
            $query = $this->db->get('prescription');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function getRegistrationDoctor($register_id)
        {  
            $this->db->where('register_id',$register_id);
            $query = $this->db->get('registration');
            $ret = $query->row();
            return $ret->doctor_id;
        }

        public function getRegistrationPatient($register_id)
        {  
            $this->db->where('register_id',$register_id);
            $query = $this->db->get('registration');
            $ret = $query->row();
            return $ret->patient_id;
        }

        public function create_emr($doctor_id, $patient_id) {

            $record_id = $this->input->post('record_id');
			$register_id = $this->input->post('register_id');
			$additional_notes = $this->input->post('additional_notes');
			$weight = $this->input->post('weight');
			$height = $this->input->post('height');
			$blood_pressure_systolic = $this->input->post('blood_pressure_systolic');
			$blood_pressure_diastolic = $this->input->post('blood_pressure_diastolic');
			$pulse = $this->input->post('pulse');
			$respiration = $this->input->post('respiration');
			$temperature = $this->input->post('temperature');
			$temperature_location = $this->input->post('temperature_location');
			$oxygen_saturation = $this->input->post('oxygen_saturation');
			$head_circumference = $this->input->post('head_circumference');
			$waist_circumference = $this->input->post('waist_circumference');
			$bmi = $this->input->post('bmi');
			$complaint = $this->input->post('complaint');
			$symptoms = $this->input->post('symptoms');
			$diagnosis = $this->input->post('diagnosis');
			$handling = $this->input->post('handling');
		
            $data = array(
                'record_id'   => $record_id,
                'doctor_id'   => $doctor_id,
                'register_id'      => $register_id,
                'patient_id'      => $patient_id,
                'time' => date('Y-m-j H:i:s'),
                'complaint'      => $complaint,
                'symptoms'      => $symptoms,
                'diagnosis'    => $diagnosis,
                'handling'    => $handling,
                'additional_notes' => $additional_notes,
                'created_at' => date('Y-m-j H:i:s'),
            );

            $run = $this->db->insert('medical_record', $data);

            if ($run) {
                $data2 = array(
                    'record_id'   => $record_id,
                    'weight'   => $weight,
                    'height'      => $height,
                    'blood_pressure_systolic'      => $blood_pressure_systolic,
                    'blood_pressure_diastolic' => $blood_pressure_diastolic,
                    'pulse'      => $pulse,
                    'respiration'      => $respiration,
                    'temperature'    => $temperature,
                    'temperature_location'    => $temperature_location,
                    'oxygen_saturation' => $oxygen_saturation,
                    'head_circumference' => $head_circumference,
                    'waist_circumference' => $waist_circumference,
                    'bmi' => $bmi,
                );

                $run2 = $this->db->insert('medical_record_vitals', $data2);
            }
            
            return $run2;
		
	    }
        
        public function generate_id(){
            $date = date("dmy");

            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->record_id_prefix;
            
            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $date ."-" . $iddata;

            return $query;
        }

        public function Read_specific($record_id){
            $this->db->select('*');
            $this->db->from('getemrcompleteview');
            $this->db->where('record_id', $record_id);
            return $this->db->get();
        }

        public function getrecord_report($patient_id, $start, $end){
            $dataquery = "CALL getRecordMonth(?, ?, ?)";
            $execute = $this->db->query($dataquery,array($patient_id, $start, $end));
            $ret = $execute->result();
            $execute->next_result();
            $execute->result();
            return $ret;
        }

    }
?>