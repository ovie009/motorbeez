<?php
class ControllerSettingThemeSetting extends Controller {
	private $error = array();
	public function index() {
		$this->load->model('setting/setting');
		$this->load->language('setting/theme_setting');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] 			= $this->language->get('heading_title');
		$data['text_edit'] 				= $this->language->get('text_edit');
		$data['text_form'] 				= $this->language->get('text_form');
		$data['text_default']           = $this->language->get('text_default');
		$data['text_enable']            = $this->language->get('text_enable');
		$data['text_disable']           = $this->language->get('text_disable');
		$data['text_select']            = $this->language->get('text_select');
		$data['text_none'] 				= $this->language->get('text_none');
		$data['text_header1'] 			= $this->language->get('text_header1');
		$data['text_header2'] 			= $this->language->get('text_header2');
		$data['text_header3'] 			= $this->language->get('text_header3');
		$data['text_footer1'] 			= $this->language->get('text_footer1');
		$data['text_footer2'] 			= $this->language->get('text_footer2');
		$data['text_footer3'] 			= $this->language->get('text_footer3');
		$data['text_width'] 			= $this->language->get('text_width');
		$data['text_height'] 			= $this->language->get('text_height');
		$data['text_mapkey'] 			= $this->language->get('text_mapkey');
		
		$data['tab_setting']            = $this->language->get('tab_setting');
		$data['tab_header']             = $this->language->get('tab_header');
		$data['tab_footer']             = $this->language->get('tab_footer');
		$data['tab_banner']         = $this->language->get('tab_banner');
		$data['tab_socialmedia'] 		= $this->language->get('tab_socialmedia');
		$data['tab_theme'] 		= $this->language->get('tab_theme');
		$data['tab_map'] 		= $this->language->get('tab_map');

		$data['lable_name']             = $this->language->get('lable_name');
		$data['lable_footericon'] 		= $this->language->get('lable_footericon');
		$data['lable_fburl'] 			= $this->language->get('lable_fburl');
		$data['lable_google'] 			= $this->language->get('lable_google');
		$data['lable_twet'] 			= $this->language->get('lable_twet');
		$data['lable_in'] 				= $this->language->get('lable_in');
		$data['lable_instagram'] 		= $this->language->get('lable_instagram');
		$data['lable_pinterest'] 		= $this->language->get('lable_pinterest');
		$data['lable_youtube'] 			= $this->language->get('lable_youtube');
		$data['lable_blogger'] 			= $this->language->get('lable_blogger');
		$data['lable_address2'] 		= $this->language->get('lable_address2');
		$data['lable_title'] 			= $this->language->get('lable_title');
		$data['lable_aboutdes'] 		= $this->language->get('lable_aboutdes');
		$data['lable_phoneno'] 			= $this->language->get('lable_phoneno');
		$data['lable_mobile'] 			= $this->language->get('lable_mobile');
		$data['lable_email'] 			= $this->language->get('lable_email');
		$data['lable_twittercode'] 		= $this->language->get('lable_twittercode');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_iconcolor'] = $this->language->get('entry_iconcolor');
		$data['entry_iconborder'] = $this->language->get('entry_iconborder');
		$data['entry_searchbtncolor'] = $this->language->get('entry_searchbtncolor');
		$data['entry_listbuttoncolor'] = $this->language->get('entry_listbuttoncolor');
		$data['entry_filtertitle'] = $this->language->get('entry_filtertitle');
		$data['entry_filterbg'] = $this->language->get('entry_filterbg');
		$data['entry_dashboardtabactive'] = $this->language->get('entry_dashboardtabactive');
		$data['entry_dashboardhoverbg'] = $this->language->get('entry_dashboardhoverbg');
		$data['entry_dashboardtxtcolor'] = $this->language->get('entry_dashboardtxtcolor');
		$data['entry_dashboardhovertxtcolor'] = $this->language->get('entry_dashboardhovertxtcolor');
		$data['entry_dashboardbtnbg'] = $this->language->get('entry_dashboardbtnbg');
		$data['entry_dashboardsticker'] = $this->language->get('entry_dashboardsticker');
		$data['entry_classfiedadd'] = $this->language->get('entry_classfiedadd');
		$data['entry_banneradd'] = $this->language->get('entry_banneradd');
		$data['entry_ftlogo'] = $this->language->get('entry_ftlogo');
		$data['entry_footerdesc'] = $this->language->get('entry_footerdesc');

