<?php
class ControllerStartupSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}
		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}
			
			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);

					if ($url[0] == 'classified_id') {
						$this->request->get['classified_id'] = $url[1];
					}


					if ($url[0] == 'classified_category_id') {
						$this->request->get['classified_category_id'] = $url[1];
					}

					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}

					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'manufacturer_id' && $url[0] != 'classified_category_id' && $url[0] != 'classified_id') {
						$this->request->get['route'] = $query->row['query'];
					}
				} else {


					$query1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified WHERE `classified_id`='" .(int)$part . "'");

					if ($query1->num_rows)

					{
						$this->request->get['classified_id'] =(int)$part;
					}

					else{
					$this->request->get['route'] = 'error/not_found';
					}

					break;


				}
			}

			if (!isset($this->request->get['route'])) {
				if (isset($this->request->get['classified_id'])) {
					$this->request->get['route'] = 'classified/classified_view';
				} elseif (isset($this->request->get['classified_category_id'])) {
					$this->request->get['route'] = 'classified/classified_search';
				} elseif (isset($this->request->get['information_id'])) {
					$this->request->get['route'] = 'information/information';
				}
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));
		$url = '';

		$data = array();

		parse_str($url_info['query'], $data);
		foreach ($data as $key => $value) {
		
			if (isset($data['route'])) {
				if (($data['route'] == 'classified/classified_view' && $key == 'classified_id') || ($data['route'] == 'classified/classified_search' && $key == 'classified_category_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}
				} elseif ($key == 'path') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'classified_category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
			}
		}

		

		
		if ($url) {
			unset($data['route']);

			$query = '';

			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((is_array($value) ? http_build_query($value) : (string)$value));
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}

	
}
