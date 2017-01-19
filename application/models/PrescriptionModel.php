<?php
    class PrescriptionModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/prescription_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('prescription');
            $query = $this->db->get();
            return $query->result();
        }

        public function getRecordID(){
            $data = array();
            $query = $this->db->get('medical_record');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getWorkerID(){
            $data = array();
            $query = $this->db->get('worker');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getMedicineID(){
            $data = array();
            $query = $this->db->get('medicine');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function create_prescription($prescription_id, $record_id, 
				$worker_id, $description) {
		
                $data = array(
                    'prescription_id'   => $prescription_id,
                    'record_id'   => $record_id,
                    'worker_id'      => $worker_id,
                    'time' => date('Y-m-j H:i:s'),
                    'description'      => $description,
                );

            return $this->db->insert('prescription', $data);

            
        }

        public function create_prescription_detail($prescription_id, $medicine_id, $dosage, $amount, $total, $usage){
            $data2 = array(
                'prescription_id'   => $prescription_id,
                'medicine_id'   => $medicine_id,
                'dosage'      => $dosage,
                'amount'      => $amount,
                'total'      => $total,
                'usage'      => $usage,
            );
            
            return $this->db->insert('prescription_detail', $data2);
        }
        
        public function update_medicalrecord($record_id, $prescription_id){
            $data = array(
                'prescription_id'   => $prescription_id,
            );

            $this->db->where("record_id", $record_id);
            $this->db->update("medical_record",$data);
            $this->Redirect();
        }

        public function generate_id(){
            $today = date("Y-m-d");
            $this->db->where('time', $today);
            $this->db->from('prescription');
            $result = $this->db->count_all_results();
            $date = date("dmy");
            
            if($result<=9){
                $query = "PSC-". $date ."-000" . $result;
            } else if($result<=99){
                $query = "PSC-". $date ."-00" . $result;
            } else if($result<=999){
                $query = "PSC-". $date ."-0" . $result;
            } else if($result<=9999){
                $query = "PSC-". $date ."-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('prescription', $data);
        }

        public function Read_specific($NIS){
            $dataquery = "CALL getPrescription(?)";
            $execute = $this->db->query($dataquery,array($NIS));
            return $execute;
        }

        public function Update($prescription_id, $record_id, 
				$worker_id, $description){
            
            $data = array(
                'prescription_id'   => $prescription_id,
                'record_id'   => $record_id,
                'worker_id'      => $worker_id,
                'time' => date('Y-m-j H:i:s'),
                'description'      => $description,
            );

            

            $this->db->where("prescription_id", $prescription_id);
            $this->db->update("prescription",$data);

        }

        public function UpdateDetail($prescription_id, $medicine_id, $dosage, $amount, $total, $usage){

            $data2 = array(
                'prescription_id'   => $prescription_id,
                'medicine_id'   => $medicine_id,
                'dosage'      => $dosage,
                'amount'      => $amount,
                'total'      => $total,
                'usage'      => $usage,
            );


            $this->db->where("prescription_id", $prescription_id);
            $this->db->update("prescription_detail",$data2);

            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('prescription');

            //$this->db->where($data);
            //$this->db->delete('prescription_detail');
	    }
        
        
    }
?>