<?php
class ModelClassifiedCity extends Model {
	public function addCity($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "city SET status = '" . (int)$data['status'] . "', cityname = '" . $this->db->escape($data['cityname']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "'");

		$city_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "city SET image = '" . $this->db->escape($data['image']) . "' WHERE city_id = '" . (int)$city_id . "'");
		}
		
		if (isset($data['hoverimg'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "city SET hoverimg = '" . $this->db->escape($data['hoverimg']) . "' WHERE city_id = '" . (int)$city_id . "'");
		}
		
	}

	public function editCity($city_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "city SET status = '" . (int)$data['status'] . "', cityname = '" . $this->db->escape($data['cityname']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "' WHERE city_id = '" . (int)$city_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "city SET image = '" . $this->db->escape($data['image']) . "' WHERE city_id = '" . (int)$city_id . "'");
		}
		
		if (isset($data['hoverimg'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "city SET hoverimg = '" . $this->db->escape($data['hoverimg']) . "' WHERE city_id = '" . (int)$city_id . "'");
		}
		
		$this->cache->delete('city');
	}
	
	public function deleteCity($city_id){
		$sql="delete  from " . DB_PREFIX . "city where city_id='".$city_id."'";
		$query=$this->db->query($sql);
	}

	public function getCity($city_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "city c LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) WHERE city_id = '" . (int)$city_id . "'");
		
		return $query->row;
	}
	
	
	public function getcityname($city_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE city_id = '" .$city_id . "'");
		
		return $query->row;
	}
	
	
	
	public function getCityimagesss($city_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city c WHERE city_id = '" . (int)$city_id . "'");
		return $query->row;
	}
	
	
	public function getCityvehicle($city_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "city c LEFT JOIN " . DB_PREFIX . "vehicle v ON (v.city = c.city_id) WHERE c.city_id = '" . (int)$city_id . "'");
		return $query->rows;
	}
	
	public function getCityimagess($city_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "city c LEFT JOIN " . DB_PREFIX . "vehicle v ON (v.city = c.city_id) WHERE c.city_id = '" . (int)$city_id . "'");
		return $query->row;
	}

	public function getCities($data = array()) {
		$sql = "SELECT c.city_id, c.cityname, c.zone_id, z.name AS zone, z.code, ct.name as country	FROM " . DB_PREFIX . "city c LEFT JOIN " . DB_PREFIX . "zone z ON (c.zone_id = z.zone_id) LEFT JOIN " . DB_PREFIX . "country ct ON (c.country_id = ct.country_id) where c.city_id<>0";
		
		if (isset($data['filter_name'])) {
			$sql .= " AND c.cityname LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'c.cityname',
			'z.name',
			'ct.name'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY c.cityname";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if(isset($data['sort']) && $data['sort'] != 'c.cityname'){
			$sql .= ", c.cityname ASC";
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

	public function getCitiesByZoneId($zone_id) {
		$city_data = $this->cache->get('city.' . (int)$zone_id);

		if (!$city_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE zone_id = '" . (int)$zone_id . "' AND status = '1' ORDER BY cityname");

			$zone_data = $query->rows;

			$this->cache->set('zone.' . (int)$zone_id, $zone_data);
		}
		return $zone_data;
	}

	public function getTotalCities() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "city");

		return $query->row['total'];
	}

	public function getTotalCitiesByZoneId($zone_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "city WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row['total'];
	}

	
}