<?php
class Modelclassifiedclassifiedpackage extends Model {
	public function addPackage($data){
		$sql="INSERT INTO " . DB_PREFIX . "classified_package set package_name='".$this->db->escape($data['package_name'])."',price='".$this->db->escape($data['price'])."',no_of_day='".(int)$data['no_of_day']."',type='".$this->db->escape($data['type'])."',package_icon='".$this->db->escape($data['package_icon'])."',classified_limit='".$this->db->escape($data['classified_limit'])."', status='".(int)$data['status']."'";
		$this->db->query($sql);
		$package_id = $this->db->getLastId();
	}

//edit
	public function editPackage($package_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "classified_package set package_name='".$this->db->escape($data['package_name'])."',price='".$this->db->escape($data['price'])."',no_of_day='".(int)$data['no_of_day']."',type='".$this->db->escape($data['type'])."',package_icon='".$this->db->escape($data['package_icon'])."',classified_limit='".$this->db->escape($data['classified_limit'])."', status='".(int)$data['status']."' WHERE package_id = '" .$package_id . "'");
	 }
	
	public function getPackage($package_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_package where package_id='".$package_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

		public function getCustomerPackage($customer_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_paid_package where customer_id='".$customer_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getPackages($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified_package WHERE package_id<>0";
			
			$sort_data = array(
			'package_id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY package_id";
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
	public function getTotalPackages($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_package where package_id<>0";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	public function deletePackage($package_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "classified_package WHERE package_id = '" . (int)$package_id . "'");
		$this->cache->delete('package_id');
	
	}
}
