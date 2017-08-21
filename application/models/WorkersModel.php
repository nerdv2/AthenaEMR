<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkersModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class WorkersModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/workers_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('worker');
            $query = $this->db->get();
            return $query->result();
        }

        public function create_workers() {

            $worker_id = $this->input->post('worker_id');
			$name    = $this->input->post('name');
			$gender = $this->input->post('gender');
			$role = $this->input->post('role');
			$dob = $this->input->post('dob');
			$address = $this->input->post('address');
		
            $data = array(
                'worker_id'   => $worker_id,
                'name'   => $name,
                'gender'      => $gender,
                'role'      => $role,
                'dob'      => $dob,
                'address'      => $address,
                'created_at' => date('Y-m-j H:i:s'),
            );
            
            return $this->db->insert('worker', $data);
		
	    }

        public function generate_id(){
            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->worker_id_prefix;

            $iddata = $this->extfnc->id_generate(4);
            
            $query = $prefix . "-". $iddata;

            return $query;
        }

        public function Read_specific($worker_id){
            $this->db->select('*');
            $this->db->from('worker');
            $this->db->where('worker_id', $worker_id);
            return $this->db->get();
        }

        public function Update(){

            $worker_id = $this->input->post('worker_id');
			$name    = $this->input->post('name');
			$gender = $this->input->post('gender');
			$role = $this->input->post('role');
			$dob = $this->input->post('dob');
			$address = $this->input->post('address');
            
            $data = array(
                'name'   => $name,
                'gender'      => $gender,
                'role'      => $role,
                'dob'      => $dob,
                'address'      => $address,
                'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("worker_id", $worker_id);
            $this->db->update("worker",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('worker');
	    }
        
        
    }
?>