<?php
class Controllerclassifiedmysetting extends Controller {
	private $error = array();

	public function index() {
		 if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}

		$this->load->language('classified/mysetting');
		$this->load->model('classified/myads');
		$this->load->model('tool/image');
		$this->load->model('classified/mymessages');
		$this->load->model('account/customer');
		if (isset($this->request->post['thumb'])) {
			$data['thumb'] = $this->request->post['thumb'];
		} else {
			$data['thumb'] = '';
		}

		$data['action'] = $this->url->link('classified/mysetting', '', true);

		if(!empty($this->customer->isLogged())){
			$data['customer_id']=$this->customer->isLogged();
		}else{
			$data['customer_id']='';
		}

		$this->document->setTitle($this->language->get('heading_title'));
		$data['text_account']  		= $this->language->get('text_account');
		$data['text_dashboard']  		= $this->language->get('text_dashboard');
		$data['text_myads']  		= $this->language->get('text_myads');
		$data['text_favads']  		= $this->language->get('text_favads');
		$data['text_messages']  		= $this->language->get('text_messages');
		$data['text_setting']  		= $this->language->get('text_setting');
		$data['text_addclassified']  		= $this->language->get('text_addclassified');
		$data['text_changeprofile']  		= $this->language->get('text_changeprofile');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['text_submit'] = $this->language->get('text_submit');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_account_customer->editCustomer($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('classified/mysetting'));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($customer_info)) {
			$data['firstname'] = $customer_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($customer_info)) {
			$data['lastname'] = $customer_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$data['email'] = $customer_info['email'];
		} else {
			$data['email'] = '';
		}
		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}


		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$data['telephone'] = $customer_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

			if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($customer_info)) {
			$data['address'] = $customer_info['address'];
		} else {
			$data['address'] = '';
		}


		if (isset($customer_info['image'])) {
			$data['profileImage']= $this->model_tool_image->resize($customer_info['image'], 170,170);
		} else {
			$data['profileImage'] = '';
		}

		// Image
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($customer_info)) {
			$data['image'] = $customer_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($customer_info) && is_file(DIR_IMAGE . $customer_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($customer_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		if (isset($customer_info['profile_text'])) {
			$data['profile_text'] = $customer_info['profile_text'];
		} else {
			$data['profile_text'] = '';
		}

		if(!empty($customer_info['firstname'])){
		 $data['customername']=$customer_info['firstname'].' '.$customer_info['lastname'];
		}else{
		 $data['customername']='';
		}

		$data['InquieryTotal']=$this->model_classified_myads->getTotalInquiery($this->customer->isLogged());
		$data['classitotalread']=$this->model_classified_mymessages->classitotalread($this->customer->isLogged());

		$data['myfavouriteads']=$this->url->link('classified/myfavouriteads');
		$data['mymessages']=$this->url->link('classified/mymessages');
		$data['mysetting']=$this->url->link('classified/mysetting');
		$data['myads']=$this->url->link('classified/myads');
		$data['dashboard']=$this->url->link('classified/dashboard');
//////
		$customername=$this->model_classified_myads->getCustomerMyadd($this->customer->isLogged());

		if(!empty($customername['date_added'])){
		$data['dateadded']=date($this->language->get('date_format_short'), strtotime($customername['date_added']));
		}else{
		 $data['dateadded']='';
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

		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']  		= $this->language->get('heading_title');
		$data['text_active']  		= $this->language->get('text_active');
		$data['text_incative']  		= $this->language->get('text_incative');
		$data['text_delete']  		= $this->language->get('text_delete');
		$data['text_image']  		= $this->language->get('text_image');
		$data['button_upload']  		= $this->language->get('button_upload');
		$data['text_loading']  		= $this->language->get('text_loading');
		$data['text_descriptions']  		= $this->language->get('text_descriptions');
		$data['placeholder']  = '';
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['content_top'] = $this->load->controller('common/content_top');
        $this->response->setOutput($this->load->view('classified/mysetting', $data));
	 }
	protected function validate() {
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (($this->customer->getEmail() != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if (!empty($this->request->post['password'])) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = $this->language->get('error_password');
			}

			if ($this->request->post['confirm'] != $this->request->post['password']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}

			if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	 public function profileupload(){
		$json = array();
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}
			// Allowed file extension types
			$allowed = array();
			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));
			$filetypes = explode("\n", $extension_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Allowed file mime types
			$allowed = array();
			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));
			$filetypes = explode("\n", $mime_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');

			}
			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['file']['tmp_name']);
			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Return any upload error
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		if (!$json) {
			$targetDir = DIR_IMAGE.'catalog/';
			$file = $filename;
			$location = $targetDir.$file;
			$location1 = 'catalog/'.$file;
			move_uploaded_file($this->request->files['file']['tmp_name'], $location);
			$json['location1'] =$location1;
			$json['success'] = $this->language->get('text_upload');
		}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
	}

}
