<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PaymentModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class PaymentModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/payment_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('getpaymenttoday');
            $query = $this->db->get();
            return $query->result();
        }

        public function getRegisterID(){
            $data = array();
            $query = $this->db->get('getregistertoday');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getPrescriptionID(){
            $data = array();
            $query = $this->db->get('prescription');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getResultID(){
            $data = array();
            $query = $this->db->get('lab_result');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getWorkerID($iddata){
            $data = array();
            $this->db->select("*");
            $this->db->from('worker');
            $this->db->where('role', 'payment');
            $this->db->where('worker_id', $iddata);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getInvoiceData($UID){
            $dataquery = "CALL getInvoice(?)";
            $execute = $this->db->query($dataquery,array($UID));
            return $execute;
        }

        public function get_entrynumber($clinic_id){
            $this->db->where('clinic_id',$clinic_id);
            $this->db->from('showentrydata');
            $result = $this->db->count_all_results();

            return $result;
        }

        public function create_payment_medicine() {

            $payment_id = $this->input->post('payment_id');
			$prescription_id    = $this->input->post('prescription_id');
			$worker_id = $this->input->post('worker_id');

            $amount = $this->getPrescriptionAmount($prescription_id);
            $register_id = $this->getPrescriptionRegistration($prescription_id);

            $data = array(
                'payment_id'   => $payment_id,
                'register_id'   => $register_id,
                'worker_id'      => $worker_id,
                'type'      => "medicine",
                'amount'      => $amount,
                'time' => date('Y-m-j H:i:s'),
            );
            
            return $this->db->insert('payment', $data);

        }

        public function create_lab_payment() {

            $payment_id = $this->input->post('payment_id');
			$result_id    = $this->input->post('result_id');
			$worker_id = $this->input->post('worker_id');
            
            $amount = $this->getLabAmount($result_id);
            $register_id = $this->getLabRegistration($result_id);

            $data = array(
                'payment_id'   => $payment_id,
                'register_id'   => $register_id,
                'worker_id'      => $worker_id,
                'type'      => "lab",
                'amount'      => $amount,
                'time' => date('Y-m-j H:i:s'),
            );
            
            return $this->db->insert('payment', $data);
        }

        public function create_payment() {

            $payment_id = $this->input->post('payment_id');
			$register_id    = $this->input->post('register_id');
			$worker_id = $this->input->post('worker_id');
			$type = $this->input->post('type');
		
            $amount = $this->getAmount($register_id);
            

            $getnew = $this->check_new_registration($register_id);
            $total = $getnew + $amount;

            $clinic_id = $this->getClinicRegistration($register_id);

            $entrynumber = $this->get_entrynumber($clinic_id);
            $entrynumber++;

            $info = "";
            if($getnew > 0){
                $info = "new";
            } else if($getnew <= 0){
                $info = "";
            }

            $data = array(
                'payment_id'   => $payment_id,
                'register_id'   => $register_id,
                'worker_id'      => $worker_id,
                'type'      => $type,
                'amount'      => $total,
                'time' => date('Y-m-j H:i:s'),
                'info' => $info,
                'entry_no'    => $entrynumber,
            );
            
            return $this->db->insert('payment', $data);

	    }

        public function getClinicRegistration($register_id){
            $this->db->select('*');
            $this->db->from('registration');
            $this->db->where('register_id', $register_id);

            $query = $this->db->get();
            $ret = $query->row();
            $type = $ret->clinic_id;
            return $type;
        }

        public function getAmount($register_id){
            $dataquery = "CALL getAmount(?)";
            $execute = $this->db->query($dataquery,array($register_id));
            $ret = $execute->row();
            $execute->next_result();
            $execute->free_result();
            $amount = $ret->tariff;
            return $amount;
        }

        public function getPrescriptionAmount($register_id){
            $dataquery = "CALL getPrescriptionRegistration(?)";
            $execute = $this->db->query($dataquery,array($register_id));
            $ret = $execute->row();
            $execute->next_result();
            $execute->free_result();
            $amount = $ret->total_price;
            return $amount;
        }

        public function getPrescriptionRegistration($register_id){
            $dataquery = "CALL getPrescriptionRegistration(?)";
            $execute = $this->db->query($dataquery,array($register_id));
            $ret = $execute->row();
            $execute->next_result();
            $execute->free_result();
            $register = $ret->register_id;
            return $register;
        }

        public function getLabAmount($result_id){
            $amount = 0;
            $this->db->select('*');
            $this->db->from('getlabprice');
            $this->db->where('result_id', $result_id);

            $query = $this->db->get();
            $ret = $query->row();
            $type = $ret->tariff;
            
            return $type;
        }

        public function getLabRegistration($result_id){
            $amount = 0;
            $this->db->select('*');
            $this->db->from('getlabprice');
            $this->db->where('result_id', $result_id);

            $query = $this->db->get();
            $ret = $query->row();
            $type = $ret->register_id;
            
            return $type;
        }

        public function check_new_registration($register_id){
            $amount = 0;
            $this->db->select('*');
            $this->db->from('registration');
            $this->db->where('register_id', $register_id);

            $query = $this->db->get();
            $ret = $query->row();
            $type = $ret->patient_type;
            if($type === "0"){
                $amount = 0;
            } else if($type === "1") {
                $amount = 15000;
            }
            return $amount;
        }

        public function update_register(){

            $register_id    = $this->input->post('register_id');

            $data = array(
                'patient_type'   => 0,
            );

            $this->db->where("register_id", $register_id);
            $this->db->update("registration",$data);
            $this->Redirect();
        }

        public function generate_id(){
            $today = date("Y-m-d");
            $this->db->where('time', $today);
            $this->db->from('payment');
            $result = $this->db->count_all_results();
            $date = date("dmy");

            $getprefix = $this->db->get('app_settings')->row();
            $prefix = $getprefix->payment_id_prefix;
            
            if($result<=9){
                $query = $prefix . "-". $date ."-000" . $result;
            } else if($result<=99){
                $query = $prefix . "-". $date ."-00" . $result;
            } else if($result<=999){
                $query = $prefix . "-". $date ."-0" . $result;
            } else if($result<=9999){
                $query = $prefix . "-". $date ."-" . $result;
            }

            return $query;
        }


        public function Read_specific($id){
            $this->db->select('*');
            $this->db->from('payment');
            $this->db->where('payment_id', $id);
            return $this->db->get();
        }


        public function Delete($data){
		    $this->db->where($data);
		    $this->db->delete('payment');
	    }
        
        
    }
?>