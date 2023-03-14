<?php
class ModelclassifiedClassifiedCategory extends Model {
	public function getPostCategories($parent_id=0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
		return $query->rows;	
	}

public function getPostCategory($data =array()) {
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

	public function deletePostCategory($classified_category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_path WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_description WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_category_filter WHERE classified_category_id = '" . (int)$classified_category_id . "'");
		$this->cache->delete('category');
	}



	public function getPostCategoryDesc($classified_category_id) {
		$query  = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category pc LEFT JOIN " . DB_PREFIX . "classified_category_description pcd ON (pc.classified_category_id = pcd.classified_category_id) WHERE pcd.classified_category_id = '" . (int)$classified_category_id . "' AND pcd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getTotalPostCategories($parent_id=0) {
		$query = $this->db->query("SELECT count(*) AS total FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1'");
	
		return $query->row['total'];
	}


	public function getsubCategory($classified_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category_description where classified_category_id = '" . (int)$classified_category_id."'");

		return $query->row;
	}

	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id)  WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}
	public function getPostCategorie($classified_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id)  WHERE c.parent_id = '" . (int)$classified_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}


		public function getCategory($classified_category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "classified_category c LEFT JOIN " . DB_PREFIX . "classified_category_description cd ON (c.classified_category_id = cd.classified_category_id) WHERE c.classified_category_id = '" . (int)$classified_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}


	public function customerAllad($data) {
         
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0 AND c.approve=1 AND c.active=1  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
	

		if (!empty($data['classified_category_id'])) {
			$sql .= " AND c.classified_category_id = '" . (int)$data['classified_category_id'] . "'";
		}
	
		if (!empty($data['filter_city'])){
			$sql .=" and (c.city like '%".$this->db->escape($data['filter_city'])."%')";
		}

		if (!empty($data['filter_name'])){
			$sql .=" and (cd.title like '%".$this->db->escape($data['filter_name'])."%' OR cd.post_description like '%".$this->db->escape($data['filter_name'])."%' OR c.price like '%".$this->db->escape($data['filter_name'])."%')";
		}


		$sort_data = array(
			'c.classified_category_id'
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

	 public function getTotalusealladd($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0 AND c.approve=1 AND c.active=1  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['classified_category_id'])) {
			$sql .= " AND c.classified_category_id = '" . (int)$data['classified_category_id'] . "'";
		}

		if ((isset($data['filter_name']))){
				$sql .=" and (cd.title like '%".$this->db->escape($data['filter_name'])."%' OR cd.post_description like '%".$this->db->escape($data['filter_name'])."%' OR c.price like '%".$this->db->escape($data['filter_name'])."%')";
	
		}

		$query = $this->db->query($sql);
		return $query->row['total'];
	}
}
