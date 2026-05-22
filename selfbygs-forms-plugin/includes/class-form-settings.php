<?php
/**
 * Form field settings for SELF by GS Forms.
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SelfByGS_Form_Settings {

	private static $option_prefix = 'selfbygs_form_settings_';

	public static function install_defaults() {
		$forms = array(
			'lead'    => self::default_lead_form(),
			'contact' => self::default_contact_form(),
		);
		foreach ( $forms as $id => $config ) {
			if ( ! get_option( self::$option_prefix . $id ) ) {
				update_option( self::$option_prefix . $id, $config );
			}
		}
	}

	public static function get( $form_id ) {
		$default = array(
			'lead'    => self::default_lead_form(),
			'contact' => self::default_contact_form(),
		);
		$saved = get_option( self::$option_prefix . $form_id, array() );
		return ! empty( $saved ) ? $saved : ( $default[ $form_id ] ?? array( 'fields' => array(), 'config' => array() ) );
	}

	public static function get_all_forms() {
		return array(
			'lead'    => array( 'label' => 'Lead / Clarity Call Form', 'id' => 'lead' ),
			'contact' => array( 'label' => 'Contact Page Form', 'id' => 'contact' ),
		);
	}

	public static function save( $form_id, array $fields, array $config ) {
		$sanitized_fields = array();
		foreach ( $fields as $f ) {
			$sanitized_fields[] = array(
				'key'         => sanitize_key( $f['key'] ?? '' ),
				'label'       => sanitize_text_field( $f['label'] ?? '' ),
				'type'        => sanitize_text_field( $f['type'] ?? 'text' ),
				'placeholder' => sanitize_text_field( $f['placeholder'] ?? '' ),
				'required'    => ! empty( $f['required'] ),
				'options'     => array_map( 'sanitize_text_field', (array) ( $f['options'] ?? array() ) ),
				'enabled'     => ! empty( $f['enabled'] ),
			);
		}
		$sanitized_config = array(
			'admin_label'   => sanitize_text_field( $config['admin_label'] ?? '' ),
			'success_msg'   => sanitize_textarea_field( $config['success_msg'] ?? '' ),
			'notify_email'  => sanitize_email( $config['notify_email'] ?? '' ),
			'steps'         => (int) ( $config['steps'] ?? 1 ),
		);
		update_option( self::$option_prefix . $form_id, array(
			'fields' => $sanitized_fields,
			'config' => $sanitized_config,
		) );
	}

	private static function default_lead_form() {
		return array(
			'config' => array(
				'admin_label'  => 'Lead · Clarity Call',
				'success_msg'  => "Thank you — we'll be in touch within one business day.",
				'notify_email' => get_option( 'admin_email', '' ),
				'steps'        => 4,
			),
			'fields' => array(
				array( 'key' => 'who',            'label' => 'Who is this for?',           'type' => 'chips',    'placeholder' => '',                         'required' => true,  'enabled' => true,  'options' => array( 'Student · Career clarity', 'Student · YLP / Placement readiness', 'Parent · For my child', 'Educator · School / College', 'Institution · Bulk programs', 'L&D · For my team', 'Founder / Leadership' ) ),
				array( 'key' => 'programs',       'label' => 'Which intervention?',        'type' => 'chips',    'placeholder' => '',                         'required' => false, 'enabled' => true,  'options' => array( 'Career Architecture · Decision Lab', 'Young Leaders Program (YLP)', 'YLP Pro · Placement', 'Beyond Teaching · FDP', 'Executive Effectiveness', 'Core Skills (Communication, Sales, AI…)', 'Custom Solution', 'Not sure yet' ) ),
				array( 'key' => 'lead_name',      'label' => 'Full name',                  'type' => 'text',     'placeholder' => 'Your name',                'required' => true,  'enabled' => true,  'options' => array() ),
				array( 'key' => 'lead_email',     'label' => 'Email',                      'type' => 'email',    'placeholder' => 'you@example.com',          'required' => true,  'enabled' => true,  'options' => array() ),
				array( 'key' => 'lead_phone',     'label' => 'Mobile (with code)',         'type' => 'tel',      'placeholder' => '+91 98xx xx xx xx',         'required' => false, 'enabled' => true,  'options' => array() ),
				array( 'key' => 'lead_org',       'label' => 'Organisation / Institution', 'type' => 'text',     'placeholder' => 'Where you study or work',  'required' => false, 'enabled' => true,  'options' => array() ),
				array( 'key' => 'lead_context',   'label' => 'Context',                    'type' => 'textarea', 'placeholder' => "I'm trying to figure out…", 'required' => false, 'enabled' => true,  'options' => array() ),
				array( 'key' => 'lead_time',      'label' => 'Preferred time',             'type' => 'select',   'placeholder' => '',                         'required' => false, 'enabled' => true,  'options' => array( 'Weekday · Morning (10am–12pm IST)', 'Weekday · Afternoon (1pm–4pm IST)', 'Weekday · Evening (5pm–8pm IST)', 'Weekend · I\'ll pick a slot' ) ),
			),
		);
	}

	private static function default_contact_form() {
		return array(
			'config' => array(
				'admin_label'  => 'Contact Page Form',
				'success_msg'  => "We've received your message and will respond within one business day.",
				'notify_email' => get_option( 'admin_email', '' ),
				'steps'        => 1,
			),
			'fields' => array(
				array( 'key' => 'name',    'label' => 'Full Name',    'type' => 'text',     'placeholder' => 'Your full name',       'required' => true,  'enabled' => true, 'options' => array() ),
				array( 'key' => 'email',   'label' => 'Email',        'type' => 'email',    'placeholder' => 'you@example.com',      'required' => true,  'enabled' => true, 'options' => array() ),
				array( 'key' => 'phone',   'label' => 'Phone',        'type' => 'tel',      'placeholder' => '+91 98xx xx xx xx',     'required' => false, 'enabled' => true, 'options' => array() ),
				array( 'key' => 'context', 'label' => 'Your Message', 'type' => 'textarea', 'placeholder' => 'How can we help you?', 'required' => true,  'enabled' => true, 'options' => array() ),
			),
		);
	}
}
