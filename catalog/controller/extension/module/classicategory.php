<?php 
class ControllerExtensionModuleClassiCategory extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/classicategory');
        
	    $this->load->model('classified/classified_category');
		$this->load->model('tool/image');
        
		$data['heading_title'] = $setting['name'];
		$url = '';
		$category_total = $this->model_classified_classified_category->getTotalPostCategories(0);

		$category_results = $this->model_classified_classified_category->getPostCategories(0);
		
		foreach ($category_results  as $category_result) {
			$categoryimage='';
            
            if ($category_result['image']) {
				$categoryimage = $this->model_tool_image->resize($category_result['image'], $setting['width'], $setting['height']);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
			}

			$data['categoryresult'][]=array(
				'classified_category_id'  =>$category_result['classified_category_id'],
				'name'              =>$category_result['name'],
				'image'             =>$categoryimage,
			     'href'             => $this->url->link('classified/classified_search','&classified_category_id=' . $category_result['classified_category_id'] . $url)

			);
	
		}


		return $this->load->view('extension/module/classicategory', $data);

	}
}