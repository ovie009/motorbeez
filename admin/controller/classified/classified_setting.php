<?php
class ControllerClassifiedClassifiedsetting extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('classified/classified_setting');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		$this->load->model('tool/image');
		$this->load->model('classified/classifiedadd');
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_setting_setting->editSetting('classified',$this->request->post);
									
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('classified/classified_setting', 'token=' . $this->session->data['token'], true));
		}


		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] =  $this->language->get('text_form');
		$data['text_default'] = $this->language->get('text_default');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_iconcolor'] = $this->language->get('entry_iconcolor');
		$data['entry_iconborder'] = $this->language->get('entry_iconborder');
		$data['entry_searchbtncolor'] = $this->language->get('entry_searchbtncolor');
		$data['entry_listbuttoncolor'] = $this->language->get('entry_listbuttoncolor');
		$data['entry_filtertitle'] = $this->language->get('entry_filtertitle');
		$data['entry_filterbg'] = $this->language->get('entry_filterbg');
		$data['entry_dashboardtabactive'] = $this->language->get('entry_dashboardtabactive');
		$data['entry_dashboardhoverbg'] = $this->language->get('entry_dashboardhoverbg');
		$data['entry_dashboardtxtcolor'] = $this->language->get('entry_dashboardtxtcolor');
		$data['entry_dashboardhovertxtcolor'] = $this->language->get('entry_dashboardhovertxtcolor');
		$data['entry_dashboardbtnbg'] = $this->language->get('entry_dashboardbtnbg');
		$data['entry_dashboardsticker'] = $this->language->get('entry_dashboardsticker');
		$data['entry_classfiedadd'] = $this->language->get('entry_classfiedadd');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_mapapi'] = $this->language->get('text_mapapi');
		$data['entry_complete_status'] = $this->language->get('entry_complete_status');
		$data['entry_footerlogo'] = $this->language->get('entry_footerlogo');
		$data['entry_facebook'] = $this->language->get('entry_facebook');
		$data['entry_twitter'] = $this->language->get('entry_twitter');
		$data['entry_google'] = $this->language->get('entry_google');
		$data['entry_instgram'] = $this->language->get('entry_instgram');
		$data['entry_youtube'] = $this->language->get('entry_youtube');
		$data['entry_linkdin'] = $this->language->get('entry_linkdin');
		
		$data['text_width'] = $this->language->get('text_width');
		$data['text_height'] = $this->language->get('text_height');
		$data['classified_bannerads'] = $this->language->get('classified_bannerads');
	   
	
		$data['button_add'] = $this->language->get('button_add');
		$data['button_save'] = $this->language->get('button_save');
		$data['text_none'] = $this->language->get('text_none');
		$data['token'] 		= $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
			'href' => $this->url->link('classified/classified_setting', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['action'] = $this->url->link('classified/classified_setting', 'token=' . $this->session->data['token'] . $url, true);
		
		
		if (isset($this->request->post['classified_titlecolor'])) {
			$data['classified_titlecolor'] = $this->request->post['classified_titlecolor'];
		} else {
			$data['classified_titlecolor'] = $this->config->get('classified_titlecolor');
		}
		if (isset($this->request->post['classified_pricecolor'])) {
			$data['classified_pricecolor'] = $this->request->post['classified_pricecolor'];
		} else {
			$data['classified_pricecolor'] = $this->config->get('classified_pricecolor');
		}
		if (isset($this->request->post['classified_iconcolor'])) {
			$data['classified_iconcolor'] = $this->request->post['classified_iconcolor'];
		} else {
			$data['classified_iconcolor'] = $this->config->get('classified_iconcolor');
		}
		if (isset($this->request->post['classified_bordercolor'])) {
			$data['classified_bordercolor'] = $this->request->post['classified_bordercolor'];
		} else {
			$data['classified_bordercolor'] = $this->config->get('classified_bordercolor');
		}
		if (isset($this->request->post['classified_searchbtncolor'])) {
			$data['classified_searchbtncolor'] = $this->request->post['classified_searchbtncolor'];
		} else {
			$data['classified_searchbtncolor'] = $this->config->get('classified_searchbtncolor');
		}
		if (isset($this->request->post['classified_listgridbtncolor'])) {
			$data['classified_listgridbtncolor'] = $this->request->post['classified_listgridbtncolor'];
		} else {
			$data['classified_listgridbtncolor'] = $this->config->get('classified_listgridbtncolor');
		}
		if (isset($this->request->post['classified_filtertitlecolor'])) {
			$data['classified_filtertitlecolor'] = $this->request->post['classified_filtertitlecolor'];
		} else {
			$data['classified_filtertitlecolor'] = $this->config->get('classified_filtertitlecolor');
		}
		if (isset($this->request->post['classified_filterbgcolor'])) {
			$data['classified_filterbgcolor'] = $this->request->post['classified_filterbgcolor'];
		} else {
			$data['classified_filterbgcolor'] = $this->config->get('classified_filterbgcolor');
		}
		if (isset($this->request->post['classified_dashboardtabbgcolor'])) {
			$data['classified_dashboardtabbgcolor'] = $this->request->post['classified_dashboardtabbgcolor'];
		} else {
			$data['classified_dashboardtabbgcolor'] = $this->config->get('classified_dashboardtabbgcolor');
		}
		if (isset($this->request->post['classified_dashboardhoverbgcolor'])) {
			$data['classified_dashboardhoverbgcolor'] = $this->request->post['classified_dashboardhoverbgcolor'];
		} else {
			$data['classified_dashboardhoverbgcolor'] = $this->config->get('classified_dashboardhoverbgcolor');
		}
		if (isset($this->request->post['classified_dashboardtextcolor'])) {
			$data['classified_dashboardtextcolor'] = $this->request->post['classified_dashboardtextcolor'];
		} else {
			$data['classified_dashboardtextcolor'] = $this->config->get('classified_dashboardtextcolor');
		}
		if (isset($this->request->post['classified_dashboardhovertextcolor'])) {
			$data['classified_dashboardhovertextcolor'] = $this->request->post['classified_dashboardhovertextcolor'];
		} else {
			$data['classified_dashboardhovertextcolor'] = $this->config->get('classified_dashboardhovertextcolor');
		}
		if (isset($this->request->post['classified_dashboardbtnbgcolor'])) {
			$data['classified_dashboardbtnbgcolor'] = $this->request->post['classified_dashboardbtnbgcolor'];
		} else {
			$data['classified_dashboardbtnbgcolor'] = $this->config->get('classified_dashboardbtnbgcolor');
		}
		
		if (isset($this->request->post['classified_dashboardstickerbgcolor'])) {
			$data['classified_dashboardstickerbgcolor'] = $this->request->post['classified_dashboardstickerbgcolor'];
		} else {
			$data['classified_dashboardstickerbgcolor'] = $this->config->get('classified_dashboardstickerbgcolor');
		}


	
		if (isset($this->request->post['classified_classified_id'])) {
			$data['classified_classified_id'] = $this->request->post['classified_classified_id'];
		} elseif (!empty($this->config->get('classified_classified_id'))) {
			$data['classified_classified_id'] = $this->config->get('classified_classified_id');
		} else {
			$data['classified_classified_id'] = '';
		}
		/* banner ads  */
		if (isset($this->request->post['classified_icon'])) {
		$data['classified_icon'] = $this->request->post['classified_icon'];

		} else {

			$data['classified_icon'] = $this->config->get('classified_icon');

		}

		if (isset($this->request->post['classified_icon']) && is_file(DIR_IMAGE . $this->request->post['classified_icon'])) {
			$data['icon'] = $this->model_tool_image->resize($this->request->post['classified_icon'], 100, 100);
		} elseif ($this->config->get('classified_icon') && is_file(DIR_IMAGE . $this->config->get('classified_icon'))) {
			$data['icon'] = $this->model_tool_image->resize($this->config->get('classified_icon'), 100, 100);
		} else {
			$data['icon'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		
		/* banners ads  */
		/* map api  */
		if (isset($this->request->post['classified_mapkey'])) {
			$data['classified_mapkey'] = $this->request->post['classified_mapkey'];
		} else {
			$data['classified_mapkey'] = $this->config->get('classified_mapkey');
		}



		if (isset($this->request->post['classified_width'])) {
			$data['classified_width'] = $this->request->post['classified_width'];
		} else {
			$data['classified_width'] = $this->config->get('classified_width');
		}
		


		if (isset($this->request->post['classified_height'])) {
			$data['classified_height'] = $this->request->post['classified_height'];
		} else {
			$data['classified_height'] = $this->config->get('classified_height');
		}
		
		if (isset($this->request->post['classified_fb'])) {
			$data['classified_fb'] = $this->request->post['classified_fb'];
		} else {
			$data['classified_fb'] = $this->config->get('classified_fb');
		}
        
        if (isset($this->request->post['classified_twitter'])) {
			$data['classified_twitter'] = $this->request->post['classified_twitter'];
		} else {
			$data['classified_twitter'] = $this->config->get('classified_twitter');
		}
        
        if (isset($this->request->post['classified_instgram'])) {
			$data['classified_instgram'] = $this->request->post['classified_instgram'];
		} else {
			$data['classified_instgram'] = $this->config->get('classified_instgram');
		}
        
        if (isset($this->request->post['classified_google'])) {
			$data['classified_google'] = $this->request->post['classified_google'];
		} else {
			$data['classified_google'] = $this->config->get('classified_google');
		}
        
        if (isset($this->request->post['classified_youtube'])) {
			$data['classified_youtube'] = $this->request->post['classified_youtube'];
		} else {
			$data['classified_youtube'] = $this->config->get('classified_youtube');
		}
        
        if (isset($this->request->post['classified_linkdin'])) {
			$data['classified_linkdin'] = $this->request->post['classified_linkdin'];
		} else {
			$data['classified_linkdin'] = $this->config->get('classified_linkdin');
		}
		/* map api  */
		
	
		if (isset($this->request->post['classified_classified'])) {
			$data['classified_classified'] = $this->request->post['classified_classified'];
		} elseif (!empty($this->config->get('classified_classified'))) {
			$data['classified_classified'] = $this->config->get('classified_classified');
		} else {
			$data['classified_classified'] = '';
		}

		if (isset($this->request->post['classified_complete_status'])) {
			$data['classified_complete_status']  = $this->request->post['classified_complete_status'];
		} elseif (!empty($this->config->get('classified_complete_status'))) {
			$data['classified_complete_status']  = $this->config->get('classified_complete_status');
		} else {
			$data['classified_complete_status']  =  array();
		}
		
		
		
		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
	
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/classified_setting', $data));

	}
	public function autocomplete() {
		$json = array();
			$this->load->model('catalog/product');
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
			$results = $this->model_catalog_product->getProducts($filter_data);
			foreach ($results as $result) {
				$json[] = array(
					'classified_classified_id'       => $result['product_id'],
					'name'                           => $result['name'],
				
				
				);
			}
		

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	
}