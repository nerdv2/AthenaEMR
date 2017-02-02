<?php
    class UsersModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/users_view"));
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

        public function create_user($username, $password, $status, $doctor_id, $worker_id, $photo) {
		
            $data = array(
                'username'   => $username,
                'password_hash'   => $this->hash_password($password),
                'status'      => $status,
                'created_at' => date('Y-m-j H:i:s'),
                'photo'     => $photo,
            );
            
            return $this->db->insert('user', $data);
            
        }

        public function create_user_doctor($username, $password, $status, $doctor_id, $photo) {
		
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

        public function create_user_worker($username, $password, $status, $worker_id, $photo) {
		
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

        public function Insert($data){
            $this->db->insert('user', $data);
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_user', $NIS);
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
            $this->Redirect();
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
            $this->Redirect();
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
            $this->Redirect();
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