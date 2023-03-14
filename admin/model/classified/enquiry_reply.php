<?php
class ModelclassifiedEnquiryReply extends Model {
	
	public function addinquiryhistory($data){
		$sql="INSERT INTO " . DB_PREFIX . "post_enquiry_history  set 
		id = '" .(int)$data['id'] ."',
		post_id = '" .(int)$data['post_id'] ."',
		message='".$this->db->escape($data['message'])."',
		date_added=now()";
		$this->db->query($sql);
		$inquiry_history_id = $this->db->getLastId();
		
		$emailinfo=$this->model_classified_enquiry_reply->getinquiryemail($data['id']);
		if(isset($emailinfo['email'])){
				$inquiryemail=$emailinfo['email'];	
			}else{
				$inquiryemail='';
			}

			if(isset($emailinfo['name'])){
				$name=$emailinfo['name'];	
			}else{
				$name='';
			}

			
	        $subject = sprintf($name, ENT_QUOTES, 'UTF-8');
			$message = sprintf(html_entity_decode($data['message']), ENT_QUOTES, 'UTF-8') . "\n\n";
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($inquiryemail);
			$mail->setFrom($inquiryemail);
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
  			
		
	}
	
	public function getinquiry($id) {
		$sql="SELECT * from " . DB_PREFIX . "post_enquiry WHERE id = '" . (int)$id . "'";
		$query=$this->db->query($sql);
		return $query->row;
	}

	public function getinquiryhistory($id) {
		$sql = "SELECT * FROM ".DB_PREFIX."post_enquiry_history WHERE id = '" . (int)$id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getinquiryemail($id) {
		$sql="SELECT * from " . DB_PREFIX . "post_enquiry WHERE id = '" . (int)$id . "'";
		$query=$this->db->query($sql);
		return $query->row;
	}	
}
