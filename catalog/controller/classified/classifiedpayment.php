<?php
class ControllerclassifiedClassifiedpayment extends Controller {
	private $error = array();
	
	public function index() {
		 if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('classified/login', '', true));
		}

		$this->load->language('classified/classifiedadd');
		$this->load->model('classified/classifiedadd');
		$this->load->model('classified/myads');
		$classified_id=$this->config->get('classified_classified_id');
		
		$classifiedPayments   = $this->model_classified_classifiedadd->classifiedPayments($this->request->get['classified_id']);
   
        $classified_payments=array();
		foreach ($classifiedPayments as $classifiedPayment) {
		    $classifiedcolor=$this->model_classified_myads->placementClasscolor($classifiedPayment['package_id']);
			
			if(!empty($classifiedcolor['price'])){
				$price =$classifiedcolor['price'];
			}else{
				$price='';
			}

			if(!empty($classifiedcolor['title'])){
				$title =$classifiedcolor['title'];
			}else{
				$title='';
			}

			if(!empty($classifiedcolor['package_id'])){
				$package_id =$classifiedcolor['package_id'];
			}else{
				$package_id='';
			}
			 $classifiedname=$this->model_classified_myads->getClassified($classifiedPayment['classified_id']);

			 if(!empty($classifiedname['title'])){
				$classifiedname =$classifiedname['title'];
			}else{
				$classifiedname='';
			}   	
			$classified_payments[]=array(
			   'classified_id'         =>$classifiedPayment['classified_id'],	
			   'package_id'          =>$classifiedPayment['package_id'],	
			   'price'                 =>$price,	
			   'title'                 =>$title,	
			   'classifiedname'        =>$classifiedname	
			);

        }
		$quantity='1';
		$recurring_id=0;
   	 	$option['classified_payments']=$classified_payments;
		$this->cart->add($this->config->get('classified_classified_id'), $quantity, $option,$recurring_id);
		
		$this->response->redirect($this->url->link('checkout/cart', '', 'SSL'));
        
	 }

	 public function add() {
		$this->load->language('checkout/cart');
		$json = array();
                    
       if (!$json) {
      		$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' .$this->config->get('classified_classified_id')),$this->url->link('checkout/cart'));
				// Unset all shipping and payment methods
				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);
				// Totals
				$this->load->model('extension/extension');

				$totals = array();
				$taxes = $this->cart->getTaxes();
				$total = 0;
		
				// Because __call can not keep var references so we put them into an array. 			
				$total_data = array(
					'totals' => &$totals,
					'taxes'  => &$taxes,
					'total'  => &$total
				);

				// Display prices
				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$sort_order = array();

					$results = $this->model_extension_extension->getExtensions('total');

					foreach ($results as $key => $value) {
						$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
					}

					array_multisort($sort_order, SORT_ASC, $results);

					foreach ($results as $result) {
						if ($this->config->get($result['code'] . '_status')) {
							$this->load->model('extension/total/' . $result['code']);

							// We have to put the totals in an array so that they pass by reference.
							$this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
						}
					}

					$sort_order = array();

					foreach ($totals as $key => $value) {
						$sort_order[$key] = $value['sort_order'];
					}

					array_multisort($sort_order, SORT_ASC, $totals);
				}

				$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total, $this->session->data['currency']));
			} else {
				$json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
			}
		

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}