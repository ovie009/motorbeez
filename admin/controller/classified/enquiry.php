<?php
class ControllerclassifiedEnquiry extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('classified/enquiry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/enquiry');

		$this->getList();
	}

	public function add() {
		$this->load->language('classified/enquiry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/enquiry');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_classified_enquiry->addEnquiry($this->request->post);

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

			$this->response->redirect($this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('classified/enquiry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/enquiry');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_classified_enquiry->deleteEnquiry($id);
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

			$this->response->redirect($this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function edit() {
		$this->load->language('classified/enquiry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/enquiry');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_classified_enquiry->editEnquiry($this->request->get['id'], $this->request->post);

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

			$this->response->redirect($this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url, true));
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
			'href' => $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('classified/enquiry/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('classified/enquiry/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['enquiries'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$enquiry_total = $this->model_classified_enquiry->getTotaleEnquiries($filter_data);
		$enquiry_info = $this->model_classified_enquiry->getEnquiries($filter_data);
		$data['enquiries']= '';

		foreach($enquiry_info as $result) {
			$data['enquiries'][] = array(
				'id' 			=> $result['id'],
				'name' 			=> $result['name'],
				'email' 		=> $result['email'],
				 'description'  => html_entity_decode(substr($result['description'], 0, 50)),
				'edit'      	=> $this->url->link('classified/enquiry/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, true),
				'respond'       => $this->url->link('classified/enquiry_reply', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] , true)

			);
		}

		$data['heading_title'] 		= $this->language->get('heading_title');

		$data['text_list'] 			= $this->language->get('text_list');
		$data['token'] 				= $this->session->data['token'];
		$data['text_no_results']	= $this->language->get('text_no_results');
		$data['text_confirm'] 		= $this->language->get('text_confirm');

		$data['column_name'] 		= $this->language->get('column_name');
		$data['column_sort_order'] 	= $this->language->get('column_sort_order');
		$data['column_action'] 		= $this->language->get('column_action');
		$data['column_classifiedname'] 	= $this->language->get('column_classifiedname');
	
		$data['button_add'] 		= $this->language->get('button_add');
		$data['button_edit'] 		= $this->language->get('button_edit');
		$data['button_delete'] 		= $this->language->get('button_delete');
		$data['button_filter'] 		= $this->language->get('button_filter');
		$data['button_reply'] 		= $this->language->get('button_reply');

		$data['entry_name'] 		= $this->language->get('entry_name');
		$data['entry_description'] 	= $this->language->get('entry_description');
		$data['entry_email'] 		= $this->language->get('entry_email');

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

		$data['sort_name'] = $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_email'] = $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);
		$data['sort_description'] = $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . '&sort=description' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination 		= new Pagination();
		$pagination->total 	= $enquiry_total;
		$pagination->page 	= $page;
		$pagination->limit 	= $this->config->get('config_limit_admin');
		$pagination->url 	= $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($enquiry_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($enquiry_total - $this->config->get('config_limit_admin'))) ? $enquiry_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $enquiry_total, ceil($enquiry_total / $this->config->get('config_limit_admin')));

		$data['sort'] 	= $sort;
		$data['order'] 	= $order;

		$data['header'] 		= $this->load->controller('common/header');
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['footer'] 		= $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/enquiry_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] 		= $this->language->get('heading_title');

		$data['text_form'] 			= !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] 		= $this->language->get('text_enabled');
		$data['text_select'] 		= $this->language->get('text_select');
		$data['text_disabled'] 		= $this->language->get('text_disabled');
		$data['text_default'] 		= $this->language->get('text_default');
		$data['text_percent'] 		= $this->language->get('text_percent');
		$data['text_amount'] 		= $this->language->get('text_amount');
		$data['text_pdf'] 			= $this->language->get('text_pdf');
		$data['text_flash'] 		= $this->language->get('text_flash');
		$data['text_upload'] 		= $this->language->get('text_upload');
		$data['tab_general'] 		= $this->language->get('tab_general');
		
		$data['entry_name'] 		= $this->language->get('entry_name');
		$data['entry_email'] 		= $this->language->get('entry_email');
		$data['entry_email'] 		= $this->language->get('entry_email');
		$data['entry_description'] 	= $this->language->get('description');
		$data['entry_post_title'] 	= $this->language->get('entry_post_title');
		$data['entry_customer'] 	= $this->language->get('entry_customer');
		
		
		$data['button_add'] 		= $this->language->get('button_add');
		$data['button_upload'] 		= $this->language->get('button_upload');
		$data['button_remove'] 		= $this->language->get('button_remove');
		$data['button_save'] 		= $this->language->get('button_save');
		$data['button_cancel'] 		= $this->language->get('button_cancel');
		$data['text_none'] 			= $this->language->get('text_none');
		$data['token'] 				= $this->session->data['token'];

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
			'href' => $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('classified/enquiry/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('classified/enquiry/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, true);
		}
		
		$data['cancel'] = $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$enquiry_info = $this->model_classified_enquiry->getEnquiry($this->request->get['id']);
			//
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($enquiry_info)) {
			$data['name'] = $enquiry_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($enquiry_info)) {
			$data['email'] = $enquiry_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (!empty($enquiry_info)) {
			$data['description'] = $enquiry_info['description'];
		} else {
			$data['description'] = '';
		}

		$this->load->model('classified/post_edit');
		$data['postedits']= $this->model_classified_post_edit->getPostEditTypes('id');
		if (isset($this->request->post['post_id'])) {
			$data['post_id'] = $this->request->post['post_id'];
		} elseif (!empty($enquiry_info)) {
			$data['post_id'] = $enquiry_info['post_id'];
		} else {
			$data['post_id'] = '';
		}

		if (isset($this->request->post['customer_id'])) {
			$data['customer_id'] = $this->request->post['customer_id'];
		} elseif (!empty($enquiry_info)) {
			$data['customer_id'] = $enquiry_info['customer_id'];
		} else {
			$data['customer_id'] = 0;
		}

		if (isset($this->request->post['customer'])) {
			$data['customer'] = $this->request->post['customer'];
		} elseif (!empty($enquiry_info)) {
			$this->load->model('customer/customer');
			$customer_info = $this->model_customer_customer->getCustomer($enquiry_info['customer_id']);

			if ($customer_info) {
				$data['customer'] = $customer_info['firstname'] .' '. $customer_info['lastname'];
			} else {
				$data['customer'] = '';
			}
		} else {
			$data['customer'] = '';
		}
	

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/enquiry_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'classified/enquiry')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'classified/enquiry')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('classified/enquiry');

		return !$this->error;
	}
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('classified/enquiry');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_classified_enquiry->getEnquiries($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'id' => $result['id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}