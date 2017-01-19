<?php
    class MedicineTypeModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/medicine_type_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('medicine_type');
            $query = $this->db->get();
            return $query->result();
        }

        public function create_medicine($type_id,$name) {
		
		$data = array(
            'type_id'   => $type_id,
            'name'   => $name,
            'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('medicine_type', $data);
		
	    }

        public function generate_id(){
            $result = $this->db->count_all('medicine_type');

            if($result<=9){
                $query = "TYP-000" . $result;
            } else if($result<=99){
                $query = "TYP-00" . $result;
            } else if($result<=999){
                $query = "TYP-0" . $result;
            } else if($result<=9999){
                $query = "TYP-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('medicine_type', $data);
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('medicine_type');
            $this->db->where('type_id', $NIS);
            return $this->db->get();
        }

        public function Update($type_id,$name){
            
            $data = array(
               'type_id'   => $type_id,
                'name'   => $name,
                'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("type_id", $type_id);
            $this->db->update("medicine_type",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('medicine_type');
	    }
        
        
    }
?>