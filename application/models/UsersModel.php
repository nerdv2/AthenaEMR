<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UsersModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class UsersModel extends CI_Model {

        public function redirect(){
            redirect(base_url("index.php/users"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('user');
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
            $query->result();
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
            $query->result();
            return $data;
        }

        public function create_user() {
		
            $username = $this->input->post('username');
			$password    = $this->input->post('password');
			$status = $this->input->post('status');
			$photo = $this->input->post('photo');

            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'created_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
            );
            
            return $this->db->insert('user', $data);
            
        }

        public function create_user_doctor() {
		
            $username = $this->input->post('username');
			$password    = $this->input->post('password');
			$status = $this->input->post('status');
			$doctor_id = $this->input->post('doctor_id');
			$photo = $this->input->post('photo');

            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'doctor_id'      => $doctor_id,
                'created_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
            );
            
            return $this->db->insert('user', $data);
            
        }

        public function create_user_worker() {

            $username = $this->input->post('username');
			$password    = $this->input->post('password');
			$status = $this->input->post('status');
			$worker_id = $this->input->post('worker_id');
			$photo = $this->input->post('photo');
		
            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'worker_id'      => $worker_id,
                'created_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
            );
            
            return $this->db->insert('user', $data);
            
        }

        public function Read_specific($id_user){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_user', $id_user);
            return $this->db->get();
        }

        public function update_user($id_user,
				 $username, $password, $status, $doctor_id, $worker_id, $photo){
            
            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'doctor_id'      => $doctor_id,
                'worker_id'      => $worker_id,
                'updated_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
	    	);
            
            $this->db->where("id_user", $id_user);
            $this->db->update("user",$data);
            $this->redirect();
        }

        public function update_user_doctor($id_user,
				 $username, $password, $status, $doctor_id, $photo){
            
            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'doctor_id'      => $doctor_id,
                'updated_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
	    	);
            
            $this->db->where("id_user", $id_user);
            $this->db->update("user",$data);
            $this->redirect();
        }

        public function update_user_worker($id_user,
				 $username, $password, $status, $worker_id, $photo){
            
            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'worker_id'      => $worker_id,
                'updated_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
	    	);
            
            $this->db->where("id_user", $id_user);
            $this->db->update("user",$data);
            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('user');
	    }
        
        private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
        
    }
?>