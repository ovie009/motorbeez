<?php
class ControllerclassifiedCategory extends Controller {
	public function index() {
		$this->load->language('classified/category');
		$this->load->model('classified/classified_category');
		$this->load->model('tool/image');
		$data['text_categoryclssefied'] = $this->language->get('text_categoryclssefied');
		   $url='';
			if (isset($this->request->get['sort'])) {
		    	$sort = $this->request->get['sort'];
			} else {
			 $sort = 'DESC';
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
			$this->document->setTitle($this->language->get('text_categoryclssefied'));
		///category show start 
		   $data['categoryresult'] = array();
			$filter_data = array(
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit'              => $this->config->get('config_limit_admin')
			);

		$category_total = $this->model_classified_classified_category->getTotalPostCategories(0);

		$category_results = $this->model_classified_classified_category->getPostCategories(0);
		
		foreach ($category_results  as $category_result) {
			$categoryimage='';

			if ($category_result['image']) {
				$categoryimage = $this->model_tool_image->resize($category_result['image'],200,200);
			} 

			$data['categoryresult'][]=array(
				'classified_category_id'  =>$category_result['classified_category_id'],
				'name'              =>$category_result['name'],
				'image'             =>$categoryimage,
			     'href'             => $this->url->link('classified/classified_search','&classified_category_id=' . $category_result['classified_category_id'] . $url)

			);
	
		}
		$pagination = new Pagination();
		$pagination->total = $category_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/category'.$url . '&page={page}');
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));
		$data['sort'] = $sort;
		$data['order'] = $order;
		///category show  end
		$data['continue']                 = $this->url->link('classified/home');
		$data['column_left']              = $this->load->controller('common/column_left');
		$data['column_right']             = $this->load->controller('common/column_right');
		$data['content_top']              = $this->load->controller('common/content_top');
		$data['content_bottom']           = $this->load->controller('common/content_bottom');
		$data['footer']                   = $this->load->controller('common/footer');
		$data['header']                   = $this->load->controller('common/header');
	   // Set the last category breadcrumb
	     $this->response->setOutput($this->load->view('classified/category', $data));
	 } 
	
}
