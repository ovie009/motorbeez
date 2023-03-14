<?php
class Controllerclassifiedmyads extends Controller {
	private $error = array();

	public function index() {

	   if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}

			$this->load->language('classified/myads');
			$this->load->model('account/customer');


			$this->document->setTitle($this->language->get('heading_title'));
			$data['heading_title']  		= $this->language->get('heading_title');
			$data['text_active']  		= $this->language->get('text_active');
			$data['text_incative']  		= $this->language->get('text_incative');
			$data['text_delete']  		= $this->language->get('text_delete');
			$data['text_no_results']  		= $this->language->get('text_no_results');
			$data['text_activeadd']  		= $this->language->get('text_activeadd');
			$data['text_addinactive']  		= $this->language->get('text_addinactive');
			$data['text_deleteadd']  		= $this->language->get('text_deleteadd');
			$data['text_edit']  		= $this->language->get('text_edit');
			$data['text_approve']  		= $this->language->get('text_approve');
			$data['text_disapprove']  		= $this->language->get('text_disapprove');
			$data['text_delete']  		= $this->language->get('text_delete');

			$data['text_account']  		= $this->language->get('text_account');
			$data['text_dashboard']  		= $this->language->get('text_dashboard');
			$data['text_myads']  		= $this->language->get('text_myads');
			$data['text_favads']  		= $this->language->get('text_favads');
			$data['text_messages']  		= $this->language->get('text_messages');
			$data['text_setting']  		= $this->language->get('text_setting');
			$data['text_addclassified']  		= $this->language->get('text_addclassified');
			$data['text_active']  		= $this->language->get('text_active');
			$data['text_inactive']      = $this->language->get('text_inactive');
			$data['payment_status'] = $this->config->get('pp_standard_status');
			$data['text_error_planexpiry'] = $this->language->get('text_error_planexpiry');
			$data['text_error_planrenew'] = $this->language->get('text_error_planrenew');

