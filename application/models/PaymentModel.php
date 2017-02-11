<?php
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
            $this->db->from('getpaymenttoday');
            $result = $this->db->count_all_results();

            return $result;
        }

        public function create_payment($payment_id, $register_id, 
				$worker_id, $type) {
		
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

        public function update_register($register_id){
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
            
            if($result<=9){
                $query = "PAY-". $date ."-000" . $result;
            } else if($result<=99){
                $query = "PAY-". $date ."-00" . $result;
            } else if($result<=999){
                $query = "PAY-". $date ."-0" . $result;
            } else if($result<=9999){
                $query = "PAY-". $date ."-" . $result;
            }

            return $query;
        }

        public function Insert($data){
            $this->db->insert('payment', $data);
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