<?php
use Drupal\Core\Form\FormStateInterface;
function demo_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
	$form ['site_sub_slogan'] = array (
			'#type' => 'textfield',
			'#title' => t ( 'Subslogan' ),
			'#default_value' => theme_get_setting ( 'site_sub_slogan' ),
			'#description' => t ( 'Place the text in header region.' )
	);
}