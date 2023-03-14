<?php
class ModelclassifiedClassifiedcategory extends Model {
	public function addPostCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "classified_category SET parent_id = '" . (int)$data['parent_id'] . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$classified_category_id = $this->db->getLastId();


//Post category _path start 07-09-2018 //
		$level = 0;
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "classified_category_path` SET `classified_category_id` = '" . (int)$classified_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "classified_category_path` SET `classified_category_id` = '" . (int)$classified_category_id . "', `path_id` = '" . (int)$classified_category_id . "', `level` = '" . (int)$level . "'");
//Post category _path end 07-09-2018//

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "classified_category SET image = '" . $this->db->escape($data['image']) . "' WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		}

		foreach ($data['classified_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "classified_category_description SET classified_category_id = '" . (int)$classified_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'classified_category_id=" . (int)$classified_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('category');

		return $classified_category_id;
	}

	public function editPostCategory($classified_category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified_category SET parent_id = '" . (int)$data['parent_id'] . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE classified_category_id = '" . (int)$classified_category_id . "'");


		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_description WHERE classified_category_id = '" . (int)$classified_category_id . "'");

		foreach ($data['classified_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "classified_category_description SET classified_category_id = '" . (int)$classified_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

//Post category _path start 07-09-2018 //
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_category_path` WHERE path_id = '" . (int)$classified_category_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $classified_category_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$classified_category_path['classified_category_id'] . "' AND level < '" . (int)$classified_category_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$classified_category_path['classified_category_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "classified_category_path` SET classified_category_id = '" . (int)$classified_category_path['classified_category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$classified_category_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "classified_category_path` SET classified_category_id = '" . (int)$classified_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "classified_category_path` SET classified_category_id = '" . (int)$classified_category_id . "', `path_id` = '" . (int)$classified_category_id . "', level = '" . (int)$level . "'");
		}
//Post category _path end 07-09-2018 //


		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "classified_category SET image = '" . $this->db->escape($data['image']) . "' WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_description WHERE classified_category_id = '" . (int)$classified_category_id . "'");

		foreach ($data['classified_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "classified_category_description SET classified_category_id = '" . (int)$classified_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_category_id=" . (int)$classified_category_id . "'");

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'classified_category_id=" . (int)$classified_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('category');
	}

	public function repairPostCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $category) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$category['classified_category_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "classified_category_path` WHERE classified_category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "classified_category_path` SET classified_category_id = '" . (int)$category['classified_category_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "classified_category_path` SET classified_category_id = '" . (int)$category['classified_category_id'] . "', `path_id` = '" . (int)$category['classified_category_id'] . "', level = '" . (int)$level . "'");

			$this->repairPostCategories($category['classified_category_id']);
		}
	}


	public function getPostCategory($classified_category_id) {
	
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "classified_category_path cp LEFT JOIN " . DB_PREFIX . "classified_category_description cd1 ON (cp.path_id = cd1.classified_category_id AND cp.classified_category_id != cp.path_id) WHERE cp.classified_category_id = c.classified_category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.classified_category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_category_id=" . (int)$classified_category_id . "') AS keyword FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd2 ON (c.classified_category_id = cd2.classified_category_id) WHERE c.classified_category_id = '" . (int)$classified_category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPostCategoryDesc($classified_category_id) {
	
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "classified_category_path cp LEFT JOIN " . DB_PREFIX . "classified_category_description cd1 ON (cp.path_id = cd1.classified_category_id AND cp.classified_category_id != cp.path_id) WHERE cp.classified_category_id = c.classified_category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.classified_category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_category_id=" . (int)$classified_category_id . "') AS keyword FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd2 ON (c.classified_category_id = cd2.classified_category_id) WHERE c.classified_category_id = '" . (int)$classified_category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	public function getCatgmatch($classified_category_id) {
		$query  = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_package  WHERE  classified_category_id = '" . $this->db->escape(utf8_strtolower($classified_category_id)) . "'");

		return $query->row;
	}
	

	public function getPostCategoryDescription($classified_category_id) {
		$post_category_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category_description WHERE classified_category_id = '" . (int)$classified_category_id . "'");

		foreach ($query->rows as $result) {
			$post_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'classified_category_id'             => $result['classified_category_id'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $post_category_description_data;
	}

	public function getPostCategories($data = array()) {
		$sql = "SELECT cp.classified_category_id AS classified_category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "classified_category_path cp LEFT JOIN " . DB_PREFIX . "classified_category c1 ON (cp.classified_category_id = c1.classified_category_id) LEFT JOIN " . DB_PREFIX . "classified_category c2 ON (cp.path_id = c2.classified_category_id) LEFT JOIN " . DB_PREFIX . "classified_category_description cd1 ON (cp.path_id = cd1.classified_category_id) LEFT JOIN " . DB_PREFIX . "classified_category_description cd2 ON (cp.classified_category_id = cd2.classified_category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {

			$sql .= " AND cd1.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";

		}
		$sql .= " GROUP BY cp.classified_category_id";
		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function deletePostCategory($classified_category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_path WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_description WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdform_classified_category WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'classified_category_id=" . (int)$classified_category_id . "'");

		$this->cache->delete('classified_category_path');
	}
	
	public function getTotalPostCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_category");

		return $query->row['total'];
	}
		public function getPostclassifiedCategories($parent_id=0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
		return $query->rows;	
	}

	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id)  WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}
	public function getCategoriesss($data = array()) {
		
		$sql = " SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id)  WHERE c.classified_category_id<>0 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        
        if (!empty($data['filter_name'])) {

			$sql .= " AND cd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";

		}

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		return $query->rows;

	}


		public function getCategory_classified($classified_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category WHERE classified_category_id = '" . (int)$classified_category_id . "'");

		return $query->row;
	}

	public function getForms($form_id) {
		$form_field_data = array();
		
		$form_field_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field tf LEFT JOIN " . DB_PREFIX . "tmdform_field_description tfd ON (tf.field_id = tfd.field_id) WHERE tf.form_id = '" .(int)$form_id . "' AND tfd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY tf.sort_order");
		
		foreach ($form_field_query->rows as $form_field) {
			$form_field_option_data = array();
			
			$form_field_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_option WHERE field_id = '".(int)$form_field['field_id'] ."' AND language_id = '" . (int)$this->config->get('config_language_id') . "' order by sort_order asc");
			
			foreach ($form_field_option_query->rows as $form_field_option) {
				$form_field_option_data[] = array(
					'field_id' 		=> $form_field_option['field_id'],
					'form_id' 		=> $form_field_option['form_id'],
					'name' 			=> $form_field_option['name'],
					'image' 		=> $form_field_option['image'],
					'sort_order' 	=> $form_field_option['sort_order']
				);
			}

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
				'form_field_option' => $form_field_option_data
			);
			
		}
		return $form_field_data;
	}


		public function getFormsOption($form_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "tmdform_field_option WHERE form_id =' ".$form_id."'";
		$query=$this->db->query($sql);
		
		return $query->rows;
	}
	
}
