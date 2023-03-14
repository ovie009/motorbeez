<?php
class ModelclassifiedAllPostlisting extends Model {
	public function addebook($data) {
  //customer_id start
    $customerid=$this->model_classified_all_post_listing->getCustomer($data['customer_id']);	
    if(!empty($customerid['firstname'])){
    	$firstname=$customerid['firstname'];
      }
    ///	
  //customer_id end 		
	$sql="INSERT INTO " . DB_PREFIX . "classified set post_category_id='".(int)($data['post_category_id'])."',sub_category_id='".(int)($data['sub_category_id'])."',sub_sub_category_id='".(int)($data['sub_sub_category_id'])."',title='".$this->db->escape($data['title'])."',post_description='".$this->db->escape($data['post_description'])."',country_id='".(int)($data['country_id'])."',zone_id='".(int)($data['zone_id'])."',city ='".$this->db->escape($data['city'])."',price='".$this->db->escape($data['price'])."', 	   
	lat='".$this->db->escape($data['lat'])."',lng='".$this->db->escape($data['lng'])."',location='".$this->db->escape($data['location'])."',  
	customer_id = '".(int)($data['customer_id'])."',coustomername='".$firstname."',date_added=now()"; 
	$this->db->query($sql);
	$classified_id = $this->db->getLastId();

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

		return $classified_id;
	}

//edit
	public function editPostInfo($classified_id, $data) {
		$customerid=$this->model_classified_all_post_listing->getCustomer($data['customer_id']);	
		if(!empty($customerid['firstname'])){
			$firstname=$customerid['firstname'];
		}
		$this->db->query("UPDATE " . DB_PREFIX . "classified set post_category_id='".(int)($data['post_category_id'])."',
		sub_category_id='".(int)($data['sub_category_id'])."',
		sub_sub_category_id='".(int)($data['sub_sub_category_id'])."',
		title='".$this->db->escape($data['title'])."',post_description='".$this->db->escape($data['post_description'])."',
		country_id='".(int)($data['country_id'])."',zone_id='".(int)($data['zone_id'])."',
		city ='".$this->db->escape($data['city'])."',price='".$this->db->escape($data['price'])."',lat='".$this->db->escape($data['lat'])."',lng='".$this->db->escape($data['lng'])."',
		location='".$this->db->escape($data['location'])."',customer_id = '".(int)($data['customer_id'])."',coustomername='".$firstname."',date_modified=now() WHERE classified_id = '" . (int)$classified_id . "'");
    	
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
				sort_order   ='" .$form_query->row['sort_order'] . "',
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


	}
	
	public function getEbook($ebook_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "ebook where ebook_id='".$ebook_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	
	
	public function getEbooks($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified where classified_id<>0";

		if (!empty($data['filter_coustomer'])){
		 	$sql .=" and coustomername like '".$this->db->escape($data['filter_coustomer'])."%'";
		}

		if (!empty($data['filter_title'])){
		 	$sql .=" and title like '".$this->db->escape($data['filter_title'])."%'";
		}

		$sort_data = array(
			'classified_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY classified_id";
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

	

	public function getTotalebook($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified where classified_id<>0";
		
		
		if (!empty($data['filter_coustomer'])){
		 	$sql .=" and coustomername like '".$this->db->escape($data['filter_coustomer'])."%'";
		}

		if (!empty($data['filter_title'])){
		 	$sql .=" and title like '".$this->db->escape($data['filter_title'])."%'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function deletepost($classified_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" .$classified_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" .$classified_id . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getPostPad($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_paid_package WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->rows;
	}

	public function getplacement($placement_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_package WHERE placement_id = '" . (int)$placement_id . "'");

		return $query->row;
	}

	public function approve($classified_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified SET approve='1' WHERE classified_id = '" . (int)$classified_id . "'");
		
			

	}
	public function disapprove($classified_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified SET approve='0' WHERE classified_id = '" . (int)$classified_id . "'");
		
			

	}

	public function getPostInfo($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->row;
	}

	public function getPostInfoImage($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->rows;
	}

	

	
}
