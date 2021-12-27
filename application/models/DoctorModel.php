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

        public function redirect(){
            redirect(base_url("doctor"));
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
            $query->result();
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
            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->doctor_id_prefix;

            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $iddata;

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
            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('doctor');
	    }
        
        
    }
?>