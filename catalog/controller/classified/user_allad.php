<?php
class ControllerclassifiedUserallad extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('classified/myads');

		$this->document->setTitle($this->language->get('heading_title1'));
		$data['heading_title1']  		= $this->language->get('heading_title1');
		$data['text_active']  		= $this->language->get('text_active');
		$data['text_incative']  		= $this->language->get('text_incative');
		$data['text_delete']  		= $this->language->get('text_delete');
		$data['text_no_results']  		= $this->language->get('text_no_results');
		$data['text_category']  		= $this->language->get('text_category');
		$data['text_submit']  		= $this->language->get('text_submit');

		if (isset($this->request->get['customerid'])) {
			$customerid = $this->request->get['customerid'];
		} else {
			$customerid = '';
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
		$this->load->language('classified/myads');
		$this->document->setTitle($this->language->get('heading_title1'));
		$this->load->model('classified/myads');
		$this->load->model('tool/image');
        $data['useralladinfos']=array();
        $filter_data = array(
			'customerid'  =>$customerid,
			'start'       => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'       => $this->config->get('config_limit_admin')
	
		);
	
	  $data['useralladinfos']=array();
        $userallad_total=$this->model_classified_myads->getTotalusealladd($filter_data);
		$userallad_results=$this->model_classified_myads->customerAllad($filter_data);
		foreach ($userallad_results as $userallad_result) {
		
              //countery start 

              $CountryInfos=$this->model_classified_myads->getCountry($userallad_result['country_id']);
             
				if(!empty($CountryInfos['name'])){
					$namecountry=$CountryInfos['name'];
				}else{
					$namecountry='';
				}

              //countery end 

				//Zone start 
				$ZoneInfos=$this->model_classified_myads->getZone($userallad_result['zone_id']);
				if(!empty($ZoneInfos['name'])){
					$zonename=$ZoneInfos['name'];
				}else{
					$zonename='';
				}

				$cityinfo=$this->model_classified_myads->getCity($userallad_result['city_id']);
				if(!empty($cityinfo['cityname'])){
					$cityname=$cityinfo['cityname'];
				}else{
					$cityname='';
				}

				if(!empty($userallad_result['city'])){
					$city=$userallad_result['city'];
				}else{
					$city='';
				}


			   //Zone end  

			///category start
			$postcategory=$this->model_classified_myads->getMyaddCategory($userallad_result['classified_category_id']);

		
			if(!empty($postcategory['name'])){
			 $categoryname=$postcategory['name'];
			}else{
				$categoryname='';
			}

			$postcategorysub=$this->model_classified_myads->getMyaddCategory($userallad_result['sub_category_id']);
		

			if(!empty($postcategorysub['name'])){
			 $subcategoryname=$postcategorysub['name'];
			}else{
				$subcategoryname='';
			}	

			$postcategorysubsub=$this->model_classified_myads->getMyaddCategory($userallad_result['sub_sub_category_id']);
			
			if(!empty($postcategorysubsub['name'])){
			 $categorynamesub=$postcategorysubsub['name'];
			}else{
				$categorynamesub='';
			}

			$favouritestatuscolor=$this->model_classified_myads->favouriteaddcolor($userallad_result['classified_id']);
		
			if(!empty($favouritestatuscolor['favouritestatus'])){
			 $favouritestatus =$favouritestatuscolor['favouritestatus'];
			}else{
				$favouritestatus='';
			}
			$totdate=date('Y-m-d');

			
			$configcurrency =$this->config->get('config_currency');

			if (!empty($userallad_result['singal_post'])) {
				$singal_post = $this->model_tool_image->resize($userallad_result['singal_post'], 200,200);
			} else {
				$singal_post = $this->model_tool_image->resize('placeholder.png',200,206);
			}

			///category end 	

			$data['useralladinfos'][]=array(
				'classified_id'    =>$userallad_result['classified_id'],
				'post_description' => substr(strip_tags(html_entity_decode($userallad_result['post_description'])),0,200),
				'title'            =>$userallad_result['title'],
				'customer_id'      =>$userallad_result['customer_id'],
				'city'             =>$city,
				'singal_post'       =>$singal_post,
				'price'            =>$this->currency->format($userallad_result['price'].$configcurrency,$this->session->data['currency']),
				'date_added'       =>date($this->language->get('date_format_short'), strtotime($userallad_result['date_added'])),
				'namecountry'      =>$namecountry,
				'favouritestatus'  =>$favouritestatus,
				'zonename'         =>$zonename,
				'categoryname'     =>$categoryname,
				'subcategoryname'  =>$subcategoryname,
				'categorynamesub'  =>$categorynamesub,
				 'enquirypopup'	   => $this->url->link('classified/user_allad/enquirypopup','&classified_id=' . $userallad_result['classified_id']),
				 'view'		       => $this->url->link('classified/classified_view','&classified_id=' . $userallad_result['classified_id'])



			);
		}
      
       
		$data['accountlogin']=$this->url->link('account/account');
		$data['customerlogin']=$this->customer->isLogged();
		

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
		$pagination->total = $userallad_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('classified/user_allad',$url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($userallad_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($userallad_total - $this->config->get('config_limit_admin'))) ? $userallad_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $userallad_total, ceil($userallad_total / $this->config->get('config_limit_admin')));

		$data['active'] = $this->url->link('classified/myads/Active' . $url);
		$data['inactive'] = $this->url->link('classified/myads/Inactive' . $url);
		$data['delete'] = $this->url->link('classified/myads/delete'. $url);
		$data['enquirypopup'] = $this->url->link('classified/allads/enquirypopup');
    
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $this->response->setOutput($this->load->view('classified/user_allad', $data));
	 }


	 public function Addfavourite() {
		$json = array();
		$this->load->language('classified/myads');
		$this->load->model('classified/myads');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

	    $form_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "classified_favourite_ad where classified_id = '".$this->request->get['classified_id']."' and login_customer_id='".$this->customer->isLogged()."'");
		
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

       if(!empty($classified_id) && !empty($customer_id) && !empty($login_customer_id)){
		}else{
			 $this->model_classified_myads->favouriteadd($this->request->post,$this->request->get['classified_id']);	
				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('classified/myfavouriteads'));

		}
		

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

	 public function enquirypopup() {
	 	$this->load->language('classified/myads');
         $this->load->model('classified/myads');
         	$data['text_submit']  		= $this->language->get('text_submit');
         	$data['button_submit']  		= $this->language->get('button_submit');
         	$data['text_enquiry']  		= $this->language->get('text_enquiry');

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



	}