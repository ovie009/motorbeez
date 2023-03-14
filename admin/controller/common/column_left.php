<?php
class ControllerCommonColumnLeft extends Controller {
	public function index() {
		if (isset($this->request->get['token']) && isset($this->session->data['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$this->load->language('common/column_left');
	
			$this->load->model('user/user');
	
			$this->load->model('tool/image');
	
			$user_info = $this->model_user_user->getUser($this->user->getId());
	
			if ($user_info) {
				$data['firstname'] = $user_info['firstname'];
				$data['lastname'] = $user_info['lastname'];
	
				$data['user_group'] = $user_info['user_group'];
	
				if (is_file(DIR_IMAGE . $user_info['image'])) {
					$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
				} else {
					$data['image'] = '';
				}
			} else {
				$data['firstname'] = '';
				$data['lastname'] = '';
				$data['user_group'] = '';
				$data['image'] = '';
			}			
		
			// Create a 3 level menu array
			
			
			// Menu
			$data['menus'][] = array(
				'id'       => 'menu-dashboard',
				'icon'	   => 'fa-dashboard',
				'name'	   => $this->language->get('text_dashboard'),
				'href'     => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
				'children' => array()
			);
			
			// Catalog
			$catalog = array();
			
			if ($this->user->hasPermission('access', 'catalog/option')) {
				$catalog[] = array(
					'name'	   => $this->language->get('text_option'),
					'href'     => $this->url->link('catalog/option', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
			if ($this->user->hasPermission('access', 'catalog/information')) {		
				$catalog[] = array(
					'name'	   => $this->language->get('text_information'),
					'href'     => $this->url->link('catalog/information', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);					
			}
			
			if ($catalog) {
				$data['menus'][] = array(
					'id'       => 'menu-catalog',
					'icon'	   => 'fa-tags', 
					'name'	   => $this->language->get('text_catalog'),
					'href'     => '',
					'children' => $catalog
				);		
			}
			
	

			//post start	
			if ($this->user->hasPermission('access', 'classified/classifiedadd')) {	
				$post[] = array(
					'name'	   => $this->language->get('text_allpost'),
					'href'     => $this->url->link('classified/classifiedadd', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			
		
		
			if ($this->user->hasPermission('access', 'classified/classified_category')) {	
				$post[] = array(
					'name'	   => $this->language->get('text_classifiedcategory'),
					'href'     => $this->url->link('classified/classified_category', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			
			

			if ($this->user->hasPermission('access', 'classified/form')) {	
				$post[] = array(
					'name'	   => $this->language->get('text_formBuilder'),
					'href'     => $this->url->link('classified/form', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			

			if ($this->user->hasPermission('access', 'classified/post_payment_report')) {	
				$post[] = array(
					'name'	   => $this->language->get('text_payment_report'),
					'href'     => $this->url->link('classified/post_payment_report', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			
			
           	if ($this->user->hasPermission('access', 'classified/mail')) {
				$post[] = array(
					'name'	   => $this->language->get('text_mail'),
					'href'     => $this->url->link('classified/mail', 'token=' . $this->session->data['token'], true),
					'children' => array()		

				);

			}
        
			
			if ($this->user->hasPermission('access', 'classified/classified_payment_history')) {	
				$post[] = array(
					'name'	   => $this->language->get('text_paymenthistory'),
					'href'     => $this->url->link('classified/classified_payment_history', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}


			if ($post) {
				$data['menus'][] = array(
					'id'       => 'menu-post',
					'icon'	   => 'fa-shopping-cart', 
					'name'	   => $this->language->get('text_post'),
					'href'     => '',
					'children' => $post
				);
			}
		
    /// post end

			// Package
			$package = array();
		

			if ($this->user->hasPermission('access', 'classified/classified_package')) {	
				$package[] = array(
					'name'	   => $this->language->get('text_post_placement'),
					'href'     => $this->url->link('classified/classified_package', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/payment/pp_standard')) {	
				$package[] = array(
					'name'	   => $this->language->get('text_seting_payment'),
					'href'     => $this->url->link('extension/payment/pp_standard', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}

				if ($package) {					
				$data['menus'][] = array(
					'id'       => 'menu-package',
					'icon'	   => 'fa-money', 
					'name'	   => $this->language->get('text_package'),
					'href'     => '',
					'children' => $package
				);		
			}
		// Package end


			// Customer
			$customer = array();
			
			if ($this->user->hasPermission('access', 'customer/customer')) {
				$customer[] = array(
					'name'	   => $this->language->get('text_customer'),
					'href'     => $this->url->link('customer/customer', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}

			
			if ($customer) {
				$data['menus'][] = array(
					'id'       => 'menu-customer',
					'icon'	   => 'fa-users', 
					'name'	   => $this->language->get('text_customer'),
					'href'     => '',
					'children' => $customer
				);	
			}

		// Extension
			$extension = array();
		
			
			if ($this->user->hasPermission('access', 'extension/extension')) {		
				$extension[] = array(
					'name'	   => $this->language->get('text_module'),
					'href'     => $this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=module', true),
					'children' => array()
				);
			}

			if ($this->user->hasPermission('access', 'extension/analytics/google_analytics')) {		
				$extension[] = array(
					'name'	   => $this->language->get('text_google_analytics'),
					'href'     => $this->url->link('extension/analytics/google_analytics', 'token=' . $this->session->data['token'], true),
					'children' => array()
				);
			}
										
			if ($extension) {					
				$data['menus'][] = array(
					'id'       => 'menu-extension',
					'icon'	   => 'fa-puzzle-piece', 
					'name'	   => $this->language->get('text_extension'),
					'href'     => '',
					'children' => $extension
				);		
			}
			
			// Design
			$design = array();
			
			if ($this->user->hasPermission('access', 'design/layout')) {
				$design[] = array(
					'name'	   => $this->language->get('text_layout'),
					'href'     => $this->url->link('design/layout', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
		
			if ($this->user->hasPermission('access', 'design/banner')) {
				$design[] = array(
					'name'	   => $this->language->get('text_banner'),
					'href'     => $this->url->link('design/banner', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
			if ($design) {
				$data['menus'][] = array(
					'id'       => 'menu-design',
					'icon'	   => 'fa-television', 
					'name'	   => $this->language->get('text_design'),
					'href'     => '',
					'children' => $design
				);	
			}
			
			// System
			$system = array();

			if ($this->user->hasPermission('access', 'setting/theme_setting')) {
				$system[] = array(
					'name'	   => $this->language->get('text_theme_setting'),
					'href'     => $this->url->link('setting/theme_setting', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}

			
			if ($this->user->hasPermission('access', 'setting/setting')) {
				$system[] = array(
					'name'	   => $this->language->get('text_setting'),
					'href'     => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
		
	
			// Tools	
			$tool = array();
			
			if ($this->user->hasPermission('access', 'tool/log')) {
				$tool[] = array(
					'name'	   => $this->language->get('text_log'),
					'href'     => $this->url->link('tool/log', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
			if ($tool) {
				$system[] = array(
					'name'	   => $this->language->get('text_tools'),
					'href'     => '',
					'children' => $tool	
				);
			}
			
			if ($system) {
				$data['menus'][] = array(
					'id'       => 'menu-system',
					'icon'	   => 'fa fa-cogs fw', 
					'name'	   => $this->language->get('text_setting'),
					'href'     => '',
					'children' => $system
				);
			}
			

		
//user
			$user = array();

			if ($this->user->hasPermission('access', 'user/user')) {
				$user[] = array(
					'name'	   => $this->language->get('text_users'),
					'href'     => $this->url->link('user/user', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			
			if ($this->user->hasPermission('access', 'user/user_permission')) {	
				$user[] = array(
					'name'	   => $this->language->get('text_user_group'),
					'href'     => $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}


			if ($user) {
				$data['menus'][] = array(
					'id'       => 'menu-user',
					'icon'	   => 'fa fa-user fw', 
					'name'	   => $this->language->get('text_users'),
					'href'     => '',
					'children' => $user
				);
			}

				// Localisation
			$localisation = array();
			
			if ($this->user->hasPermission('access', 'localisation/currency')) {
				$localisation[] = array(
					'name'	   => $this->language->get('text_currency'),
					'href'     => $this->url->link('localisation/currency', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
			if ($this->user->hasPermission('access', 'localisation/country')) {
				$localisation[] = array(
					'name'	   => $this->language->get('text_country'),
					'href'     => $this->url->link('localisation/country', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
			if ($this->user->hasPermission('access', 'localisation/zone')) {
				$localisation[] = array(
					'name'	   => $this->language->get('text_zone'),
					'href'     => $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			if ($this->user->hasPermission('access', 'localisation/language')) {
				$localisation[] = array(
					'name'	   => $this->language->get('text_language'),
					'href'     => $this->url->link('localisation/language', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
		
			if ($localisation) {
				$data['menus'][] = array(
					'id'       => 'menu-localisation',
					'icon'	   => 'fa fa-map-marker fw', 
					'name'	   => $this->language->get('text_localisation'),
					'href'     => '',
					'children' => $localisation
				);
			}
			
			return $this->load->view('common/column_left', $data);
		}
	}
}