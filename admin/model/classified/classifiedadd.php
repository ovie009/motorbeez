<?php
class ModelclassifiedClassifiedadd extends Model {
	public function addebook($data) {
  //customer_id start
    $customerid=$this->model_classified_classifiedadd->getCustomer($data['customer_id']);	
    if(!empty($customerid['firstname'])){
    	$firstname=$customerid['firstname'];
      }else{
      	$firstname='';
      }

  //customer_id end 		
	$sql="INSERT INTO " . DB_PREFIX . "classified set classified_category_id='".(int)($data['classified_category_id'])."',sub_category_id='".(int)($data['sub_category_id'])."',sub_sub_category_id='".(int)($data['sub_sub_category_id'])."',singal_post='".$this->db->escape($data['singal_post'])."', country_id='".(int)($data['country_id'])."',zone_id='".(int)($data['zone_id'])."',city_id ='".(int)($data['city_id'])."', city='".$this->db->escape($data['city'])."', address='".$this->db->escape($data['address'])."', price='".$this->db->escape($data['price'])."', 	   
	lat='".$this->db->escape($data['lat'])."',lng='".$this->db->escape($data['lng'])."',location='".$this->db->escape($data['location'])."',  
	customer_id = '".(int)($data['customer_id'])."',coustomername='".$firstname."',video_type='".$this->db->escape($data['video_type'])."',youtube_video='".$this->db->escape($data['youtube_video'])."',video_vimeo='".$this->db->escape($data['video_vimeo'])."',upload_video='".$this->db->escape($data['upload_video'])."',active=1,date_added=now()"; 
	$this->db->query($sql);
	$classified_id = $this->db->getLastId();
		
		foreach ($data['classified_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "classified_description SET classified_id = '" . (int)$classified_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', post_description = '" . $this->db->escape($value['post_description']) . "'");
		}
	/// form builder start
	if (isset($data['formfields'])) {
		foreach ($data['formfields'] as $key => $fields) {
			$form_id =$data['form_id'];
			$form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field tf LEFT JOIN " . DB_PREFIX . "tmdform_field_description tfd ON (tf.field_id = tfd.field_id) WHERE tf.form_id = '" .(int)$form_id . "' and tf.field_id='".$key."'");
			
			$serialize=0;
			if (is_array($fields)) {
			$fields=serialize($fields);
			$serialize=1;
			}

			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_field_classified SET 
				classified_id      = '" . (int)$classified_id . "',
				form_id      ='".(int)$data['form_id']."',
				label        ='".$form_query->row['field_name']."',
				field_id     = '" .$key . "',
				sort_order   ='" .$form_query->row['sort_order'] . "',
				serialize    ='".$serialize."',
				value        ='".$this->db->escape($fields)."'");
		}
	
	}
	/// form builder  end 
	///image start

	if (isset($data['image'])) {
			foreach ($data['image'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "classified_ad_image SET classified_id = '" . (int)$classified_id . "', image = '" . $this->db->escape($image['image']) . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'classified_id=" . (int)$classified_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		return $classified_id;
	}

//edit
	public function editPostInfo($classified_id, $data) {
				
		$customerid=$this->model_classified_classifiedadd->getCustomer($data['customer_id']);	
		if(!empty($customerid['firstname'])){
			$firstname=$customerid['firstname'];
		}
		$this->db->query("UPDATE " . DB_PREFIX . "classified set classified_category_id='".(int)($data['classified_category_id'])."',
		sub_category_id='".(int)($data['sub_category_id'])."',
		singal_post='".$this->db->escape($data['singal_post'])."',
		sub_sub_category_id='".(int)($data['sub_sub_category_id'])."', country_id='".(int)($data['country_id'])."',zone_id='".(int)($data['zone_id'])."',
		city_id ='".(int)($data['city_id'])."', city='".$this->db->escape($data['city'])."', address='".$this->db->escape($data['address'])."', price='".$this->db->escape($data['price'])."',lat='".$this->db->escape($data['lat'])."',lng='".$this->db->escape($data['lng'])."',
		location='".$this->db->escape($data['location'])."',customer_id = '".(int)($data['customer_id'])."',coustomername='".$firstname."',active='" . (int)$data['active'] . "',video_type='".$this->db->escape($data['video_type'])."',youtube_video='".$this->db->escape($data['youtube_video'])."',video_vimeo='".$this->db->escape($data['video_vimeo'])."',upload_video='".$this->db->escape($data['upload_video'])."',date_modified=now() WHERE classified_id = '" . (int)$classified_id . "'");
	
	$this->db->query("DELETE FROM " . DB_PREFIX . "classified_description WHERE classified_id = '" .$classified_id . "'");

		foreach ($data['classified_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "classified_description SET classified_id = '" . (int)$classified_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', post_description = '" . $this->db->escape($value['post_description']) . "'");
		}
    	
    /// form builder start
	$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" .$classified_id . "'");
	if (isset($data['formfields'])) {
		foreach ($data['formfields'] as $key => $fields) {
			$form_id =$data['form_id'];
			$form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field tf LEFT JOIN " . DB_PREFIX . "tmdform_field_description tfd ON (tf.field_id = tfd.field_id) WHERE tf.form_id = '" .(int)$form_id . "' and tf.field_id='".$key."'");
		
			$serialize=0;
			if (is_array($fields)) {
			$fields=serialize($fields);
			$serialize=1;
			}

			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_field_classified SET 
				classified_id      = '" . (int)$classified_id . "',
				form_id      ='".(int)$data['form_id']."',
				label        ='".$form_query->row['field_name']."',
				field_id     = '" .$key . "',
				serialize    ='".$serialize."',
				value        ='".$this->db->escape($fields)."'");
		}
	
	}
	/// form builder  end 
	///image start
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" .$classified_id . "'");
		if (isset($data['image'])) {
			foreach ($data['image'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "classified_ad_image SET classified_id = '" . (int)$classified_id . "', image = '" . $this->db->escape($image['image']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_id=" . (int)$classified_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'classified_id=" . (int)$classified_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}


	}
	
	
	
	public function getEbooks($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_coustomer'])){
		 	$sql .=" and c.coustomername like '".$this->db->escape($data['filter_coustomer'])."%'";
		}

		if (!empty($data['filter_title'])){
		 	$sql .=" and cd.title like '".$this->db->escape($data['filter_title'])."%'";
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

public function classifiedcompletes($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_paid_package where order_status_id='5'";

		$sort_data = array(
			'classified_paid_package_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY classified_paid_package_id";
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

	public function getclassifiedDescription($classified_id) {
		$classified_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_description WHERE classified_id = '" . (int)$classified_id . "'");

		foreach ($query->rows as $result) {
			$classified_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'post_description'      => $result['post_description'],
				'classified_id'             => $result['classified_id']
			);
		}

		return $classified_description_data;
	}

	public function getTotalComplete($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_paid_package where order_status_id='5'";

		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function getTotalebook($data) {
		
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_coustomer'])){
		 	$sql .=" and c.coustomername like '".$this->db->escape($data['filter_coustomer'])."%'";
		}

		if (!empty($data['filter_title'])){
		 	$sql .=" and cd.title like '".$this->db->escape($data['filter_title'])."%'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function deletepost($classified_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_description WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_favourite_ad WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_id=" . (int)$classified_id . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}



	public function getplacement($placement_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_package WHERE placement_id = '" . (int)$placement_id . "'");

		return $query->row;
	}
	
	public function getOrderStatus($order_status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "'");
		return $query->row;
	}

	public function approve($classified_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified SET approve='1' WHERE classified_id = '" . (int)$classified_id . "'");
		
	//Classifiedadd approve mail
			$this->load->model('classified/mail');
			$type = 'classified_approved_mail';
		
		$mailinfo = $this->model_classified_mail->getMailInfo($type);

		$classified_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified WHERE classified_id = '" . (int)$classified_id . "'");
			if(isset($classified_info->row['customer_id'])){
			$customer_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$classified_info->row['customer_id'] . "'");
			}
			
			if(!empty($customer_info->row['language_id'])) {
				$language_id = $customer_info->row['language_id'];
			} else {
				$language_id= 1;
			}		
		$classified_desc_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_description WHERE classified_id = '" . (int)$classified_info->row['classified_id'] . "' AND language_id = '" . (int)$language_id . "'");
			
			if(!empty($classified_info->row['coustomername'])){
			if(!empty($mailinfo['message'])){
				if(isset($mailinfo['type'])){
			
			$find = array(
			'{classifiedadd}',						
			'{price}',						
			'{addlink}'						
			);

			if(isset($customer_info->row['email'])) {
				$emails = $customer_info->row['email'];
			} else {
				$emails='';
			}
			if(isset($classified_desc_info->row['title'])) {
				$classifiedadd = $classified_desc_info->row['title'];
			} else {
				$classifiedadd='';
			}
			if(isset($classified_info->row['price'])) {
				$price = $classified_info->row['price'];
			} else {
				$price='';
			}


			$baseurl = HTTP_CATALOG.'index.php?route=classified/classified_view&classified_id='.$classified_id;
 
			$replace = array(
			'classifiedadd'	=> $classifiedadd,	
			'price'	=> $price,
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

	}
	public function disapprove($classified_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified SET approve='0' WHERE classified_id = '" . (int)$classified_id . "'");
	}

	public function getPostClassified($classified_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_id=" . (int)$classified_id . "') AS keyword FROM " . DB_PREFIX . "classified WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->row;
	}

	public function getPostInfo($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->row;
	}

	public function getPostInfoImage($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->rows;
	}
// /tmdform_field_option tmdform_field_classified
	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id)  WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}


		public function getCategory_classified($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->row;
	}

		public function getCategorymyadd($classified_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_classified_category WHERE classified_category_id = '" . (int)$classified_category_id . "'");

		return $query->row;
	}


	public function getForms($form_id) {
		$form_field_data = array();
		
		$form_field_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field tf LEFT JOIN " . DB_PREFIX . "tmdform_field_description tfd ON (tf.field_id = tfd.field_id) WHERE tf.form_id = '" .(int)$form_id . "' AND tfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND tf.form_status='1'");
		
		foreach ($form_field_query->rows as $form_field) {
			$form_field_data[] = array(
				'field_id' 		=> $form_field['field_id'],
				'form_id' 		=> $form_field['form_id'],
				'type' 			=> $form_field['type'],
				'form_status' 	=> $form_field['form_status'],
				'required' 		=> $form_field['required'],
				'field_name' 	=> $form_field['field_name'],
				'help_text' 	=> $form_field['help_text'],
				'placeholder' 	=> $form_field['placeholder'],
				'error_message' => $form_field['error_message'],
			);
			
		}

		return $form_field_data;
	}

		public function getFormsOption($field_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "tmdform_field_option WHERE field_id =' ".$field_id."' AND language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$query=$this->db->query($sql);
		
		return $query->rows;
	}
	public function getclassified($classified_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id =' ".$classified_id."'  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$query=$this->db->query($sql);
		
		return $query->row;
	}
	public function getclassifiedCustomer($customer_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "classified WHERE customer_id =' ".$customer_id."'";
		$query=$this->db->query($sql);
		
		return $query->row;
	}

	public function orderProduct($order_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id =' ".$order_id."'";
		$query=$this->db->query($sql);
		
		return $query->row;
	}


	public function getOrders($customer_id) {
		
		$query = $this->db->query("SELECT o.order_id, o.firstname, o.lastname,o.customer_id, os.name as status, o.date_added, o.total, o.currency_code, o.currency_value FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_status os ON (o.order_status_id = os.order_status_id) WHERE o.customer_id='".$customer_id."' And  o.store_id = '" . (int)$this->config->get('config_store_id') . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "'  ORDER BY o.order_id DESC");
		return $query->row;
	}

	public function getTotalOrderProductsByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

	public function getTotalOrderVouchersByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order_voucher` WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

	public function getclassifiedCustomerall($customer_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "classified WHERE customer_id =' ".$customer_id."'";
		$query=$this->db->query($sql);
		
		return $query->rows;
	}

}