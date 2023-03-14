<?php
class Modelclassifiedclassifiedsetting extends Model {
	public function addPostPlacement($data){
		$sql="INSERT INTO " . DB_PREFIX . "classified_package set title='".$this->db->escape($data['title'])."',price='".$this->db->escape($data['price'])."',package_time='".$this->db->escape($data['package_time'])."',package_icon='".$this->db->escape($data['package_icon'])."',package_color='".$this->db->escape($data['package_color'])."'";
		$this->db->query($sql);
		$placement_id = $this->db->getLastId();
	}

//edit
	public function editPostPlacement($placement_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified_package set title='".$this->db->escape($data['title'])."',price='".$this->db->escape($data['price'])."',package_time='".$this->db->escape($data['package_time'])."',package_icon='".$this->db->escape($data['package_icon'])."',package_color='".$this->db->escape($data['package_color'])."' WHERE placement_id = '" .$placement_id . "'");
	 }
	
	public function getPostPlacement($placement_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_package where placement_id='".$placement_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}



	
	public function getPostPlacements($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_package WHERE placement_id<>0";
			
			$sort_data = array(
			'placement_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY placement_id";
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
	public function getTotalPostPlacement($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_package where placement_id<>0";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	public function deletePostPlacement($placement_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_package WHERE placement_id = '" . (int)$placement_id . "'");
		$this->cache->delete('placement_id');
	
	}
}
