<?php  
class ControllerclassifiedCustomerinvoice extends Controller {

 	private $error = array();
 	public function index() {
	 		 if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}

		$this->load->language('classified/customer_invoice');
		$this->load->model('account/customer');
		$this->load->model('tool/image');	


		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] 	= $this->language->get('heading_title');

		$data['text_invoice'] = $this->language->get('text_invoice');

		$data['entry_customername'] = $this->language->get('entry_customername');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_plan'] = $this->language->get('entry_plan');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_orderstatus'] = $this->language->get('entry_orderstatus');
		$data['entry_planstart'] = $this->language->get('entry_planstart');
		$data['entry_planexpiry'] = $this->language->get('entry_planexpiry');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_approved'] = $this->language->get('entry_approved');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['text_print'] = $this->language->get('text_print');

		$this->load->model('tool/image');

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }


		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
            $data['image'] = $server . 'image/' . $this->config->get('config_logo');
        } else {
            $data['image'] = '';
        }
		

		 $customer_info= $this->model_account_customer->getCustomer($this->customer->isLogged());
		 
		if(!empty($customer_info['firstname'])){
			$data['cust_name'] = $customer_info['firstname'].' '.$customer_info['lastname'];
		} else {
			$data['cust_name'] = '';
		}
		if(!empty($customer_info['email'])){
			$data['email'] = $customer_info['email'];
		} else {
			$data['email'] = '';
		}
		
		 if(!empty($customer_info['address'])){
			$data['address'] = $customer_info['address'];
		} else {
			$data['address'] = '';
		}


		 $custpackinfo= $this->model_account_customer->getcompleteOrderStatuse($this->customer->isLogged());

		if(isset($custpackinfo['classified_paid_package_id'])){
			$data['order_id'] = $custpackinfo['classified_paid_package_id'];
		} else {
			$data['order_id'] = '';
		}
		if(isset($custpackinfo['price'])){
			$data['price'] = $custpackinfo['price'];
		} else {
			$data['price'] = '';
		}

		if(isset($custpackinfo['package_name'])){
			$data['package_name'] = $custpackinfo['package_name'];
		} else {
			$data['package_name'] = '';
		}

		if(isset($custpackinfo['startdate'])){
			$data['startdate'] = $custpackinfo['startdate'];
		} else {
			$data['startdate'] = '';
		}
		if(isset($custpackinfo['expirydate'])){
			$data['expirydate'] = $custpackinfo['expirydate'];
		} else {
			$data['expirydate'] = '';
		}

		if(isset($custpackinfo['package_id'])){
			$package_id = $custpackinfo['package_id'];
		} else {
			$package_id = '';
		}


		$packageinfo= $this->model_account_customer->getpackage($package_id);

		if(!empty($packageinfo['classified_limit'])){
			$data['classified_limit'] = $packageinfo['classified_limit'];
		} else {
			$data['classified_limit'] = '';
		}

		 if(isset($custpackinfo['order_status_id'])){
			$order_status_id = $custpackinfo['order_status_id'];
		} else {
			$order_status_id = '';
		} 

		$order_statuses = $this->model_account_customer->getOrderStatuse($order_status_id);
	
		if(isset($order_statuses['name'])){
			$data['nameorder'] = $order_statuses['name'];
		} else {
			$data['nameorder'] = '';
		}
	
		

		$this->response->setOutput($this->load->view('classified/customer_invoice',$data));
	}


 }