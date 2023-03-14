<?php
class ControllerCommonSearch extends Controller {
	public function index() {
		$this->load->language('common/search');

		$data['text_search'] = $this->language->get('text_search');
		$data['text_selectcity'] = $this->language->get('text_selectcity');
		$data['text_selectcat'] = $this->language->get('text_selectcat');

		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}
		if (isset($this->request->get['filter_city'])) {
			$data['filter_city'] = $this->request->get['filter_city'];
		} else {
			$data['filter_city'] = '';
		}

		if (isset($this->request->get['filter_name'])) {
			$data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$data['filter_name'] = '';
		}
		if (isset($this->request->get['classified_category_id'])) {
			$data['classified_category_id'] = $this->request->get['classified_category_id'];
		} else {
			$data['classified_category_id'] = '';
		}
		$this->load->model('localisation/country');
		$this->load->model('classified/classified_category');
		$data['cities'] = $this->model_localisation_country->getCities(0);

		$data['categories'] = $this->model_classified_classified_category->getPostCategories(0);


		$headerlayout = $this->config->get('classified_header');

		if($headerlayout=='header2'){
			 return $this->load->view('common/search1', $data);
		} else {
			return $this->load->view('common/search', $data);
		}

	}
}
