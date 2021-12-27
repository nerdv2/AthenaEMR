<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PatientModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class PatientModel extends CI_Model {

        public function redirect(){
            redirect(base_url("patient"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('patient');
            $query = $this->db->get();
            return $query->result();
        }

        public function getDoctorPatientData($doctor_id){
            $this->db->select("*");
            $this->db->where("doctor_id", $doctor_id);
            $this->db->from('getpatientdoctor');
            $this->db->group_by("name");
            $query = $this->db->get();
            return $query->result();
        }

        public function getPatientLab($patient_id){
            $dataquery = "CALL getPatientLab(?)";
            $execute = $this->db->query($dataquery,array($patient_id));
            $resultdata = $execute->result();
            $execute->next_result();
            $execute->result();
            return $resultdata;
        }

        public function Read_patientname($patient_id){
            $this->db->select('*');
            $this->db->from('patient');
            $this->db->where('patient_id', $patient_id);
            $query = $this->db->get();
            $ret = $query->row();
            return $ret->name;
        }

        public function getPatientPrescription($patient_id){
            $dataquery = "CALL getPatientPrescription(?)";
            $execute = $this->db->query($dataquery,array($patient_id));
            $resultdata = $execute->result();
            $execute->next_result();
            $execute->result();
            return $resultdata;
        }

        public function create_patient() {
		
            $patient_id = $this->input->post('patient_id');
            $name    = $this->input->post('name');
            $dob = $this->input->post('dob');
            $gender = $this->input->post('gender');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            $postal_code = $this->input->post('postal_code');
            $mother_name = $this->input->post('mother_name');
            $emergency_contact = $this->input->post('emergency_contact');
            $home_phone = $this->input->post('home_phone');
            $work_phone = $this->input->post('work_phone');
            $mobile_phone = $this->input->post('mobile_phone');
            $email = $this->input->post('email');
            $marital_status = $this->input->post('marital_status');
            $religion = $this->input->post('religion');
            $language = $this->input->post('language');
            $race = $this->input->post('race');
            $ethnicity = $this->input->post('ethnicity');
            
            $data = array(
                'patient_id'   => $patient_id,
                'name'   => $name,
                'dob'      => $dob,
                'gender'      => $gender,
                'created_at' => date('Y-m-j H:i:s'),
            );

            $run = $this->db->insert('patient', $data);

            if ($run) {
                $data2 = array(
                    'patient_id' => $patient_id,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'postal_code' => $postal_code,
                    'mother_name' => $mother_name,
                    'emergency_contact' => $emergency_contact,
                    'home_phone' => $home_phone,
                    'work_phone' => $work_phone,
                    'mobile_phone' => $mobile_phone,
                    'email' => $email,
                );

                $run2 = $this->db->insert('patient_contact', $data2);

                if ($run2) {
                    $data3 = array(
                        'patient_id' => $patient_id,
                        'marital_status' => $marital_status,
                        'religion' => $religion,
                        'language' => $language,
                        'race' => $race,
                        'ethnicity' => $ethnicity,
                    );

                    $run3 = $this->db->insert('patient_detail', $data3);
                }
            }
            
            return $run3;
		
	    }

        public function generate_id(){
            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->patient_id_prefix;

            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $iddata;

            return $query;
        }

        public function Read_specific($patient_id){
            $this->db->select('*');
            $this->db->from('patient');
            $this->db->join('patient_detail', 'patient_detail.patient_id = patient.patient_id');
            $this->db->join('patient_contact', 'patient_contact.patient_id = patient.patient_id');
            $this->db->where('patient.patient_id', $patient_id);
            return $this->db->get();
        }

        public function Update(){

            $patient_id = $this->input->post('patient_id');
			$name    = $this->input->post('name');
			$dob = $this->input->post('dob');
			$gender = $this->input->post('gender');
		    $address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$country = $this->input->post('country');
			$postal_code = $this->input->post('postal_code');
			$emergency_contact = $this->input->post('emergency_contact');
			$mother_name = $this->input->post('mother_name');
			$home_phone = $this->input->post('home_phone');
			$work_phone = $this->input->post('work_phone');
			$mobile_phone = $this->input->post('mobile_phone');
			$email = $this->input->post('email');
			$marital_status = $this->input->post('marital_status');
			$religion = $this->input->post('religion');
			$language = $this->input->post('language');
			$race = $this->input->post('race');
			$ethnicity = $this->input->post('ethnicity');

            $data = array(
                'patient_id'   => $patient_id,
                'name'   => $name,
                'dob'      => $dob,
                'gender'      => $gender,
                'updated_at' => date('Y-m-j H:i:s'),
            );

            $this->db->where("patient_id", $patient_id);
            $run = $this->db->update("patient", $data);

            if ($run) {
                $data2 = array(
                    'patient_id' => $patient_id,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'postal_code' => $postal_code,
                    'mother_name' => $mother_name,
                    'emergency_contact' => $emergency_contact,
                    'home_phone' => $home_phone,
                    'work_phone' => $work_phone,
                    'mobile_phone' => $mobile_phone,
                    'email' => $email,
                );

                $this->db->where("patient_id", $patient_id);
                $run2 = $this->db->update("patient_contact", $data2);

                if ($run2) {
                    $data3 = array(
                        'patient_id' => $patient_id,
                        'marital_status' => $marital_status,
                        'religion' => $religion,
                        'language' => $language,
                        'race' => $race,
                        'ethnicity' => $ethnicity,
                    );

                    $this->db->where("patient_id", $patient_id);
                    $run3 = $this->db->update("patient_detail", $data3);
                }
            }

            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $run = $this->db->delete('patient_detail');

            if ($run) {
                $this->db->where($data);
                $run2 = $this->db->delete('patient_contact');

                if ($run2) {
                    $this->db->where($data);
                    $this->db->delete('patient');
                } 
            }
	    }


    }
?>