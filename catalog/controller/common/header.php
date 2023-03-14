<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('extension/extension');
		$this->load->model('account/customer');

		//plan expiry
		if(!empty($this->config->get('pp_standard_status'))){
	     	$this->model_account_customer->Customerplanexpiry(0);
         }

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');
		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();
		//share links code start
		$data['seotitle'] = $this->document->getTitle();
		$data['seodescription'] = $this->document->getDescription();
		$data['seoimage'] =$this->document->getSeoimage();
		$data['seoshare'] = $this->document->getLink();
//share links code end


		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_myadss'] = $this->language->get('text_myadss');
		$data['text_mymessages'] = $this->language->get('text_mymessages');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_allads'] = $this->language->get('text_allads');

		$data['home'] = $this->url->link('classified/home');
		$data['logged'] = $this->customer->isLogged();
        $data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('classified/dashboard', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));
		$data['register'] = $this->url->link('classified/register', '', true);
		$data['login'] = $this->url->link('classified/login', '', true);
		$data['logout'] = $this->url->link('classified/logout', '', true);
		$data['myadss'] = $this->url->link('classified/myads', '', true);
		$data['mymessages'] = $this->url->link('classified/mymessages', '', true);
		$data['dashboard'] = $this->url->link('classified/dashboard', '', true);
		$data['allclassifed'] = $this->url->link('classified/allclassified', '', true);

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}



		$data['themecolor'] = $this->config->get('classified_theme');

		$headerlayout = $this->config->get('classified_header');

		if($headerlayout=='header1'){
			 return $this->load->view('common/header', $data);
		} elseif($headerlayout=='header2'){
			return $this->load->view('common/header2', $data);
		} elseif($headerlayout=='header3'){
			return $this->load->view('common/header3', $data);
		} else {
			return $this->load->view('common/header', $data);
		}
	}
}
