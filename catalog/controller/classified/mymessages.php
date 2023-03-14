<?php
class Controllerclassifiedmymessages extends Controller {
	private $error = array();

	public function index() {

		   if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
			}
			$this->load->language('classified/mymessages');
			$this->load->model('account/customer');

			$this->document->setTitle($this->language->get('heading_title'));
			$data['text_account']  		= $this->language->get('text_account');
			$data['text_dashboard']  	= $this->language->get('text_dashboard');
			$data['text_myads']  		= $this->language->get('text_myads');
			$data['text_favads']  	  	  = $this->language->get('text_favads');
			$data['text_messages']  	  = $this->language->get('text_messages');
			$data['text_setting']  		  = $this->language->get('text_setting');
			$data['text_addclassified']  = $this->language->get('text_addclassified');
			$data['text_typemassage']  		= $this->language->get('text_typemassage');

			$this->load->model('classified/mymessages');
			$this->load->model('classified/myads');
			$this->load->model('tool/image');


			$Magclassifieds=$this->model_classified_mymessages->classifiedMsg($this->customer->isLogged());

		   if(!empty($Magclassifieds['classified_id'])){
				$classified_id=$Magclassifieds['classified_id'];
			}else{
				$classified_id='';
			}


			if(!empty($Magclassifieds['firstname'])){
				$data['firstname']=$Magclassifieds['firstname'].' '.$Magclassifieds['lastname'];
			}else{
				$data['firstname']='';
			}


		   $data['messagesinfos']=array();
			$messages_results = $this->model_classified_mymessages->classifiedMsgalls(0);
           foreach ($messages_results as $messages_result) {
		 $replyinfo=array();
			$replymsgs= $this->model_classified_mymessages->classifiedMsgall($messages_result['classified_enquiry_id']);
          	foreach ($replymsgs as $replymsg) {
          	 $logincustomerid=$this->model_classified_mymessages->getCustomerImages($replymsg['login_customer_id']);

			if ($logincustomerid['image']) {
				$profileImage= $this->model_tool_image->resize($logincustomerid['image'], 40,40);
			} else {
				$profileImage = '';
			}
			if(!empty($logincustomerid['customer_id'])){
				$customer_id=$logincustomerid['customer_id'];
			}else{
				$customer_id='';
			}
             $replyinfo[]=array(
				'classified_enquiry_id'   =>$replymsg['enquiry_reply_id'],
				'profileImage'            =>$profileImage,
				'customer_id'             =>$customer_id,
				'message'                 =>$replymsg['message']);

			}

			   $customerimgall=$this->model_classified_mymessages->getCustomerImages($messages_result['login_customer_id']);
				if (!empty($customerimgall['image'])) {
					$customerimg= $this->model_tool_image->resize($customerimgall['image'], 40,40);
				} else {
					$customerimg = $this->model_tool_image->resize('placeholder.png',40,40);
				}
				$data['messagesinfos'][]=array(
					'classified_enquiry_id'    =>$messages_result['classified_enquiry_id'],
					'customer_id'              =>$messages_result['customer_id'],
					'login_customer_id'        =>$messages_result['login_customer_id'],
					'replyinfo'                =>$replyinfo,
					'customerimg'              =>$customerimg,
					'enqdiscription'           =>$messages_result['enq_discription'],
					'classified_id'            =>$messages_result['classified_id']

				);
			}

			//echo "<pre>";
			//print_r($data['messagesinfos']); die();

			$data['customerlogin']=$this->customer->isLogged();



		$data['totalreplyss']=$this->model_classified_mymessages->getTotalInquieryReplay(43);



	///profile images
		$custinfo = $this->model_account_customer->getCustomer($this->customer->isLogged());

		$data['InquieryTotal']=$this->model_classified_myads->getTotalInquiery($this->customer->isLogged());
		$data['classitotalread']=$this->model_classified_mymessages->classitotalread($this->customer->isLogged());


		if ($custinfo['image']) {
			$data['profileImage']= $this->model_tool_image->resize($custinfo['image'], 170,170);
		} else {
			$data['profileImage'] = $this->model_tool_image->resize('placeholder.png',100,100);
		}

		if (isset($custinfo['profile_text'])) {
			$data['profile_text'] = $custinfo['profile_text'];
		}else {
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
		 $data['firstname']=$customername['firstname'].' '.$customername['lastname'];
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
        $this->response->setOutput($this->load->view('classified/mymessages', $data));
	 }


	 public function replyMsg() {
		$json = array();
			$this->load->model('classified/mymessages');
		$this->load->language('classified/mymessages');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		if(!empty($this->request->post['message'])){}
		$category_infos = $this->model_classified_mymessages->replyMsgadd($this->request->post,$this->request->get['classified_enquiry_id']);
		$json['success']=$this->language->get('text_success1');
	   }else{}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function replyReadMsg() {
		$json = array();
			$this->load->model('classified/mymessages');
		$this->load->language('classified/mymessages');
	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		 $category_infos = $this->model_classified_mymessages->replyReadmsg($this->request->post,$this->customer->isLogged());
           $json['success']=$this->language->get('text_success1');
         }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}



}
