<?php

add_action('acf/init', function() {

	$key = 'article_header';

	function acf_add_signup_choice( $options ) {
		$post_type = get_post_type();
		if ($post_type == "page") { // example post type
			$options['choices'][ 'signup_hero' ] = "Standard hero with signup";
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
							'value' => 'signup_hero',
					),
				)
			),
			'placement' => 'left'
		),
		array (
			'key' => 'widget_super_hero_signup_heading',
			'label' => 'Heading',
			'name' => 'heading',
			'type' => 'text',
			'instructions' => 'The main sell for the signup',
			'required' => 1,
		),
		array (
			'key' => 'widget_super_hero_signup_email_placeholder',
			'label' => 'Email placeholder',
			'name' => 'email_placeholder',
			'type' => 'text',
			'instructions' => 'A placeholder which sits within the email address input box',
			'required' => 1,
		),
		array (
			'key' => 'widget_super_hero_signup_promise_label',
			'label' => 'Promise label',
			'name' => 'promise_label',
			'type' => 'text',
			'instructions' => 'Text to display beneath the email input box',
		),
		array (
			'key' => 'widget_super_hero_signup_button_label',
			'label' => 'Button label',
			'name' => 'button_label',
			'type' => 'text',
			'instructions' => 'The label on the submit button',
		),
		array (
			'key' => 'widget_super_hero_signup_options',
			'label' => 'Options',
			'name' => 'options',
			'type' => 'checkbox',
			'choices' => array (
				'full-height' => 'Enable full height (fill the screen)',
				'parallax' => 'Enable parallax effect',
				'carousel-buttons' => 'Enable previous/next carousel buttons (if used)',
				'scroll-down-button' => 'Enable scroll down button (if full-height is used)'
			),
			'default_value' => array (
				'carousel-buttons' => 'carousel-buttons',
				'scroll-down-button' => 'scroll-down-button',
			),
		),
	];

	foreach ($fields as $field) {
		$field['parent'] = $key . '_group';
		acf_add_local_field($field);
	}

}, 0);
