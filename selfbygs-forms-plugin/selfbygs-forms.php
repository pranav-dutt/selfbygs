<?php
/**
 * Plugin Name:       SELF by GS · Forms Manager
 * Plugin URI:        https://selfbygs.com
 * Description:       Manages all lead/contact forms for SELF by GS. Stores entries, sends branded email notifications, and provides an admin dashboard.
 * Version:           1.0.0
 * Author:            Gaurav Sharma & Associates
 * Author URI:        https://selfbygs.com
 * Text Domain:       selfbygs-forms
 * License:           GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SELFBYGS_FORMS_VERSION', '1.0.0' );
define( 'SELFBYGS_FORMS_DIR', plugin_dir_path( __FILE__ ) );
define( 'SELFBYGS_FORMS_URL', plugin_dir_url( __FILE__ ) );
define( 'SELFBYGS_FORMS_DB_VERSION', '1.0' );

require_once SELFBYGS_FORMS_DIR . 'includes/class-db.php';
require_once SELFBYGS_FORMS_DIR . 'includes/class-email-handler.php';
require_once SELFBYGS_FORMS_DIR . 'includes/class-form-settings.php';

// ─── Activation ──────────────────────────────────────────────────────────────
register_activation_hook( __FILE__, 'selfbygs_forms_activate' );
function selfbygs_forms_activate() {
	SelfByGS_DB::create_tables();
	SelfByGS_Form_Settings::install_defaults();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'selfbygs_forms_deactivate' );
function selfbygs_forms_deactivate() {
	flush_rewrite_rules();
}

// ─── REST API ─────────────────────────────────────────────────────────────────
add_action( 'rest_api_init', 'selfbygs_register_rest_routes' );
function selfbygs_register_rest_routes() {
	register_rest_route( 'selfbygs/v1', '/submit', array(
		'methods'             => 'POST',
		'callback'            => 'selfbygs_handle_form_submit',
		'permission_callback' => '__return_true',
	) );
}

function selfbygs_handle_form_submit( WP_REST_Request $request ) {
	$params = $request->get_json_params();
	if ( ! $params ) {
		$params = $request->get_body_params();
	}

	$form_id   = sanitize_text_field( $params['form_id'] ?? 'lead' );
	$name      = sanitize_text_field( $params['lead_name'] ?? $params['name'] ?? '' );
	$email     = sanitize_email( $params['lead_email'] ?? $params['email'] ?? '' );
	$phone     = sanitize_text_field( $params['lead_phone'] ?? $params['phone'] ?? '' );
	$org       = sanitize_text_field( $params['lead_org'] ?? $params['organisation'] ?? '' );
	$who       = sanitize_text_field( $params['who'] ?? '' );
	$programs  = is_array( $params['programs'] ?? null ) ? array_map( 'sanitize_text_field', $params['programs'] ) : array( sanitize_text_field( $params['programs'] ?? '' ) );
	$context   = sanitize_textarea_field( $params['lead_context'] ?? $params['context'] ?? '' );
	$time_pref = sanitize_text_field( $params['lead_time'] ?? $params['preferred_time'] ?? '' );
	$page      = sanitize_text_field( $params['source_page'] ?? '' );
	$ip        = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );

	if ( empty( $email ) && empty( $phone ) ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Please provide an email or phone number.' ), 400 );
	}

	// Rate-limiting: max 3 submissions per IP per hour
	$transient_key = 'sbgs_rl_' . md5( $ip );
	$count = (int) get_transient( $transient_key );
	if ( $count >= 3 ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Too many submissions. Please try again later.' ), 429 );
	}
	set_transient( $transient_key, $count + 1, HOUR_IN_SECONDS );

	$entry_id = SelfByGS_DB::insert_entry( array(
		'form_id'        => $form_id,
		'name'           => $name,
		'email'          => $email,
		'phone'          => $phone,
		'organisation'   => $org,
		'who'            => $who,
		'programs'       => implode( ', ', $programs ),
		'context'        => $context,
		'preferred_time' => $time_pref,
		'source_page'    => $page,
		'ip_address'     => $ip,
		'status'         => 'new',
	) );

	if ( ! $entry_id ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Server error. Please try again.' ), 500 );
	}

	$handler = new SelfByGS_Email_Handler();
	$handler->send_admin_notification( $entry_id );
	if ( ! empty( $email ) ) {
		$handler->send_user_confirmation( $entry_id );
	}

	return new WP_REST_Response( array(
		'success'   => true,
		'message'   => 'Thank you — we\'ll be in touch within one business day.',
		'entry_id'  => $entry_id,
	), 200 );
}

// ─── Admin Menu ───────────────────────────────────────────────────────────────
add_action( 'admin_menu', 'selfbygs_forms_admin_menu' );
function selfbygs_forms_admin_menu() {
	add_menu_page(
		__( 'SELF · Forms', 'selfbygs-forms' ),
		__( 'SELF Forms', 'selfbygs-forms' ),
		'manage_options',
		'selfbygs-forms',
		'selfbygs_render_entries_page',
		'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="2"/><path d="M19.07 4.93a10 10 0 1 0 0 14.14"/></svg>' ),
		26
	);

	add_submenu_page(
		'selfbygs-forms',
		__( 'All Entries', 'selfbygs-forms' ),
		__( 'All Entries', 'selfbygs-forms' ),
		'manage_options',
		'selfbygs-forms',
		'selfbygs_render_entries_page'
	);

	add_submenu_page(
		'selfbygs-forms',
		__( 'View Entry', 'selfbygs-forms' ),
		'',
		'manage_options',
		'selfbygs-entry-detail',
		'selfbygs_render_entry_detail_page'
	);

	add_submenu_page(
		'selfbygs-forms',
		__( 'Form Settings', 'selfbygs-forms' ),
		__( 'Form Settings', 'selfbygs-forms' ),
		'manage_options',
		'selfbygs-form-settings',
		'selfbygs_render_form_settings_page'
	);

	add_submenu_page(
		'selfbygs-forms',
		__( 'Email Templates', 'selfbygs-forms' ),
		__( 'Email Templates', 'selfbygs-forms' ),
		'manage_options',
		'selfbygs-email-templates',
		'selfbygs_render_email_templates_page'
	);
}

function selfbygs_render_entries_page() {
	require_once SELFBYGS_FORMS_DIR . 'admin/entries-list.php';
}
function selfbygs_render_entry_detail_page() {
	require_once SELFBYGS_FORMS_DIR . 'admin/entry-detail.php';
}
function selfbygs_render_form_settings_page() {
	require_once SELFBYGS_FORMS_DIR . 'admin/form-settings.php';
}
function selfbygs_render_email_templates_page() {
	require_once SELFBYGS_FORMS_DIR . 'admin/email-templates.php';
}

// ─── Admin Assets ─────────────────────────────────────────────────────────────
add_action( 'admin_enqueue_scripts', 'selfbygs_forms_admin_assets' );
function selfbygs_forms_admin_assets( $hook ) {
	if ( strpos( $hook, 'selfbygs' ) === false ) return;

	wp_enqueue_style(
		'selfbygs-forms-admin',
		SELFBYGS_FORMS_URL . 'assets/css/admin.css',
		array(),
		SELFBYGS_FORMS_VERSION
	);
	wp_enqueue_script(
		'selfbygs-forms-admin',
		SELFBYGS_FORMS_URL . 'assets/js/admin.js',
		array( 'jquery', 'jquery-ui-sortable' ),
		SELFBYGS_FORMS_VERSION,
		true
	);
	wp_localize_script( 'selfbygs-forms-admin', 'selfbygsFormsAdmin', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'selfbygs_forms_nonce' ),
		'strings' => array(
			'confirmDelete'  => __( 'Delete this entry? This cannot be undone.', 'selfbygs-forms' ),
			'replySent'      => __( 'Reply sent successfully.', 'selfbygs-forms' ),
			'settingsSaved'  => __( 'Settings saved.', 'selfbygs-forms' ),
		),
	) );
}

// ─── AJAX: send reply from entry detail ──────────────────────────────────────
add_action( 'wp_ajax_selfbygs_send_reply', 'selfbygs_ajax_send_reply' );
function selfbygs_ajax_send_reply() {
	check_ajax_referer( 'selfbygs_forms_nonce', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$entry_id = absint( $_POST['entry_id'] ?? 0 );
	$subject  = sanitize_text_field( $_POST['subject'] ?? '' );
	$body     = wp_kses_post( $_POST['body'] ?? '' );

	if ( ! $entry_id || ! $subject || ! $body ) {
		wp_send_json_error( 'Missing fields' );
	}

	$entry = SelfByGS_DB::get_entry( $entry_id );
	if ( ! $entry || empty( $entry->email ) ) {
		wp_send_json_error( 'Entry not found or no email' );
	}

	$handler = new SelfByGS_Email_Handler();
	$sent    = $handler->send_manual_reply( $entry->email, $entry->name, $subject, $body );

	if ( $sent ) {
		SelfByGS_DB::add_note( $entry_id, 'Reply sent: ' . $subject, get_current_user_id() );
		SelfByGS_DB::update_status( $entry_id, 'replied' );
		wp_send_json_success( 'Reply sent.' );
	} else {
		wp_send_json_error( 'Failed to send email.' );
	}
}

// ─── AJAX: add note ───────────────────────────────────────────────────────────
add_action( 'wp_ajax_selfbygs_add_note', 'selfbygs_ajax_add_note' );
function selfbygs_ajax_add_note() {
	check_ajax_referer( 'selfbygs_forms_nonce', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$entry_id = absint( $_POST['entry_id'] ?? 0 );
	$note     = sanitize_textarea_field( $_POST['note'] ?? '' );

	if ( ! $entry_id || ! $note ) {
		wp_send_json_error( 'Missing fields' );
	}

	SelfByGS_DB::add_note( $entry_id, $note, get_current_user_id() );
	wp_send_json_success( 'Note saved.' );
}

// ─── AJAX: update entry status ────────────────────────────────────────────────
add_action( 'wp_ajax_selfbygs_update_status', 'selfbygs_ajax_update_status' );
function selfbygs_ajax_update_status() {
	check_ajax_referer( 'selfbygs_forms_nonce', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$entry_id = absint( $_POST['entry_id'] ?? 0 );
	$status   = sanitize_text_field( $_POST['status'] ?? '' );
	$allowed  = array( 'new', 'contacted', 'replied', 'scheduled', 'converted', 'closed' );

	if ( ! $entry_id || ! in_array( $status, $allowed, true ) ) {
		wp_send_json_error( 'Invalid' );
	}

	SelfByGS_DB::update_status( $entry_id, $status );
	wp_send_json_success( 'Status updated.' );
}

// ─── AJAX: delete entry ───────────────────────────────────────────────────────
add_action( 'wp_ajax_selfbygs_delete_entry', 'selfbygs_ajax_delete_entry' );
function selfbygs_ajax_delete_entry() {
	check_ajax_referer( 'selfbygs_forms_nonce', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$entry_id = absint( $_POST['entry_id'] ?? 0 );
	if ( ! $entry_id ) {
		wp_send_json_error( 'Invalid' );
	}

	SelfByGS_DB::delete_entry( $entry_id );
	wp_send_json_success( 'Entry deleted.' );
}

// ─── AJAX: save form field settings ──────────────────────────────────────────
add_action( 'wp_ajax_selfbygs_save_form_settings', 'selfbygs_ajax_save_form_settings' );
function selfbygs_ajax_save_form_settings() {
	check_ajax_referer( 'selfbygs_forms_nonce', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$form_id = sanitize_text_field( $_POST['form_id'] ?? 'lead' );
	$fields  = $_POST['fields'] ?? array();
	$config  = $_POST['config'] ?? array();

	SelfByGS_Form_Settings::save( $form_id, $fields, $config );
	wp_send_json_success( 'Settings saved.' );
}

// ─── AJAX: save email template ────────────────────────────────────────────────
add_action( 'wp_ajax_selfbygs_save_email_template', 'selfbygs_ajax_save_email_template' );
function selfbygs_ajax_save_email_template() {
	check_ajax_referer( 'selfbygs_forms_nonce', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized' );
	}

	$tpl_id  = sanitize_text_field( $_POST['template_id'] ?? '' );
	$subject = sanitize_text_field( $_POST['subject'] ?? '' );
	$body    = wp_kses_post( $_POST['body'] ?? '' );

	update_option( 'selfbygs_email_tpl_' . $tpl_id, array(
		'subject' => $subject,
		'body'    => $body,
	) );
	wp_send_json_success( 'Template saved.' );
}

// ─── CSV Export ───────────────────────────────────────────────────────────────
add_action( 'admin_init', 'selfbygs_handle_csv_export' );
function selfbygs_handle_csv_export() {
	if ( ! isset( $_GET['selfbygs_export'] ) ) return;
	if ( ! current_user_can( 'manage_options' ) ) return;
	check_admin_referer( 'selfbygs_export' );

	$entries = SelfByGS_DB::get_entries( array( 'per_page' => 9999, 'page' => 1 ) );

	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename="selfbygs-leads-' . date( 'Y-m-d' ) . '.csv"' );

	$out = fopen( 'php://output', 'w' );
	fputcsv( $out, array( 'ID', 'Date', 'Form', 'Name', 'Email', 'Phone', 'Organisation', 'Who', 'Programs', 'Context', 'Preferred Time', 'Status', 'Source Page' ) );

	foreach ( $entries as $e ) {
		fputcsv( $out, array(
			$e->id, $e->created_at, $e->form_id, $e->name, $e->email, $e->phone,
			$e->organisation, $e->who, $e->programs, $e->context,
			$e->preferred_time, $e->status, $e->source_page,
		) );
	}
	fclose( $out );
	exit;
}
