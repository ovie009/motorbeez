<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		$this->load->language('common/dashboard');
		$this->load->model('classified/dashboard');
		$this->load->model('tool/image');

		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_total'] = $this->language->get('text_total');
		$data['text_enquiry'] = $this->language->get('text_enquiry');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_revenue'] = $this->language->get('text_revenue');
		$data['text_classified'] = $this->language->get('text_classified');
		$data['text_totalenquiry'] = $this->language->get('text_totalenquiry');
		$data['text_totalcustomer'] = $this->language->get('text_totalcustomer');
		$data['text_revenu'] = $this->language->get('text_revenu');
		$data['text_recentinvoice'] = $this->language->get('text_recentinvoice');
		$data['text_recentuser'] = $this->language->get('text_recentuser');
		$data['text_recentlisting'] = $this->language->get('text_recentlisting');
		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_totalinvoice'] = $this->language->get('text_totalinvoice');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_edit'] = $this->language->get('button_edit');
				$data['token'] 		= $this->session->data['token'];
				$url='';
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}
		
	//dashboard data
		$data['total_classifieds'] = $this->model_classified_dashboard->getTotalclassifieds(0);
		$data['total_customers'] = $this->model_classified_dashboard->getTotalcustomers(0);
		$data['total_invoice'] = $this->model_classified_dashboard->getTotalInvoice(0);

//revenue total
		$data['revenue_total'] = $this->model_classified_dashboard->getRevenueTotal(0);
		
		$data['revcurreny']=strtolower($this->config->get('config_currency'));
	//recent customer	
		$recentcustomers = $this->model_classified_dashboard->getRecentcustomers(0);
		$data['recent_customers'] = array();

		foreach ($recentcustomers as $recentcustomer) {

			if (is_file(DIR_IMAGE . $recentcustomer['image'])) {
				$image = $this->model_tool_image->resize($recentcustomer['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$data['recent_customers'][] = array(
				'custname' => $recentcustomer['firstname'].' '.$recentcustomer['lastname'],
				'custimage' => $image,
				'edit'           => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $recentcustomer['customer_id'] . $url, true),
			);

		}
		
	//recent listing	
		$recentclassifieds = $this->model_classified_dashboard->getRecentClassifieds(0);
		$data['recent_classifieds'] = array();

		foreach ($recentclassifieds as $recentclassified) {
			$imageinfos = $this->model_classified_dashboard->getClassifiedImage($recentclassified['classified_id']);


	
				if (!empty($imageinfos['image'])) {
					$classified_image = $this->model_tool_image->resize($imageinfos['image'], 40, 40);
				} else {
					$classified_image = $this->model_tool_image->resize('no_image.png', 40, 40);
				}
	
			$data['recent_classifieds'][] = array(
				'classified_title' => $recentclassified['title'],
				'classified_image' => $classified_image,
				'edit'           => $this->url->link('classified/classifiedadd/edit', 'token=' . $this->session->data['token'] . '&classified_id=' . $recentclassified['classified_id'] . $url, true),
			);

		}

		//recent invoices	
		$recentinvoices = $this->model_classified_dashboard->getRecentInvoices(0);
		$data['recent_invoices'] = array();

		foreach ($recentinvoices as $recentinvoice) {
			$custinvoice = $this->model_classified_dashboard->getCustomer($recentinvoice['customer_id']);

			if (is_file(DIR_IMAGE . $custinvoice['image'])) {
				$invoice_image = $this->model_tool_image->resize($custinvoice['image'], 40, 40);
			} else {
				$invoice_image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			if (!empty($custinvoice['firstname'])) {
				$invoice_name = $custinvoice['firstname'].' '.$custinvoice['lastname'];
			} else {
				$invoice_name = '';
			}

			$data['recent_invoices'][] = array(
				'invoice_name' => $invoice_name,
				'invoice_image' => $invoice_image,
				'view'           => $this->url->link('customer/customer/customerinvoice', 'token=' . $this->session->data['token'] . '&customer_id=' . $custinvoice['customer_id'] . $url, true),
			);

		}

		


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		// Run currency update
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');
			$this->model_localisation_currency->refresh();
		}

		$this->response->setOutput($this->load->view('common/dashboard', $data));
	}


	public function monthlydata() {
	$this->load->model('classified/dashboard');
     $json=array();
	  $monthly_customers=$this->model_classified_dashboard->getcustomermonth();
	 
    foreach ($monthly_customers as $result) {

    	if($result['month']==1){
    	$month='Jnauary';
    	}elseif($result['month']==2){
    	$month='Februry';
    	}elseif($result['month']==3){
    	$month='March';
    	}elseif($result['month']==4){
    	$month='April';
    	}elseif($result['month']==5){
    	$month='May';
    	}elseif($result['month']==6){
    	$month='June';
    	}elseif($result['month']==7){
    	$month='July';
    	}elseif($result['month']==8){
    	$month='August';
    	}elseif($result['month']==9){
    	$month='September';
    	}elseif($result['month']==10){
    	$month='Octuber';
    	}elseif($result['month']==11){
    	$month='November';
    	}elseif($result['month']==12){
    	$month='December';
    	}else{
    	$month='';	
    	}

        $json[] = array(
          'total_customer' => $result['total_customer'],
          'month' => $month
        );
      }

   $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($json));

  }
}