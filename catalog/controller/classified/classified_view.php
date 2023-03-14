<?php
class Controllerclassifiedclassifiedview extends Controller {
	private $error = array();

	public function index() {

	  	$this->load->model('classified/myads');
		$this->load->model('classified/classifiedadd');
		$this->load->model('account/customer');
		$this->load->model('tool/image');

		$this->load->language('classified/classified_view');

		
		$data['heading_title']  		= $this->language->get('heading_title');
		$data['text_seller']  		= $this->language->get('text_seller');
		$data['text_report']  		= $this->language->get('text_report');
		$data['text_adid']  		= $this->language->get('text_adid');
		$data['text_photos']  		= $this->language->get('text_photos');
		$data['text_title']  		= $this->language->get('text_title');
		$data['text_desc']  		= $this->language->get('text_desc');
		$data['text_location']  		= $this->language->get('text_location');
		$data['text_map']  		= $this->language->get('text_map');
		$data['text_additiondetail']  		= $this->language->get('text_additiondetail');
		$data['text_featuredetail']  		= $this->language->get('text_featuredetail');
		$data['text_address']  		= $this->language->get('text_address');
		$data['text_city']  		= $this->language->get('text_city');
		$data['text_zone']  		= $this->language->get('text_zone');
		$data['text_country']  		= $this->language->get('text_country');
		$data['text_postedon']  		= $this->language->get('text_postedon');
		$data['text_video']  		= $this->language->get('text_video');

		if (isset($this->request->get['classified_id'])) {
			$classified_id = $this->request->get['classified_id'];
		} else {
			$classified_id = '';
		}

        $data['slidersbigimg']=array();
		$myadd_slidersbig=$this->model_classified_myads->getPostImageUser($classified_id);

		foreach ($myadd_slidersbig as $myadd_slider) {
			if ($myadd_slider['image']) {
					$slidersbig = $this->model_tool_image->resize($myadd_slider['image'], 1280,1014);
					
				} else {
					$slidersbig = $this->model_tool_image->resize('placeholder.png',1280,1014);
					
				}
				
             $data['slidersbigimg'][1]=array(
             	'slidersbig' =>$slidersbig

            );
			
		}
		$data['sliderssmall']=array();
		$myadd_sliderssmalls=$this->model_classified_myads->getPostImageUser($classified_id);
		foreach ($myadd_sliderssmalls as $myadd_sliderssmall) {
				if ($myadd_sliderssmall['image']) {
					$sliders = $this->model_tool_image->resize($myadd_sliderssmall['image'], 1280,1014);
				} else {
					$sliders = $this->model_tool_image->resize('placeholder.png',1280,1014);
				}

             $data['sliderssmall'][]=array(
              	'sliders'   =>$sliders

            );

		}
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		///
    	$classifiedView=$this->model_classified_myads->getClassified($classified_id);
	//	print_r($classifiedView); die();


		if(!empty($classifiedView['video_type']=='upload')){
		$data['uploadvideourl'] =$server.'image/video/'.$classifiedView['upload_video'];
		}else if(!empty($classifiedView['video_type']=='youtube')){
		$data['uploadvideourl'] =$classifiedView['youtube_video'];
		}else if(!empty($classifiedView['video_type']=='vimeo')){
		$data['uploadvideourl'] =$classifiedView['video_vimeo'];
		}else{
		$data['uploadvideourl'] ='';
		}
		
	
		
		if (!empty($classifiedView['singal_post'])) {
			$data['singal_post'] = $this->model_tool_image->resize($classifiedView['singal_post'], 1280,1014);
			$this->document->setSeoimage($data['singal_post']);
	} else {
			$data['singal_post'] = $this->model_tool_image->resize('placeholder.png',1280,1014);
		}

		if(!empty($classifiedView['title']) &&!empty($classifiedView['classified_id']) ){
		}else{
			$this->response->redirect($this->url->link('classified/home'));
		}
		$favouritestatuscolor=$this->model_classified_myads->favouriteaddcolor($classifiedView['classified_id']);
		if(!empty($favouritestatuscolor['favouritestatus'])){
		$data['favouritestatus'] =$favouritestatuscolor['favouritestatus'];
		}else{
		$data['favouritestatus']='';
		}
		if(!empty($classifiedView['post_description'])){
			$data['postdescription'] =html_entity_decode($classifiedView['post_description']);
		}else{
           $data['postdescription']='';
		}
		if(!empty($classifiedView['title'])){
			$data['title'] =$classifiedView['title'];
		}else{
           $data['title']='';
		}
		$this->document->setTitle($classifiedView['title']);
		
		if(!empty($classifiedView['city'])){
			$data['city'] =$classifiedView['city'];
		}else{
           $data['city']='';
		}

		if(!empty($classifiedView['address'])){
			$data['address'] =html_entity_decode($classifiedView['address']);
		}else{
           $data['address']='';
		}
   //countery start

      $CountryInfos=$this->model_classified_myads->getCountry($classifiedView['country_id']);

		if(!empty($CountryInfos['name'])){
			$data['namecountry']=$CountryInfos['name'];
		}else{
			$data['namecountry']='';
		}

      //countery end

		//Zone start
		$ZoneInfos=$this->model_classified_myads->getZone($classifiedView['zone_id']);
		if(!empty($ZoneInfos['name'])){
			$data['zonename']=$ZoneInfos['name'];
		}else{
			$data['zonename']='';
		}

		$cityinfo=$this->model_classified_myads->getCity($classifiedView['city_id']);
		if(!empty($cityinfo['cityname'])){
			$data['cityname']=$cityinfo['cityname'];
		}else{
			$data['cityname']='';
		}
		//city end



		if(!empty($classifiedView['lat'])){
			$data['lat'] =$classifiedView['lat'];
		}else{
           $data['lat']='';
		}

		if(!empty($classifiedView['lng'])){
			$data['lng'] =$classifiedView['lng'];
		}else{
           $data['lng']='';
		}
		if(!empty($classifiedView['classified_id'])){
			$data['classified_id'] =$classifiedView['classified_id'];
		}else{
           $data['classified_id']='';
		}

		if(!empty($classifiedView['customer_id'])){
			$data['customer_id'] =$classifiedView['customer_id'];
		}else{
           $data['customer_id']='';
		}

		$configcurrency =$this->config->get('config_currency');

		if(!empty($classifiedView['price'])){
			$data['price'] =$this->currency->format($classifiedView['price'], $this->session->data['currency']);
		}else{
           $data['price']='';
		}

		if(!empty($classifiedView['date_added'])){
			$data['date_added'] =date($this->language->get('date_format_short'), strtotime($classifiedView['date_added']));
		}else{
           $data['date_added']='';
		}


		///category start
			$postcategory=$this->model_classified_myads->getMyaddCategory($classifiedView['classified_category_id']);

			if(!empty($postcategory['name'])){
			$data['categoryname']=$postcategory['name'];
			}else{
				$data['categoryname']='';
			}

			$postcategorysub=$this->model_classified_myads->getMyaddCategory($classifiedView['sub_category_id']);


			if(!empty($postcategorysub['name'])){
			 $data['subcategoryname']=$postcategorysub['name'];
			}else{
			 $data['subcategoryname']='';
			}

			$postcategorysubsub=$this->model_classified_myads->getMyaddCategory($classifiedView['sub_sub_category_id']);

			if(!empty($postcategorysubsub['name'])){
			  $data['categorynamesub']=$postcategorysubsub['name'];
			}else{
				$data['categorynamesub']='';
			}

		$customername=$this->model_classified_myads->getCustomerMyadd($classifiedView['customer_id']);
		 $data['classified_mapkey'] = $this->config->get('classified_mapkey');


		if ($this->config->get('classified_icon')) {
		 $data['classified_icon']= $this->model_tool_image->resize($this->config->get('classified_icon'), 150,150);
		} else {
		 $data['classified_icon'] = '';
		}

		if(!empty($customername['date_added'])){
		$data['dateadded']=date($this->language->get('date_format_short'), strtotime($customername['date_added']));
		}else{
		 $data['dateadded']='';
		}

		if(!empty($customername['firstname'])){
		 $data['firstname']=$customername['firstname'].$customername['lastname'];
		}else{
		 $data['firstname']='';
		}

		if(!empty($customername['telephone'])){
			$data['telephone'] =$customername['telephone'];
		}else{
           $data['telephone']='';
		}


       $data['classifiedform']=array();
		$classifiedFileds=$this->model_classified_myads->getFiledClassified($classified_id);

		if(!empty($classifiedFileds['form_id'])) {
        $form_id=$classifiedFileds['form_id'];
		}else{
		$form_id='';
		}

		$formgets= $this->model_classified_classifiedadd->getForms($form_id);
			//echo"<pre>";
  	    //  print_r($formgets); die();

		foreach ($formgets as $formget) {
			$form_field_option=array();
		     $optionresults= $this->model_classified_classifiedadd->getFormsOption($formget['field_id']);
		     foreach ($optionresults as $optionresult) {
		     	$form_field_option[]=array(
		  	 		'name'         =>$optionresult['name'],
		  	 		'field_id'     =>$optionresult['field_id'],
		  	 		'sort_order'     =>$optionresult['sort_order']
		  	 	 );
		     }
		          $form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdform_field_classified WHERE classified_id = '" .$classified_id."'and field_id='".$formget['field_id']."'");

            		
            	if(!empty($form_query->row['serialize'])){
            		$customevalue='';
					$customevalue=unserialize($form_query->row['value']);
				}else{
					if(!empty($form_query->row['value'])){
						$customevalue=$form_query->row['value'];
					}else{
						$customevalue='';
					}
			   }
				

			if(!empty($form_query->row['serialize'])){
				$fieldinfos=unserialize($form_query->row['value']);

			   $value='';
				foreach($fieldinfos as $field){
				    $value .=$field.',';
				}


				$customevalue=$value;
			}
  	     	$data['classifiedform'][]=array(
                  'field_id'      	   =>$formget['field_id'],
                  'form_id'      	   =>$formget['form_id'],
                  'required'      	   =>$formget['required'],
                  'field_name'         =>$formget['field_name'],
                  'type'      	       =>$formget['type'],
                  'help_text'          =>$formget['help_text'],
                  'placeholder'        =>$formget['placeholder'],
                  'error_message'      =>$formget['error_message'],
                  'form_field_option'  =>$form_field_option,
                  'value'   	       =>$customevalue
               );
  	       }
  	      // echo"<pre>";
  	      /// print_r($data['classifiedform']); die();
    /// profile image
		$ProfileImages = $this->model_account_customer->getCustomer($classifiedView['customer_id']);
		if (isset($ProfileImages['image'])) {
		 $data['profileImage']= $this->model_tool_image->resize($ProfileImages['image'], 100,100);
		} else {
		 $data['profileImage'] = $this->model_tool_image->resize('placeholder.png',100,100);
		}

		$data['userallad']=$this->url->link('classified/user_allad','&customerid='.$classifiedView['customer_id']);


         $data['accountlogin']  =$this->url->link('classified/login');
		$data['customerlogin']  =$this->customer->isLogged();

		if (isset($this->request->get['classified_id'])) {
			$data['classifiedid'] = $this->request->get['classified_id'];
		} else {
			$data['classifiedid'] = '';
		}

        $data['enquirypopup'] =$this->url->link('classified/classified_view/enquirypopup','&classified_id=' . $data['classifiedid']);
		
		$data['reportspopup'] =$this->url->link('classified/classified_view/reportpopup','&classified_id=' . $data['classifiedid']);
		
		$setLink =$this->url->link('classified/classified_view','&classified_id=' . $data['classifiedid']);
		$this->document->setLink($setLink);
		$this->document->setDescription(strip_tags($data['postdescription']));
		


		$data['footer']       =$this->load->controller('common/footer');
		$data['header']       =$this->load->controller('common/header');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');

        $this->response->setOutput($this->load->view('classified/classified_view', $data));
	 }

