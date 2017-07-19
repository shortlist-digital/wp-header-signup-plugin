<?php

add_action('acf/init', function() {

	$key = 'article_header';

	function acf_add_signup_choice( $options ) {
		$post_type = get_post_type();
		if ($post_type == "page") { // example post type
			$options['choices']['hero-signup'] = "Hero Signup";
		}
		return $options;
	}

	add_filter('acf/load_field/key=' . $key . '_type', 'acf_add_signup_choice');

	$fields = [
		array (
			'key' => $key . '_signup_details_tab',
			'label' => 'Signup Details',
			'type' => 'tab',
			'conditional_logic' => array (
				array (
					array (
							'field' => $key . '_type',
							'operator' => '==',
							'value' => 'hero-signup',
					),
				)
			),
			'placement' => 'left'
		),
		array (
			'key' => $key . '_heading',
			'label' => 'Heading',
			'name' => 'header_heading',
			'type' => 'text',
			'instructions' => 'The main sell for the signup',
			'required' => 1,
		),
		array (
			'key' => $key . '_email_placeholder',
			'label' => 'Email placeholder',
			'name' => 'header_email_placeholder',
			'type' => 'text',
			'instructions' => 'A placeholder which sits within the email address input box',
			'required' => 1,
		),
		array (
			'key' => $key . '_promise_label',
			'label' => 'Promise label',
			'name' => 'header_promise_label',
			'type' => 'text',
			'instructions' => 'Text to display beneath the email input box',
		),
		array (
			'key' => $key . '_button_label',
			'label' => 'Button label',
			'name' => 'header_button_label',
			'type' => 'text',
			'instructions' => 'The label on the submit button',
		),
	];

	foreach ($fields as $field) {
		$field['parent'] = $key . '_group';
		acf_add_local_field($field);
	}

}, 0);
