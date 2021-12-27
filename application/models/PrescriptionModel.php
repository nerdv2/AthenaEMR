<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PrescriptionModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class PrescriptionModel extends CI_Model {

        public function redirect(){
            redirect(base_url("prescription"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('prescription');
            $query = $this->db->get();
            return $query->result();
        }

        public function getMedicineInfo($prescription_id){
            $this->db->select("*");
            $this->db->from('getprescriptionprice');
            $this->db->where('prescription_id', $prescription_id);
            $query = $this->db->get();
            return $query->result();
        }

        public function getMedicineUsage($prescription_id){
            $this->db->select("*");
            $this->db->from('prescription_detail');
            $this->db->where('prescription_id', $prescription_id);
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
            $query->result();
            return $data;
        }

        public function getWorkerID($iddata){
            $data = array();
            $this->db->select("*");
            $this->db->from('worker');
            $this->db->where('role', 'pharmacist');
            $this->db->where('worker_id', $iddata);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
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
            $query->result();
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

        public function create_prescription_detail_batch($prescription_id, $medicine_id, $dosage, $amount, $total, $usage){
            $count = count($medicine_id);

            $databatch = array();
            for($i=0; $i<$count; $i++) {

                $databatch[$i] = array(
                    'prescription_id'   => $prescription_id,
                    'medicine_id'   => $medicine_id[$i],
                    'dosage'      => $dosage[$i],
                    'amount'      => $amount[$i],
                    'total'      => $total[$i],
                    'usage'      => $usage[$i],
                );

            }
            
            return $this->db->insert_batch('prescription_detail', $databatch);
        }
        
        public function update_medicalrecord($record_id, $prescription_id){
            $data = array(
                'prescription_id'   => $prescription_id,
            );

            $this->db->where("record_id", $record_id);
            $this->db->update("medical_record",$data);
            $this->redirect();
        }

        public function generate_id(){
            $date = date("dmy");

            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->prescription_id_prefix;
            
            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $date ."-" . $iddata;

            return $query;
        }

        public function Read_specific($prescription_id){
            $dataquery = "CALL getPrescription(?)";
            $execute = $this->db->query($dataquery,array($prescription_id));
            $ret = $execute->row();
            $execute->next_result();
            $execute->result();
            return $ret;
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

            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('prescription');

            //$this->db->where($data);
            //$this->db->delete('prescription_detail');
	    }
        
        
    }
?>