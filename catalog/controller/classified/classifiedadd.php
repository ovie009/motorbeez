<?php
class ControllerclassifiedClassifiedadd extends Controller {
	private $error = array();
	
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}

		$this->load->model('classified/classifiedadd');
				
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = null;
		}

		if (isset($this->request->get['sort'])){
			$sort = $this->request->get['sort'];} 
			else{$sort = 'name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		if (isset($this->request->get['page'])){
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
       $url='';

		if ($order == 'ASC'){
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		$url = '';

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['sort'])){
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])){
			$url .= '&order='.$this->request->get['order'];
		}

		if (isset($this->request->get['page'])){
			$url .= '&page='.$this->request->get['page'];
		}

		
		$this->load->language('classified/classifiedadd');
		
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']  		= $this->language->get('heading_title');
		$data['text_select']  			= $this->language->get('text_select');
		$data['text_loading'] 			= $this->language->get('text_loading');
		$data['text_none'] 				= $this->language->get('text_none');
		$data['text_list'] 				= $this->language->get('text_list');
		$data['column_image']			= $this->language->get('column_image');
		$data['column_name']			= $this->language->get('column_name');
		$data['column_desc']		= $this->language->get('column_desc');
		$data['column_type']			= $this->language->get('column_type');
		$data['column_status']			= $this->language->get('column_status');
		$data['column_action']			= $this->language->get('column_action');
		$data['button_delete']			= $this->language->get('button_delete');
		$data['text_confirm']			= $this->language->get('text_confirm');
		$data['text_success']			= $this->language->get('text_success');
		$data['text_free']			= $this->language->get('text_free');
		$data['text_paid']			= $this->language->get('text_paid');
		$data['text_enabled']			= $this->language->get('text_enabled');
		$data['text_disabled']			= $this->language->get('text_disabled');
		$data['text_no_results']			= $this->language->get('text_no_results');
		$data['column_action']			= $this->language->get('column_action');
		$data['entry_status']			 = $this->language->get('entry_status');
		$data['order_status']			= $this->language->get('order_status');
		$data['text_error_planexpiry'] = $this->language->get('text_error_planexpiry');
		$data['text_error_planrenew'] = $this->language->get('text_error_planrenew');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['placeholder']  = '';
		$data['button_add']			= $this->language->get('Add');
		$data['button_edit']			= $this->language->get('button_edit');
		$data['button_filter']			= $this->language->get('button_filter');
		$data['payment_status'] = $this->config->get('pp_standard_status');
		if (isset($this->error['warning'])){
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])){
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else{
			$data['success'] = '';
		}

			
	   $data['delete'] = $this->url->link('classified/classifiedadd/delete' . $url);
		
			
		$data['postedits']=array();
		
		$filter_data = array(
			'customer_id'   => $this->customer->getId(),
			'filter_status' => $filter_status,
			'filter_type' 	=> $filter_type,
			'sort'       =>  $sort,
			'order'      =>  $order,
			'start'      =>  ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'      =>  $this->config->get('config_limit_admin')
		);

				
		$this->load->model('classified/classifiedadd');				
		$this->load->model('tool/image');
		
		$post_total = $this->model_classified_classifiedadd->getTotalPostEdit($filter_data);
	
		$results = $this->model_classified_classifiedadd->getPostcreates($filter_data);
	
		foreach($results as $result){
			if ($result['main_image']) {
				$image = $this->model_tool_image->resize($result['main_image'], 50,50);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png',50,50);
			}
		
			$data['postedits'][] = array(
				'classified_id' 		=> $result['classified_id'],
				'name'        	=> $result['name'],
				'image'  		=>  $image,
				'type'          => ($result['payment_mode']) ? $this->language->get('text_free') : $this->language->get('text_paid'),
				'status'        => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'        	=> $this->url->link('classified/classifiedadd/edit','&classified_id=' . $result['classified_id'] . $url, true),
				'delete'      	=> $this->url->link('classified/classifiedadd/delete','&classified_id=' . $result['classified_id'] . $url)
			
			);	
		}

		$url='';
		if ($order == 'ASC'){
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		$url = '';

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		$pagination 		= new Pagination();
		$pagination->total 	= $post_total;
		$pagination->page 	= $page;
		$pagination->limit 	= $this->config->get('config_limit_admin');
		$pagination->url 	= $this->url->link('classified/classifiedadd', $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($post_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($post_total - $this->config->get('config_limit_admin'))) ? $post_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $post_total, ceil($post_total / $this->config->get('config_limit_admin')));
		
		$data['filter_status'] = $filter_status;
		$data['filter_type'] 	= $filter_type;
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $this->response->setOutput($this->load->view('classified/classifiedadd_list', $data));
	 
		}

		public function add() {
		$this->load->language('classified/classifiedadd');
		$this->load->model('classified/classifiedadd');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['text_error_planexpiry'] = $this->language->get('text_error_planexpiry');
		$data['text_error_planrenew'] = $this->language->get('text_error_planrenew');
		 if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		 	 $classified_id=$this->model_classified_classifiedadd->addpost($this->request->post);
		 	if(!empty($this->request->post['package_id'])){
			$this->response->redirect($this->url->link('classified/classifiedpayment&classified_id='.$classified_id));
			}else{
	
			 $this->response->redirect($this->url->link('classified/myads'));
			}
		  }
		 $this->getForm();
	}


	
	public function getform() {
		if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}
		$this->load->language('classified/classifiedadd');
		

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('classified/classifiedadd');
		$this->load->model('classified/myads');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_selectcategory'] = $this->language->get('text_selectcategory');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_Paid'] = $this->language->get('text_Paid');
		$data['text_Free'] = $this->language->get('text_Free');
		$data['text_addservice'] = $this->language->get('text_addservice');
		$data['text_typeaddress'] = $this->language->get('text_typeaddress');
		$data['text_location'] = $this->language->get('text_location');
		$data['text_error_planexpiry'] = $this->language->get('text_error_planexpiry');
		$data['text_error_planrenew'] = $this->language->get('text_error_planrenew');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_addimage'] = $this->language->get('entry_addimage');
		$data['entry_otherimage'] = $this->language->get('entry_otherimage');
		$data['entry_addimage'] = $this->language->get('entry_addimage');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_category_sub'] = $this->language->get('entry_category_sub');
		$data['entry_category_sub_sub'] = $this->language->get('entry_category_sub_sub');


		$data['entry_paymentmode'] = $this->language->get('entry_paymentmode');
		$data['entry_duration'] = $this->language->get('entry_duration');
		$data['entry_placement'] = $this->language->get('entry_placement');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_date'] = $this->language->get('entry_date');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_no_of_views'] = $this->language->get('entry_no_of_views');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_cityy'] = $this->language->get('entry_cityy');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_state'] = $this->language->get('entry_state');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_images'] = $this->language->get('entry_images');
		$data['entry_otherimages'] = $this->language->get('entry_otherimages');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['text_paid_services'] = $this->language->get('text_paid_services');
		$data['text_paid_distinguish'] = $this->language->get('text_paid_distinguish');
		  $data['btn_img'] = $this->language->get('btn_img');
		  $data['button_remove'] = $this->language->get('button_remove');
		  $data['entry_addimage'] = $this->language->get('entry_addimage');
		  $data['button_upload'] = $this->language->get('button_upload');
		
		$data['classified_mapkey']=	$this->config->get('classified_mapkey');
		
		
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
		$data['entry_active'] = $this->language->get('entry_active');

 //product video code end
 


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
		
		
		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}


		 $filter_data = array(
			'customer_id' => $this->customer->isLogged()
		);

		//plan limit start
		$data['currentdate'] = date("Y-m-d");
		$packagedate=$this->model_classified_myads->getPackagedate($this->customer->isLogged());

		if (!empty($packagedate['expirydate'])) {
			$data['expirydate'] = $packagedate['expirydate'];
		} else {
			$data['expirydate'] = '';
		}
		
		if (!empty($packagedate['package_id'])) {
			$package_id = $packagedate['package_id'];
		} else {
			$package_id = '';
		}

		$packageinfo=$this->model_classified_myads->getCustPackage($package_id);
		
		if (!empty($packageinfo['classified_limit'])) {
			$data['classified_limit'] = $packageinfo['classified_limit'];
		} else {
			$data['classified_limit'] = '';
		}

	
		$data['total_classified']=$this->model_classified_myads->getTotalMyadd($filter_data);
		//plan limit end

		if (!isset($this->request->get['classified_id'])) {
			$data['action'] = $this->url->link('classified/classifiedadd/add', '', true);
		} else {
			$data['action'] = $this->url->link('classified/classifiedadd/edit','&classified_id=' . $this->request->get['classified_id'] , true);
		}
		if (isset($this->request->get['classified_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$post_info = $this->model_classified_classifiedadd->getPostEdit($this->request->get['classified_id']);
		}

		if (isset($this->request->post['classified_description'])) {
			$data['classified_description'] = $this->request->post['classified_description'];
		} elseif (isset($this->request->get['classified_id'])) {
			$data['classified_description'] = $this->model_classified_classifiedadd->getclassifiedDescription($this->request->get['classified_id']);
		} else {
			$data['classified_description'] = array();
		}

		if (isset($this->request->post['classified_id'])) {
			$data['classified_id'] = $this->request->post['classified_id'];
		} else {
			$data['classified_id'] = '';
		}


		if (isset($this->request->post['city_id'])) {
			$data['city_id'] = $this->request->post['city_id'];
		} elseif (!empty($post_info)) {
			$data['city_id'] = $post_info['city_id'];
		} else {
			$data['city_id'] = '';
		}
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($post_info)) {
			$data['city'] = $post_info['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($post_info)) {
			$data['address'] = $post_info['address'];
		} else {
			$data['address'] = '';
		}

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($post_info)) {
			$data['price'] = $this->currency->format($post_info['price'], $this->config->get('config_currency'));
		} else {
			$data['price'] = '';
		}
		
		if (isset($this->request->post['price'])) {
			$data['pricer'] = $this->request->post['price'];
		} elseif (!empty($post_info)) {
			$data['pricer'] = $post_info['price'];
		} else {
			$data['pricer'] = '';
		}
		
		
		
		if (isset($this->request->post['classified_category_id'])) {
			$data['classified_category_id'] = $this->request->post['classified_category_id'];
		} elseif (!empty($post_info)) {
			$data['classified_category_id'] = $post_info['classified_category_id'];
		} else {
			$data['classified_category_id'] = '';
		}

		$data['revcurreny']=strtolower($this->config->get('config_currency'));

		if (isset($this->request->post['sub_category_id'])) {
			$data['sub_category_id'] = $this->request->post['sub_category_id'];
		} elseif (!empty($post_info)) {
			$data['sub_category_id'] = $post_info['sub_category_id'];
		} else {
			$data['sub_category_id'] = '';
		}
	

		if (isset($this->request->post['sub_sub_category_id'])) {
			$data['sub_sub_category_id'] = $this->request->post['sub_sub_category_id'];
		} elseif (!empty($post_info)) {
			$data['sub_sub_category_id'] = $post_info['sub_sub_category_id'];
		} else {
			$data['sub_sub_category_id'] = '';
		}

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($post_info)) {
			$data['zone_id'] = $post_info['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($post_info)) {
			$data['country_id'] = $post_info['country_id'];
		} else {
			$data['country_id'] = '';
		}

		if (isset($this->request->post['customer_id'])) {
			$data['customer_id'] = $this->request->post['customer_id'];
		} elseif (!empty($post_info)) {
			$data['customer_id'] = $post_info['customer_id'];
		} else {
			$data['customer_id'] = '';
		}
		
		
		if (isset($this->request->post['singal_post'])) {
			$data['singal_post'] = $this->request->post['singal_post'];
		} elseif (!empty($post_info)) {
			$data['singal_post'] = $post_info['singal_post'];
		} else {
			$data['singal_post'] = '';
		}
		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($post_info)) {
			$data['location'] = $post_info['location'];
		} else {
			$data['location'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['singal_post']) && is_file(DIR_IMAGE . $this->request->post['singal_post'])) {
			$data['profileImage'] = $this->model_tool_image->resize($this->request->post['singal_post'], 100, 100);
		} elseif (!empty($post_info) && is_file(DIR_IMAGE . $post_info['singal_post'])) {
			$data['profileImage'] = $this->model_tool_image->resize($post_info['singal_post'], 100, 100);
		} else {
			$data['profileImage'] = '';
		}
		
		
		
		
		
		
		
		if (isset($this->request->get['classified_id'])) {
			$data['classified_id'] = $this->request->get['classified_id'];
		} else {
			$data['classified_id'] = '';
		}
		
		
		
	
 
		if (isset($this->request->post['lat'])) {
			$data['lat'] = $this->request->post['lat'];
		} elseif (!empty($post_info)) {
			$data['lat'] = $post_info['lat'];
		} else {
			$data['lat'] = '';
		}
		if (isset($this->request->post['lng'])) {
			$data['long'] = $this->request->post['lng'];
		} elseif (!empty($post_info)) {
			$data['long'] = $post_info['lng'];
		} else {
			$data['long'] = '';
		}
		if (isset($this->request->post['active'])) {
			$data['active'] = $this->request->post['active'];
		} elseif (!empty($post_info)) {
			$data['active'] = $post_info['active'];
		} else {
			$data['active'] = '';
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



		  /// <!---vodeo  start karan ---->
		
		if (isset($post_info['video_type'])) {
		$data['video_type'] = $post_info['video_type'];
		}else {
		$data['video_type'] = '';
		}

		if (isset($post_info['youtube_video'])) {
		$data['youtube_video'] = $post_info['youtube_video'];
		}else {
		$data['youtube_video'] = '';
		}
		
		if (isset($post_info['video_vimeo'])) {
		$data['video_vimeo'] = $post_info['video_vimeo'];
		}else {
		$data['video_vimeo'] = '';
		}
		if (isset($post_info['upload_video'])) {
		$data['upload_video'] = $post_info['upload_video'];
		}else {
		$data['upload_video'] = '';
		}
		 /// <!---vodeo  start karan ---->
		


		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		/// start end 
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		$this->load->model('classified/category');
		$this->load->model('tool/image');

//category
		$data['categorylists']=array();
		$category_infos = $this->model_classified_category->getCategories(0);
		foreach ($category_infos as $result) {

			if (is_file(DIR_IMAGE . $result['image'])) {
				$categoryimage = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$categoryimage ='';
			}
			$data['categorylists'][]=array(
				'classified_category_id' =>$result['classified_category_id'],
				'name' =>$result['name'],
				'categoryimage' =>$categoryimage
				);
		}

//sub category
		$subcategory_infos = $this->model_classified_category->getCategories($data['classified_category_id']);
				$data['subcategory']=array();

		foreach($subcategory_infos as $subcategory_info ){
			
			$data['subcategory'][]= array(
				'classified_category_id'   => $subcategory_info['classified_category_id'],
				'name'           		  => $subcategory_info['name'],
			);
		}


//sub sub category
		
		$sub_subcategory_infos = $this->model_classified_category->getCategories($data['sub_category_id']);
			$data['sub_subcategory']=array();

		foreach($sub_subcategory_infos as $sub_subcategory_info ){
			
			$data['sub_subcategory'][]= array(
				'classified_category_id'   => $sub_subcategory_info['classified_category_id'],
				'name'           		  => $sub_subcategory_info['name'],
			);
		}


		// Images
		if (isset($this->request->post['image'])) {
			$images = $this->request->post['image'];
		} elseif (isset($this->request->get['classified_id'])) {
			$images = $this->model_classified_classifiedadd->getPostMYADDImage($this->request->get['classified_id']);
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
				'image'        => $image,
				'classified_img_id'  => $product_image['classified_img_id'],
				'thumb'        => $this->model_tool_image->resize($thumb, 100, 100),
			);
		}