		$data['entry_footericon'] 		= $this->language->get('entry_footericon');
		$data['entry_footerlogo'] = $this->language->get('entry_footerlogo');
		$data['entry_facebook'] = $this->language->get('entry_facebook');
		$data['entry_twitter'] = $this->language->get('entry_twitter');
		$data['entry_google'] = $this->language->get('entry_google');
		$data['entry_instgram'] = $this->language->get('entry_instgram');
		$data['entry_youtube'] = $this->language->get('entry_youtube');
		$data['entry_linkdin'] = $this->language->get('entry_linkdin');

		$data['help_banner'] 			= $this->language->get('help_banner');
		$data['token']                  = $this->session->data['token'];

		$data['button_save'] 			= $this->language->get('button_save');
		$data['button_remove'] 			= $this->language->get('button_remove');
		$data['button_add'] 			= $this->language->get('button_add');
		$data['button_cancel'] 			= $this->language->get('button_cancel');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('classified', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('setting/theme_setting', 'token=' . $this->session->data['token'], true));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/theme_setting', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('setting/theme_setting', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('setting/theme_setting', 'token=' . $this->session->data['token'], true);

		$data['token'] = $this->session->data['token'];
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		///// Setting /////
			$this->load->model('tool/image');

		if (isset($this->request->post['classified_header'])) {
			$data['classified_header'] = $this->request->post['classified_header'];
		} else {
			$data['classified_header'] = $this->config->get('classified_header');
		}


		if (isset($this->request->post['classified_footer'])) {
			$data['classified_footer'] = $this->request->post['classified_footer'];
		} else {
			$data['classified_footer'] = $this->config->get('classified_footer');
		}

