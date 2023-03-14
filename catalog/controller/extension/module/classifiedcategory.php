<?php
class ControllerExtensionModuleClassifiedCategory extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/classifiedcategory');
	$this->load->model('classified/classified_category');
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_selectcountry'] = $this->language->get('text_selectcountry');
		$data['text_selectstate'] = $this->language->get('text_selectstate');
		$data['text_selectcity'] = $this->language->get('text_selectcity');
		$data['text_selectcategory'] = $this->language->get('text_selectcategory');
		$data['text_selectscategory'] = $this->language->get('text_selectscategory');
		$data['text_none'] = $this->language->get('text_none');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_state'] = $this->language->get('text_state');
		$data['text_city'] = $this->language->get('text_city');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_subcategory'] = $this->language->get('text_subcategory');
		$data['text_ssubcategory'] = $this->language->get('text_ssubcategory');
		$url = '';


		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		if (isset($this->request->post['city_id'])) {
			$data['city_id'] = $this->request->post['city_id'];
		} else {
			$data['city_id'] = '';
		}

		if (isset($this->request->post['sub_sub_category_id'])) {
			$data['sub_sub_category_id'] = $this->request->post['sub_sub_category_id'];
		} else {
			$data['sub_sub_category_id'] = '';
		}

		if (isset($this->request->get['classified_category_id'])) {
			$data['classified_category_id'] = $this->request->get['classified_category_id'];
		} else {
			$data['classified_category_id'] = '';
		}

		if (isset($this->request->post['classified_category_id'])) {
			$classified_category_id = $this->request->post['classified_category_id'];
		} else {
			$classified_category_id = '';
		}

		if (isset($this->request->get['classified_category_id'])) {
			$classifiedcategoryd = $this->request->get['classified_category_id'];
		} else {
			$classifiedcategoryd = '';
		}

			/// start end 
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries(0);

		// sub category start
	    $data['sub_subcategory']=array();				
		$this->load->model('classified/category');
		$subcategory_infos = $this->model_classified_category->getCategories($classifiedcategoryd);
		foreach($subcategory_infos as $sub_info ){

		$data['sub_subcategory'][]= array(
			'classified_category_id'      => $sub_info['classified_category_id'],
			'name'             => $sub_info['name'],
		);
		}



		// sub category end 


		return $this->load->view('extension/module/classifiedcategory', $data);

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
	public function  categoryclassifiedseach() {
		$this->load->language('classified/classifiedadd');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_category'] = $this->language->get('text_category');
		if(!empty($this->request->get['classified_id'])){
         $classified_id=$this->request->get['classified_id'];
		}else{
		$classified_id='';
		}

		$json = array();
		$data['tmdform_fields']=array();
	    $this->load->model('classified/classifiedadd');
		$subcategory_infos = $this->model_classified_classifiedadd->getCategorymyadd($this->request->get['classified_category_id']);

		if(!empty($subcategory_infos['form_id'])) {
        $form_id=$subcategory_infos['form_id'];
		}else{
		$form_id='';
		}
		if(!empty($subcategory_infos['form_id'])) {
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
           $this->response->setOutput($this->load->view('extension/module/classifiedcategory_search.tpl', $data));	
     }
    public function  seach_filter_category() {
    	
    	$this->load->language('classified/classifiedadd');
		$this->load->model('classified/myads');
		$this->load->model('tool/image');

		$data['text_select'] = $this->language->get('text_select');
		$data['text_category'] = $this->language->get('text_category');

		$json = array();
    	
		if (isset($this->request->get['classified_category_id'])) {
			$classified_category_id = $this->request->get['classified_category_id'];
		} else {
			$classified_category_id = '';
		}
	
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['classified_category_id'])) {
			$url .= '&classified_category_id=' . $this->request->get['classified_category_id'];
		}

		if (isset($this->request->post['formfields'])) {
			$formfields = $this->request->post['formfields'];
		} else {
			$formfields = '';
		}
		if (!empty($this->request->post['country_id'])) {
			$country_id = $this->request->post['country_id'];
		} else {
			$country_id = '';
		}
		if (!empty($this->request->post['zone_id'])) {
			$zone_id = $this->request->post['zone_id'];
		} else {
			$zone_id = '';
		}
		if (!empty($this->request->post['sub_category_id'])) {
			$sub_category_id = $this->request->post['sub_category_id'];
		} else {
			$sub_category_id = '';
		}
		if (!empty($this->request->post['sub_sub_category_id'])) {
			$sub_sub_category_id = $this->request->post['sub_sub_category_id'];
		} else {
			$sub_sub_category_id = '';
		}

	  $data['classifiedseachs']=array();

		$filter_data = array(
			'country_id'              => $country_id,
			'zone_id'                 => $zone_id,
			////'city_id'                 => $this->request->post['city_id'],
			'classified_category_id'         => $classified_category_id,
			'sub_category_id'         => $sub_category_id,
			'sub_sub_category_id'     => $sub_sub_category_id,
			'formfields'              =>$formfields,
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);
		
		$myadds_total=$this->model_classified_myads->getMyaddsfilterTotal($filter_data);
		$myadds_results=$this->model_classified_myads->getMyadds_filter($filter_data);
		foreach ($myadds_results as $category_search) {
		if(!empty($category_search['active']==1)){
			$myaddsImgs=$this->model_classified_myads->getPostImageUser($category_search['classified_id']);
			$imguser=array();
		
            foreach ($myaddsImgs as $myaddsImg) {
            				if ($myaddsImg['image']) {
					$imgusershow = $this->model_tool_image->resize($myaddsImg['image'], 263,206);
				} else {
					$imgusershow = $this->model_tool_image->resize('placeholder.png',263,206);
				}
            	$imguser[1]=array(
            	'imguser'=>$imgusershow);
              }
              //countery start 

              $CountryInfos=$this->model_classified_myads->getCountry($category_search['country_id']);
             
				if(!empty($CountryInfos['name'])){
					$namecountry=$CountryInfos['name'];
				}else{
					$namecountry='';
				}

              //countery end 

				//Zone start 
				$ZoneInfos=$this->model_classified_myads->getZone($category_search['zone_id']);
				if(!empty($ZoneInfos['name'])){
					$zonename=$ZoneInfos['name'];
				}else{
					$zonename='';
				}

				//Zone start 
				$cityinfo=$this->model_classified_myads->getCity($category_search['city_id']);
				if(!empty($cityinfo['cityname'])){
					$cityname=$cityinfo['cityname'];
				}else{
					$cityname='';
				}
				if(!empty($category_search['city'])){
					$city=$category_search['city'];
				}else{
					$city='';
				}

			   //Zone end  

			///category start
			$postcategory=$this->model_classified_myads->getMyaddCategory($category_search['classified_category_id']);

		
			if(!empty($postcategory['name'])){
			 $categoryname=$postcategory['name'];
			}else{
				$categoryname='';
			}

			$postcategorysub=$this->model_classified_myads->getMyaddCategory($category_search['sub_category_id']);
		

			if(!empty($postcategorysub['name'])){
			 $subcategoryname=$postcategorysub['name'];
			}else{
				$subcategoryname='';
			}	

			$postcategorysubsub=$this->model_classified_myads->getMyaddCategory($category_search['sub_sub_category_id']);
			
			if(!empty($postcategorysubsub['name'])){
			 $categorynamesub=$postcategorysubsub['name'];
			}else{
				$categorynamesub='';
			}

			$favouritestatuscolor=$this->model_classified_myads->favouriteaddcolor($category_search['classified_id']);
		
			if(!empty($favouritestatuscolor['favouritestatus'])){
			 $favouritestatus =$favouritestatuscolor['favouritestatus'];
			}else{
				$favouritestatus='';
			}



			$colors=$this->model_classified_myads->placementClassFied($category_search['classified_id']); 

			if(!empty($colors['classified_id'])){
			 $classified_id =$colors['classified_id'];
			}else{
				$classified_id='';
			} 

		
			if(!empty($colors['placement_id'])){
			$placement_id =$colors['placement_id'];
			}else{
			$placement_id='';
			}
		
			  $configcurrency =$this->config->get('config_currency'); 	
			  
			  if (!empty($category_search['singal_post'])) {
					$singal_post = $this->model_tool_image->resize($category_search['singal_post'],262, 206);
				} else {
					$singal_post = $this->model_tool_image->resize('placeholder.png',262, 206);
				}

			$data['classifiedseachs'][]=array(
				'classified_id'    =>$category_search['classified_id'],
				'post_description' => utf8_substr(strip_tags(html_entity_decode($category_search['post_description'], ENT_QUOTES, 'UTF-8')), 0, 50) . '..',
				'title'            =>$category_search['title'],
				'customer_id'      =>$category_search['customer_id'],
				'city'             =>$city,
				'singal_post'       =>$singal_post,
				'price' 		   =>$this->currency->format($category_search['price'], $this->session->data['currency']),

				'date_added'       =>date($this->language->get('date_format_short'), strtotime($category_search['date_added'])),
				'img'              =>$imguser,
				'namecountry'      =>$namecountry,
				'favouritestatus'  =>$favouritestatus,
				'zonename'         =>$zonename,
				'categoryname'     =>$categoryname,
				'subcategoryname'  =>$subcategoryname,
				'categorynamesub'  =>$categorynamesub,
				 'enquirypopup'	   => $this->url->link('classified/user_allad/enquirypopup','&classified_id=' . $category_search['classified_id']),
				 'view'		       => $this->url->link('classified/classified_view','&classified_id=' . $category_search['classified_id'])



			);
		   }
		} 	
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if (isset($this->request->get['classified_category_id'])) {
			$url .= '&classified_category_id=' . $this->request->get['classified_category_id'];
		}
		$pagination = new Pagination();
		$pagination->total      = $myadds_total;
		$pagination->page       = $page;
		$pagination->limit      = $this->config->get('config_limit_admin');
		$pagination->url        = $this->url->link('classified/classified_search',$url . '&page={page}', true);
		$data['pagination']     = $pagination->render();
        $data['results']        = sprintf($this->language->get('text_pagination'), ($myadds_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($myadds_total - $this->config->get('config_limit_admin'))) ? $myadds_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $myadds_total, ceil($myadds_total / $this->config->get('config_limit_admin')));
        $data['text_no_results'] =$this->language->get('text_no_results');

        $data['accountlogin']=$this->url->link('classified/login');
		$data['customerlogin']=$this->customer->isLogged();

		$this->response->setOutput($this->load->view('extension/module/serachfiltercategory', $data));
	}
}