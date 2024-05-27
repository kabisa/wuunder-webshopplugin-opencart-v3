<?php
class ControllerExtensionShippingWuunderShippingFive extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/shipping/wuunder_shipping');

		$this->document->setTitle($this->language->get('heading_title') . ' 5');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('shipping_wuunder_shipping_five', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title') . ' 5',
			'href' => $this->url->link('extension/shipping/wuunder_shipping_five', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/wuunder_shipping_five', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true);

		if (isset($this->request->post['shipping_wuunder_shipping_five_cost'])) {
			$data['shipping_wuunder_shipping_five_cost'] = $this->request->post['shipping_wuunder_shipping_five_cost'];
		} else {
			$data['shipping_wuunder_shipping_five_cost'] = $this->config->get('shipping_wuunder_shipping_five_cost');
		}

		if (isset($this->request->post['shipping_wuunder_shipping_five_tax_class_id'])) {
			$data['shipping_wuunder_shipping_five_tax_class_id'] = $this->request->post['shipping_wuunder_shipping_five_tax_class_id'];
		} else {
			$data['shipping_wuunder_shipping_five_tax_class_id'] = $this->config->get('shipping_wuunder_shipping_five_tax_class_id');
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['shipping_wuunder_shipping_five_geo_zone_id'])) {
			$data['shipping_wuunder_shipping_five_geo_zone_id'] = $this->request->post['shipping_wuunder_shipping_five_geo_zone_id'];
		} else {
			$data['shipping_wuunder_shipping_five_geo_zone_id'] = $this->config->get('shipping_wuunder_shipping_five_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['shipping_wuunder_shipping_five_status'])) {
			$data['shipping_wuunder_shipping_five_status'] = $this->request->post['shipping_wuunder_shipping_five_status'];
		} else {
			$data['shipping_wuunder_shipping_five_status'] = $this->config->get('shipping_wuunder_shipping_five_status');
		}

		if (isset($this->request->post['shipping_wuunder_shipping_five_sort_order'])) {
			$data['shipping_wuunder_shipping_five_sort_order'] = $this->request->post['shipping_wuunder_shipping_five_sort_order'];
		} else {
			$data['shipping_wuunder_shipping_five_sort_order'] = $this->config->get('shipping_wuunder_shipping_five_sort_order');
		}

		if (isset($this->request->post['shipping_wuunder_shipping_five_wuunder_filter'])) {
			$data['shipping_wuunder_shipping_five_wuunder_filter'] = $this->request->post['shipping_wuunder_shipping_five_wuunder_filter'];
		} else {
			$data['shipping_wuunder_shipping_five_wuunder_filter'] = $this->config->get('shipping_wuunder_shipping_five_wuunder_filter');
		}

		if (isset($this->request->post['shipping_wuunder_shipping_five_method_title'])) {
			$data['shipping_wuunder_shipping_five_method_title'] = $this->request->post['shipping_wuunder_shipping_five_method_title'];
		} else {
			$data['shipping_wuunder_shipping_five_method_title'] = $this->config->get('shipping_wuunder_shipping_five_method_title');
		}

		if (isset($this->request->post['shipping_wuunder_shipping_five_method_name'])) {
			$data['shipping_wuunder_shipping_five_method_name'] = $this->request->post['shipping_wuunder_shipping_five_method_name'];
		} else {
			$data['shipping_wuunder_shipping_five_method_name'] = $this->config->get('shipping_wuunder_shipping_five_method_name');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['shipping_code_addition'] = '_five';

		$this->response->setOutput($this->load->view('extension/shipping/wuunder_shipping', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/wuunder_shipping_five')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}