<?php
class Controllerclassifieddashboard extends Controller {
	private $error = array();

	public function index() {
		 if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}


		$this->load->language('classified/myads');
		$this->load->model('classified/myads');
		$this->load->model('account/customer');
		$this->load->model('classified/mymessages');
		$this->load->model('tool/image');

		$this->document->setTitle($this->language->get('heading_dashboard'));
		$data['text_account']  		= $this->language->get('text_account');
		$data['text_dashboard']  		= $this->language->get('text_dashboard');
		$data['text_myads']  		= $this->language->get('text_myads');
		$data['text_favads']  		= $this->language->get('text_favads');
		$data['text_messages']  		= $this->language->get('text_messages');
		$data['text_setting']  		= $this->language->get('text_setting');
		$data['text_addclassified']  		= $this->language->get('text_addclassified');
		$data['text_renew']  		= $this->language->get('text_renew');
		$data['text_printinvoice']  		= $this->language->get('text_printinvoice');
		$data['text_about']  		= $this->language->get('text_about');
		$data['text_planad']  		= $this->language->get('text_planad');
		$data['text_planrend']  		= $this->language->get('text_planrend');

		///profile images
		$data['InquieryTotal']=$this->model_classified_myads->getTotalInquiery($this->customer->isLogged());
		$data['classitotalread']=$this->model_classified_mymessages->classitotalread($this->customer->isLogged());
		$data['totalCust_classified']=$this->model_classified_myads->getTotalCustadd($this->customer->isLogged());
		$data['totalFav_classified']=$this->model_classified_myads->getTotalCustFav($this->customer->isLogged());
		$data['totalMsg_classified']=$this->model_classified_myads->getTotalCustMsg($this->customer->isLogged());


		$custinfo = $this->model_account_customer->getCustomer($this->customer->isLogged());

		if (isset($custinfo['image'])) {
			$data['profileImage']= $this->model_tool_image->resize($custinfo['image'], 170,170);
		} else {
			$data['profileImage'] = '';
		}

		if (!empty($custinfo['profile_text'])) {
			$data['profile_text'] = html_entity_decode($custinfo['profile_text']);
		} else {
			$data['profile_text'] = '';
		}
		if (isset($custinfo['address'])) {
			$data['address'] = $custinfo['address'];
		} else {
			$data['address'] = '';
		}
		if (isset($custinfo['payment_status'])) {
			$data['custpayment_status'] = $custinfo['payment_status'];
		} else {
			$data['custpayment_status'] = '';
		}
		//myfavouriteads
		$data['myfavouriteads']=$this->url->link('classified/myfavouriteads');
		$data['mymessages']=$this->url->link('classified/mymessages');
		$data['mysetting']=$this->url->link('classified/mysetting');
		$data['myads']=$this->url->link('classified/myads');
		$data['dashboard']=$this->url->link('classified/dashboard');
		$data['renewplan']=$this->url->link('classified/renewplans');
		$data['custinvoice']=$this->url->link('classified/customer_invoice');
		$data['payment_status'] = $this->config->get('pp_standard_status');

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
    // end
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['content_top'] = $this->load->controller('common/content_top');
    $this->response->setOutput($this->load->view('classified/dashboard', $data));
	 }

}