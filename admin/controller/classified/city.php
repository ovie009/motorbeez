<?php 
class ControllerclassifiedCity extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('classified/city');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('classified/city');
		$this->getList();
	}

	public function add() {
		$this->language->load('classified/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/city');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$city = $this->request->post;
			
			$this->load->model('localisation/country');
			$country = $this->model_localisation_country->getCountry($city['country_id']);
			$city['country_iso_code_2'] = $country['iso_code_2'];
			$this->load->model('localisation/zone');
			$zone = $this->model_localisation_zone->getZone($city['zone_id']);
			$city['zone_code'] = $zone['code'];
			$this->model_classified_city->addCity($city);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('classified/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/city');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$city = $this->request->post;
			$this->load->model('localisation/country');
			$country = $this->model_localisation_country->getCountry($city['country_id']);
			$city['country_iso_code_2'] = $country['iso_code_2'];
			$this->load->model('localisation/zone');
			$zone = $this->model_localisation_zone->getZone($city['zone_id']);
			$city['zone_code'] = $zone['code'];
			
			$this->model_classified_city->editCity($this->request->get['city_id'], $city);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('classified/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/city');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $city_id) {
				$this->model_classified_city->deleteCity($city_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'c.cityname';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$data['add'] = $this->url->link('classified/city/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('classified/city/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		
		$data['cities'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$city_total = $this->model_classified_city->getTotalCities($filter_data);

		$results = $this->model_classified_city->getCities($filter_data);
		
		foreach ($results as $result) {
			$action = array();

			$data['cities'][] = array(
				'city_id' => $result['city_id'],
				'zone' 	=> $result['zone'],
				'country' 	=> $result['country'],
				'cityname'       => $result['cityname'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['city_id'], $this->request->post['selected']),				
				'edit'    => $this->url->link('classified/city/edit', 'token=' . $this->session->data['token'] . '&city_id=' . $result['city_id'] . $url, 'SSL')
			);
		}
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_add'] = $this->language->get('button_add');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_zone'] = $this->language->get('column_zone');
		$data['column_country'] = $this->language->get('column_country');
		$data['column_action'] = $this->language->get('column_action');	
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('classified/city', 'token=' . $this->session->data['token'] . '&sort=c.cityname' . $url, 'SSL');
		$data['sort_zone'] = $this->url->link('classified/city', 'token=' . $this->session->data['token'] . '&sort=z.name' . $url, 'SSL');
		$data['sort_country'] = $this->url->link('classified/city', 'token=' . $this->session->data['token'] . '&sort=ct.name' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $city_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($city_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($city_total - $this->config->get('config_limit_admin'))) ? $city_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $city_total, ceil($city_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/city_list.tpl', $data));
		
		
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = !isset($this->request->get['city_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['text_select'] = $this->language->get('text_select');	
		$data['entry_status'] = $this->language->get('entry_status');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_hoverimage'] = $this->language->get('entry_hoverimage');
		$data['entry_local_city'] = $this->language->get('entry_local_city');
		$data['entry_local_cityname'] = $this->language->get('entry_local_cityname');
		
		$data['entry_latitude'] = $this->language->get('entry_latitude');
		$data['entry_longitude'] = $this->language->get('entry_longitude');
		$data['entry_map'] = $this->language->get('entry_map');
		
		$data['token'] = $this->session->data['token'];
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['cityname'])) {
			$data['error_name'] = $this->error['cityname'];
		} else {
			$data['error_name'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		
		if (!isset($this->request->get['city_id'])) {
			$data['action'] = $this->url->link('classified/city/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('classified/city/edit', 'token=' . $this->session->data['token'] . '&city_id=' . $this->request->get['city_id'] . $url, 'SSL');
		}

		
		$data['cancel'] = $this->url->link('classified/city', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['city_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
		$city_info = $this->model_classified_city->getCity($this->request->get['city_id']);
			
		}
		
		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}

		
		if (isset($this->request->post['cityname'])) {
			$data['cityname'] = $this->request->post['cityname'];
		} elseif (!empty($city_info)) {
			$data['cityname'] = $city_info['cityname'];
		} else {
			$data['cityname'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($city_info)) {
			$data['country_id'] = $city_info['country_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($city_info)) {
			$data['zone_id'] = $city_info['zone_id'];
		} else {
			$data['zone_id'] = $this->config->get('config_zone_id');
		}

		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($city_info)) {
			$data['status'] = $city_info['status'];
		} else {
			$data['status'] = '1';
		}
				

		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$data['countries'] = $this->model_localisation_country->getCountries();
		if($data['country_id']){
			$data['zones'] = $this->model_localisation_zone->getZonesByCountryId($data['country_id']);
		}
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/city_form.tpl', $data));
		
		
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'classified/city')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['cityname']) < 3) || (utf8_strlen($this->request->post['cityname']) > 128)) {
			$this->error['cityname'] = $this->language->get('error_name');
		}
		
		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		

		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}

		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'classified/city')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

	

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	public function getmapcity(){
		$json[]=array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('localisation/country');
			$country='';
			if(isset($this->request->post['country_id'])){
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
				$country=$country_info['name'];
			}
			$this->load->model('localisation/zone');
			$zone='';
			if(isset($this->request->post['zone_id'])){
				$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);
				$zone=$country_info['name'];
			}
			
			$local_area='';
			if(isset($this->request->post['local_area']))
			{
			$local_area=$this->request->post['local_area'];
			}
		       $address=$local_area .''. $zone .' '. $country;
			 $address = str_replace(" ", "+", $address);
			 $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
			 $response = file_get_contents($url);
			 $json1 = json_decode($response,TRUE); //generate array object from the response from the web
			if(isset($json1['results'][0]['geometry']['location']['lat'])){
				$json['lat']=$json1['results'][0]['geometry']['location']['lat'];
				$json['lng']=$json1['results'][0]['geometry']['location']['lng'];
				$json['success']='Address Not Found';
			}else{
				$json['error']='Address Not Found';
			}
		}	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}
	
	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>