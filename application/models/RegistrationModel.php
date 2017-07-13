<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * RegistrationModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class RegistrationModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/registration_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('getregistertoday');
            $query = $this->db->get();
            return $query->result();
        }

        public function getWorkerID($iddata){
            $data = array();
            $this->db->select("*");
            $this->db->from('worker');
            $this->db->where('role', 'registration');
            $this->db->where('worker_id', $iddata);
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

        public function getDoctorReportID(){
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

        public function getDoctorID($cid=NULL){
            $result = $this->db->where('clinic_id', $cid)->get('doctor')->result();
            $id = array('0');
            $name = array('Select Doctor');
            for ($i=0; $i<count($result); $i++)
            {
                array_push($id, $result[$i]->doctor_id);
                array_push($name, $result[$i]->doctor_id . " - " . $result[$i]->name);
            }
            return array_combine($id, $name);
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
		
        //$entrynumber = $this->get_entrynumber($clinic_id);
        //$entrynumber++;

		$data = array(
			'register_id'   => $register_id,
			'worker_id'   => $worker_id,
			'patient_id'      => $patient_id,
            'clinic_id'      => $clinic_id,
            'doctor_id'      => $doctor_id,
            'category'      => $category,
			'time' => date('Y-m-j H:i:s'),
            //'entry_no'    => $entrynumber,
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
            $ret = $execute->result();
            $execute->next_result();
            $execute->free_result();
            return $ret;
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