<?php

namespace Drupal\test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MiscForm.
 *
 * @package Drupal\test\Form
 */
class MiscForm extends FormBase {
	// private $state;
	public function __construct(StateInterface $state) {
		$this->state = $state;
	}
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getFormId() {
		return 'misc_form';
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['qualification'] = [
				'#type' => 'select',
				'#title' => $this->t ( 'Qualification' ),
				'#options' => array (
						'U.G' => $this->t ( 'U.G' ),
						'P.G' => $this->t ( 'P.G' ),
						'others' => $this->t ( 'others' )
				),
				'#size' => 3
		];

		$form ['other_qualification'] = [
				'#type' => 'textfield',
				'#title' => $this->t ( 'Other Qualification' ),
				'#states' => array (
						'visible' => array (
								':input[name="qualification"]' => array (
										'value' => 'others'
								)
						)
				)
		];
		$form ['country'] = [
				'#type' => 'select',
				'#title' => $this->t ( 'Select Country' ),
				'#options' => array (
						'india' => $this->t ( 'India' ),
						'uk' => $this->t ( 'UK' )
				),
				'#default' => $this->state->get ( 'country' ),
				'#ajax' => [
						'callback' => 'Drupal\test\Form\MiscForm::populateStates',
						'wrapper' => 'ajax-callback-wrapper'
				]
		];

		$form ['ajax-container'] = [
				'#type' => 'container',
				'#attributes' => [
						'id' => 'ajax-callback-wrapper'
				]
		];

		$form ['submit'] = [
				'#type' => 'submit',
				'#value' => $this->t ( 'Submit' )
		];

		return $form;
	}
	public function populateStates(array &$form, FormStateInterface $form_state) {
		$country = $form_state->getValue ( 'country' );
		$state ['india'] = [
				'MH',
				'TN',
				'MP'
		];
		$state ['uk'] = [
				'london',
				'barcelona',
				'spain'
		];
		$form ['ajax-container'] ['state'] = [
				'#type' => 'select',
				'#options' => $state [$country]
		];

		return $form ['ajax-container'];
	}
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm ( $form, $form_state );
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		// Display result.
		foreach ( $form_state->getValues () as $key => $value ) {
			drupal_set_message ( $key . ': ' . $value );
			$this->state->set ( 'key', value );
		}
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( 'state' ) );
	}
}
