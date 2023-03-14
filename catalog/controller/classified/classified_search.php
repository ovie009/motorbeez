<?php
class ControllerclassifiedClassifiedsearch extends Controller {
	public function index() {

		$this->load->model('classified/classified_category');
		$this->load->model('classified/myads');
		$this->load->language('classified/classified_search');
		$this->load->model('tool/image');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']  		= $this->language->get('heading_title');
		$data['button_search'] = $this->language->get('button_search');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_category'] = $this->language->get('text_category');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('classified/home')
		);


		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_city'])) {
			$filter_city = $this->request->get['filter_city'];
		} else {
			$filter_city = '';
		}

		if (isset($this->request->get['classified_category_id'])) {
			$classified_category_id = $this->request->get['classified_category_id'];
		} else {
			$classified_category_id = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
		 $sort = 'classified_id';
		}

		if (isset($this->request->get['order'])) {
		 $order = $this->request->get['order'];
		} else {
		 $order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_city'])) {
			$url .= '&filter_city=' . $this->request->get['filter_city'];
		}
		if (isset($this->request->get['classified_category_id'])) {
			$url .= '&classified_category_id=' . $this->request->get['classified_category_id'];
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


		if (isset($this->request->get['classified_category_id'])) {
			$parts = explode('_', (string)$this->request->get['classified_category_id']);
			$classified_category_id = (int)array_pop($parts);
		} else {
			$classified_category_id = false;
		}

		/// name title and setTitle

		$categoryname= $this->model_classified_classified_category->getsubCategory($classified_category_id);


		if(!empty($categoryname['name'])){
			$name=$categoryname['name'];
		}else{
			$name='';
		}

		if ($categoryname) {
			$data['breadcrumbs'][] = array(
				'text' => $name,
				'href' => $this->url->link('classified/classified_search','&classified_category_id=' .$classified_category_id, true)
			);
		}

		$data['heading_title'] = $name;

		
		$data['text_categoryclssefied'] = $name;
	

	    $data['post_infios'] = array();

	    $filter1 = array(
			'filter_name'            => $filter_name,
			'filter_city' => $filter_city,
			'classified_category_id' => $classified_category_id,
			'sort'                   =>  $sort,
			'order'                  =>  $order,
			'start'                  =>  ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                  =>  $this->config->get('config_limit_admin')
		);


       $data['classifiedseachs']=array();
       $post_total=$this->model_classified_classified_category->getTotalusealladd($filter1);

		$category_searchs = $this->model_classified_classified_category->customerAllad($filter1);

		foreach ($category_searchs as $category_search) {
			if(!empty($category_search['active']==1)){
			$myaddsImgs=$this->model_classified_myads->getPostImageUser($category_search['classified_id']);
			
			$imguser=array();
            foreach ($myaddsImgs as $myaddsImg) {
				if ($myaddsImg['image']) {
					$imgusershow = $this->model_tool_image->resize($myaddsImg['image'],262, 206);
				} else {
					$imgusershow = $this->model_tool_image->resize('placeholder.png',262, 206);
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

			///category end
			// color start

			$colors=$this->model_classified_myads->placementClassFied($category_search['classified_id']);

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
	
			///configcurrency start

			$configcurrency =$this->config->get('config_currency');
			///configcurrency end
		
			
			/// image start
			
				if (!empty($category_search['singal_post'])) {
					$singal_post = $this->model_tool_image->resize($category_search['singal_post'],262, 206);
				} else {
					$singal_post = $this->model_tool_image->resize('placeholder.png',262, 206);
				}
			/// image end 
				
				

			$data['classifiedseachs'][]=array(
				'classified_id'    =>$category_search['classified_id'],
				'post_description' => utf8_substr(strip_tags(html_entity_decode($category_search['post_description'], ENT_QUOTES, 'UTF-8')), 0, 50) . '..',
				'title'            =>$category_search['title'],
				'customer_id'      =>$category_search['customer_id'],
				'city'             =>$city,
				'singal_post'             =>$singal_post,
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

	
			

		$pagination 		= new Pagination();
		$pagination->total 	= $post_total;
		$pagination->page 	= $page;
		$pagination->limit 	= $this->config->get('config_limit_admin');

		$pagination->url 	= $this->url->link('classified/classified_search','&classified_category_id=' .$classified_category_id  . '&page={page}', true);

		$data['pagination'] = $pagination->render();


		$data['results'] = sprintf($this->language->get('text_pagination'), ($post_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($post_total - $this->config->get('config_limit_admin'))) ? $post_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $post_total, ceil($post_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['sort'] 		= $sort;
		$data['order'] 		= $order;
		$data['accountlogin']=$this->url->link('classified/login');
		$data['customerlogin']=$this->customer->isLogged();

		if (isset($this->request->get['classified_category_id'])) {
			$data['classifiedcategoryid'] = $this->request->get['classified_category_id'];
		} else {
			$data['classifiedcategoryid']= '';
		}

		//// post  end
		$data['continue']                 = $this->url->link('classified/home');
		$data['column_left']              = $this->load->controller('common/column_left');
		$data['column_right']             = $this->load->controller('common/column_right');
		$data['content_top']              = $this->load->controller('common/content_top');
		$data['content_bottom']           = $this->load->controller('common/content_bottom');
		$data['footer']                   = $this->load->controller('common/footer');
		$data['header']                   = $this->load->controller('common/header');
			// Set the last category breadcrumb
	     $this->response->setOutput($this->load->view('classified/classified_search', $data));
	 }

}
