<?php
class ModelclassifiedAllclassified extends Model {
	
	public function getAllClassifieds($classified_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.approve=1 AND c.active='1'";

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

	public function getTotalAllclassified($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.approve=1 AND c.active='1'";

		$query = $this->db->query($sql);
		return $query->row['total'];
	}
}