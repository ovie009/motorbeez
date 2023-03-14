<?php 
class ModelClassifiedForm extends Model {
 	public function addForm($data) {	

		$sql="INSERT INTO " . DB_PREFIX . "classified_tmdform set title ='".$this->db->escape($data['title'])."',status='".$this->db->escape($data['status'])."',date_added=now()";
		$this->db->query($sql);
		$form_id = $this->db->getLastId();	

		if (isset($data['option_fields'])){

		   foreach ($data['option_fields'] as $fields){

			   if(!empty($fields['type'])) {

					$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_field SET  

					form_id='".(int)$form_id."',form_status = '" .$fields['form_status']. "', required = '".$fields['required']. "', sort_order='".(int)$fields['sort_order']."', type='".$fields['type']."'");

					$field_id = $this->db->getLastId();
				   if(isset($fields['form_fields'])) {
						foreach ($fields['form_fields'] as $language_id => $form) {
							$this->db->query("INSERT INTO " .DB_PREFIX . "tmdform_field_description SET field_id ='" . (int)$field_id . "',form_id ='" . (int)$form_id . "',language_id = '" . (int)$language_id ."',field_name='".$this->db->escape($form['field_name'])."',help_text='".$this->db->escape($form['help_text'])."',placeholder='".$this->db->escape($form['placeholder'])."',error_message='".$this->db->escape($form['error_message'])."'"); 
						}
					}
					if(isset($fields['option_type'])) {
					foreach ($fields['option_type'] as $option_description) {
						$baseoption=$this->db->query("INSERT INTO  " .DB_PREFIX . "tmdform_field_option_base set field_id ='" . (int)$field_id . "' , form_id ='" . (int)$form_id . "'");
						$optiobaseid=$this->db->getLastId();			
						if(isset($option_description['option_value_description'])) {
							foreach ($option_description['option_value_description'] as $language_id => $option_value_description) {					
								$this->db->query("INSERT INTO " .DB_PREFIX . "tmdform_field_option SET field_id ='" . (int)$field_id . "',form_id ='" . (int)$form_id . "',optiobaseid='".$optiobaseid."',language_id = '" . (int)$language_id ."',
								name='".$option_value_description['name']."',sort_order='".$option_description['sort_order']."',image='".$option_description['image']."'"); 

							}

						}

					}

				}

			}	   		  

		   	}

		}

		
		if (isset($data['category_post'])){
		foreach ($data['category_post'] as $classified_category_id){
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_classified_category SET  form_id = '" . (int) $form_id . "',classified_category_id = '" . $this->db->escape($classified_category_id). "'");
			}
		}		

		return $form_id;

	}   
 	public function editForm($form_id,$data) {		

		$sql="UPDATE " . DB_PREFIX . "classified_tmdform set title ='".$this->db->escape($data['title'])."',status='".$this->db->escape($data['status'])."',date_modified=now()where form_id='".$form_id."'";

	 	$this->db->query($sql);		
	
		if (isset($data['option_fields'])){
		   foreach ($data['option_fields'] as $fields){
		 	   if(!empty($fields['type'])) {

				    $this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field where  field_id ='" . (int)$fields['field_id']."'");
				
				    $this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_field SET form_id='".(int)$form_id."', form_status = '" .$fields['form_status']. "', required = '".$fields['required']. "', sort_order = '".$fields['sort_order']. "', type='".$fields['type']."'");
			
					$field_id = $this->db->getLastId();
					
				   	$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_description where  field_id ='" . (int)$fields['field_id']."'");
				   	if(isset($fields['form_fields'])) {

					foreach ($fields['form_fields'] as $language_id => $form) {
						$this->db->query("INSERT INTO " .DB_PREFIX . "tmdform_field_description SET field_id ='" . (int)$field_id . "',form_id ='" . (int)$form_id . "',language_id = '" . (int)$language_id ."',field_name='".$this->db->escape($form['field_name'])."',help_text='".$this->db->escape($form['help_text'])."',placeholder='".$this->db->escape($form['placeholder'])."',error_message='".$this->db->escape($form['error_message'])."'");
					}
				}					

				$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_option where  field_id ='" . (int)$fields['field_id']."'");	

				$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_field_option_base where  field_id ='" . (int)$fields['field_id']."'");	

			   	if(isset($fields['option_type'])) {
			
					foreach ($fields['option_type'] as $option_description) {							

						$baseoption=$this->db->query("INSERT INTO  " .DB_PREFIX . "tmdform_field_option_base set field_id ='" . (int)$field_id . "' , form_id ='" . (int)$form_id . "'");

						$optiobaseid=$this->db->getLastId();

						if(isset($option_description['option_value_description'])) {

							foreach ($option_description['option_value_description'] as $language_id => $option_value_description) {

							$this->db->query("INSERT INTO " .DB_PREFIX . "tmdform_field_option SET field_id ='" . (int)$field_id . "',form_id ='" . (int)$form_id . "',optiobaseid='".$optiobaseid."',language_id = '" . (int)$language_id ."', name='".$option_value_description['name']."',sort_order='".$option_description['sort_order']."',image='".$option_description['image']."'"); 

							}

						}

					}

				}

			}	   			

		}

	}

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_classified_category where  form_id ='" . (int)$form_id."'");	

		if (isset($data['category_post'])){
				foreach ($data['category_post'] as $classified_category_id){
					$this->db->query("INSERT INTO " . DB_PREFIX . "tmdform_classified_category SET  form_id = '" . (int) $form_id . "',classified_category_id = '" . $this->db->escape($classified_category_id). "'");
				}
			}
 	}

 	public function deleteForm($form_id){	

		$this->db->query("DELETE  FROM " . DB_PREFIX . "classified_tmdform where form_id='".$form_id."'");
		$this->db->query("DELETE  FROM " . DB_PREFIX . "tmdform_classified_category WHERE form_id='".$form_id."'");
		$this->db->query("DELETE  FROM " . DB_PREFIX . "tmdform_field where form_id='".$form_id."'");
		$this->db->query("DELETE  FROM " . DB_PREFIX . "tmdform_field_classified where form_id='".$form_id."'");
		$this->db->query("DELETE  FROM " . DB_PREFIX . "tmdform_field_description where form_id='".$form_id."'");
		$this->db->query("DELETE  FROM " . DB_PREFIX . "tmdform_field_option WHERE form_id='".$form_id."'");
		$this->db->query("DELETE  FROM " . DB_PREFIX . "tmdform_field_option_base WHERE form_id='".$form_id."'");
 	} 

	

	public function getForm($form_id){	

		$sql="SELECT DISTINCT *,(SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'form_id=" . (int)$form_id . "') AS keyword FROM " . DB_PREFIX . "classified_tmdform WHERE form_id='".$form_id."'";	

		$query=$this->db->query($sql);

		return $query->row;

	}

 	public function getForms($data){

		$sql = "SELECT * FROM " . DB_PREFIX . "classified_tmdform where form_id<>0";		

		if (!empty($data['filter_title'])){

			$sql .=" and title like '".$this->db->escape($data['filter_title'])."%'";

		}
		$sort_data = array(

			'title',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {

		 	$sql .= " ORDER BY " . $data['sort'];

		} else {

		 	$sql .= " ORDER BY title";

		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {

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

		}

		$query = $this->db->query($sql);

		return $query->rows;
 	}

	

	public function getFormDescriptions($form_id) {

		$form_descriptio_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."tmdform_description WHERE form_id = '" . (int)$form_id . "'");

		foreach ($query->rows as $result) {

			$form_descriptio_data[$result['language_id']] = array(
				'title'=> $result['title'],
				'meta_title'=> $result['meta_title'],
				'button_name'=> $result['button_name'],
				'resetbuttonname'=> $result['resetbuttonname'],
				'popuplinkname'=> $result['popuplinkname'],
				'meta_keyword'=> $result['meta_keyword'],
				'meta_description'=> $result['meta_description'],
				'top_description'=> $result['top_description'],
				'bottom_description'=> $result['bottom_description'],
			);

	 	}
		return $form_descriptio_data;
	}

	public function getFormSuccess($form_id) {

		$form_success_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."tmdform_success WHERE form_id = '" . (int)$form_id . "'");

		foreach ($query->rows as $result) {
			$form_success_data[$result['language_id']] = array(
				'success_title'=> $result['success_title'],
				'success_meta_title'=> $result['success_meta_title'],
				'success_description'=> $result['success_description'],
			);
	 	}
		return $form_success_data;
	}
	public function getFormNotification($form_id) {

		$form_notification_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."tmdform_notification WHERE form_id = '" . (int)$form_id . "'");

		foreach ($query->rows as $result) {

			$form_notification_data[$result['language_id']] = array(
				'customer_subject'=> $result['customer_subject'],
				'customer_message'=> $result['customer_message'],
				'admin_subject'=> $result['admin_subject'],
				'admin_message'=> $result['admin_message']
			);
	 	}
		return $form_notification_data;

	}

