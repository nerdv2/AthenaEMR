<?php
    class PaymentModel extends CI_Model {

        public function Redirect(){
            redirect(base_url("index.php/athenaMain/payment_view"));
        }

        public function getData(){
            $this->db->select("*");
            $this->db->from('payment');
            $query = $this->db->get();
            return $query->result();
        }

        public function getRegisterID(){
            $data = array();
            $query = $this->db->get('registration');
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row){
                        $data[] = $row;
                    }
            }
            $query->free_result();
            return $data;
        }

        public function getWorkerID(){
            $data = array();
            $query = $this->db->get('worker');
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

        public function create_payment($payment_id, $register_id, 
				$worker_id, $type, $amount) {
		
		$data = array(
			'payment_id'   => $payment_id,
			'register_id'   => $register_id,
			'worker_id'      => $worker_id,
            'type'      => $type,
            'amount'      => $amount,
			'time' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('payment', $data);

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