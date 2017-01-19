<?php
    class EMRModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/emr_view"));
        }

        public function getData(){
            $this->db->select("*");
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
            $query->free_result();
            return $data;
        }

        public function getRegisterID(){
            $data = array();
            $query = $this->db->get('registration');
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

        public function getLabResultID(){
            $data = array();
            $query = $this->db->get('lab_result');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
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
            $query->free_result();
            return $data;
        }

        public function getRegistrationDoctor($id)
        {  
            $this->db->where('register_id',$id);
            $query = $this->db->get('registration');
            $ret = $query->row();
            return $ret->doctor_id;
        }

        public function getRegistrationPatient($id)
        {  
            $this->db->where('register_id',$id);
            $query = $this->db->get('registration');
            $ret = $query->row();
            return $ret->patient_id;
        }

        public function create_emr($record_id, $doctor_id, 
				$register_id, $patient_id, $complaint, $symptoms,$diagnosis,$handling) {
		
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
		);
		
		return $this->db->insert('medical_record', $data);
		
	    }
        
        public function generate_id(){
            $today = date("Y-m-d");
            $this->db->where('time', $today);
            $this->db->from('medical_record');
            $result = $this->db->count_all_results();
            $date = date("dmy");
            
            if($result<=9){
                $query = "REC-". $date ."-000" . $result;
            } else if($result<=99){
                $query = "REC-". $date ."-00" . $result;
            } else if($result<=999){
                $query = "REC-". $date ."-0" . $result;
            } else if($result<=9999){
                $query = "REC-". $date ."-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('medical_record', $data);
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('medical_record');
            $this->db->where('record_id', $NIS);
            return $this->db->get();
        }

        public function getrecord_report($patient_id, $start, $end){
            $dataquery = "CALL getRecordMonth(?, ?, ?)";
            $execute = $this->db->query($dataquery,array($patient_id, $start, $end));
            return $execute->result();
        }

        public function Update($record_id, $doctor_id, 
				$register_id, $patient_id, $lab_id, $result_id, $prescription_id, $complaint, $symptoms,$diagnosis,$handling){
            
                $data = array(
                'record_id'   => $record_id,
                'doctor_id'   => $doctor_id,
                'register_id'      => $register_id,
                'patient_id'      => $patient_id,
                'time' => date('Y-m-j H:i:s'),
                'lab_id'      => $lab_id,
                'result_id'      => $result_id,
                'prescription_id'      => $prescription_id,
                'complaint'      => $complaint,
                'symptoms'      => $symptoms,
                'diagnosis'    => $diagnosis,
                'handling'    => $handling,
            );

            $this->db->where("record_id", $record_id);
            $this->db->update("medical_record",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('medical_record');
	    }
        
        
    }
?>