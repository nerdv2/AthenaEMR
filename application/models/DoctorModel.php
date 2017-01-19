<?php
    class DoctorModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/doctor_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('doctor');
            $query = $this->db->get();
            return $query->result();
        }

        public function getClinicID(){
            $data = array();
            $query = $this->db->get('clinic');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function create_doctor($doctor_id, $clinic_id, 
				$name, $gender, $dob, $address, $phone, $photo) {
		
		$data = array(
			'doctor_id'   => $doctor_id,
			'clinic_id'   => $clinic_id,
			'name'      => $name,
            'gender'      => $gender,
            'dob'      => $dob,
            'address'      => $address,
            'phone'      => $phone,
            'photo'      => $photo,
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('doctor', $data);
		
	    }

        public function generate_id(){
            $result = $this->db->count_all('doctor');

            if($result<=9){
                $query = "DOC-000" . $result;
            } else if($result<=99){
                $query = "DOC-00" . $result;
            } else if($result<=999){
                $query = "DOC-0" . $result;
            } else if($result<=9999){
                $query = "DOC-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('doctor', $data);
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('doctor');
            $this->db->where('doctor_id', $NIS);
            return $this->db->get();
        }

        public function Update($doctor_id, $clinic_id, 
				$name, $gender, $dob, $address, $phone, $photo){
            
            $data = array(
                'doctor_id'   => $doctor_id,
			    'clinic_id'   => $clinic_id,
			    'name'      => $name,
                'gender'      => $gender,
                'dob'      => $dob,
                'address'      => $address,
                'phone'      => $phone,
                'photo'      => $photo,
			    'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("doctor_id", $doctor_id);
            $this->db->update("doctor",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('doctor');
	    }
        
        
    }
?>