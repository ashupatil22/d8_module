<?php

namespace Drupal\test\Form;

use Drupal\Core\Form;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

class WeatherForm extends ConfigFormBase {
	public function getFormId() {
		return 'weather_config_form';
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		// $fetched = $this->dbwrapper->getData ();
		$form ['appid'] = array (
				'#type' => 'textfield',
				'#title' => 'Weather app API key',
				'#default_value' => $this->config ( 'test.test_weather_config' )->get ( 'appid' )
		);

		return parent::buildForm ( $form, $form_state );
	}
	protected function getEditableConfigNames() {
		return [
				'test.test_weather_config'
		];
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm ( $form, $form_state );
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config ( 'test.test_weather_config' )->set ( 'appid', $form_state->getValue ( 'appid' ) )->save ();
		parent::submitForm ( $form, $form_state );
	}
	/*
	 * public static function create(ContainerInterface $container) {
	 * return new static ( $container->get ( 'test.dbwrapper' ) );
	 * }
	 */
}