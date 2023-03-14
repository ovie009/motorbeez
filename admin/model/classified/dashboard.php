<?php
class ModelclassifiedDashboard extends Model {
	
	public function getTotalclassifieds() {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified where classified_id<>0";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	public function getTotalcustomers() {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer where customer_id<>0";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function getTotalInvoice() {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "classified_paid_package where order_status_id='5'";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}


	public function getRecentcustomers() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id<>0 order BY customer_id DESC limit 4");
		return $query->rows;
	}

	public function getRecentClassifieds() {
		$sql = "SELECT * FROM " . DB_PREFIX . "classified c LEFT JOIN " . DB_PREFIX . "classified_description cd ON (c.classified_id = cd.classified_id)  WHERE c.classified_id<>0  AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' order BY c.classified_id DESC limit 4";
		$query = $this->db->query($sql);

		return $query->rows;
	}


	public function getClassifiedImage($classified_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_ad_image WHERE classified_id = '" . (int)$classified_id . "'");

		return $query->row;
	}
	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}
	
	public function getRecentInvoices() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_paid_package WHERE classified_paid_package_id<>0 AND order_status_id='5' order BY classified_paid_package_id DESC limit 4");
		return $query->rows;
	}

	public function getcustomermonth(){ 
		$query = $this->db->query("SELECT year(date_added) as year, month(date_added) as month, count(customer_id) as total_customer FROM " . DB_PREFIX . "customer group by year(date_added), month(date_added)");
		return $query->rows;  
    }

    public function getRevenueTotal(){ 
		$query = $this->db->query("SELECT sum(price) as total FROM " . DB_PREFIX . "classified_paid_package WHERE order_status_id='5'");
		return $query->row['total'];  
    }
}