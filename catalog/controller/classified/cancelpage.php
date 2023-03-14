<?php
class ControllerClassifiedCancelpage extends Controller {
	public function index() {
	$this->load->language('classified/cancelpage');
	$this->document->setTitle($this->language->get('heading_title'));
	$data['breadcrumbs'] = array();
	
	$data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_home'),
		'href' => $this->url->link('classified/home')

	);

		$data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_payment_failed'),
		'href' => $this->url->link('classified/cancelpage')

		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_success'] = $this->language->get('text_success');
     	$data['text_payment_failed'] = $this->language->get('text_payment_failed');
		$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));
		$data['button_continue'] = $this->language->get('button_continue');
	    $data['continue'] = $this->url->link('classified/home', '', true);
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
    	$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('classified/cancelpage', $data));

	}

}