		if (isset($this->request->post['classified_titlecolor'])) {
			$data['classified_titlecolor'] = $this->request->post['classified_titlecolor'];
		} else {
			$data['classified_titlecolor'] = $this->config->get('classified_titlecolor');
		}
		if (isset($this->request->post['classified_pricecolor'])) {
			$data['classified_pricecolor'] = $this->request->post['classified_pricecolor'];
		} else {
			$data['classified_pricecolor'] = $this->config->get('classified_pricecolor');
		}
		if (isset($this->request->post['classified_iconcolor'])) {
			$data['classified_iconcolor'] = $this->request->post['classified_iconcolor'];
		} else {
			$data['classified_iconcolor'] = $this->config->get('classified_iconcolor');
		}
		if (isset($this->request->post['classified_bordercolor'])) {
			$data['classified_bordercolor'] = $this->request->post['classified_bordercolor'];
		} else {
			$data['classified_bordercolor'] = $this->config->get('classified_bordercolor');
		}
		if (isset($this->request->post['classified_searchbtncolor'])) {
			$data['classified_searchbtncolor'] = $this->request->post['classified_searchbtncolor'];
		} else {
			$data['classified_searchbtncolor'] = $this->config->get('classified_searchbtncolor');
		}
		if (isset($this->request->post['classified_listgridbtncolor'])) {
			$data['classified_listgridbtncolor'] = $this->request->post['classified_listgridbtncolor'];
		} else {
			$data['classified_listgridbtncolor'] = $this->config->get('classified_listgridbtncolor');
		}
		if (isset($this->request->post['classified_filtertitlecolor'])) {
			$data['classified_filtertitlecolor'] = $this->request->post['classified_filtertitlecolor'];
		} else {
			$data['classified_filtertitlecolor'] = $this->config->get('classified_filtertitlecolor');
		}
		if (isset($this->request->post['classified_filterbgcolor'])) {
			$data['classified_filterbgcolor'] = $this->request->post['classified_filterbgcolor'];
		} else {
			$data['classified_filterbgcolor'] = $this->config->get('classified_filterbgcolor');
		}
		if (isset($this->request->post['classified_dashboardtabbgcolor'])) {
			$data['classified_dashboardtabbgcolor'] = $this->request->post['classified_dashboardtabbgcolor'];
		} else {
			$data['classified_dashboardtabbgcolor'] = $this->config->get('classified_dashboardtabbgcolor');
		}
		if (isset($this->request->post['classified_dashboardhoverbgcolor'])) {
			$data['classified_dashboardhoverbgcolor'] = $this->request->post['classified_dashboardhoverbgcolor'];
		} else {
			$data['classified_dashboardhoverbgcolor'] = $this->config->get('classified_dashboardhoverbgcolor');
		}
		if (isset($this->request->post['classified_dashboardtextcolor'])) {
			$data['classified_dashboardtextcolor'] = $this->request->post['classified_dashboardtextcolor'];
		} else {
			$data['classified_dashboardtextcolor'] = $this->config->get('classified_dashboardtextcolor');
		}
		if (isset($this->request->post['classified_dashboardhovertextcolor'])) {
			$data['classified_dashboardhovertextcolor'] = $this->request->post['classified_dashboardhovertextcolor'];
		} else {
			$data['classified_dashboardhovertextcolor'] = $this->config->get('classified_dashboardhovertextcolor');
		}
		if (isset($this->request->post['classified_dashboardbtnbgcolor'])) {
			$data['classified_dashboardbtnbgcolor'] = $this->request->post['classified_dashboardbtnbgcolor'];
		} else {
			$data['classified_dashboardbtnbgcolor'] = $this->config->get('classified_dashboardbtnbgcolor');
		}
		
		if (isset($this->request->post['classified_dashboardstickerbgcolor'])) {
			$data['classified_dashboardstickerbgcolor'] = $this->request->post['classified_dashboardstickerbgcolor'];
		} else {
			$data['classified_dashboardstickerbgcolor'] = $this->config->get('classified_dashboardstickerbgcolor');
		}

		if (isset($this->request->post['classified_width'])) {
			$data['classified_width'] = $this->request->post['classified_width'];
		} else {
			$data['classified_width'] = $this->config->get('classified_width');
		}

		if (isset($this->request->post['classified_mapkey'])) {
			$data['classified_mapkey'] = $this->request->post['classified_mapkey'];
		} else {
			$data['classified_mapkey'] = $this->config->get('classified_mapkey');
		}

	
		if (isset($this->request->post['classified_classified_id'])) {
			$data['classified_classified_id'] = $this->request->post['classified_classified_id'];
		} elseif (!empty($this->config->get('classified_classified_id'))) {
			$data['classified_classified_id'] = $this->config->get('classified_classified_id');
		} else {
			$data['classified_classified_id'] = '';
		}
/* banner ads  */
		if (isset($this->request->post['classified_icon'])) {
		$data['classified_icon'] = $this->request->post['classified_icon'];
		} else {
		$data['classified_icon'] = $this->config->get('classified_icon');
		}

