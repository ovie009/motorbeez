<?php
class ControllerExtensionModuleclassifiedfeatured extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/classifiedfeatured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('classified/classifiedadd');
		$this->load->model('classified/myads');
		$this->load->model('tool/image');
		$data['accountlogin']=$this->url->link('account/account');
		$data['customerlogin']=$this->customer->isLogged();
	
		if (isset($this->request->get['classified_category_id'])) {
			$data['classifiedcategoryid'] = $this->request->get['classified_category_id'];
		} else {
			$data['classifiedcategoryid']= '';
		}
		$data['classifiedseachs'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['classified'])) {

			$classifieds = array_slice($setting['classified'], 0, (int)$setting['limit']);

			foreach ($classifieds as $classified_id) {
				$product_info = $this->model_classified_classifiedadd->getclassifieds($classified_id);

				foreach ($product_info as $category_search) {
				$myaddsImgs=$this->model_classified_myads->getPostImageUser($classified_id);
			$imguser=array();
            foreach ($myaddsImgs as $myaddsImg) {
				if ($myaddsImg['image']) {
					$imgusershow = $this->model_tool_image->resize($myaddsImg['image'], $setting['width'], $setting['height']);
				} else {
					$imgusershow = $this->model_tool_image->resize('placeholder.png',$setting['width'], $setting['height']);
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

			///category end
			// color start 
		  $totdate=date('Y-m-d');

			$colors=$this->model_classified_myads->placementClassFied($category_search['classified_id']); 

			if(!empty($colors['classified_id'])){
			 $classified_id =$colors['classified_id'];
			}else{
				$classified_id='';
			} 

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
			$colorspad=$this->model_classified_myads->placementClasscolor($placement_id);  		
			// color start end

			if(!empty($colorspad['package_color'])){
				$packagecolor =$colorspad['package_color'];
			}else{
				$packagecolor='';
			}  
            
			if (!empty($colorspad['package_icon'])) {
				$packagecolorimg = $this->model_tool_image->resize($colorspad['package_icon'], 263,206);
			}else{
				  $packagecolorimg='';
			}

			/// color end
			///configcurrency start

			$configcurrency =$this->config->get('config_currency');
			///configcurrency end

          if (!empty($category_search['singal_post'])) {
					$singal_post = $this->model_tool_image->resize($category_search['singal_post'],262, 206);
				} else {
					$singal_post = $this->model_tool_image->resize('placeholder.png',262, 206);
				}

			$data['classifiedseachs'][]=array(
				'classified_id'    =>$category_search['classified_id'],
				'post_description' => utf8_substr(strip_tags(html_entity_decode($category_search['post_description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',       
				'title'            =>$category_search['title'],
				'customer_id'      =>$category_search['customer_id'],
				'city'             =>$cityname,
				'packagecolor'     =>$packagecolor,
				'packagecolorimg'  =>$packagecolorimg,
				'singal_post'       =>$singal_post,
                 'price'            =>$this->currency->format($category_search['price'].$configcurrency,$this->session->data['currency']),
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
		}

		if ($data['classifiedseachs']) {
			return $this->load->view('extension/module/classifiedfeatured', $data);
		}
	}
}