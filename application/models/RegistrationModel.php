<?php
    class RegistrationModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/registration_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('registration');
            $query = $this->db->get();
            return $query->result();
        }

        public function getWorkerID(){
            $data = array();
            $this->db->select("*");
            $this->db->from('worker');
            $this->db->where('role', 'registration');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
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
            $query->free_result();
            return $data;
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

        public function getDoctorID(){
            $data = array();
            $query = $this->db->get('doctor');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
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
            $query->free_result();
            return $data;
        }

        public function get_entrynumber($clinic_id){
            $this->db->where('clinic_id',$clinic_id);
            $this->db->from('getregistertoday');
            $result = $this->db->count_all_results();

            return $result;
        }

        public function create_registration($register_id, $worker_id, 
				$patient_id, $clinic_id, $doctor_id, $category, $patient_type) {
		
        $entrynumber = $this->get_entrynumber($clinic_id);

		$data = array(
			'register_id'   => $register_id,
			'worker_id'   => $worker_id,
			'patient_id'      => $patient_id,
            'clinic_id'      => $clinic_id,
            'doctor_id'      => $doctor_id,
            'category'      => $category,
			'time' => date('Y-m-j H:i:s'),
            'entry_no'    => $entrynumber,
            'patient_type'  => $patient_type,
		);
		
		return $this->db->insert('registration', $data);
		
	    }


        public function getmonth_report($start, $end){
            $dataquery = "CALL getRegistrationMonth(?, ?)";
            $execute = $this->db->query($dataquery,array($start, $end));
            return $execute;
        }

        public function getvisit_month_excel($start, $end, $doctor_id){
            $dataquery = "CALL getPatientMonth(?, ?, ?)";
            $execute = $this->db->query($dataquery,array($start, $end, $doctor_id));
            return $execute;
        }

        public function getvisit_month($start, $end, $doctor_id){
            $dataquery = "CALL getPatientMonth(?, ?, ?)";
            $execute = $this->db->query($dataquery,array($start, $end, $doctor_id));
            return $execute->result();
        }

        public function generate_id(){
            $today = date("Y-m-d");
            $this->db->where('time', $today);
            $this->db->from('registration');
            $result = $this->db->count_all_results();
            $date = date("dmy");
            
            if($result<=9){
                $query = "REG-". $date ."-000" . $result;
            } else if($result<=99){
                $query = "REG-". $date ."-00" . $result;
            } else if($result<=999){
                $query = "REG-". $date ."-0" . $result;
            } else if($result<=9999){
                $query = "REG-". $date ."-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('registration', $data);
        }

        public function Read_specific($id){
            $this->db->select('*');
            $this->db->from('registration');
            $this->db->where('register_id', $id);
            return $this->db->get();
        }


        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('registration');
	    }
        
        
    }
?>