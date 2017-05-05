<?php

namespace Drupal\test\Form;

use Drupal\Core\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\test\DbWrapper;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DicForm extends FormBase {

	/**
	 * Returns a unique string identifying the form.
	 *
	 * @return string The unique string identifying the form.
	 */
	private $dbwrapper;
	public function __construct(DbWrapper $dbwrapper) {
		$this->dbwrapper = $dbwrapper;
	}
	public function getFormId() {
		return 'dic_form';
	}

	/**
	 * Form constructor.
	 *
	 * @param array $form
	 *        	An associative array containing the structure of the form.
	 * @param \Drupal\Core\Form\FormStateInterface $form_state
	 *        	The current state of the form.
	 *
	 * @return array The form structure.
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$fetched = $this->dbwrapper->getData ();
		$form ['fname'] = array (
				'#type' => 'textfield',
				'#title' => 'First Name',
				'#default_value' => $fetched ['fname']
		);
		$form ['lname'] = array (
				'#type' => 'textfield',
				'#title' => 'Last Name',
				'#default_value' => $fetched ['lname']
		);
		$form ['submit'] = array (
				'#type' => 'submit',
				'#value' => 'Submit'
		);
		return $form;
	}

	/**
	 * Form validation handler.
	 *
	 * @param array $form
	 *        	An associative array containing the structure of the form.
	 * @param \Drupal\Core\Form\FormStateInterface $form_state
	 *        	The current state of the form.
	 */

	/**
	 * Form submission handler.
	 *
	 * @param array $form
	 *        	An associative array containing the structure of the form.
	 * @param \Drupal\Core\Form\FormStateInterface $form_state
	 *        	The current state of the form.
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		// drupal_set_message ( 'Form sent' );;
		$this->dbwrapper->setData ( $form_state->getValue ( 'fname' ), $form_state->getValue ( 'lname' ) );
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( 'test.dbwrapper' ) );
	}
}