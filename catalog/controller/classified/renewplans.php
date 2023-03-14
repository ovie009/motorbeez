<?php
class ControllerClassifiedRenewplans extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}
		$this->load->language('classified/register');
	 	$data['customer_id'] = $this->customer->getId();

		$data['text_memberplanlist']   			=$this->language->get('text_memberplanlist');
		$data['text_classified']   			=$this->language->get('text_classified');
		$data['text_validity']   				=$this->language->get('text_validity');
		$data['text_close']   					=$this->language->get('text_close');
		$data['text_top']   					=$this->language->get('text_top');
		$data['text_feature']   				=$this->language->get('text_feature');
		$data['text_latest']   					=$this->language->get('text_latest');
		$data['text_bottom']   					=$this->language->get('text_bottom');
		$data['text_buynow']   					=$this->language->get('text_buynow');
		$data['login']=$this->url->link('classified/login');

		$this->load->model('account/customer');
		$this->load->model('tool/image');

		$data['memberships']=$this->model_account_customer->getPlans(0);
		  $data['membershipsall']=array();
		  $memberships_results =$this->model_account_customer->getPlans(0);

		  foreach($memberships_results as $memberships_result){
			if(!empty($memberships_result['price'])){
				$price =$this->currency->format($memberships_result['price'], $this->config->get('config_currency'));
			}else{
				$price='';
			}
			if(!empty($memberships_result['type'])){
				$ttypename =strtoupper($memberships_result['type'][0]);
			}else{
				$ttypename='';
			}


			  $data['membershipsall'][]=array(
			   'price'          => $this->currency->format($memberships_result['price'], $this->config->get('config_currency')),
			   'typename'       => $ttypename,
			   'type'           => $memberships_result['type'],
			   'package_name'           => $memberships_result['package_name'],
			   'classified_limit' => $memberships_result['classified_limit'],
			   'package_id' 		=> $memberships_result['package_id'],
			   'no_of_day'      	=> $memberships_result['no_of_day']
			 );
		}

		$data['column_left'] 					= $this->load->controller('common/column_left');
		$data['column_right'] 					= $this->load->controller('common/column_right');
		$data['content_top']	 				= $this->load->controller('common/content_top');
		$data['content_bottom'] 				= $this->load->controller('common/content_bottom');
		$data['footer'] 						= $this->load->controller('common/footer');
		$data['header'] 						= $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('classified/renewplans', $data));
	}

	public function renewcustomerplan() {
		$this->load->model('account/customer');
		$this->load->language('agent/agentsignup');
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {	

			$this->model_account_customer->renewpackage($this->request->post);
			$json['success'] = $this->language->get('text_renew');	
			$json['redirec'] =$this->url->link('classified/pp_standard&customer_id='.$this->customer->getId());		
		}	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}

