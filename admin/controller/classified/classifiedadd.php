<?php
class ControllerclassifiedClassifiedadd extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('classified/classifiedadd');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classifiedadd');

		$this->getList();
	}

	public function add() {
		$this->load->language('classified/classifiedadd');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classifiedadd');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_classified_classifiedadd->addebook($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
			}

			if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
			}

			if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function approve(){
		$this->load->language('classified/classifiedadd');
		$this->load->model('classified/classifiedadd');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['classified_id'])){
			$approves[] = $this->request->get['classified_id'];
		}
		if ($approves){
			foreach($approves as $classified_id){
				$this->model_classified_classifiedadd->approve($classified_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
			}

			if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
			}

			if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
	  }

	  public function disapprove(){
		$this->load->language('classified/classifiedadd');
		$this->load->model('classified/classifiedadd');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$disapprove = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['classified_id'])){
			$disapprove[] = $this->request->get['classified_id'];
		}
		if ($disapprove){
			foreach($disapprove as $classified_id){
				$this->model_classified_classifiedadd->disapprove($classified_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
			}

			if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
			}

			if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
	  }
	public function delete() {
		$this->load->language('classified/classifiedadd');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classifiedadd');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $classified_id) {
				$this->model_classified_classifiedadd->deletepost($classified_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
           if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
			}

			if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
			}

			if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function edit() {
		$this->load->language('classified/classifiedadd');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classifiedadd');

	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_classified_classifiedadd->editPostInfo($this->request->get['classified_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
			}

			if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
			}

			if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	protected function getList() {
		
		if (isset($this->request->get['filter_coustomer'])) {
			$filter_coustomer = $this->request->get['filter_coustomer'];
		} else {
			$filter_coustomer = '';
		}
		if (isset($this->request->get['filter_title'])) {
			$filter_title = $this->request->get['filter_title'];
		} else {
			$filter_title = '';
		}

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

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}

		if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
		}

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
			'href' => $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('classified/classifiedadd/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('classified/classifiedadd/delete', 'token=' . $this->session->data['token'] . $url, true);


		$filter_data = array(
			'filter_coustomer' => $filter_coustomer,
			'filter_title' => $filter_title,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');
		
	  $data['allpostlistings']=array();
		$Total_filter = $this->model_classified_classifiedadd->getTotalebook($filter_data);
		$all_post_listings = $this->model_classified_classifiedadd->getEbooks($filter_data);

		foreach($all_post_listings as $all_post_listing){
		/// coustomer name start
		$customernameget = $this->model_classified_classifiedadd->getCustomer($all_post_listing['customer_id']);
		
		if(!empty($customernameget['firstname'])){
			$firstname=$customernameget['firstname'];
		}else{
			$firstname='';
		}
			/// coustomer name end
	     	
	     	/// Post name start
		$placement=array();
		
			if (!$all_post_listing['approve']) {
				$approve = $this->url->link('classified/classifiedadd/approve', 'token=' . $this->session->data['token'] . '&classified_id=' . $all_post_listing['classified_id'] . $url, true);
			} else {
				$approve = '';
			}

			if ($all_post_listing['approve']) {
				$disapprove = $this->url->link('classified/classifiedadd/disapprove', 'token=' . $this->session->data['token'] . '&classified_id=' . $all_post_listing['classified_id'] . $url, true);
			} else {
				$disapprove = '';
			}
				 
			$data['allpostlistings'][] = array(
				'classified_id' 	   => $all_post_listing['classified_id'],
				'placement'    => $placement,
				'title' 	   => $all_post_listing['title'],
				'price'        => (float)$all_post_listing['price'] ? $this->currency->format($all_post_listing['price'], $this->config->get('config_currency')) : false,
				'approve'      => $approve,
				'disapprove'   => $disapprove,
				'firstname'    => $firstname,
				'active'     => $all_post_listing['active'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'edit'		   => $this->url->link('classified/classifiedadd/edit', 'token=' . $this->session->data['token'] .'&classified_id=' . $all_post_listing['classified_id'] . $url, true));
			}
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['token'] 		= $this->session->data['token'];
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['text_visible'] = $this->language->get('text_visible');
		$data['text_disabled'] = $this->language->get('text_disabled');
		

		$data['column_name'] = $this->language->get('column_name');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['entry_ebook'] = $this->language->get('entry_ebook');
		$data['entry_author'] = $this->language->get('entry_author');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_total_page'] = $this->language->get('entry_total_page');
		$data['entry_book_format'] = $this->language->get('entry_book_format');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_title'] = $this->language->get('column_title');
		$data['column_package'] = $this->language->get('column_package');
		$data['column_edit'] = $this->language->get('column_edit');
		$data['column_delete'] = $this->language->get('column_delete');
		$data['column_active'] = $this->language->get('column_active');
		$data['column_approved'] = $this->language->get('column_approved');
		$data['column_disapproved'] = $this->language->get('column_disapproved');
		$data['filter_coustomer'] = $this->language->get('filter_coustomer');
		$data['filter_title'] = $this->language->get('filter_title');
		$data['text_none'] = $this->language->get('text_none');




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
		if (isset($this->request->post['customer_id'])) {
			$data['customer_id'] =$this->request->post['customer_id'];
		} else {
			$data['customer_id'] ='';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['filter_starting_date'])) {
			$url .= '&filter_starting_date=' . $this->request->get['filter_starting_date'];
		}

		if (isset($this->request->get['filter_end_date'])) {
			$url .= '&filter_end_date=' . $this->request->get['filter_end_date'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_sort_order'] = $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

	    if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}

		if (isset($this->request->get['filter_coustomer'])) {
			$url .= '&filter_coustomer=' . $this->request->get['filter_coustomer'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

	
		$pagination = new Pagination();
		$pagination->total = $Total_filter;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($Total_filter) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($Total_filter - $this->config->get('config_limit_admin'))) ? $Total_filter : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $Total_filter, ceil($Total_filter / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['filter_coustomer'] = $filter_coustomer;
		$data['filter_title'] = $filter_title;
		$data['customer_id'] ='';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/classifiedadd_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['classified_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_visible'] = $this->language->get('text_visible');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_pdf'] = $this->language->get('text_pdf');
		$data['text_flash'] = $this->language->get('text_flash');
		$data['text_upload'] = $this->language->get('text_upload');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_typelocation'] = $this->language->get('text_typelocation');
		$data['tab_general'] 			= $this->language->get('tab_general');
		
		$data['entry_ebook'] = $this->language->get('entry_ebook');
		$data['entry_total_page'] = $this->language->get('entry_total_page');
		$data['entry_author'] = $this->language->get('entry_author');
		$data['entry_book_format'] = $this->language->get('entry_book_format');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_description'] = $this->language->get('description');
		$data['entry_upload'] = $this->language->get('entry_upload');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_upload'] = $this->language->get('entry_upload');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_active'] = $this->language->get('entry_active');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		

		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_sub_category'] = $this->language->get('entry_sub_category');
		$data['entry_category_sub_sub'] = $this->language->get('entry_category_sub_sub');
		$data['entry_title'] = $this->language->get('entry_title');
		
		$data['entry_country']  = $this->language->get('entry_country');
		$data['entry_zone']     = $this->language->get('entry_zone');
		$data['entry_city']     = $this->language->get('entry_city');
		$data['entry_address']  = $this->language->get('entry_address');
		$data['entry_price']    = $this->language->get('entry_price');
		$data['btn_img']    = $this->language->get('btn_img');
		$data['entry_customer']    = $this->language->get('entry_customer');
		$data['entry_postimage']    = $this->language->get('entry_postimage');

	
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_none'] = $this->language->get('text_none');
		$data['token'] 		= $this->session->data['token'];
		
		
		 //product video code start
		$data['tab_video'] = $this->language->get('tab_video');
		$data['text_upload'] = $this->language->get('text_upload');
		$data['text_youtube'] = $this->language->get('text_youtube');
		$data['text_vimeo'] = $this->language->get('text_vimeo');
		$data['text_upload_video'] = $this->language->get('text_upload_video');
		$data['text_videotype'] = $this->language->get('text_videotype');
		$data['text_videothumb'] = $this->language->get('text_videothumb');
		$data['text_video'] = $this->language->get('text_video');
		$data['text_uploading'] = $this->language->get('text_uploading');
		$data['entry_youtubelink'] = $this->language->get('entry_youtubelink');
		$data['entry_vimeoid'] = $this->language->get('entry_vimeoid');
		$data['entry_uploadvideo'] = $this->language->get('entry_uploadvideo');
		$data['help_keyword'] = $this->language->get('help_keyword');

 //product video code end

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
		}

		
		if (isset($this->error['singal_post'])) {
			$data['error_post_image'] = $this->error['singal_post'];
		} else {
			$data['error_post_image'] = '';
		}

		
		$url = '';

		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['classified_id'])) {
			$data['action'] = $this->url->link('classified/classifiedadd/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('classified/classifiedadd/edit', 'token=' . $this->session->data['token'] . '&classified_id=' . $this->request->get['classified_id'] . $url, true);
		}

	
		$this->load->model('localisation/country');
		$this->load->model('tool/image');
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['countries']= $this->model_localisation_country->getCountries(0);
		$this->load->model('classified/classifiedadd');
		$data['categorylists'] = $this->model_classified_classifiedadd->getCategories(0);

		
		$data['cancel'] = $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['classified_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$getPostInfo = $this->model_classified_classifiedadd->getPostClassified($this->request->get['classified_id']);
		}


		if (isset($this->request->post['classified_description'])) {
			$data['classified_description'] = $this->request->post['classified_description'];
		} elseif (isset($this->request->get['classified_id'])) {
			$data['classified_description'] = $this->model_classified_classifiedadd->getclassifiedDescription($this->request->get['classified_id']);
		} else {
			$data['classified_description'] = array();
		}

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($getPostInfo)) {
			$data['price'] = $getPostInfo['price'];
		} else {
			$data['price'] = '';
		}

		if (isset($this->request->post['classified_category_id'])) {
			$data['classified_category_id'] = $this->request->post['classified_category_id'];
		} elseif (!empty($getPostInfo)) {
			$data['classified_category_id'] = $getPostInfo['classified_category_id'];
		} else {
			$data['classified_category_id'] = '';
		}


		if (isset($this->request->post['sub_category_id'])) {
			$data['sub_category_id'] = $this->request->post['sub_category_id'];
		} elseif (!empty($getPostInfo)) {
			$data['sub_category_id'] = $getPostInfo['sub_category_id'];
		} else {
			$data['sub_category_id'] = '';
		}

		if (isset($this->request->post['sub_sub_category_id'])) {
			$data['sub_sub_category_id'] = $this->request->post['sub_sub_category_id'];
		} elseif (!empty($getPostInfo)) {
			$data['sub_sub_category_id'] = $getPostInfo['sub_sub_category_id'];
		} else {
			$data['sub_sub_category_id'] = '';
		}

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($getPostInfo)) {
			$data['zone_id'] = $getPostInfo['zone_id'];
		} else {
			$data['zone_id'] = '';
		}
		if (isset($this->request->post['city_id'])) {
			$data['city_id'] = $this->request->post['city_id'];
		} elseif (!empty($getPostInfo)) {
			$data['city_id'] = $getPostInfo['city_id'];
		} else {
			$data['city_id'] = '';
		}
		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($getPostInfo)) {
			$data['address'] = $getPostInfo['address'];
		} else {
			$data['address'] = '';
		}

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($getPostInfo)) {
			$data['city'] = $getPostInfo['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($getPostInfo)) {
			$data['country_id'] = $getPostInfo['country_id'];
		} else {
			$data['country_id'] = '';
		}

		if (isset($this->request->post['customer'])) {
			$data['customer'] = $this->request->post['customer'];
		} elseif (!empty($getPostInfo)) {
			$data['customer'] = $getPostInfo['coustomername'];
		} else {
			$data['customer'] = '';
		}
		if (isset($this->request->post['customer_id'])) {
			$data['customer_id'] = $this->request->post['customer_id'];
		} elseif (!empty($getPostInfo)) {
			$data['customer_id'] = $getPostInfo['customer_id'];
		} else {
			$data['customer_id'] = '';
		}

		if (isset($this->request->post['active'])) {
			$data['active'] = $this->request->post['active'];
		} elseif (!empty($getPostInfo)) {
			$data['active'] = $getPostInfo['active'];
		} else {
			$data['active'] = '';
		}
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($getPostInfo)) {
			$data['keyword'] = $getPostInfo['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->get['classified_id'])) {
			$data['classified_id'] = $this->request->get['classified_id'];
		} else {
			$data['classified_id'] = '0';
		}
        
		 /// <!---vodeo  start karan ---->
		
		$data['videotypes'] = array();

		$data['videotypes'][] = array(
			'name' => $this->language->get('text_youtube'),
			'value' => 'youtube',
		);
		$data['videotypes'][] = array(
			'name' => $this->language->get('text_vimeo'),
			'value' => 'vimeo',
		);
		$data['videotypes'][] = array(
			'name' => $this->language->get('text_upload_video'),
			'value' => 'upload',
		);
		//product video code end
        
		
 /// <!---vodeo  start karan ---->
		
   ///image 

		// Images
		if (isset($this->request->post['image'])) {
			$images = $this->request->post['image'];
		} elseif (isset($this->request->get['classified_id'])) {
			$images = $this->model_classified_classifiedadd->getPostInfoImage($this->request->get['classified_id']);
		} else {
			$images = array();
		}

		$data['post_images'] = array();
		foreach ($images as $product_image) {
			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
				$thumb = $product_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['post_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
			);
		}

//image
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($getPostInfo)) {
			$data['location'] = $getPostInfo['location'];
		} else {
			$data['location'] = '';
		}
		if (isset($this->request->post['lat'])) {
			$data['lat'] = $this->request->post['lat'];
		} elseif (!empty($getPostInfo)) {
			$data['lat'] = $getPostInfo['lat'];
		} else {
			$data['lat'] = '';
		}
		if (isset($this->request->post['lng'])) {
			$data['long'] = $this->request->post['lng'];
		} elseif (!empty($getPostInfo)) {
			$data['long'] = $getPostInfo['lng'];
		} else {
			$data['long'] = '';
		}

		if (isset($this->request->post['customer'])) {
		$data['customer'] = $this->request->post['customer'];
		} elseif (!empty($getPostInfo)) {

		$customer_info=$this->model_classified_classifiedadd->getCustomer($getPostInfo['customer_id']);
		if ($customer_info) {
		$data['customer'] = $customer_info['firstname'];
		} else {
			$data['customer'] = '';
		}
		} else {
			$data['customer'] = '';
	   }
	   
	   
	   if (isset($getPostInfo['singal_post'])) {
			$data['singal_post'] = $getPostInfo['singal_post'];
		}else {
			$data['singal_post'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['singal_post']) && is_file(DIR_IMAGE . $this->request->post['singal_post'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['singal_post'], 100, 100);
		} elseif (!empty($getPostInfo) && is_file(DIR_IMAGE . $getPostInfo['singal_post'])) {
			$data['thumb'] = $this->model_tool_image->resize($getPostInfo['singal_post'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		  /// <!---vodeo  start karan ---->
		
		if (isset($getPostInfo['video_type'])) {
		$data['video_type'] = $getPostInfo['video_type'];
		}else {
		$data['video_type'] = '';
		}

		if (isset($getPostInfo['youtube_video'])) {
		$data['youtube_video'] = $getPostInfo['youtube_video'];
		}else {
		$data['youtube_video'] = '';
		}
		
		if (isset($getPostInfo['video_vimeo'])) {
		$data['video_vimeo'] = $getPostInfo['video_vimeo'];
		}else {
		$data['video_vimeo'] = '';
		}
		if (isset($getPostInfo['upload_video'])) {
		$data['upload_video'] = $getPostInfo['upload_video'];
		}else {
		$data['upload_video'] = '';
		}
		 /// <!---vodeo  start karan ---->
		
		
		$data['classified_mapkey'] = $this->config->get('classified_mapkey');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/classified_form', $data));
	}
	
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'classified/classifiedadd')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['classified_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 2) || (utf8_strlen($value['title']) > 45)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

		}

		/// image start
		
		if ($this->request->post['singal_post'] == '') {
			 $this->error['singal_post'] = $this->language->get('error_post_image');
		}
		/// image end


		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['classified_id']) && $url_alias_info['query'] != 'classified_id=' . $this->request->get['classified_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['classified_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('classified_id'));
			}
		} 

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
	
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'classified/classifiedadd')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('classified/classifiedadd');
		return !$this->error;
	}

	public function category() {
		$json = array();
       $this->load->model('classified/classifiedadd');
		$category_infos = $this->model_classified_classifiedadd->getCategories($this->request->get['classified_category_id']);
		foreach($category_infos as $category_info ){
			
			$json['subcategory'][]= array(
			 'classified_category_id'      => $category_info['classified_category_id'],
			 'name'                        => $category_info['name'],
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function subcategory() {
		$json = array();
		  $this->load->model('classified/classifiedadd');
		$subcategory_infos = $this->model_classified_classifiedadd->getCategories($this->request->get['classified_category_id']);
		foreach($subcategory_infos as $sub_info ){
			
			$json['sub_subcategory'][]= array(
				'classified_category_id'      => $sub_info['classified_category_id'],
				'name'             => $sub_info['name'],
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function  categoryclassified_formfiled() {
		$this->load->language('classified/classifiedadd');
		if(!empty($this->request->get['classified_id'])){
         $classified_id=$this->request->get['classified_id'];
		}else{
		$classified_id='';
		}

		$json = array();
		$data['tmdform_fields']=array();

		$this->load->model('classified/classifiedadd');
		$subcategory_infos = $this->model_classified_classifiedadd->getCategorymyadd($this->request->get['classified_category_id']);

		if(!empty($subcategory_infos['form_id'])){
        $form_id=$subcategory_infos['form_id'];
		}else{
		$form_id='';
		}

		if(!empty($subcategory_infos['form_id'])){
        $data['form_id']=$subcategory_infos['form_id'];
		}else{
		$data['form_id']='';
		}
         
		$formgets= $this->model_classified_classifiedadd->getForms($form_id);

		foreach ($formgets as $formget) {
			$form_field_option=array();
		     $optionresults= $this->model_classified_classifiedadd->getFormsOption($formget['field_id']);

		     foreach ($optionresults as $optionresult) {
		     	$form_field_option[]=array(
		  	 		'name'         =>$optionresult['name'],	
		  	 		'field_id'     =>$optionresult['field_id'],	
		  	 		'sort_order'   =>$optionresult['sort_order']	
		  	 	 );
		     }

		       $form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" .$classified_id."'and field_id='".$formget['field_id']."'");
      
           	  if(!empty($form_query->row['serialize'])){
           	  	$valuelist='';
					$valuelist=unserialize($form_query->row['value']);
				}else{
					if(!empty($form_query->row['value'])){
						$valuelist=$form_query->row['value'];
					}else{
						$valuelist='';
					}
				}
			
	     
  	     	
  	     	$data['tmdform_fields'][]=array(
                  'field_id'      	    =>$formget['field_id'], 
                  'form_id'      	    =>$formget['form_id'], 
                  'required'      	    =>$formget['required'], 
                  'field_name'          =>$formget['field_name'], 
                  'type'      	        =>$formget['type'], 
                  'help_text'           =>$formget['help_text'], 
                  'placeholder'         =>$formget['placeholder'], 
                  'error_message'       =>$formget['error_message'],
                  'form_field_option'   =>$form_field_option,
                  'value'               =>$valuelist
               );
  	     } 

         
         $this->response->setOutput($this->load->view('classified/classifiedajax', $data));

	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_email'])) {
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_email'])) {
				$filter_email = $this->request->get['filter_email'];
			} else {
				$filter_email = '';
			}

			$this->load->model('customer/customer');

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->model_customer_customer->getCustomers($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'customer_id'       => $result['customer_id'],
					'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'firstname'         => $result['firstname'],
					'lastname'          => $result['lastname'],
					'email'             => $result['email']
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
	
	public function zone() {
		$json = array();

		$this->load->model('localisation/zone');
		$this->load->model('classified/city');

		$zone_info = $this->model_localisation_zone->getZone($this->request->get['zone_id']);

		if ($zone_info) {
			$this->load->model('classified/city');

			$json = array(
				'zone_id'             => $zone_info['zone_id'],
				'name'              => $zone_info['name'],
				'city'              => $this->model_classified_city->getCitiesByZoneId($this->request->get['zone_id']),
				'status'            => $zone_info['status']
			);
			
			
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	
	//product video code start
 /// <!---vodeo  start karan ---->
		
	public function uploadvideo() {
		$this->load->language('classified/classifiedadd');

		$json = array();

		// Check user has permission
		if (!$this->user->hasPermission('modify', 'classified/classifiedadd')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (!$json) {
			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array();

				$extension_allowed = preg_replace('~\r?\n~', "\n", 'mp4');

				$filetypes = explode("\n", $extension_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$mime_allowed = preg_replace('~\r?\n~', "\n", 'video/mp4');

				$filetypes = explode("\n", $mime_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Return any upload error
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}
		}

		if (!$json) {

			$targetDir = DIR_IMAGE.'video/';
			if (!file_exists($targetDir)) {
				mkdir($targetDir, 0777, true);
			}

			$file = $filename;
			$location = $targetDir."/".$file;
			move_uploaded_file($this->request->files['file']['tmp_name'], $location);

			$json['filename'] = $file;
			$json['mask'] = $filename;

			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	//product video code end

 /// <!---vodeo  start karan ---->
		
}