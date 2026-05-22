<?php
/**
 * Email sending for SELF by GS Forms.
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SelfByGS_Email_Handler {

	private $from_name;
	private $from_email;
	private $admin_email;
	private $brand_gold = '#C9A24D';

	public function __construct() {
		$this->from_name   = get_option( 'selfbygs_email_from_name',  'SELF by GS · Gaurav Sharma & Associates' );
		$this->from_email  = get_option( 'selfbygs_email_from',       'namaste@selfbygs.com' );
		$this->admin_email = get_option( 'selfbygs_admin_notify_email', get_option( 'admin_email' ) );
	}

	public function send_admin_notification( $entry_id ) {
		$entry = SelfByGS_DB::get_entry( $entry_id );
		if ( ! $entry ) return false;

		$tpl     = get_option( 'selfbygs_email_tpl_admin_notification', array() );
		$subject = $tpl['subject'] ?? '[SELF · New Lead] {name} — {form_id}';
		$subject = $this->replace_tokens( $subject, $entry );
		$body    = $tpl['body'] ?? '';

		if ( ! $body ) {
			$body = $this->default_admin_body( $entry );
		} else {
			$body = $this->replace_tokens( $body, $entry );
		}

		return $this->send(
			$this->admin_email,
			'SELF Admin',
			$subject,
			$this->wrap_html( $body, 'dark' )
		);
	}

	public function send_user_confirmation( $entry_id ) {
		$entry = SelfByGS_DB::get_entry( $entry_id );
		if ( ! $entry || ! $entry->email ) return false;

		$tpl     = get_option( 'selfbygs_email_tpl_user_confirmation', array() );
		$subject = $tpl['subject'] ?? 'Thank you, {name} — SELF by GS';
		$subject = $this->replace_tokens( $subject, $entry );
		$body    = $tpl['body'] ?? '';

		if ( ! $body ) {
			$body = $this->default_user_body( $entry );
		} else {
			$body = $this->replace_tokens( $body, $entry );
		}

		return $this->send(
			$entry->email,
			$entry->name,
			$subject,
			$this->wrap_html( $body, 'light' )
		);
	}

	public function send_manual_reply( $to_email, $to_name, $subject, $body ) {
		return $this->send( $to_email, $to_name, $subject, $this->wrap_html( $body, 'light' ) );
	}

	private function send( $to, $to_name, $subject, $html_body ) {
		add_filter( 'wp_mail_from',      array( $this, 'filter_from_email' ) );
		add_filter( 'wp_mail_from_name', array( $this, 'filter_from_name' ) );
		add_filter( 'wp_mail_content_type', array( $this, 'filter_content_type' ) );

		$result = wp_mail( $to, $subject, $html_body );

		remove_filter( 'wp_mail_from',      array( $this, 'filter_from_email' ) );
		remove_filter( 'wp_mail_from_name', array( $this, 'filter_from_name' ) );
		remove_filter( 'wp_mail_content_type', array( $this, 'filter_content_type' ) );

		return $result;
	}

	public function filter_from_email()    { return $this->from_email; }
	public function filter_from_name()     { return $this->from_name; }
	public function filter_content_type()  { return 'text/html'; }

	private function replace_tokens( $text, $entry ) {
		$tokens = array(
			'{name}'           => esc_html( $entry->name ),
			'{email}'          => esc_html( $entry->email ),
			'{phone}'          => esc_html( $entry->phone ),
			'{organisation}'   => esc_html( $entry->organisation ),
			'{who}'            => esc_html( $entry->who ),
			'{programs}'       => esc_html( $entry->programs ),
			'{context}'        => esc_html( $entry->context ),
			'{preferred_time}' => esc_html( $entry->preferred_time ),
			'{source_page}'    => esc_html( $entry->source_page ),
			'{form_id}'        => esc_html( $entry->form_id ),
			'{status}'         => esc_html( $entry->status ),
			'{date}'           => esc_html( $entry->created_at ),
			'{entry_id}'       => (int) $entry->id,
			'{site_name}'      => esc_html( get_bloginfo( 'name' ) ),
			'{site_url}'       => esc_url( home_url() ),
		);
		return str_replace( array_keys( $tokens ), array_values( $tokens ), $text );
	}

	private function default_admin_body( $entry ) {
		$admin_url = admin_url( 'admin.php?page=selfbygs-entry-detail&id=' . (int) $entry->id );
		return "
<h2 style='color:{$this->brand_gold};font-family:Georgia,serif;margin:0 0 24px;'>New Lead · #{$entry->id}</h2>
<table style='width:100%;border-collapse:collapse;font-size:15px;'>
  <tr><td style='padding:8px 0;color:#666;width:180px;'>Name</td><td style='padding:8px 0;font-weight:600;'>" . esc_html( $entry->name ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Email</td><td style='padding:8px 0;'><a href='mailto:" . esc_html( $entry->email ) . "' style='color:{$this->brand_gold};'>" . esc_html( $entry->email ) . "</a></td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Phone</td><td style='padding:8px 0;'>" . esc_html( $entry->phone ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Organisation</td><td style='padding:8px 0;'>" . esc_html( $entry->organisation ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Who</td><td style='padding:8px 0;'>" . esc_html( $entry->who ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Programs</td><td style='padding:8px 0;'>" . esc_html( $entry->programs ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Preferred Time</td><td style='padding:8px 0;'>" . esc_html( $entry->preferred_time ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Source Page</td><td style='padding:8px 0;'>" . esc_html( $entry->source_page ) . "</td></tr>
  <tr><td style='padding:8px 0;color:#666;'>Context</td><td style='padding:8px 0;font-style:italic;'>" . nl2br( esc_html( $entry->context ) ) . "</td></tr>
</table>
<div style='margin:32px 0 0;'>
  <a href='" . esc_url( $admin_url ) . "' style='background:{$this->brand_gold};color:#07070A;text-decoration:none;padding:12px 24px;font-family:Georgia,serif;font-size:14px;letter-spacing:0.08em;display:inline-block;'>View Entry →</a>
</div>
";
	}

	private function default_user_body( $entry ) {
		$name = $entry->name ? $entry->name : 'there';
		return "
<h2 style='color:{$this->brand_gold};font-family:Georgia,serif;margin:0 0 20px;font-weight:400;font-style:italic;font-size:28px;'>Thank you, {$name}.</h2>
<p style='font-size:16px;line-height:1.7;color:#555;margin:0 0 18px;'>We've received your request and we'll be in touch within one business day with a personal note from the SELF team.</p>
<p style='font-size:15px;line-height:1.7;color:#777;margin:0 0 18px;font-style:italic;'>A short, honest conversation. We listen first, then we tell you whether SELF is a fit — or what is.</p>
<div style='margin:32px 0;padding:24px;background:#F6F0E4;border-left:3px solid {$this->brand_gold};'>
  <p style='margin:0;font-size:14px;letter-spacing:0.3em;text-transform:uppercase;color:#666;font-family:Georgia,serif;'>What you requested</p>
  <p style='margin:10px 0 0;font-size:16px;color:#111;'>" . esc_html( $entry->programs ?: 'Clarity Call' ) . "</p>
</div>
<p style='font-size:13px;color:#999;margin:32px 0 0;'>Questions? Write to us at <a href='mailto:namaste@selfbygs.com' style='color:{$this->brand_gold};'>namaste@selfbygs.com</a> or WhatsApp <a href='https://wa.me/+917891122201' style='color:{$this->brand_gold};'>+91 78911 22201</a>.</p>
";
	}

	private function wrap_html( $content, $theme = 'light' ) {
		$bg    = ( 'dark' === $theme ) ? '#0E0E10' : '#F6F0E4';
		$color = ( 'dark' === $theme ) ? '#E8E4DA' : '#15140F';
		$site  = esc_url( home_url() );

		return "<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width,initial-scale=1'></head>
<body style='margin:0;padding:0;background:{$bg};font-family:Georgia,serif;color:{$color};'>
  <div style='max-width:640px;margin:0 auto;padding:48px 24px;'>
    <!-- Header -->
    <div style='text-align:center;margin-bottom:48px;padding-bottom:32px;border-bottom:1px solid rgba(201,162,77,0.3);'>
      <a href='{$site}' style='text-decoration:none;'>
        <span style='font-family:Georgia,serif;font-size:28px;letter-spacing:0.38em;color:{$this->brand_gold};font-weight:400;'>SELF</span>
      </a>
      <div style='font-size:10px;letter-spacing:0.36em;text-transform:uppercase;color:" . ( 'dark' === $theme ? '#B8B3A6' : 'rgba(21,20,15,0.5)' ) . ";margin-top:8px;'>by Gaurav Sharma &amp; Associates</div>
    </div>
    <!-- Body -->
    <div style='line-height:1.7;'>{$content}</div>
    <!-- Footer -->
    <div style='margin-top:48px;padding-top:28px;border-top:1px solid rgba(201,162,77,0.2);text-align:center;'>
      <p style='font-size:11px;letter-spacing:0.24em;text-transform:uppercase;color:" . ( 'dark' === $theme ? '#B8B3A6' : 'rgba(21,20,15,0.45)' ) . ";margin:0;'>SELF by GS · Jaipur · India · Remote</p>
      <p style='font-size:11px;color:" . ( 'dark' === $theme ? '#B8B3A6' : 'rgba(21,20,15,0.45)' ) . ";margin:8px 0 0;'>
        <a href='mailto:namaste@selfbygs.com' style='color:{$this->brand_gold};text-decoration:none;'>namaste@selfbygs.com</a>
      </p>
    </div>
  </div>
</body>
</html>";
	}
}
