<?php
class ControllerclassifiedClassifiedPaymenthistory extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('classified/classifiedadd');
		$this->load->language('classified/classifiedpaymenthistory');
		$this->document->setTitle($this->language->get('heading_title'));
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'classified_paid_package_id';
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

		$data['completes_info']=array();

		$filter_data = array(
			'sort'                 => $sort,
			'order'                => $order,
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
		);
		

		$order_total = $this->model_classified_classifiedadd->getTotalComplete($filter_data);
		
		$completes_orders = $this->model_classified_classifiedadd->classifiedcompletes(0);
         foreach ($completes_orders as $completes_order) {
          
			  $Customerinfo= $this->model_classified_classifiedadd->getCustomer($completes_order['customer_id']);

			if(!empty($Customerinfo['firstname'])){
				$Customerinfoname=$Customerinfo['firstname'] . ' ' . $Customerinfo['lastname'];
			}else{
				$Customerinfoname='';
			}

		   $orderstatus= $this->model_classified_classifiedadd->getOrderStatus($completes_order['order_status_id']);
		   if(!empty($orderstatus['name'])){
				$order_status=$orderstatus['name'];
			}else{
				$order_status='';
			}
			$data['completes_info'][]=array(
			  'customer'                   => $Customerinfoname,
			  'classified_paid_package_id'               => $completes_order['classified_paid_package_id'],
			  'package_name'               => $completes_order['package_name'],
			  'price'                      => $completes_order['price'],
     		  'order_status'               => $order_status,
			  'expirydate' 				=> $completes_order['expirydate']
			 );
		} 


		$pagination = new Pagination();
		$pagination->total = $order_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('classified/classified_payment_history', 'page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($order_total - 10)) ? $order_total : ((($page - 1) * 10) + 10), $order_total, ceil($order_total / 10));


		$data['heading_title']          = $this->language->get('heading_title');
		$data['text_lists'] 	            = $this->language->get('text_lists');
		$data['column_name'] 	        = $this->language->get('column_name');
		$data['column_pakagesname'] 	= $this->language->get('column_pakagesname');
		$data['column_price'] 	        = $this->language->get('column_price');
		$data['column_addname'] 	    = $this->language->get('column_addname');
		$data['column_orderstartus'] 	= $this->language->get('column_orderstartus');
		$data['text_no_results'] 	= $this->language->get('text_no_results');
		$data['column_expirydate'] 	= $this->language->get('column_expirydate');
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['token'] = $this->session->data['token'];	
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
		
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] , true)

		);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('classified/classifiedpaymenthistorylist.tpl', $data));

	}


}