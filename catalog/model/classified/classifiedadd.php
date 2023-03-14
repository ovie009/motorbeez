<?php
class ModelclassifiedClassifiedadd extends Model {
	public function addpost($data) {
		$customerid=$this->model_classified_classifiedadd->classifiedMsgname($this->customer->isLogged());	
		if(!empty($customerid['firstname'])){
			$firstname=$customerid['firstname'];
		}
		
	$sql="INSERT INTO " . DB_PREFIX . "classified set classified_category_id='".(int)($data['classified_category_id'])."',sub_category_id='".(int)($data['sub_category_id'])."',sub_sub_category_id='".(int)($data['sub_sub_category_id'])."', singal_post='".$this->db->escape($data['singal_post'])."', country_id='".(int)($data['country_id'])."',zone_id='".(int)($data['zone_id'])."',city_id ='".(int)($data['city_id'])."', city ='".$this->db->escape($data['city'])."', address ='".$this->db->escape($data['address'])."',price='".$this->db->escape($data['price'])."', 	   
	lat='".$this->db->escape($data['lat'])."',lng='".$this->db->escape($data['lng'])."',location='".$this->db->escape($data['location'])."',  
	customer_id = '".$this->customer->isLogged()."',approve='1',active='1',coustomername='".$firstname."',video_type='".$this->db->escape($data['video_type'])."',youtube_video='".$this->db->escape($data['youtube_video'])."',video_vimeo='".$this->db->escape($data['video_vimeo'])."',upload_video='".$this->db->escape($data['upload_video'])."',date_added=now()"; 
	$this->db->query($sql);
	$classified_id = $this->db->getLastId();
	
	foreach ($data['classified_description'] as $language_id => $value) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "classified_description SET classified_id = '" . (int)$classified_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', post_description = '" . $this->db->escape($value['post_description']) . "'");
	}

