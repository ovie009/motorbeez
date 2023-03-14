<?php
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		
			if(!empty($data['package_id'])){
			$package_id = $data['package_id'];
		} else{
			$package_id = '';
		}
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET package_id = '" . (int)$package_id ."', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',  ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '1', date_added = NOW()");

		$customer_id = $this->db->getLastId();

	//plans start
		$payment_status = $this->config->get('pp_standard_status');
		
	if(!empty($payment_status)) {
		if(!empty($data['package_id'])) {
		$plansinfo = $this->getPlan($data['package_id']);

		if(isset($plansinfo['no_of_day'])){
			$dayofreturn = $plansinfo['no_of_day'];
		} 
		if(isset($plansinfo['type'])){
			$daytype = $plansinfo['type'];
		} else{
			$daytype = '';
		}

		if(!empty($plansinfo['package_name'])){
			$package_name = $plansinfo['package_name'];
		} else{
			$package_name = $plansinfo['package_name'];
		}
		if(isset($plansinfo['price'])){
			$price = $plansinfo['price'];
		} else {
			$price = '';
		}
		$currentdate = date("Y-m-d");
		$orderdate = date('Y-m-d', strtotime($currentdate));
		$datesss   = strtotime("+".$dayofreturn." $daytype ", strtotime($orderdate));
		$expirydate=date("Y-m-d", $datesss);
         $currency_code=$this->config->get('config_currency');
		$this->db->query("INSERT INTO " .DB_PREFIX . "classified_paid_package SET  customer_id = '".$customer_id."', package_id = '" . (int)$data['package_id'] ."', package_name = '" . $this->db->escape($package_name) . "', price = '" . (int)$price ."',expirydate='".$expirydate."',startdate='".$currentdate."',currency_code='".$currency_code."'");
		}
	}

	//plans end

		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		$message .= $this->language->get('text_login') . "\n";
		 

		$message .= $this->url->link('classified/login', '', true) . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		return $customer_id;
	}

	public function editCustomer($data) {
		$customer_id = $this->customer->getId();
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image ='".$this->db->escape($data['image'])."', profile_text  = '" .$this->db->escape($data['profile_text'])."', telephone = '" . $this->db->escape($data['telephone']) . "', address = '" . $this->db->escape($data['address']) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		
		if ($data['password']) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		}

	}



	public function renewpackage($data){
		if($data['package_id']){
			$package_id =  $data['package_id'];
		}else {
			$package_id = ''; 
		}

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET package_id = '" . (int)$package_id . "'  WHERE customer_id = '" . (int)$this->customer->getId() . "'");

	//plans start		
		$plansinfo = $this->getPlan($package_id);

		if(isset($plansinfo['no_of_day'])){
			$dayofreturn = $plansinfo['no_of_day'];
		} 

		if(isset($plansinfo['type'])){
			$daytype = $plansinfo['type'];
		} 

		if(isset($plansinfo['package_name'])){
			$name = $plansinfo['package_name'];
		} 

		if(isset($plansinfo['price'])){
			$price = $plansinfo['price'];
		} else {
			$price = '';
		}
		if(isset($plansinfo['package_name'])){
			$package_name = $plansinfo['package_name'];
		} else {
			$package_name = '';
		}

		$currentdate = date("Y-m-d");
		$orderdate = date('Y-m-d', strtotime($currentdate));
		$datesss   = strtotime("+".$dayofreturn." $daytype ", strtotime($orderdate));
		$expirydate=date("Y-m-d", $datesss);
         $currency_code=$this->config->get('config_currency');
         $this->db->query("DELETE FROM " . DB_PREFIX . "classified_paid_package WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		$this->db->query("INSERT INTO " .DB_PREFIX . "classified_paid_package SET  customer_id = '".(int)$this->customer->getId()."', package_id = '" . (int)$package_id ."', package_name = '" . $this->db->escape($package_name) . "', price = '" . (int)$price ."', expirydate='".$expirydate."', startdate='".$currentdate."', currency_code='".$currency_code."', date_added = NOW()");
		$this->db->query("UPDATE " . DB_PREFIX . "classified SET active = '1' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

	//plans end

	}

	public function editPassword($email, $password) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}


	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomerByCode($code) {
		$query = $this->db->query("SELECT customer_id, firstname, lastname, email FROM `" . DB_PREFIX . "customer` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");

		return $query->row;
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}


	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

//plans
	public function getPlans() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_package` WHERE package_id<>0 AND status='1'");
		return $query->rows;
	}
	public function getPlan($package_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_package` WHERE package_id = '" . (int)$package_id . "' AND status='1'");
		return $query->row;
	}

	public function getcompleteOrderStatuse($customer_id){
		$sql="select * from " . DB_PREFIX . "classified_paid_package where customer_id='".$customer_id."' and order_status_id='5'";
		$query=$this->db->query($sql);
		return $query->row;
	}

	public function getOrderStatuse($order_status_id){
		$sql="select * from " . DB_PREFIX . "order_status where order_status_id='".$order_status_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}

	public function getpackage($package_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_package` WHERE package_id = '" . (int)$package_id . "' AND status='1'");
		return $query->row;
	}


	public function Customerplanexpiry() {
		$currentdate = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_paid_package` WHERE expirydate < '" . $currentdate . "'");
		if(!empty($query->rows)){
		$customers = $query->rows;
		}else{
		$customers=array();	
		}
		if(!empty($customers)){
			foreach ($customers as $customer) {
			$this->db->query("UPDATE " . DB_PREFIX . "classified SET active = '0' WHERE customer_id = '" . (int)$customer['customer_id'] . "'");
			}
		}
	}


	public function addPaymentHistory($customer_id,$order_status_id,$notify = false) {
		
		$sql="update " . DB_PREFIX . "classified_paid_package set  order_status_id = '".$order_status_id."' where customer_id='".$customer_id."'";
	    $query = $this->db->query($sql);
		
		/// customer table status
		  $this->db->query("UPDATE `" . DB_PREFIX . "customer` SET payment_status = '1' where customer_id='".$customer_id."'");
		
   }

   public function getPackageprice($customer_id){
		$sql="select * from " . DB_PREFIX . "classified_paid_package where customer_id='".$customer_id."'";
		$query=$this->db->query($sql);
		return $query->row;

	}

}
