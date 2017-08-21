<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * LabModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
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

        public function create_lab() {

            $lab_id = $this->input->post('lab_id');
			$name    = $this->input->post('name');
			$tariff = $this->input->post('tariff');
		
            $data = array(
                'lab_id'   => $lab_id,
                'name'   => $name,
                'tariff'      => $tariff,
                'created_at' => date('Y-m-j H:i:s'),
            );
		
		    return $this->db->insert('lab', $data);
		
	    }

        public function generate_id(){
            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->lab_id_prefix;

            $iddata = $this->extfnc->id_generate(4);
            
            $query = $prefix . "-". $iddata;

            return $query;
        }

        public function Read_specific($lab_id){
            $this->db->select('*');
            $this->db->from('lab');
            $this->db->where('lab_id', $lab_id);
            return $this->db->get();
        }

        public function Update(){

            $lab_id = $this->input->post('lab_id');
			$name    = $this->input->post('name');
			$tariff = $this->input->post('tariff');

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