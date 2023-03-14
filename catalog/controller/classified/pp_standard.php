<?php
class ControllerClassifiedPPStandard extends Controller {
	public function index() {
		$this->load->language('classified/pp_standard');

		$data['text_testmode'] = $this->language->get('text_testmode');
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['testmode'] = $this->config->get('pp_standard_test');
			$data['loading'] = 'image/loadin.gif';
		if (!$this->config->get('pp_standard_test')) {
			$data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
		} else {
			$data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}

		$this->load->model('account/customer');
		if(isset($this->request->get['customer_id'])){
				$customerid=$this->request->get['customer_id'];
			}else{
				$customerid='';
			}
		  $custinfo=$this->model_account_customer->getCustomer($customerid);
		  	if(!empty($custinfo['package_id'])){
				$package_id=$custinfo['package_id'];
			}else{
				$package_id='';
			}

		  $plansInfos=$this->model_account_customer->getpackage($package_id);
			if(!empty($plansInfos['package_name'])){
				$name=$plansInfos['package_name'];
			}else{
				$name='';
			}
			
			if(!empty($plansInfos['price'])){
				$price=$plansInfos['price'];
			}else{
				$price='';
			}

          if ($custinfo) {
			$data['business']             = $this->config->get('pp_standard_email');
			$data['planname']             = $name;
			$data['customer_id']    = $customerid;
			$data['currency_code']        =$this->config->get('config_currency');
			$data['price']                = $price;
			$data['first_name']           = html_entity_decode($custinfo['firstname'].' '.$custinfo['lastname'], ENT_QUOTES, 'UTF-8');
			$data['email']                = $custinfo['email'];
			$data['lc']                   = $this->session->data['language'];
			$data['return']               = $this->url->link('classified/paymountpage');
			$data['notify_url']           = $this->url->link('classified/pp_standard/callback', '', true);
			$data['cancel_return']        = $this->url->link('classified/cancelpage');

			if (!$this->config->get('pp_standard_transaction')) {
				$data['paymentaction'] = 'authorization';
			} else {
				$data['paymentaction'] = 'sale';
			}

			$data['custom'] = $customerid;
			$data['header'] = $this->load->controller('common/header');
			$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('classified/pp_standard', $data));

		}
	}

	public function callback() {
		$this->load->model('account/customer');
        $customer_id =$this->request->post['custom'];
		 $getPackageInfo=$this->model_account_customer->getPackageprice($customer_id);
	 	if ($getPackageInfo) {
			$request = 'cmd=_notify-validate';

			foreach ($this->request->post as $key => $value) {
				$request .= '&' . $key . '=' . urlencode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
			}

			if (!$this->config->get('pp_standard_test')) {
				$curl = curl_init('https://www.paypal.com/cgi-bin/webscr');
			} else {
				$curl = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
			}

			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$response = curl_exec($curl);

			if (!$response) {
				$this->log->write('PP_STANDARD :: CURL failed ' . curl_error($curl) . '(' . curl_errno($curl) . ')');
			}

			if ($this->config->get('pp_standard_debug')) {
				$this->log->write('PP_STANDARD :: IPN REQUEST: ' . $request);
				$this->log->write('PP_STANDARD :: IPN RESPONSE: ' . $response);
			}

			if ((strcmp($response, 'VERIFIED') == 0 || strcmp($response, 'UNVERIFIED') == 0) && isset($this->request->post['payment_status'])) {
				$order_status_id = $this->config->get('config_order_status_id');

				switch($this->request->post['payment_status']) {
					case 'Canceled_Reversal':
						$order_status_id = $this->config->get('pp_standard_canceled_reversal_status_id');
						break;
					case 'Completed':
						$receiver_match = (strtolower($this->request->post['receiver_email']) == strtolower($this->config->get('pp_standard_email')));

						$total_paid_match = ((float)$this->request->post['mc_gross'] == $this->currency->format($getPackageInfo['price'], $getPackageInfo['currency_code'], false));

						if ($receiver_match && $total_paid_match) {
							$order_status_id = $this->config->get('pp_standard_completed_status_id');
						}
						
						if (!$receiver_match) {
							$this->log->write('PP_STANDARD :: RECEIVER EMAIL MISMATCH! ' . strtolower($this->request->post['receiver_email']));
						}
						
						if (!$total_paid_match) {
							$this->log->write('PP_STANDARD :: TOTAL PAID MISMATCH! ' . $this->request->post['mc_gross']);
						}
						break;
					case 'Denied':
						$order_status_id = $this->config->get('pp_standard_denied_status_id');
						break;
					case 'Expired':
						$order_status_id = $this->config->get('pp_standard_expired_status_id');
						break;
					case 'Failed':
						$order_status_id = $this->config->get('pp_standard_failed_status_id');
						break;
					case 'Pending':
						$order_status_id = $this->config->get('pp_standard_pending_status_id');
						break;
					case 'Processed':
						$order_status_id = $this->config->get('pp_standard_processed_status_id');
						break;
					case 'Refunded':
						$order_status_id = $this->config->get('pp_standard_refunded_status_id');
						break;
					case 'Reversed':
						$order_status_id = $this->config->get('pp_standard_reversed_status_id');
						break;
					case 'Voided':
						$order_status_id = $this->config->get('pp_standard_voided_status_id');
						break;
				}

				$this->model_account_customer->addPaymentHistory($customer_id, $order_status_id);
			} else {
				$this->model_account_customer->addPaymentHistory($customer_id,$this->config->get('config_order_status_id'));
			}

			curl_close($curl);
		}
	}
}