	  public function enquirypopup() {
         $this->load->model('classified/myads');
          $this->load->language('classified/classified_view');
	 	$enquirypopupdata=$this->model_classified_myads->getClassified($this->request->get['classified_id']);
	       $data['text_submit']  		= $this->language->get('text_submit');
	       $data['button_submit']  		= $this->language->get('button_submit');
	       	$data['text_enquiry']  		= $this->language->get('text_enquiry');
	       	$data['text_title']  		= $this->language->get('text_title');
	       	$data['text_email']  		= $this->language->get('text_email');
	 	if(!empty($enquirypopupdata['customer_id'])){
			 $data['customer_id']=$enquirypopupdata['customer_id'];
			}else{
				$data['customer_id']='';
			}
			if(!empty($enquirypopupdata['classified_id'])){
			 $data['classified_id']=$enquirypopupdata['classified_id'];
			}else{
				$data['classified_id']='';
			}

			$data['customerlogin']=$this->customer->isLogged();


	 	$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $this->response->setOutput($this->load->view('classified/enquirypopup', $data));
    }

      public function reportpopup() {
         $this->load->model('classified/myads');
         $this->load->language('classified/classified_view');
		$this->load->model('classified/classifiedadd');
		$data['text_submit']  		= $this->language->get('text_submit');
			$data['text_report']  		= $this->language->get('text_report');
	 	$enquirypopupdata=$this->model_classified_myads->getClassified($this->request->get['classified_id']);

	 	if(!empty($enquirypopupdata['customer_id'])){
			 $data['customer_id']=$enquirypopupdata['customer_id'];
			}else{
				$data['customer_id']='';
			}
			if(!empty($enquirypopupdata['classified_id'])){
			 $data['classified_id']=$enquirypopupdata['classified_id'];
			}else{
				$data['classified_id']='';
			}

			$data['customerlogin']=$this->customer->isLogged();

			$data['reports']=array();

			$data['reports'][]=array(
			'name'    =>$this->language->get('text_productreport'),
			'value'   =>$this->language->get('text_productreport')
			);
			$data['reports'][]=array(
			'name'    =>$this->language->get('text_sellernot'),
			'value'   =>$this->language->get('text_sellernot')
			);
			$data['reports'][]=array(
			'name'     =>$this->language->get('text_addupli'),
			'value'    =>$this->language->get('text_addupli')
			);
			$data['reports'][]=array(
			'name'     =>$this->language->get('text_category'),
			'value'    =>$this->language->get('text_category')
			);

			$data['reports'][]=array(
			'name'    =>$this->language->get('text_Fraud'),
			'value'   =>$this->language->get('text_Fraud')
			);


	 	$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('classified/reportpopup', $data));
    }

	  public function Addfavourite() {
		$json = array();
		$this->load->language('classified/myads');
		$this->load->model('classified/myads');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
	    $form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_favourite_ad where classified_id = '".$this->request->get['classified_id']."' and login_customer_id='".$this->customer->isLogged()."' ");

		if(!empty($form_query->row['customer_id'])){
			$customer_id =$form_query->row['customer_id'];
		}else{
			$customer_id='';
		}

		if(!empty($form_query->row['classified_id'])){
			$classified_id =$form_query->row['classified_id'];
		}else{
			$classified_id='';
		}

		if(!empty($form_query->row['login_customer_id'])){
			$login_customer_id =$form_query->row['login_customer_id'];
		}else{
			$login_customer_id='';
		}
       if(!empty($classified_id) &&!empty($customer_id) &&!empty($login_customer_id)){
		}else{
			$category_infos = $this->model_classified_myads->favouriteadd($this->request->post,$this->request->get['classified_id']);
		}
		$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('classified/myfavouriteads'));
	    }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	 public function addfavouritegreen() {
		$json = array();
		$this->load->language('classified/myads');
		$this->load->model('classified/myads');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		$this->model_classified_myads->favouriteaddshow($this->request->post,$this->request->get['classified_id']);
		$json['success']='green';
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	  }
	}
	 public function addfavouriteblack() {
		$json = array();
		$this->load->language('classified/myads');
		$this->load->model('classified/myads');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
           $this->model_classified_myads->favouriteaddshowblack($this->request->post,$this->request->get['classified_id']);
		$json['success']='black';

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	  }
	}

	 public function reportssubmit() {
		$json = array();
		$this->load->model('classified/myads');
	  $this->load->language('classified/classified_view');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		$report_erro = $this->request->post['report'];
		if(!empty($report_erro)){
		   $this->model_classified_myads->reportAdd($this->request->post);
 		  $json['success']= $this->language->get('text_success');
		}else{
		  $json['error_report']       =$this->language->get('error_report');


		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	  }
	}
}
