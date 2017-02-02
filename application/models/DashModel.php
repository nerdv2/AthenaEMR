<?php
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
    }
?>