 	public function getTotalForm($data) {

		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_tmdform where form_id<>0 ";
		$query = $this->db->query($sql);
		return $query->row['total'];

	}

	

	 public function getCustomerCheckbox($form_id){

		$form_to_customer=array();
		$sql="select  *  from " . DB_PREFIX . "tmdform_customergroup where form_id='".$form_id."'";
		$query=$this->db->query($sql);	

		foreach ($query->rows as $result) {

			$form_to_customer[] = $result['customer_group_id'];

		}
		return $form_to_customer;

	}
	public function getFormByStoreId($form_id) {

		$form_store_data = array();

		$sql="select  *  from " . DB_PREFIX . "tmdform_store where form_id='".$form_id."'";

		$query=$this->db->query($sql);	

		foreach ($query->rows as $result) {

			$form_store_data[] = $result['store_id'];
		}
		return $form_store_data;

	}
	public function getFormProductbyid($form_id){

		$product_ids=array();

		$sql="select  *  from " . DB_PREFIX . "tmdform_product where form_id='".$form_id."'";

		$query=$this->db->query($sql);	

		foreach ($query->rows as $result) {

			$product_ids[] = $result['product_id'];

		}

		return $product_ids;

 	}	

	public function getFormCategorybyid($form_id){
		$category_ids=array();
		$sql="SELECT  *  FROM " . DB_PREFIX . "tmdform_classified_category where form_id='".$form_id."'";
		$query=$this->db->query($sql);	
		foreach ($query->rows as $result) {
			$category_ids[] = $result['classified_category_id'];
		}

		return $category_ids;
 	}

	

