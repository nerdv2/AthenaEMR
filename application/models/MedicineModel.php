<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MedicineModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class MedicineModel extends CI_Model {

        public function redirect(){
            redirect(base_url("medicine"));
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
            $query->result();
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
            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->medicine_id_prefix;

            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $iddata;

            return $query;
        }

        public function Read_specific($medicine_id){
            $this->db->select('*');
            $this->db->from('medicine');
            $this->db->where('medicine_id', $medicine_id);
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
            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('medicine');
	    }
        
        
    }
?>