//image
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['thumbs'] = $this->model_tool_image->resize('no_image.png', 100, 100);


	
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('classified/classifiedadd_form', $data));
	
		}

	   public function edit() {
		$this->load->language('classified/classifiedadd');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('classified/classifiedadd');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_classified_classifiedadd->editMyadd($this->request->get['classified_id'], $this->request->post);

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

			 $this->response->redirect($this->url->link('classified/myads'));
			
		}

		$this->getForm();
	}


	public function delete() {
		$this->load->language('classified/classifiedadd');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('classified/classifiedadd');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $classified_id) {
				$this->model_postcreate_postcreate->deletePost($classified_id);
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

			$this->response->redirect($this->url->link('classified/classifiedadd' . $url));
		}

		$this->index();
	}

	public function category() {
		$json = array();

		$this->load->model('classified/category');
		$category_infos = $this->model_classified_category->getCategories($this->request->get['classified_category_id']);
		foreach($category_infos as $category_info ){
			
			$json['subcategory'][]= array(
				'classified_category_id'      => $category_info['classified_category_id'],
				'name'             => $category_info['name'],
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function subcategory() {
		$json = array();
		$this->load->model('classified/category');
		$subcategory_infos = $this->model_classified_category->getCategories($this->request->get['classified_category_id']);
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
		$data['text_select'] = $this->language->get('text_select');
		
		if(!empty($this->request->get['classified_id'])){
         $classified_id=$this->request->get['classified_id'];
		}else{$classified_id='';}

		$json = array();
		$data['tmdform_fields']=array();
	    $this->load->model('classified/classifiedadd');
		$subcategory_infos = $this->model_classified_classifiedadd->getCategorymyadd($this->request->get['classified_category_id']);

		if(!empty(!empty($subcategory_infos['form_id']))){
        $form_id=$subcategory_infos['form_id'];
		}else{$form_id='';}

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
                  'field_id'      	   =>$formget['field_id'], 
                  'form_id'      	   =>$formget['form_id'], 
                  'required'      	   =>$formget['required'], 
                  'field_name'         =>$formget['field_name'], 
                  'type'      	       =>$formget['type'], 
                  'help_text'          =>$formget['help_text'], 
                  'placeholder'        =>$formget['placeholder'], 
                  'error_message'      =>$formget['error_message'],
                  'form_field_option'  =>$form_field_option,
                  'value'             =>$valuelist
               );
  	     }

		$this->response->setOutput($this->load->view('classified/classifiedadd_categoryform', $data));		 
	    
	}

	private function validate() {
	
	
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
          
		 $this->load->model('localisation/country');

		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}
		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}
		  	  
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	

	}

	public function deleteimg() {
		$json = array();
		$this->load->model('classified/classifiedadd');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		$category_infos = $this->model_classified_classifiedadd->DeleteImage($this->request->get['classified_img_id']);
		$json['success']='xcx';
	   }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function zone() {
		$json = array();

		$this->load->model('localisation/zone');

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
		
	public function city() {
		$json = array();
		$this->load->model('localisation/city');
		$city_info = $this->model_localisation_city->getCityimagesss($this->request->get['city_id']);
	
			if ($city_info['city_id']) {
			   $json['city_id'] = $city_info['city_id'];
			} 
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	
	 public function addClass(){
		$json = array();
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}
			// Allowed file extension types
			$allowed = array();
			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));
			$filetypes = explode("\n", $extension_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Allowed file mime types
			$allowed = array();
			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));
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
		if (!$json) {
			$targetDir = DIR_IMAGE.'catalog/';
			$file = time().$filename;
			$location = $targetDir.$file;
			$location1 = 'catalog/'.$file;
			$this->load->model('tool/image');
			move_uploaded_file($this->request->files['file']['tmp_name'], $location);
			$location1=$this->model_tool_image->resize($location1, 263,206);
			$json['location1'] =$location1;
			$json['location'] ='catalog/'.$file;
			$json['success'] = $this->language->get('text_upload');
		}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
	}
	
	
	
		public function uploadvideo() {
		$this->load->language('classified/classifiedadd');

		$json = array();

		if (!$json) {
			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				///print_r($this->config->get('config_file_ext_allowed')); die();
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