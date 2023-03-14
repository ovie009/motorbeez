<?php
class ControllerclassifiedEnquiryReply extends Controller {

	private $error = array();

	public function index() {

		$this->load->language('classified/enquiry_reply');
		$this->load->model('classified/enquiry');
		$this->load->model('classified/enquiry_reply');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('classified/enquiry', 'token=' . $this->session->data['token'] , true)

		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] 	   = $this->language->get('text_list');
		$data['text_enabled']  = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes']      = $this->language->get('text_yes');
		$data['text_no'] 	   = $this->language->get('text_no');
		$data['text_default']  = $this->language->get('text_default');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm']  = $this->language->get('text_confirm');
		$data['text_inquiry']  = $this->language->get('text_inquiry');
		$data['text_total']  = $this->language->get('text_total');
		$data['text_Arrival']  = $this->language->get('text_Arrival');
		$data['text_Departure']  = $this->language->get('text_Departure');
		$data['text_detail']  = $this->language->get('text_detail');
		$data['text_response']  = $this->language->get('text_response');
		$data['text_date']  = $this->language->get('text_date');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['button_send'] = $this->language->get('button_send');
		$data['token'] = $this->session->data['token'];	


		 $this->load->model('classified/enquiry_reply');
		 $data['inquiry_info']=array();

		$message_info = $this->model_classified_enquiry_reply->getinquiryhistory($this->request->get['id']);

		foreach($message_info  as $message_infos){

			$data['message_info'][]=array(
			  'inquiry_history_id'  =>($message_infos['inquiry_history_id']), 
			  'message'   => html_entity_decode($message_infos['message'])

			);

		}	
   

		$inquiry_info = $this->model_classified_enquiry_reply->getinquiry($this->request->get['id']);
		if(isset($inquiry_info['name'])){
			$data['name']=$inquiry_info['name'];
		}else{
			$data['name']='';
		}
		if(isset($inquiry_info['description'])){
			$data['message']=$inquiry_info['description'];
		}else{
			$data['message']='';
		}
		if(isset($inquiry_info['email'])){
			$data['email']=$inquiry_info['email'];
		}else{
			$data['email']='';
		}
		if(isset($inquiry_info['date_added'])){
			$data['date_added']=$inquiry_info['date_added'];
		}else{
			$data['date_added']='';
		}
		
		
		if (isset($this->request->post['id'])) {
			$data['id'] = $this->request->post['id'];
		} elseif (!empty($inquiry_info)) {
			$data['id'] = $inquiry_info['id'];
		} else {
			$data['id'] = '';
		}		
	
		if (isset($this->request->post['post_id'])) {
			$data['post_id'] = $this->request->post['post_id'];
		} elseif (!empty($inquiry_info)) {
			$data['post_id'] = $inquiry_info['post_id'];
		} else {
			$data['post_id'] = '';
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

         
	
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('classified/enquiry_reply', $data));

	}


	public function postinquiryhistory(){

		$this->load->language('classified/enquiry_reply');
		$this->load->model('classified/enquiry_reply');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

			if(!empty($this->request->post['message'])){
			
			$this->model_classified_enquiry_reply->addinquiryhistory($this->request->post);
			$json['success'] = $this->language->get('text_success');					
			}else{
				$json['error'] = $this->language->get('text_error');
			}

		}					

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));

		}

	

}

