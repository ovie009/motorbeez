<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		$data['scripts'] = $this->document->getScripts('footer');

		$data['text_links'] = $this->language->get('text_links');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_myads'] = $this->language->get('text_myads');
		$data['text_mysetting'] = $this->language->get('text_mysetting');
		$data['text_information'] = $this->language->get('text_information');

		$data['dashboard'] = $this->url->link('classified/dashboard', '', true);
		$data['myads'] = $this->url->link('classified/myads', '', true);
		$data['mysetting'] = $this->url->link('classified/mysetting', '', true);
		$data['contact_us'] = $this->url->link('information/contact', '', true);

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}


        if (is_file(DIR_IMAGE . $this->config->get('classified_footerlogo'))) {
			$data['footerlogo'] = 'image/' . $this->config->get('classified_footerlogo');
		} else {
			$data['footerlogo'] = '';
		}

        $data['name'] = $this->config->get('config_name');
        $data['address'] = $this->config->get('config_address');
        $data['email'] = $this->config->get('config_email');
        $data['telephone'] = $this->config->get('config_telephone');
        $data['description'] = $this->config->get('classified_footerdesc');
        $data['home'] = $this->url->link('classified/home');

        if (isset($this->request->post['classified_fb'])) {
		  $data['fburl'] = $this->request->post['classified_fb'];
		} else {
		  $data['fburl'] = $this->config->get('classified_fb');
		}

		if (isset($this->request->post['classified_google'])) {
		  $data['google'] = $this->request->post['classified_google'];
		} else {
		  $data['google'] = $this->config->get('classified_google');
		}

		if (isset($this->request->post['classified_twitter'])) {
		  $data['twet'] = $this->request->post['classified_twitter'];
		} else {
		  $data['twet'] = $this->config->get('classified_twitter');
		}

		if (isset($this->request->post['classified_instgram'])) {
			$data['in'] = $this->request->post['classified_instgram'];
		} else {
			$data['in'] = $this->config->get('classified_instgram');
		}

		if (isset($this->request->post['classified_linkdin'])) {
			$data['linkdin'] = $this->request->post['classified_linkdin'];
		} else {
			$data['linkdin'] = $this->config->get('classified_linkdin');
		}

		if (isset($this->request->post['classified_youtube'])) {
			$data['youtube'] = $this->request->post['classified_youtube'];
		} else {
			$data['youtube'] = $this->config->get('classified_youtube');
		}

		$footerlayout = $this->config->get('classified_footer');

		if($footerlayout=='footer1'){
			 return $this->load->view('common/footer', $data);
		} elseif($footerlayout=='footer2'){
			return $this->load->view('common/footer2', $data);
		} elseif($footerlayout=='footer3'){
			return $this->load->view('common/footer3', $data);
		} else {
			return $this->load->view('common/footer', $data);
		}
	}
}
