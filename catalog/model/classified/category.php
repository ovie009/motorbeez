<?php
class ModelclassifiedCategory extends Model {

	public function getPostCategories($parent_id=0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_category c LEFT JOIN " . DB_PREFIX . "post_category_description cd ON (c.post_category_id = cd.post_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
		return $query->rows;	
	}

public function getPostCategory($data =array()) {
			$sql = "SELECT cp.post_category_id AS post_category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "post_category_path cp LEFT JOIN " . DB_PREFIX . "post_category c1 ON (cp.post_category_id = c1.post_category_id) LEFT JOIN " . DB_PREFIX . "post_category c2 ON (cp.path_id = c2.post_category_id) LEFT JOIN " . DB_PREFIX . "post_category_description cd1 ON (cp.path_id = cd1.post_category_id) LEFT JOIN " . DB_PREFIX . "post_category_description cd2 ON (cp.post_category_id = cd2.post_category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if (!empty($data['filter_name'])) {

			$sql .= " AND cd1.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";

		}
		$sql .= " GROUP BY cp.post_category_id";
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


	public function getPostEditCategory($post_id) {
		$post_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_edit_category WHERE post_id = '" . (int)$post_id . "'");

		foreach ($query->rows as $result) {
			$post_category_data[] = $result['post_category_id'];
		}

		return $post_category_data;
	}

	public function getPostCategoryDesc($post_category_id) {
		$query  = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_category pc LEFT JOIN " . DB_PREFIX . "post_category_description pcd ON (pc.post_category_id = pcd.post_category_id) WHERE pcd.post_category_id = '" . (int)$post_category_id . "' AND pcd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getTotalPostCategories($parent_id=0) {
		$query = $this->db->query("SELECT count(*) AS total FROM " . DB_PREFIX . "post_category c LEFT JOIN " . DB_PREFIX . "post_category_description cd ON (c.post_category_id = cd.post_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1'");
	
		return $query->row['total'];
	}


	public function getsubCategory($post_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_category_description where post_category_id = '" . (int)$post_category_id."'");

		return $query->row;
	}

	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id)  WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}
	public function getPostCategorie($post_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_category c LEFT JOIN " . DB_PREFIX . "post_category_description cd ON (c.post_category_id = cd.post_category_id)  WHERE c.parent_id = '" . (int)$post_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}


		public function getCategory($post_category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "post_category c LEFT JOIN " . DB_PREFIX . "post_category_description cd ON (c.post_category_id = cd.post_category_id) WHERE c.post_category_id = '" . (int)$post_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

		public function getCategory_classified($post_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_post_category WHERE post_category_id = '" . (int)$post_category_id . "'");

		return $query->row;
	}

}