	public function getFormManufacturerbyid($form_id){
		$manufacturer_ids=array();

		$sql="SELECT  *  FROM " . DB_PREFIX . "tmdform_manufacturer where form_id='".$form_id."'";

		$query=$this->db->query($sql);	
		foreach ($query->rows as $result) {
			$manufacturer_ids[] = $result['manufacturer_id'];
		}
		return $manufacturer_ids;

 	}	
	public function getFormFieldById($form_id) {
		$form_field_data = array();
		$form_field_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field WHERE form_id = '" . (int)$form_id . "'");
		foreach ($form_field_query->rows as $form_field) {

			$form_field_description_data = array();



			$form_field_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_description WHERE form_id = '" . (int)$form_id . "' and field_id='".$form_field['field_id']."'");

			foreach ($form_field_description_query->rows as $form_field_description) {		

				$form_field_description_data[$form_field_description['language_id']] = array(

					'form_id' => $form_field_description['form_id'],
					'field_id' => $form_field_description['field_id'],
					'field_name' => $form_field_description['field_name'],
					'help_text' => $form_field_description['help_text'],
					'placeholder' => $form_field_description['placeholder'],
					'error_message' => $form_field_description['error_message']				

				);

			}

			$form_field_options=array();			

			$form_field_options_query= $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_option WHERE form_id = '" . (int)$form_id . "' and field_id='".$form_field['field_id']."' and language_id='".$this->config->get('config_language_id')."' order by sort_order asc");			

			if(isset($form_field_options_query->row))	{

				foreach ($form_field_options_query->rows as $form_field_option) {
				

				$form_field_options_query1= $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_option WHERE form_id = '" . (int)$form_id . "' and field_id='".$form_field['field_id']."' and optiobaseid='".$form_field_option['optiobaseid']."'");

				foreach ($form_field_options_query1->rows as $form_field_option1) {

				$option_name[$form_field_option1['language_id']]=$form_field_option1['name'];

				

				}

				$this->load->model('tool/image');

				if (is_file(DIR_IMAGE . $form_field_option['image'])) {

				$thumb = $this->model_tool_image->resize($form_field_option['image'], 40, 40);

				} else {

					$thumb = $this->model_tool_image->resize('no_image.png', 40, 40);

				}

				

				$form_field_options[] = array(
					'name' => $option_name,
					'sort_order' => $form_field_option['sort_order'],
					'image' => $form_field_option['image'],
					'field_id' => $form_field_option['field_id'],
					'thumb' => $thumb,
				);
			}
			}
			$form_field_data[] = array(
				'field_id' => $form_field['field_id'],
				'type' => $form_field['type'],
				'form_status' => $form_field['form_status'],
				'required' => $form_field['required'],
				'sort_order' => $form_field['sort_order'],
				'form_field_description' => $form_field_description_data,
				'form_field_options' => $form_field_options
			);

		}

		return $form_field_data;

	}
	public function getFormfields($form_id) {
		$submit_data = array();
		$submit_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_submit WHERE form_id = '" . (int)$form_id . "'");
		foreach($submit_query->rows as $submit) {
			$field_data=array();
			$data_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdfield_submit WHERE fs_id = '" . (int)$submit['fs_id'] . "'");
			foreach($data_query->rows as $fieldsubmit) {
				$field_data=array(
					'field_id' => $fieldsubmit['field_id'],
					'value' => $fieldsubmit['value']
				);

			}		
			$submit_data = array(
				'form_id' => $submit['form_id'],
				'fieldsubmit' => $field_data
			);		
		}	
		return $submit_data;
	}
	public function getTotalFormfield($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "tmdform_field where form_id<>0 ";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	public function getexportheading($form_id){
		$sql="select * from " . DB_PREFIX . "tmdfield_submit where form_id='".$form_id."'  group by field_id ORDER by sort_order asc ";
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getexportsubmit($form_id){
		$sql="select * from " . DB_PREFIX . "tmdform_submit where form_id='".$form_id."' ORDER by date_added desc ";
		$query = $this->db->query($sql);
		return $query->rows;

	}



	public function getfieldtype($field_id){
		$sql="select type from " . DB_PREFIX . "tmdform_field where field_id='".$field_id."'";
		$query = $this->db->query($sql);
		return $query->row['type'];

	}

	public function getFieldExport($fs_id,$form_id, $field_id){
		$sql="select * from " . DB_PREFIX . "tmdfield_submit where fs_id='".$fs_id."'  and form_id='".$form_id."' and field_id='".$field_id."'";	

		$query = $this->db->query($sql);

		if(isset($query->row['value']))	{			

				if($query->row['serialize']){
					$data='';				

					$values=unserialize($query->row['value']);			

					foreach($values as $value) {
						$data .=$value.',';
					}			

					return $data;	
					} else	{		

					return $query->row['value'];
				}
		}

	}
	public function deleteAllFieldById($field_id){	
		$sql="delete  from " . DB_PREFIX . "tmdform_field where field_id='".$field_id."'";
		$query=$this->db->query($sql);
		$sql="delete  from " . DB_PREFIX . "tmdform_field_description where field_id='".$field_id."'";
		$query=$this->db->query($sql);
		$sql="delete  from " . DB_PREFIX . "tmdform_field_option where field_id='".$field_id."'";
		$sql="delete  from " . DB_PREFIX . "tmdform_field_option_base where field_id='".$field_id."'";
		$query=$this->db->query($sql);	

 	} 
	public function getHeaderlinks(){
		$sql = "SELECT * FROM " . DB_PREFIX . "tmdform t LEFT JOIN " . DB_PREFIX . "tmdform_description td ON (t.form_id = td.form_id) WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$query=$this->db->query($sql);
		return $query->rows;
	}	
}
?>