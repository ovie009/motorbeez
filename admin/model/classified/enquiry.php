<?php
class ModelclassifiedEnquiry extends Model {
	public function addEnquiry($data) {
		$sql="INSERT INTO " . DB_PREFIX . "post_enquiry set
			name='".$this->db->escape($data['name'])."',
			email='".$this->db->escape($data['email'])."',
			description='".$this->db->escape($data['description'])."',
			post_id='".$this->db->escape($data['post_id'])."',
			customer_id='".$this->db->escape($data['customer_id'])."',
			date_added=now()";
		
			$this->db->query($sql);
	}

//edit start
	public function editEnquiry($id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "post_enquiry SET 
			name='".$this->db->escape($data['name'])."',
			email='".$this->db->escape($data['email'])."',
			description='".$this->db->escape($data['description'])."',
			post_id='".$this->db->escape($data['post_id'])."',
			customer_id='".$this->db->escape($data['customer_id'])."',
			date_modified=now() WHERE id = '" . (int)$id . "'");
	}
//edit end

	public function getEnquiry($id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "post_enquiry where id='".$id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getEnquiries($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "post_enquiry where id<>0";
		
		$sort_data = array(
			'id'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY id";
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

	public function getTotaleEnquiries($data) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "post_enquiry where id<>0";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function deleteEnquiry($id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_enquiry WHERE id = '" . (int)$id . "'");
		$this->cache->delete('id');
	}
}