		if (isset($this->request->post['classified_icon']) && is_file(DIR_IMAGE . $this->request->post['classified_icon'])) {
			$data['icon'] = $this->model_tool_image->resize($this->request->post['classified_icon'], 100, 100);
		} elseif ($this->config->get('classified_icon') && is_file(DIR_IMAGE . $this->config->get('classified_icon'))) {
			$data['icon'] = $this->model_tool_image->resize($this->config->get('classified_icon'), 100, 100);
		} else {
			$data['icon'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		



			if (isset($this->request->post['classified_footericon']) && is_file(DIR_IMAGE . $this->request->post['classified_footericon'])) {
				$data['thumb'] = $this->model_tool_image->resize($this->request->post['classified_footericon'], 100, 100);
			} elseif ($this->config->get('classified_footericon') && is_file(DIR_IMAGE . $this->config->get('classified_footericon'))) {
				$data['thumb'] = $this->model_tool_image->resize($this->config->get('classified_footericon'), 100, 100);
			} else {
				$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
			}

			$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);



	/*footer logo  */
		if (isset($this->request->post['classified_footerlogo'])) {
		$data['classified_footerlogo'] = $this->request->post['classified_footerlogo'];
		} else {
		$data['classified_footerlogo'] = $this->config->get('classified_footerlogo');
		}

		if (isset($this->request->post['classified_footerlogo']) && is_file(DIR_IMAGE . $this->request->post['classified_footerlogo'])) {
			$data['flogo'] = $this->model_tool_image->resize($this->request->post['classified_footerlogo'], 100, 100);
		} elseif ($this->config->get('classified_footerlogo') && is_file(DIR_IMAGE . $this->config->get('classified_footerlogo'))) {
			$data['flogo'] = $this->model_tool_image->resize($this->config->get('classified_footerlogo'), 100, 100);
		} else {
			$data['flogo'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		


		if (isset($this->request->post['classified_footerdesc'])) {
			$data['classified_footerdesc'] = $this->request->post['classified_footerdesc'];
		} else {
			$data['classified_footerdesc'] = $this->config->get('classified_footerdesc');
		}

		if (isset($this->request->post['classified_properites'])) {
			$data['classified_properites'] = $this->request->post['classified_properites'];
		} else {
			$data['classified_properites'] = $this->config->get('classified_properites');
		}

		if (isset($this->request->post['classified_agent'])) {
			$data['classified_agent'] = $this->request->post['classified_agent'];
		} else {
			$data['classified_agent'] = $this->config->get('classified_agent');
		}


		if (isset($this->request->post['classified_theme'])) {
			$data['classified_theme'] = $this->request->post['classified_theme'];
		} else {
			$data['classified_theme'] = $this->config->get('classified_theme');
		}

			if (isset($this->request->post['classified_fb'])) {
			$data['classified_fb'] = $this->request->post['classified_fb'];
		} else {
			$data['classified_fb'] = $this->config->get('classified_fb');
		}
        
        if (isset($this->request->post['classified_twitter'])) {
			$data['classified_twitter'] = $this->request->post['classified_twitter'];
		} else {
			$data['classified_twitter'] = $this->config->get('classified_twitter');
		}
        
        if (isset($this->request->post['classified_instgram'])) {
			$data['classified_instgram'] = $this->request->post['classified_instgram'];
		} else {
			$data['classified_instgram'] = $this->config->get('classified_instgram');
		}
        
        if (isset($this->request->post['classified_google'])) {
			$data['classified_google'] = $this->request->post['classified_google'];
		} else {
			$data['classified_google'] = $this->config->get('classified_google');
		}
        
        if (isset($this->request->post['classified_youtube'])) {
			$data['classified_youtube'] = $this->request->post['classified_youtube'];
		} else {
			$data['classified_youtube'] = $this->config->get('classified_youtube');
		}
        
        if (isset($this->request->post['classified_linkdin'])) {
			$data['classified_linkdin'] = $this->request->post['classified_linkdin'];
		} else {
			$data['classified_linkdin'] = $this->config->get('classified_linkdin');
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


		$data['header'] 		= $this->load->controller('common/header');
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['footer'] 		= $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('setting/theme_setting.tpl', $data));

	}


	protected function validate() {
	if (!$this->user->hasPermission('modify','setting/theme_setting')) {
		$this->error['warning'] = $this->language->get('error_permission');
	}
	return !$this->error;

	}


}


