<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * LabResultModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class LabResultModel extends CI_Model {

        public function redirect(){
            redirect(base_url("index.php/labresult"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('lab_result');
            $query = $this->db->get();
            return $query->result();
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

        public function getWorkerID($iddata){
            $data = array();
            $this->db->select("*");
            $this->db->from('worker');
            $this->db->where('role', 'lab');
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

        public function getRegisterID(){
            $data = array();
            $query = $this->db->get('registration');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->result();
            return $data;
        }

        public function create_labresult() {

            $result_id = $this->input->post('result_id');
			$worker_id    = $this->input->post('worker_id');
			$result_data = $this->input->post('result_data');
		
            $data = array(
                'result_id'   => $result_id,
                'worker_id'   => $worker_id,
                'result_data'      => $result_data,
                'time' => date('Y-m-j H:i:s'),
            );
            
            return $this->db->insert('lab_result', $data);
		
	    }

        public function update_medicalrecord(){

            $result_id = $this->input->post('result_id');
			$record_id    = $this->input->post('record_id');
			$lab_id    = $this->input->post('lab_id');

            $data = array(
                'lab_id'   => $lab_id,
                'result_id'   => $result_id,
            );

            $this->db->where("record_id", $record_id);
            $this->db->update("medical_record",$data);
            $this->redirect();
        }

        public function getLabResultData($UID){
            $dataquery = "CALL getLabResult(?)";
            $execute = $this->db->query($dataquery,array($UID));
            return $execute;
        }

        public function generate_id(){
            $date = date("dmy");

            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->result_id_prefix;
            
            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $date ."-" . $iddata;

            return $query;
        }

        public function Read_specific($result_id){
            $this->db->select('*');
            $this->db->from('lab_result');
            $this->db->where('result_id', $result_id);
            return $this->db->get();
        }

        public function Update(){

            $result_id = $this->input->post('result_id');
			$worker_id    = $this->input->post('worker_id');
			$result_data = $this->input->post('result_data');
            
            $data = array(
                'result_id'   => $result_id,
                'worker_id'   => $worker_id,
                'result_data'      => $result_data,
                'time' => date('Y-m-j H:i:s'),
            );

            $this->db->where("result_id", $result_id);
            $this->db->update("lab_result",$data);
            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('lab_result');
	    }
        
        
    }
?>