<?php
    class MedicineModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/medicine_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('medicine');
            $query = $this->db->get();
            return $query->result();
        }

        public function getMedicineTypeID(){
            $data = array();
            $query = $this->db->get('medicine_type');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function create_medicine() {

            $medicine_id = $this->input->post('medicine_id');
			$type_id    = $this->input->post('type_id');
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$price    = $this->input->post('price');
			$amount = $this->input->post('amount');
		
            $data = array(
                'medicine_id'   => $medicine_id,
                'type_id'   => $type_id,
                'name'   => $name,
                'description'   => $description,
                'price'   => $price,
                'amount'      => $amount,
                'created_at' => date('Y-m-j H:i:s'),
            );
            
            return $this->db->insert('medicine', $data);
            
        }

        public function generate_id(){
            $result = $this->db->count_all('medicine');

            if($result<=9){
                $query = "MED-000" . $result;
            } else if($result<=99){
                $query = "MED-00" . $result;
            } else if($result<=999){
                $query = "MED-0" . $result;
            } else if($result<=9999){
                $query = "MED-" . $result;
            }

            return $query;
        }

        public function Read_specific($NIS){
            $this->db->select('*');
            $this->db->from('medicine');
            $this->db->where('medicine_id', $NIS);
            return $this->db->get();
        }

        public function Update(){

            $medicine_id = $this->input->post('medicine_id');
			$type_id    = $this->input->post('type_id');
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$price    = $this->input->post('price');
			$amount = $this->input->post('amount');
            
            $data = array(
                'medicine_id'   => $medicine_id,
                'type_id'   => $type_id,
                'name'   => $name,
                'description'   => $description,
			    'price'   => $price,
			    'amount'      => $amount,
                'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("medicine_id", $medicine_id);
            $this->db->update("medicine",$data);
            $this->Redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('medicine');
	    }
        
        
    }
?>