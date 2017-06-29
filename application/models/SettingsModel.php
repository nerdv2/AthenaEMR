<?php
    class SettingsModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/"));
        }

        public function getData(){
            $this->db->select('*');
            $this->db->from('app_settings');
            $this->db->where('id', 1);
            return $this->db->get();
        }

    }
?>