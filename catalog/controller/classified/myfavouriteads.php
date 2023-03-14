<?php
class Controllerclassifiedmyfavouriteads extends Controller {
	private $error = array();

	public function index() {
		   if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}
			$this->load->language('classified/myfavouriteads');
			$this->load->model('classified/myads');
			$this->load->model('account/customer');
			$this->load->model('tool/image');
			$this->document->setTitle($this->language->get('heading_title'));
			$data['text_account']  		= $this->language->get('text_account');
			$data['text_dashboard']  		= $this->language->get('text_dashboard');
			$data['text_myads']  		= $this->language->get('text_myads');
			$data['text_favads']  		= $this->language->get('text_favads');
			$data['text_messages']  		= $this->language->get('text_messages');
			$data['text_setting']  		= $this->language->get('text_setting');
			$data['text_addclassified']  		= $this->language->get('text_addclassified');
			$data['text_category']  		= $this->language->get('text_category');
			$data['text_enquiry']  		= $this->language->get('text_enquiry');
			$data['text_no_results']  		= $this->language->get('text_no_results');
			$data['button_submit']  		= $this->language->get('button_submit');

		if (isset($this->request->get['login_customer_id'])) {
			$login_customer_id = $this->request->get['login_customer_id'];
		} else {
			$login_customer_id = '';
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ASC';
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
		$url = '';
		if (isset($this->request->get['customerid'])) {
			$url .= '&customerid=' . $this->request->get['customerid'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->session->data['favsuccess'])) {
			$data['favsuccess'] = $this->session->data['favsuccess'];
			unset($this->session->data['favsuccess']);
		} else {
			$data['favsuccess'] = '';
		}




        $data['favouritesinfo']=array();
        $filter_data = array(
			'login_customer_id' =>$this->customer->isLogged(),
			'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'              => $this->config->get('config_limit_admin')

		);

	$favouritestotal=$this->model_classified_myads->getfavouritesTotal($filter_data);
		$favourites_result=$this->model_classified_myads->getfavourites($filter_data);

		foreach ($favourites_result as $favourites) {

			$favouritesadd=$this->model_classified_myads->getClassified($favourites['classified_id']);

			$myaddsImgs=$this->model_classified_myads->getPostImageUser($favouritesadd['classified_id']);
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

              $CountryInfos=$this->model_classified_myads->getCountry($favouritesadd['country_id']);

				if(!empty($CountryInfos['name'])){
					$namecountry=$CountryInfos['name'];
				}else{
					$namecountry='';
				}

              //countery end

				//Zone start
				$ZoneInfos=$this->model_classified_myads->getZone($favouritesadd['zone_id']);
				if(!empty($ZoneInfos['name'])){
					$zonename=$ZoneInfos['name'];
				}else{
					$zonename='';
				}

			   //Zone end

			///category start
			$postcategory=$this->model_classified_myads->getMyaddCategory($favouritesadd['classified_category_id']);


			if(!empty($postcategory['name'])){
			 $categoryname=$postcategory['name'];
			}else{
				$categoryname='';
			}

			$postcategorysub=$this->model_classified_myads->getMyaddCategory($favouritesadd['sub_category_id']);


			if(!empty($postcategorysub['name'])){
			 $subcategoryname=$postcategorysub['name'];
			}else{
				$subcategoryname='';
			}

			$postcategorysubsub=$this->model_classified_myads->getMyaddCategory($favouritesadd['sub_sub_category_id']);

			if(!empty($postcategorysubsub['name'])){
			 $categorynamesub=$postcategorysubsub['name'];
			}else{
				$categorynamesub='';
			}

			if(!empty($favouritesadd['post_description'])){
				$post_description=substr(strip_tags(html_entity_decode($favouritesadd['post_description'])),0,200);
			}else{
				$post_description='';
			}

			if(!empty($favouritesadd['title'])){
			 $title=$favouritesadd['title'];
			}else{
				$title='';
			}
			if(!empty($favouritesadd['customer_id'])){
			 $customer_id=$favouritesadd['customer_id'];
			}else{
				$customer_id='';
			}
			if(!empty($favouritesadd['classified_id'])){
			 $classified_idvie=$favouritesadd['classified_id'];
			}else{
				$classified_idvie='';
			}

			if(!empty($favouritesadd['city'])){
			 $city=$favouritesadd['city'];
			}else{
				$city='';
			}
			$configcurrency =$this->config->get('config_currency');

			if(!empty($favouritesadd['price'])){
			 $price=$this->currency->format($favouritesadd['price'], $this->config->get('config_currency'));
			}else{
				$price=$this->currency->format($favouritesadd['price'], $this->config->get('config_currency'));
			}

			if(!empty($favouritesadd['date_added'])){
			 $date_added=$favouritesadd['date_added'];
			}else{
				$date_added='';
			}
				// color start

			$colors=$this->model_classified_myads->placementClassFied($favouritesadd['classified_id']);

			if(!empty($colors['classified_id'])){
			 $classified_id =$colors['classified_id'];
			}else{
				$classified_id='';
			}

			if(!empty($colors['package_id'])){
			$package_id =$colors['package_id'];
			}else{
			$package_id='';
			}
			$colorspad=$this->model_classified_myads->placementClasscolor($package_id);
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
			if (!empty($favouritesadd['singal_post'])) {
				$singal_post = $this->model_tool_image->resize($favouritesadd['singal_post'],262, 206);
			} else {
				$singal_post = $this->model_tool_image->resize('placeholder.png',262, 206);
			}
			

			$data['favouritesinfo'][]=array(
				'classified_id'    =>$classified_idvie,
				'post_description' =>$post_description,
				'title'            =>$title,
				'customer_id'      =>$customer_id,
				'packagecolorimg'      =>$packagecolorimg,
				'packagecolor'      =>$packagecolor,
				'city'             =>$city,
				'price'            =>$price,
				'date_added'       =>$date_added,
				'singal_post'       =>$singal_post,
				'img'              =>$imguser,
				'namecountry'      =>$namecountry,
				'zonename'         =>$zonename,
				'categoryname'     =>$categoryname,
				'subcategoryname'  =>$subcategoryname,
				'categorynamesub'  =>$categorynamesub,
				 'view'		       => $this->url->link('classified/classified_view','&classified_id=' . $classified_idvie),
				 'enquirypopup'	    => $this->url->link('classified/myfavouriteads/enquirypopup&classified_id=' . $classified_idvie),
				 'delete'	    => $this->url->link('classified/myfavouriteads/deleteadds&classified_id=' . $classified_idvie)



			);
		}

		$pagination = new Pagination();
		$pagination->total = $favouritestotal;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/myfavouriteads',$url . '&page={page}', true);

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($favouritestotal) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($favouritestotal - $this->config->get('config_limit_admin'))) ? $favouritestotal : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $favouritestotal, ceil($favouritestotal / $this->config->get('config_limit_admin')));

		///profile images

	$this->load->model('classified/mymessages');


		$data['InquieryTotal']=$this->model_classified_myads->getTotalInquiery($this->customer->isLogged());
		$data['classitotalread']=$this->model_classified_mymessages->classitotalread($this->customer->isLogged());

		$custinfo = $this->model_account_customer->getCustomer($this->customer->isLogged());

		if (isset($custinfo['image'])) {
			$data['profileImage']= $this->model_tool_image->resize($custinfo['image'], 170,170);
		} else {
			$data['profileImage'] = '';
		}

		if (isset($custinfo['profile_text'])) {
			$data['profile_text'] = $custinfo['profile_text'];
		} else {
			$data['profile_text'] = '';
		}

		if (isset($custinfo['address'])) {
			$data['address'] = $custinfo['address'];
		} else {
			$data['address'] = '';
		}
		//myfavouriteads

		$data['myfavouriteads']=$this->url->link('classified/myfavouriteads');
		$data['mymessages']=$this->url->link('classified/mymessages');
		$data['mysetting']=$this->url->link('classified/mysetting');
		$data['myads']=$this->url->link('classified/myads');
		$data['dashboard']=$this->url->link('classified/dashboard');


		$customername=$this->model_classified_myads->getCustomerMyadd($this->customer->isLogged());

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

	    $addressname=$this->model_classified_myads->addressMyadd($this->customer->isLogged());

	    if(!empty($addressname['country_id'])){
	    $country_id=$addressname['country_id'];	
	    }else{
	    $country_id='';	
	    } 

	    if(!empty($addressname['zone_id'])){
	    $zone_id=$addressname['zone_id'];	
	    }else{
	    $zone_id='';	
	    }



	    $countryname=$this->model_classified_myads->getCountry($country_id);

		if(!empty($countryname['name'])){
		$data['cname']=$countryname['name'];
		}else{
		$data['cname']='';
		}


		 $countrynamezone=$this->model_classified_myads->getZone($zone_id);


		if(!empty($countrynamezone['name'])){
		$data['zname']=$countrynamezone['name'];
		}else{
		$data['zname']='';
		}

    /// end

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['content_top'] = $this->load->controller('common/content_top');

        $this->response->setOutput($this->load->view('classified/myfavouriteads', $data));
	 }

	 public function enquirypopup() {
	 	$this->load->language('classified/myfavouriteads');
         $this->load->model('classified/myads');
         	$data['text_account']  		= $this->language->get('text_account');
			$data['text_dashboard']  		= $this->language->get('text_dashboard');
			$data['text_myads']  		= $this->language->get('text_myads');
			$data['text_favads']  		= $this->language->get('text_favads');
			$data['text_messages']  		= $this->language->get('text_messages');
			$data['text_setting']  		= $this->language->get('text_setting');
			$data['text_addclassified']  		= $this->language->get('text_addclassified');
			$data['text_category']  		= $this->language->get('text_category');
			$data['text_enquiry']  		= $this->language->get('text_enquiry');
			         	$data['text_title']  		= $this->language->get('text_title');
         	$data['text_email']  		= $this->language->get('text_email');
			$data['text_no_results']  		= $this->language->get('text_no_results');

			$data['button_submit']  		= $this->language->get('button_submit');
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


	 	$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $this->response->setOutput($this->load->view('classified/enquirypopup', $data));
    }


     public function enquirypopupmsg() {
		$json = array();
		$this->load->model('classified/myads');
	$this->load->language('classified/myfavouriteads');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		$enqtitle       = $this->request->post['enq_title'];
		$enqemail       = $this->request->post['enq_email'];
		$enqdiscription =$this->request->post['enq_discription'];
		if(empty($enqtitle)) {
		 $json['error_titel']       =$this->language->get('error_title');
		}else{
			$json['error_titel']='';
		}if(empty($enqemail)) {
		$json['error_email']       =$this->language->get('error_email');
		}else{
		$json['error_email']='';
		}if(empty($enqdiscription)) {
		 $json['error_discription'] =$this->language->get('error_discription');
		}else{
		$json['error_discription']='';
		}

		if(empty($json['error_titel']) && empty($json['error_email']) && empty($json['error_discription']))
		{
			$json['error_discription']='';
		  $this->model_classified_myads->enquiryAdd($this->request->post);
 		  $json['success']= $this->language->get('text_success');
		}

		



		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	  }
	}


	public function deleteadds() {
			$this->load->model('classified/myads');
			$this->load->language('classified/myfavouriteads');

		if (!empty($this->request->get['classified_id'])) {
			$classified_id=$this->request->get['classified_id'];
		  	$this->model_classified_myads->favouriteAdddelet($classified_id);
			$this->session->data['favsuccess'] = $this->language->get('text_favdelete');
		}
			$this->response->redirect($this->url->link('classified/myfavouriteads', '', true));	

	}
}
