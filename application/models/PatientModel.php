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

        public function getPatientLab($id){
            $dataquery = "CALL getPatientLab(?)";
            $execute = $this->db->query($dataquery,array($id));
            $resultdata = $execute->result();
            $execute->next_result();
            $execute->free_result();
            return $resultdata;
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
				$dob, $gender, $address, $phone) {
		
		$data = array(
			'patient_id'   => $patient_id,
			'name'   => $name,
			'dob'      => $dob,
            'gender'      => $gender,
            'address'      => $address,
            'phone'      => $phone,
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('patient', $data);
		
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

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('patient');
            $this->db->where('patient_id', $NIS);
            return $this->db->get();
        }

        public function Update($patient_id, $name, 
				$dob, $gender, $address, $phone){
            
            $data = array(
                'patient_id'   => $patient_id,
			    'name'   => $name,
			    'dob'      => $dob,
                'gender'      => $gender,
                'address'      => $address,
                'phone'      => $phone,
                'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("patient_id", $patient_id);
            $this->db->update("patient",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('patient');
	    }
        
        
    }
?>