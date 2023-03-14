<?php
class Controllerclassifiedclassifiedpackage extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('classified/classified_package');

		$this->document->setTitle($this->language->get('heading_title'));
		

		$this->load->model('classified/classified_package');
			$this->getList();
			
	}

	public function add() {

		$this->load->language('classified/classified_package');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('classified/classified_package');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){
			$this->model_classified_classified_package->addPackage($this->request->post);
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
			$this->response->redirect($this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('classified/classified_package');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classified_package');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $package_id) {
				$this->model_classified_classified_package->deletePackage($package_id);
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

			$this->response->redirect($this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function edit() {
		$this->load->language('classified/classified_package');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classified_package');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_classified_classified_package->editPackage($this->request->get['package_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	protected function getList() {
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('classified/classified_package/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('classified/classified_package/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['postplacements'] = array();
		$this->load->model('tool/image');
		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$post_placement_total = $this->model_classified_classified_package->getTotalPackages($filter_data);
		$post_placement_info = $this->model_classified_classified_package->getPackages($filter_data);
		foreach($post_placement_info as $result) {

			if (is_file(DIR_IMAGE . $result['package_icon'])) {
				$image = $this->model_tool_image->resize($result['package_icon'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			if(!empty($result['status'])){
				$status=$this->language->get('text_enabled');
			}else{
				$status=$this->language->get('text_disabled');
			}


			$data['postplacements'][] = array(
				'package_id' 		=> $result['package_id'],
				'package_icon' 		=> $image,
				'package_name' 		=> $result['package_name'],
				'price' 			=> $result['price'],
				'type' 		=> $result['no_of_day'].' '.$result['type'],
				'status' 		=> $status,
				'edit'      		=> $this->url->link('classified/classified_package/edit', 'token=' . $this->session->data['token'] . '&package_id=' . $result['package_id'] . $url, true)

			);
		}
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['token'] 		= $this->session->data['token'];
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_package_name'] = $this->language->get('column_package_name');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_duration'] = $this->language->get('column_duration');
		$data['column_icon'] = $this->language->get('column_icon');
		$data['column_status'] = $this->language->get('column_status');
		$data['button_add'] = $this->language->get('button_add');
		$data['entry_page'] = $this->language->get('entry_page');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['entry_ebook'] = $this->language->get('entry_ebook');
		$data['entry_author'] = $this->language->get('entry_author');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_total_page'] = $this->language->get('entry_total_page');
		$data['entry_book_format'] = $this->language->get('entry_book_format');
		$data['list_title'] = $this->language->get('list_title');
	   

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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
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
		$data['sort_package_icon'] = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . '&sort=package_icon' . $url, true);
		$data['sort_package_name'] = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . '&sort=package_name' . $url, true);
		$data['sort_price'] = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . '&sort=price' . $url, true);
		$data['sort_type'] = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . '&sort=type' . $url, true);
		$data['sort_status'] = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . '&sort=status' . $url, true);
	    $url = '';

		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		$pagination = new Pagination();
		$pagination->total = $post_placement_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($post_placement_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($post_placement_total - $this->config->get('config_limit_admin'))) ? $post_placement_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $post_placement_total, ceil($post_placement_total / $this->config->get('config_limit_admin')));

		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/classified_package', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['package_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_pdf'] = $this->language->get('text_pdf');
		$data['text_flash'] = $this->language->get('text_flash');
		$data['text_upload'] = $this->language->get('text_upload');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['entry_page'] = $this->language->get('entry_page');
		$data['entry_one_week_price'] = $this->language->get('entry_one_week_price');
		$data['column_duration'] = $this->language->get('column_duration');
		$data['column_price'] = $this->language->get('column_price');
		$data['text_1week'] = $this->language->get('text_1week');
		$data['text_2week'] = $this->language->get('text_2week');
		$data['text_3week'] = $this->language->get('text_3week');
		$data['text_5week'] = $this->language->get('text_5week');
		$data['text_2month'] = $this->language->get('text_2month');
		$data['text_6month'] = $this->language->get('text_6month');
		$data['text_1year'] = $this->language->get('text_1year');
		//new variable
		$data['entry_sticker_icon'] = $this->language->get('entry_sticker_icon');
		$data['entry_select_color'] = $this->language->get('entry_select_color');
		$data['entry_yellow'] = $this->language->get('entry_yellow');
		$data['entry_bandwhite'] = $this->language->get('entry_bandwhite');
		$data['entry_without_color'] = $this->language->get('entry_without_color');
		$data['entry_classifiedlimit'] = $this->language->get('entry_classifiedlimit');
		$data['entry_one_day'] = $this->language->get('entry_one_day');
		$data['entry_one_week'] = $this->language->get('entry_one_week');
		$data['entry_one_month'] = $this->language->get('entry_one_month');
		$data['entry_one_years'] = $this->language->get('entry_one_years');
		$data['entry_select_day'] = $this->language->get('entry_select_day');
		$data['entry_no_days'] = $this->language->get('entry_no_days');
		$data['entry_package_duration'] = $this->language->get('entry_package_duration');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['label_price_symbol'] = $this->language->get('label_price_symbol');
		$data['label_package_day'] = $this->language->get('label_package_day');
		$data['label_price'] = $this->language->get('label_price');
		$data['label_name'] = $this->language->get('label_name');
		
		//new variable
		$data['button_add'] = $this->language->get('button_add');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_none'] = $this->language->get('text_none');
		$data['token'] 		= $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['price'])) {
			$data['error_price'] = $this->error['price'];
		} else {
			$data['error_price'] = '';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['package_id'])) {
			$data['action'] = $this->url->link('classified/classified_package/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('classified/classified_package/edit', 'token=' . $this->session->data['token'] . '&package_id=' . $this->request->get['package_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['package_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$post_placement_info = $this->model_classified_classified_package->getPackage($this->request->get['package_id']);

		}

		if (isset($this->request->post['package_icon'])) {
			$data['image'] = $this->request->post['package_icon'];
		} elseif (!empty($post_placement_info)) {
			$data['image'] = $post_placement_info['package_icon'];
		} else {
			$data['image'] = '';
		}

		if (isset($post_placement_info['package_name'])) {
			$data['package_name'] = $post_placement_info['package_name'];
		}else {
			$data['package_name'] = '';
		}

		if (isset($post_placement_info['price'])) {
			$data['price'] = $post_placement_info['price'];
		}else {
			$data['price'] = '';
		}

		if (isset($post_placement_info['no_of_day'])) {
			$data['no_of_day'] = $post_placement_info['no_of_day'];
		}else {
			$data['no_of_day'] = '';
		}
		if (isset($post_placement_info['type'])) {
			$data['type'] = $post_placement_info['type'];
		}else {
			$data['type'] = '';
		}

		if (isset($post_placement_info['classified_limit'])) {
			$data['classified_limit'] = $post_placement_info['classified_limit'];
		}else {
			$data['classified_limit'] = '';
		}

		if (isset($post_placement_info['package_icon'])) {
			$data['package_icon'] = $post_placement_info['package_icon'];
		}else {
			$data['package_icon'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['package_icon']) && is_file(DIR_IMAGE . $this->request->post['package_icon'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['package_icon'], 100, 100);
		} elseif (!empty($post_placement_info) && is_file(DIR_IMAGE . $post_placement_info['package_icon'])) {
			$data['thumb'] = $this->model_tool_image->resize($post_placement_info['package_icon'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($post_placement_info)) {
			$data['status'] = $post_placement_info['status'];
		} else {
			$data['status'] = true;
		}

		$data['days'] = range(1, 31);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/classified_package_form', $data));
	}
	protected function validateForm(){
		if (!$this->user->hasPermission('modify', 'classified/classified_package')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['package_name']) < 2) || (utf8_strlen($this->request->post['package_name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		if ((empty($this->request->post['price']))) {
			$this->error['price'] = $this->language->get('error_price');
		}
		

		return !$this->error;
	}
		
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'classified/classified_package')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		$this->load->model('classified/classified_package');

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();
			$this->load->model('classified/classifiedadd');
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => 5
			);
			$results = $this->model_classified_classifiedadd->getEbooks($filter_data);
			foreach ($results as $result) {
				$json[] = array(
					'classified_id'       => $result['classified_id'],
					'name'                           => $result['title'],
				
				
				);
			}
		

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


	
}