	///form builder start
	if (!empty($data['formfields'])) {
		foreach ($data['formfields'] as $key => $fields) {
			$form_id =$data['form_id'];
			$form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field tf LEFT JOIN " . DB_PREFIX . "tmdform_field_description tfd ON (tf.field_id = tfd.field_id) WHERE tf.form_id = '" .(int)$form_id . "' and tf.field_id='".$key."'");
			$sort_order ="";
			$field_name ="";
			$serialize=0;
			if (is_array($fields)) {
			$fields=serialize($fields);
			$serialize=1;
			}
			if(isset($form_query->row['field_name'])){
				$field_name=$form_query->row['field_name'];	
			}
			
			if(isset($form_query->row['sort_order'])){
				$sort_order=$form_query->row['sort_order'];	
			}
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_field_classified SET 
				classified_id      = '" . (int)$classified_id . "',
				form_id    ='".(int)$data['form_id']."',
				label      ='".$field_name."',
				field_id   = '" .$key . "',
				sort_order = '" .$sort_order . "',
				serialize  ='".$serialize."',
				value      ='".$this->db->escape($fields)."'");
		}
	
	}
	/// form builder  end 
	///image start
		if($data['uploader_count']) {
				$uploader_count = $data['uploader_count']-1;
				for($i = 0; $i<=$uploader_count; $i++){
					if(isset($data['uploader_'.$i.'_tmpname']) && trim($data['uploader_'.$i.'_status'])== 'done') {
						$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "classified_ad_image SET classified_id = '" . (int) $classified_id . "', image = '" . $this->db->escape('upload/'.$data['uploader_'.$i.'_tmpname']) . "'");
					}
				}
			}
		

		return $classified_id;

	///image end 
}

	
	public function editMyadd($classified_id, $data) {
		
		$customerid=$this->model_classified_classifiedadd->classifiedMsgname($this->customer->isLogged());		
		if(!empty($customerid['firstname'])){
			$firstname=$customerid['firstname'];
		}
		$this->db->query("UPDATE " . DB_PREFIX . "classified set  classified_category_id='".(int)($data['classified_category_id'])."', sub_category_id='".(int)($data['sub_category_id'])."',singal_post='".$this->db->escape($data['singal_post'])."', sub_sub_category_id='".(int)($data['sub_sub_category_id'])."', country_id='".(int)($data['country_id'])."',zone_id='".(int)($data['zone_id'])."',city_id ='".(int)($data['city_id'])."', city ='".$this->db->escape($data['city'])."', address ='".$this->db->escape($data['address'])."', price='".$this->db->escape($data['price'])."',lat='".$this->db->escape($data['lat'])."',lng='".$this->db->escape($data['lng'])."', location='".$this->db->escape($data['location'])."', approve='1',active='1',customer_id = '".$this->customer->isLogged()."',coustomername='".$firstname."',video_type='".$this->db->escape($data['video_type'])."',youtube_video='".$this->db->escape($data['youtube_video'])."',video_vimeo='".$this->db->escape($data['video_vimeo'])."',upload_video='".$this->db->escape($data['upload_video'])."',date_modified=now() WHERE classified_id = '" . (int)$classified_id . "'");
    	
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
			if(isset($form_query->row['field_name'])){
				$field_name=$form_query->row['field_name'];	
			}else{
			$field_name='';	
			}
			
			if(isset($form_query->row['sort_order'])){
				$sort_order=$form_query->row['sort_order'];	
			}else{
			$sort_order='';	
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_field_classified SET 
				classified_id      = '" .(int)$classified_id . "',
				form_id      ='".(int)$data['form_id']."',
				label        ='".$field_name."',
				field_id     = '" .$key . "',
				sort_order   ='" .$sort_order . "',
				serialize    ='".$serialize."',
				value        ='".$this->db->escape($fields)."'");
		}
	
	}
	
	/// form builder  end 
		if($data['uploader_count']) {
				$uploader_count = $data['uploader_count']-1;
				for($i = 0; $i<=$uploader_count; $i++){
					if(isset($data['uploader_'.$i.'_tmpname']) && trim($data['uploader_'.$i.'_status'])== 'done') {
						$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "classified_ad_image SET classified_id = '" . (int) $classified_id . "', image = '" . $this->db->escape('upload/'.$data['uploader_'.$i.'_tmpname']) . "'");

					}

				}
			}

			if (isset($data['image'])){
			foreach ($data['image'] as $image){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "classified_ad_image SET classified_id = '" . (int) $classified_id . "',image = '" . $this->db->escape($image['image']) . "'");
			}

		}


	}



		public function getPostEdit($classified_id) { 
		$sql = "SELECT * FROM " . DB_PREFIX . "classified where classified_id='".$classified_id."'";
		$query = $this->db->query($sql);
		return $query->row;
		
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
	
	public function getPostCategoryDesc($post_category_id) {
		$query  = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_category pc LEFT JOIN " . DB_PREFIX . "post_category_description pcd ON (pc.post_category_id = pcd.post_category_id) WHERE pcd.post_category_id = '" . (int)$post_category_id . "' AND pcd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPostEditImage($classified_id) { 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "' ORDER BY image ASC");

		return $query->rows;
	}

	public function getTmdform($form_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "tmdform_field WHERE form_id =' ".$form_id."'";
		$query=$this->db->query($sql);
		
		return $query->row;
	}

		public function getPostMYADDImage($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->rows;
	}

	

	public function getCountry($country_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "'");

		return $query->row;
	}

	public function getZone($zone_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row;
	}




	public function DeleteImage($classified_img_id) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "classified_ad_image WHERE classified_img_id = '" .$classified_img_id . "'");
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

		public function getCategorymyadd($classified_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_classified_category WHERE classified_category_id = '" . (int)$classified_category_id . "'");

		return $query->row;
	}
	public function getCategorySeach($classified_category_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "tmdform_classified_category WHERE classified_category_id =' ".$classified_category_id."'";
		

		$query=$this->db->query($sql);

		return $query->rows;
	}

	public function classifiedMsgname($customer_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customer where customer_id ='".$this->customer->isLogged()."'";
		$query = $this->db->query($sql);
		return $query->row;	
	}


	public function getclassifieds($classified_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id =' ".$classified_id."'  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$query=$this->db->query($sql);
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
	public function getclassifiedImage($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->rows;
	}

}

