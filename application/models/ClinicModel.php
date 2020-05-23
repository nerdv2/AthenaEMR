<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ClinicModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class ClinicModel extends CI_Model {

        public function redirect(){
            redirect(base_url("index.php/clinic"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('clinic');
            $query = $this->db->get();
            return $query->result();
        }

        public function generate_id(){
            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->clinic_id_prefix;

            $iddata = bin2hex(random_bytes(6));
            
            $query = $prefix . "-". $iddata;

            return $query;
        }

        public function create_clinic() {

            $clinic_id = $this->input->post('clinic_id');
			$name    = $this->input->post('name');
			$tariff = $this->input->post('tariff');
		
            $data = array(
                'clinic_id'   => $clinic_id,
                'name'   => $name,
                'tariff'      => $tariff,
                'created_at' => date('Y-m-j H:i:s'),
            );
		
		    return $this->db->insert('clinic', $data);
		
	    }

        public function Read_specific($clinic_id){
            $this->db->select('*');
            $this->db->from('clinic');
            $this->db->where('clinic_id', $clinic_id);
            return $this->db->get();
        }

        public function Update(){

            $clinic_id = $this->input->post('clinic_id');
			$name    = $this->input->post('name');
			$tariff = $this->input->post('tariff');
            
            $data = array(
                'clinic_id'   => $clinic_id,
			    'name'   => $name,
			    'tariff'      => $tariff,
                'updated_at' => date('Y-m-j H:i:s'),
		    );

            $this->db->where("clinic_id", $clinic_id);
            $this->db->update("clinic",$data);
            $this->redirect();
        }

        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('clinic');
	    }
        
        
    }
?>