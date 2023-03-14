<?php
class ModelclassifiedMyads extends Model {

	public function getMyadds($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if (!empty($data['customer_id'])) {
			$sql .= " AND c.customer_id = '" . (int)$data['customer_id'] . "'";
		}

		$sort_data = array(
			'c.classified_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY c.classified_id";
		}
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query = $this->db->query($sql);
		return $query->rows;	
	}
	public function getPostImageUser($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->rows;
	}

	public function getMyaddCategory($classified_category_id) {
         $query  = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category pc LEFT JOIN " . DB_PREFIX . "classified_category_description pcd ON (pc.classified_category_id = pcd.classified_category_id) LEFT JOIN " . DB_PREFIX . "classified_category_path pcp ON (pc.classified_category_id = pcp.classified_category_id) WHERE pcd.classified_category_id = '" . (int)$classified_category_id . "' AND pcd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	public function getCountry($country_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "'");

		return $query->row;
	}
	public function getZone($zone_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "' ");

		return $query->row;
	}
	public function getTotalMyadd($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if (!empty($data['customer_id'])) {
			$sql .= " AND c.customer_id = '" . (int)$data['customer_id'] . "'";
		}

		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function getCity($city_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE city_id = '" . (int)$city_id . "' ");

		return $query->row;
	}

	public function DeleteMyadd($classified_id) {
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_description WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_favourite_ad WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_id=" . (int)$classified_id . "'");

			$this->cache->delete('classified');
		
	
	}

	public function ActiveMyAdd($classified_id) {
			$this->db->query("UPDATE " . DB_PREFIX . "classified SET active='1' WHERE classified_id = '" . (int)$classified_id . "'");
	
	 }
	
	public function DeActiveMyAD($classified_id) {
	     $this->db->query("UPDATE " . DB_PREFIX . "classified SET active='0' WHERE classified_id = '" . (int)$classified_id . "'");
	}

	public function getClassified($classified_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id = '" . (int)$classified_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

     public function getFiledClassified($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" . (int)$classified_id . "'");
		return $query->row;
	}


	public function getCustomerMyadd($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}



	public function addressMyadd($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->isLogged() . "'");

		return $query->row;
	}


       public function getTotalusealladd($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.customer_id<>0 AND  c.approve=1 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if (!empty($data['customerid'])) {
			$sql .= " AND c.customer_id = '" . (int)$data['customerid'] . "'";
		}

		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function customerAllad($data) {    
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.customer_id<>0 AND  c.approve=1 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if (!empty($data['customerid'])) {
			$sql .= " AND c.customer_id = '" . (int)$data['customerid'] . "'";
		}

		$sort_data = array(
			'c.customer_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY c.classified_id";
		}
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query = $this->db->query($sql);
		return $query->rows;	
	}


	public function favouriteadd($data) {
       $this->db->query("INSERT INTO " .DB_PREFIX . "classified_favourite_ad SET customer_id = '" . (int)$data['customer_id'] ."',classified_id = '" . (int)$data['classified_id'] ."',login_customer_id = '" . (int)$data['login_customer_id'] ."',favouritestatus='1',date_added=now()");
	}


	public function favouriteaddcolor($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_favourite_ad WHERE classified_id = '" . (int)$classified_id. "' and login_customer_id ='".$this->customer->isLogged()."'");

		return $query->row;
	}

	public function favouriteaddshow($data,$classified_id) {
			$this->db->query("UPDATE " . DB_PREFIX . "classified_favourite_ad set favouritestatus= '" . (int)$data['favouritestatus'] ."' WHERE classified_id = '" .$classified_id. "' and login_customer_id ='".$this->customer->isLogged()."'");

		
	}

	public function favouriteaddshowblack($data,$classified_id) {
	 $this->db->query("UPDATE " . DB_PREFIX . "classified_favourite_ad set favouritestatus= '" . (int)$data['favouritestatus'] ."' WHERE classified_id = '" .$classified_id. "' and login_customer_id ='".$this->customer->isLogged()."'");

		
	}

	///favourete start

	public function getfavourites($data) {
		
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_favourite_ad where favourite_id<>0 and favouritestatus='1'";
		if (!empty($data['login_customer_id'])) {
			$sql .= " AND login_customer_id = '" . (int)$data['login_customer_id'] . "'";
		}



		$sort_data = array(
			'favourite_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY login_customer_id";
		}
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query = $this->db->query($sql);
		return $query->rows;	
	}


	 public function getfavouritesTotal($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_favourite_ad  where favourite_id<>0 and favouritestatus='1'";
		if (!empty($data['login_customer_id'])) {
			$sql .= " AND login_customer_id = '" . (int)$data['login_customer_id'] . "'";
		}


		$query = $this->db->query($sql);
		return $query->row['total'];
	}


	public function enquiryAdd($data) {
		$this->db->query("INSERT INTO " .DB_PREFIX . "classified_enquiry SET customer_id = '" . (int)$data['customer_id'] ."',classified_id = '" . (int)$data['classified_id'] ."',login_customer_id = '" . (int)$data['login_customer_id'] ."',enq_title = '" .$this->db->escape($data['enq_title']) ."',enq_email = '" .$data['enq_email'] ."',enq_discription  = '" .$this->db->escape($data['enq_discription']) ."',date_added=now()");
		
		//Classifiedadd enquiry mail
			$this->load->model('classified/mail');
			$type = 'classified_enquiry_mail';
		
		$mailinfo = $this->model_classified_mail->getMailInfo($type);

		$classified_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_enquiry WHERE classified_id = '" . (int)$data['classified_id'] . "' and customer_id = '" . (int)$data['customer_id'] ."' and login_customer_id = '" . (int)$data['login_customer_id'] ."' ORDER BY date_added DESC");
			
			if(isset($classified_info->row['customer_id'])){
			$customer_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$classified_info->row['customer_id'] . "'");
		
			}
			
			
			if(!empty($mailinfo['message'])){
				if(isset($mailinfo['type'])){
			
			$find = array(
			'{enquirytitle}',						
			'{enquirydesc}',						
			'{enquiryemail}',											
			'{addlink}'											
			);

			if(isset($customer_info->row['email'])) {
				$emails = $customer_info->row['email'];
			} else {
				$emails='';
			}
			if(isset($classified_info->row['enq_title'])) {
				$enquirytitle = $classified_info->row['enq_title'];
			} else {
				$enquirytitle='';
			}
			
			if(isset($classified_info->row['enq_discription'])) {
				$enquirydesc = $classified_info->row['enq_discription'];
			} else {
				$enquirydesc='';
			}
			if(isset($classified_info->row['enq_email'])) {
				$enquiryemail = $classified_info->row['enq_email'];
			} else {
				$enquiryemail='';
			}

 		$baseurl = $this->url->link('classified/classified_view','&classified_id='.$data['classified_id'], '', true) . "\n\n";


			$replace = array(
			'enquirytitle'	=> $enquirytitle,
			'enquirydesc'	=> $enquirydesc,
			'enquiryemail'	=> $enquiryemail,
			'addlink'	=> $baseurl
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

			$mail->setTo($emails);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		}
		}
	

	}

	public function favouriteAdddelet($classified_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_favourite_ad WHERE classified_id = '" .$classified_id . "'");
	     $this->cache->delete('classified_favourite_ad');
	}

	public function reportAdd($data) {
		$this->db->query("INSERT INTO " .DB_PREFIX . "classified_report SET customer_id = '" . (int)$data['customer_id'] ."',classified_id = '" . (int)$data['classified_id'] ."',login_customer_id = '" . (int)$data['login_customer_id'] ."',report = '" .$this->db->escape($data['report']) ."',date_added=now()");
        //report enquiry mail
		$this->load->model('classified/mail');
		$type = 'classified_report_mail';
		 $mailinfo = $this->model_classified_mail->getMailInfo($type);
		   $classified_report_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified WHERE classified_id = '" . (int)$data['classified_id'] . "'");
		    $customer_report = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$classified_report_info->row['customer_id'] . "'");
	        $report_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$data['login_customer_id'] . "'");
			
			if(!empty($mailinfo['message'])){
			if(isset($mailinfo['type'])){
			$find = array(
				'{enquiryemail}',											
				'{report}',											
				'{addlink}'											
			);

			if(isset($customer_report->row['email'])) {
				$emailsreport = $customer_report->row['email'];
			} 
			if(isset($report_info->row['email'])) {
				$emailreport = $report_info->row['email'];
			} 
			$baseurl = $this->url->link('classified/classified_view','&classified_id='.$data['classified_id'], '', true) . "\n\n";
			$replace = array(
				'emailreport'	 => $emailreport,
				'report'	     => $data['report'],
				'addlink'	     => $baseurl
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
			$mail->setTo($emailsreport);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		  }
		}     
	}

	///favourete end 

	public function getMyadds_filter($data) {
		$fieldid=array();
	 	  if(!empty($data['formfields'])){
	 	  		 foreach ($data['formfields'] as $key =>$value) {
	 	  		 	if(!empty($value)){
                   $fieldid[$key]=array('value' => $value);
                
                   }
                }
            }
		


		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.customer_id<>0 AND  c.approve=1 AND c.active=1 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['country_id'])) {
			 $sql .= " AND c.country_id = '" . (int)$data['country_id'] . "'";
		}
		if (!empty($data['zone_id'])) {
			 $sql .= " AND c.zone_id = '" . (int)$data['zone_id'] . "'";
		}
		
		if (!empty($data['city_id'])) {
			 $sql .= " AND c.city_id = '" . (int)$data['city_id'] . "'";
		}


		if (!empty($data['classified_category_id'])) {
			 $sql .= " AND c.classified_category_id  = '" . (int)$data['classified_category_id'] . "'";
		}
		if (!empty($data['sub_category_id'])) {
			 $sql .= " AND c.sub_category_id  = '" . (int)$data['sub_category_id'] . "'";
		}

		if (!empty($data['sub_sub_category_id'])) {
			 $sql .= " AND c.sub_sub_category_id  = '" . (int)$data['sub_sub_category_id'] . "'";
		}

		if(!empty($fieldid)){
					$countfid=count($fieldid);
					$i=1;
				 foreach ($fieldid as $key => $value) {
					 $sql .= " and (SELECT value FROM " . DB_PREFIX . "tmdform_field_classified tfc  where tfc.value ='" .$value['value']. "' AND  tfc.field_id ='" .$key. "' and tfc.classified_id=c.classified_id)='".$value['value']."'";
					 
				} 
		} 



		$sort_data = array(
			'c.classified_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY c.classified_id";
		}
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		return $query->rows;	
	}


	 public function getMyaddsfilterTotal($data) {
		$fieldid=array();
	 	  if(!empty($data['formfields'])){
	 	  		 foreach ($data['formfields'] as $key =>$value) {
	 	  		 	if(!empty($value)){
                   $fieldid[$key]=array('value' => $value);
                
                   }
                }
            }
			$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.customer_id<>0 AND  c.approve=1 AND c.active=1 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		
		if (!empty($data['country_id'])) {
			 $sql .= " AND c.country_id = '" . (int)$data['country_id'] . "'";
		}
		if (!empty($data['zone_id'])) {
			 $sql .= " AND c.zone_id = '" . (int)$data['zone_id'] . "'";
		}
		
		if (!empty($data['city_id'])) {
			 $sql .= " AND c.city_id = '" . (int)$data['city_id'] . "'";
		}

		if (!empty($data['classified_category_id'])) {
			 $sql .= " AND c.classified_category_id  = '" . (int)$data['classified_category_id'] . "'";
		}
		if (!empty($data['sub_category_id'])) {
			 $sql .= " AND c.sub_category_id  = '" . (int)$data['sub_category_id'] . "'";
		}

		if (!empty($data['sub_sub_category_id'])) {
			 $sql .= " AND c.sub_sub_category_id  = '" . (int)$data['sub_sub_category_id'] . "'";
		}

		if(!empty($fieldid)){
					$countfid=count($fieldid);
					$i=1;
				 foreach ($fieldid as $key => $value) {
					 $sql .= " and (SELECT value FROM " . DB_PREFIX . "tmdform_field_classified tfc  where tfc.value ='" .$value['value']. "' AND  tfc.field_id ='" .$key. "' and tfc.classified_id=c.classified_id)='".$value['value']."'";
					 
				} 
		} 

		$query = $this->db->query($sql);
		return $query->row['total'];
	}


public function placementClassFied($classified_id ) {
	$classifiedpaid=date('Y-m-d');
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_paid_package WHERE package_id  = '" . (int)$classified_id  . "' and expirydate >='".$classifiedpaid."' and order_status_id=5");
	return $query->row;
}

public function placementClasscolor($package_id ) {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_package WHERE package_id  = '" . (int)$package_id  . "'");
	return $query->row;
}

public function getPackagedate($customer_id) {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_paid_package WHERE customer_id  = '" . (int)$customer_id  . "'");
	return $query->row;
}

public function getCustPackage($package_id) {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_package WHERE package_id  = '" . (int)$package_id  . "'");
	return $query->row;
}

   public function getTotalInquiery($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_enquiry where customer_id='".$this->customer->isLogged()."' and readmsg='0'";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	 public function getTotalCustadd($customer_id) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified where customer_id='".$customer_id."' and approve=1 and active=1";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	 public function getTotalCustFav($customer_id) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_favourite_ad where login_customer_id='".$customer_id."' and favouritestatus=1";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

 public function getTotalCustMsg($customer_id) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_enquiry where customer_id='".$customer_id."'";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
 }