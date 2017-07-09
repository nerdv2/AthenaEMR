<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * DashModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class DashModel extends CI_Model{
        public function getNewRegister(){
            $this->db->from('getregistertoday');
            $result = $this->db->count_all_results();
            return $result;
        }

        public function getPatientTotal(){
            $this->db->from('patient');
            $result = $this->db->count_all_results();
            return $result;
        }

        public function getRegistrationTotal(){
            $this->db->from('registration');
            $result = $this->db->count_all_results();
            return $result;
        }

        public function getRegisterTotal(){
            $this->db->select("*");
            $this->db->from('getregistertotal');
            $query = $this->db->get();
            return $query->result();
        }

        public function getRegisterEntry(){
            $this->db->select("*");
            $this->db->from('getentry');
            $query = $this->db->get();
            return $query->result();
        }
    }
?>