<?php
    class LabModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/lab_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('lab');
            $query = $this->db->get();
            return $query->result();
        }

        public function create_lab($lab_id, $name, 
				$tariff) {
		
		$data = array(
			'lab_id'   => $lab_id,
			'name'   => $name,
			'tariff'      => $tariff,
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('lab', $data);
		
	    }

        public function generate_id(){
            $result = $this->db->count_all('lab');

            if($result<=9){
                $query = "LAB-000" . $result;
            } else if($result<=99){
                $query = "LAB-00" . $result;
            } else if($result<=999){
                $query = "LAB-0" . $result;
            } else if($result<=9999){
                $query = "LAB-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('lab', $data);
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('lab');
            $this->db->where('lab_id', $NIS);
            return $this->db->get();
        }

        public function Update($lab_id, $name, 
				$tariff){
            
           
		$data = array(
			'lab_id'   => $lab_id,
			'name'   => $name,
			'tariff'      => $tariff,
			'updated_at' => date('Y-m-j H:i:s'),
		);

            $this->db->where("lab_id", $lab_id);
            $this->db->update("lab",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('lab');
	    }
        
        
    }
?>