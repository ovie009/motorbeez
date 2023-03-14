<?php
class ModelclassifiedMymessages extends Model {

	public function classifiedMsg($customer_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customer where customer_id ='".$this->customer->isLogged()."'";
		$query = $this->db->query($sql);
		return $query->row;	
	}

	public function customerNmaeGet($customer_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customer where customer_id ='".$customer_id."'";
		$query = $this->db->query($sql);
		return $query->row;	
	}

	public function classifiedMsgalls(){
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_enquiry where classified_enquiry_id<>0 and (customer_id ='".$this->customer->isLogged()."' or login_customer_id='".$this->customer->isLogged()."') ORDER BY date_added DESC";
		$query = $this->db->query($sql);
		return $query->rows;	
	}

	public function classifiedMsgall($classified_enquiry_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_enquiry_reply  where classified_enquiry_id='".$classified_enquiry_id."' ORDER BY date_added DESC";
		$query = $this->db->query($sql);
		return $query->rows;	
	}

  public function replyMsgadd($data) {
	$sql="INSERT INTO " . DB_PREFIX . "classified_enquiry_reply SET customer_id = '" . (int)$data['customer_id'] ."',classified_id = '" . (int)$data['classified_id'] ."',login_customer_id = '" . (int)$data['login_customer_id'] ."',classified_enquiry_id = '" . (int)$data['classified_enquiry_id'] ."',message  = '" .$this->db->escape($data['message']) ."',date_added=now()"; 
	$this->db->query($sql);
	$enquiry_reply_id = $this->db->getLastId();
	$logincustomerid=$this->model_classified_mymessages->classitotalreadmsg($enquiry_reply_id);
	$classifiedEmail=$this->model_classified_mymessages->inqueryEmail($logincustomerid['classified_enquiry_id']);
	$customeremail=$this->model_classified_mymessages->inqueryEmailCustomer($data['customer_id']);
	$customeremailemail=$this->model_classified_mymessages->customerNmaeGet($customeremail['customer_id']);
	if(!empty($classifiedEmail['enq_email'])){
		$enq_email=$classifiedEmail['enq_email'];
		$this->load->model('classified/mail');
		$type = 'classified_reply_mail';
		$mailinfo = $this->model_classified_mail->getMailInfo($type);
			if(!empty($mailinfo['message'])){
				if(isset($mailinfo['type'])){
			$find = array(
			 '{messagee}',						
			
			);

			$replace = array(
				'messagee'	=> $data['message'],
			);
			$subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));
			$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($enq_email);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		  }
		}
	   }elseif(!empty($customeremailemail['email'])){
		 $enqemail=$customeremailemail['email'];
			$this->load->model('classified/mail');
			$type = 'classified_reply_mail';
		    $mailinfo = $this->model_classified_mail->getMailInfo($type);
			if(!empty($mailinfo['message'])){
				if(isset($mailinfo['type'])){
			
			$find = array(
			 '{messagee}',						
						
			);

			$replace = array(
				'messagee'	        => $data['message'],
			);
			$subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));
			$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($enqemail);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		  }
		}

	}else{
		$enq_email='';
		$enqemail='';

	}
	///email end 

  }
	public function replyReadmsg($customer_id) {
			$this->db->query("UPDATE " . DB_PREFIX . "classified_enquiry set readmsg='1' WHERE customer_id = '" .$this->customer->isLogged() . "'");

	}

	public function getCustomerImages($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function classitotalread($customer_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_enquiry where customer_id ='".$this->customer->isLogged()."' and readmsg='0'";
		$query = $this->db->query($sql);
		return $query->row;	
	}

	public function getTotalInquieryReplay($classified_id) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_enquiry_reply where `login_customer_id`!='".$this->customer->isLogged()."'";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function classitotalreadmsg($enquiry_reply_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_enquiry_reply where enquiry_reply_id ='".$enquiry_reply_id."' and `login_customer_id`='".$this->customer->isLogged()."' ";
		$query = $this->db->query($sql);
		return $query->row;	
	}

	public function inqueryEmail($classified_enquiry_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_enquiry where classified_enquiry_id ='".$classified_enquiry_id."' and login_customer_id!='".$this->customer->isLogged()."'";
		$query = $this->db->query($sql);
		return $query->row;	
	}

	public function inqueryEmailCustomer($customer_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_enquiry where customer_id='".$customer_id."'";
		$query = $this->db->query($sql);
		return $query->row;	
	}
	


 }