		if (isset($this->request->get['customer'])) {
			$customer = $this->request->get['customer'];
		} else {
			$customer = '';
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
		if (isset($this->request->get['customer'])) {
			$url .= '&customer=' . $this->request->get['customer'];
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

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

			if (isset($this->session->data['delsuccess'])) {
			$data['delsuccess'] = $this->session->data['delsuccess'];
			unset($this->session->data['delsuccess']);
		} else {
			$data['delsuccess'] = '';
		}
			if (isset($this->session->data['adsuccess'])) {
			$data['adsuccess'] = $this->session->data['adsuccess'];
			unset($this->session->data['adsuccess']);
		} else {
			$data['adsuccess'] = '';
		}
			if (isset($this->session->data['insuccess'])) {
			$data['insuccess'] = $this->session->data['insuccess'];
			unset($this->session->data['insuccess']);
		} else {
			$data['insuccess'] = '';
		}
		$this->load->language('classified/myads');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('classified/myads');
		$this->load->model('tool/image');
        $data['myaddsinfo']=array();
        $filter_data = array(
			'customer_id' => $this->customer->isLogged(),
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')

		);

		$myadds_total=$this->model_classified_myads->getTotalMyadd($filter_data);
		$myadds_results=$this->model_classified_myads->getMyadds($filter_data);
		foreach ($myadds_results as $myadds_result) {
			
              //countery start

              $CountryInfos=$this->model_classified_myads->getCountry($myadds_result['country_id']);

				if(!empty($CountryInfos['name'])){
					$namecountry=$CountryInfos['name'];
				}else{
					$namecountry='';
				}

              //countery end

				//Zone start
				$ZoneInfos=$this->model_classified_myads->getZone($myadds_result['zone_id']);
				if(!empty($ZoneInfos['name'])){
					$zonename=$ZoneInfos['name'];
				}else{
					$zonename='';
				}

					$cityinfo=$this->model_classified_myads->getCity($myadds_result['city_id']);
				if(!empty($cityinfo['cityname'])){
					$cityname=$cityinfo['cityname'];
				}else{
					$cityname='';
				}

				if(!empty($myadds_result['city'])){
					$city=$myadds_result['city'];
				}else{
					$city='';
				}


		 //Zone end

			///category start
			$postcategory=$this->model_classified_myads->getMyaddCategory($myadds_result['classified_category_id']);

			if(!empty($postcategory['name'])){
			 $categoryname=$postcategory['name'];
			}else{
				$categoryname='';
			}

			$postcategorysub=$this->model_classified_myads->getMyaddCategory($myadds_result['sub_category_id']);


			if(!empty($postcategorysub['name'])){
			 $subcategoryname=$postcategorysub['name'];
			}else{
				$subcategoryname='';
			}

			$postcategorysubsub=$this->model_classified_myads->getMyaddCategory($myadds_result['sub_sub_category_id']);

			if(!empty($postcategorysubsub['name'])){
			 $categorynamesub=$postcategorysubsub['name'];
			}else{
				$categorynamesub='';
			}
		
			///configcurrency start

			$configcurrency =$this->config->get('config_currency');
			///configcurrency end
			///category end
			
				if (!empty($myadds_result['singal_post'])) {
				$singal_post = $this->model_tool_image->resize($myadds_result['singal_post'], 200,200);
			} else {
				$singal_post = $this->model_tool_image->resize('placeholder.png',200,206);
			}


			$data['myaddsinfo'][]=array(
				'classified_id'    =>$myadds_result['classified_id'],
				'post_description' => substr(strip_tags(html_entity_decode($myadds_result['post_description'])),0,200),
				'title'            =>$myadds_result['title'],
				'active'            =>$myadds_result['active'],
				'singal_post'       =>$singal_post,
				'city'             =>$city,
				'price' 		   =>$this->currency->format($myadds_result['price'], $this->session->data['currency']),
				'date_added'       =>date($this->language->get('date_format_short'), strtotime($myadds_result['date_added'])),
				'namecountry'      =>$namecountry,
				'zonename'         =>$zonename,
				'categoryname'     =>$categoryname,
				'subcategoryname'  =>$subcategoryname,
				'categorynamesub'  =>$categorynamesub,
				'href'		       => $this->url->link('classified/classifiedadd/add','&classified_id=' . $myadds_result['classified_id']),
				'view'		       => $this->url->link('classified/classified_view','&classified_id=' . $myadds_result['classified_id']),
				'delete'		       => $this->url->link('classified/myads/deleteclassified','&classified_id=' . $myadds_result['classified_id']),
				'active_classified'		       => $this->url->link('classified/myads/active','&classified_id=' . $myadds_result['classified_id']),
				'inactive_classified'		       => $this->url->link('classified/myads/inactive','&classified_id=' . $myadds_result['classified_id'])

			);

		}


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

		$pagination = new Pagination();
		$pagination->total = $myadds_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/myads',$url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($myadds_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($myadds_total - $this->config->get('config_limit_admin'))) ? $myadds_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $myadds_total, ceil($myadds_total / $this->config->get('config_limit_admin')));


		///profile images
		$custinfo = $this->model_account_customer->getCustomer($this->customer->isLogged());

		if (!empty($custinfo['image'])) {
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
		$data['classifiedaddbtn']=$this->url->link('classified/classifiedadd/add');

		$data['dashboard']=$this->url->link('classified/dashboard');
		$data['addclassified']=$this->url->link('classified/dashboard');

       //plan limit
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

		$this->load->model('classified/mymessages');
		$customername=$this->model_classified_myads->getCustomerMyadd($this->customer->isLogged());

		$data['InquieryTotal']=$this->model_classified_myads->getTotalInquiery($this->customer->isLogged());
		$data['classitotalread']=$this->model_classified_mymessages->classitotalread($this->customer->isLogged());

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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
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
        $this->response->setOutput($this->load->view('classified/myads', $data));
	 }

	///Delete Adds

	public function deleteclassified() {
			$this->load->language('classified/myads');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('classified/myads');

		if (!empty($this->request->get['classified_id'])) {
			$classified_id=$this->request->get['classified_id'];
		  $this->model_classified_myads->DeleteMyadd($classified_id);	
			$this->session->data['delsuccess'] = $this->language->get('text_delsuccess');
		}
			$this->response->redirect($this->url->link('classified/myads', '', true));	

	}
	

	 public function Active() {
		$json = array();
		$this->load->language('classified/myads');
		$this->load->model('classified/myads');
	
	   	if(!empty($this->request->get['classified_id'])){
		$classified_id =$this->request->get['classified_id'];
		$this->model_classified_myads->ActiveMyAdd($classified_id);
		
		$this->session->data['adsuccess'] = $this->language->get('text_adsuccess');

		}
		$this->response->redirect($this->url->link('classified/myads', '', true));	
	
	}
	 public function Inactive() {
		$this->load->language('classified/myads');
		$this->load->model('classified/myads');

	   if(!empty($this->request->get['classified_id'])){
		$classified_id =$this->request->get['classified_id'];
		$this->model_classified_myads->DeActiveMyAD($classified_id);
		
		$this->session->data['insuccess'] = $this->language->get('text_insuccess');
	
		}
		$this->response->redirect($this->url->link('classified/myads', '', true));	
	}
	
	 public function deletemyadddelet() {
		$json = array();
		$this->load->model('classified/myads');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		$category_infos = $this->model_classified_myads->DeleteMyadd($this->request->get['classified_id']);
		$json['success']='successfully deleted';
	   }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}
