<?php
    class PatientModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/patient_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('patient');
            $query = $this->db->get();
            return $query->result();
        }

        public function getDoctorPatientData($id){
            $this->db->select("*");
            $this->db->where("doctor_id", $id);
            $this->db->from('getpatientdoctor');
            $this->db->group_by("name");
            $query = $this->db->get();
            return $query->result();
        }

        public function getPatientLab($id){
            $dataquery = "CALL getPatientLab(?)";
            $execute = $this->db->query($dataquery,array($id));
            $resultdata = $execute->result();
            $execute->next_result();
            $execute->free_result();
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

        public function getPatientPrescription($id){
            $dataquery = "CALL getPatientPrescription(?)";
            $execute = $this->db->query($dataquery,array($id));
            $resultdata = $execute->result();
            $execute->next_result();
            $execute->free_result();
            return $resultdata;
        }

        public function create_patient($patient_id, $name, 
					$dob, $gender, $address, $city, $state, $country, $postal_code, 
					$mother_name, $emergency_contact, $home_phone, $work_phone, 
					$mobile_phone, $email, $marital_status, $religion, $language, $race, $ethnicity) {
		
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
            $result = $this->db->count_all('patient');

            if($result<=9){
                $query = "USR-00000" . $result;
            } else if($result<=99){
                $query = "USR-0000" . $result;
            } else if($result<=999){
                $query = "USR-000" . $result;
            } else if($result<=9999){
                $query = "USR-00" . $result;
            } else if($result<=99999){
                $query = "USR-0" . $result;
            } else if($result<=999999){
                $query = "USR-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('patient', $data);
        }

        public function Read_specific($patient_id){
            $this->db->select('*');
            $this->db->from('patient');
            $this->db->join('patient_detail', 'patient_detail.patient_id = patient.patient_id');
            $this->db->join('patient_contact', 'patient_contact.patient_id = patient.patient_id');
            $this->db->where('patient.patient_id', $patient_id);
            return $this->db->get();
        }

        public function Update($patient_id, $name, 
					$dob, $gender, $address, $city, $state, $country, $postal_code, 
					$mother_name, $emergency_contact, $home_phone, $work_phone, 
					$mobile_phone, $email, $marital_status, $religion, $language, $race, $ethnicity){

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

            $this->Redirect();
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