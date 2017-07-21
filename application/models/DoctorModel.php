<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * DoctorModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
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

        public function create_doctor() {
		
            $doctor_id = $this->input->post('doctor_id');
			$clinic_id    = $this->input->post('clinic_id');
			$name = $this->input->post('name');
			$gender = $this->input->post('gender');
			$dob = $this->input->post('dob');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');

            $data = array(
                'doctor_id'   => $doctor_id,
                'clinic_id'   => $clinic_id,
                'name'      => $name,
                'gender'      => $gender,
                'dob'      => $dob,
                'address'      => $address,
                'phone'      => $phone,
                'created_at' => date('Y-m-j H:i:s'),
            );
            
            return $this->db->insert('doctor', $data);
		
	    }

        public function generate_id(){
            $result = $this->db->count_all('doctor');

            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->doctor_id_prefix;

            if($result<=9){
                $query = $prefix."-000" . $result;
            } else if($result<=99){
                $query = $prefix."-00" . $result;
            } else if($result<=999){
                $query = $prefix."-0" . $result;
            } else if($result<=9999){
                $query = $prefix."-" . $result;
            }

            return $query;
        }

        public function Read_specific($doctor_id){
            $this->db->select('*');
            $this->db->from('doctor');
            $this->db->where('doctor_id', $doctor_id);
            return $this->db->get();
        }

        public function Read_doctorname($doctor_id){
            $this->db->select('*');
            $this->db->from('doctor');
            $this->db->where('doctor_id', $doctor_id);
            $query = $this->db->get();
            $ret = $query->row();
            return $ret->name;
        }

        public function Update(){
            
            $doctor_id = $this->input->post('doctor_id');
			$clinic_id    = $this->input->post('clinic_id');
			$name = $this->input->post('name');
			$gender = $this->input->post('gender');
			$dob = $this->input->post('dob');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');


            $data = array(
                'doctor_id'   => $doctor_id,
			    'clinic_id'   => $clinic_id,
			    'name'      => $name,
                'gender'      => $gender,
                'dob'      => $dob,
                'address'      => $address,
                'phone'      => $phone,
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