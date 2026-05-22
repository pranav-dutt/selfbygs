<?php
/**
 * Admin: Email Templates editor
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$templates = array(
	'admin_notification' => array(
		'label'           => 'Admin Notification',
		'description'     => 'Sent to admin when a new form entry arrives.',
		'default_subject' => '[SELF · New Lead] {name} — {form_id}',
	),
	'user_confirmation' => array(
		'label'           => 'User Confirmation',
		'description'     => 'Sent to the lead after successful form submission.',
		'default_subject' => 'Thank you, {name} — SELF by GS',
	),
);

$active_tpl = sanitize_text_field( $_GET['tpl'] ?? 'admin_notification' );
if ( ! array_key_exists( $active_tpl, $templates ) ) {
	$active_tpl = 'admin_notification';
}

$saved   = get_option( 'selfbygs_email_tpl_' . $active_tpl, array() );
$subject = $saved['subject'] ?? $templates[ $active_tpl ]['default_subject'];
$body    = $saved['body'] ?? '';
$nonce   = wp_create_nonce( 'selfbygs_forms_nonce' );

$tokens = array(
	'{name}', '{email}', '{phone}', '{organisation}', '{who}', '{programs}',
	'{context}', '{preferred_time}', '{source_page}', '{form_id}', '{status}',
	'{date}', '{entry_id}', '{site_name}', '{site_url}',
);

?>
<div class="wrap sbgs-admin">
  <h1 class="sbgs-page-title">Email Templates <span class="sbgs-dot"></span></h1>

  <!-- Template selector tabs -->
  <div class="sbgs-tabs">
    <?php foreach ( $templates as $id => $tpl ) : ?>
    <a href="<?php echo esc_url( admin_url( 'admin.php?page=selfbygs-email-templates&tpl=' . urlencode( $id ) ) ); ?>" class="sbgs-tab <?php echo $id === $active_tpl ? 'is-active' : ''; ?>">
      <?php echo esc_html( $tpl['label'] ); ?>
    </a>
    <?php endforeach; ?>
  </div>

  <div class="sbgs-card" style="margin-bottom:20px;">
    <p class="sbgs-card-sub"><?php echo esc_html( $templates[ $active_tpl ]['description'] ); ?></p>
    <p class="sbgs-card-sub" style="margin-top:8px;"><strong>Available tokens:</strong>
      <?php foreach ( $tokens as $token ) : ?>
      <code class="sbgs-token"><?php echo esc_html( $token ); ?></code>
      <?php endforeach; ?>
    </p>
    <p class="sbgs-card-sub" style="margin-top:8px;color:#999;">Leave body blank to use the built-in default template.</p>
  </div>

  <form id="sbgs-email-tpl-form" data-template-id="<?php echo esc_attr( $active_tpl ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">

    <div class="sbgs-card">
      <div class="sbgs-field" style="margin-bottom:24px;">
        <label class="sbgs-field-label">Subject Line</label>
        <input type="text" id="sbgs-tpl-subject" class="sbgs-input sbgs-input--full" value="<?php echo esc_attr( $subject ); ?>" />
      </div>

      <div class="sbgs-field">
        <label class="sbgs-field-label">Body (HTML)</label>
        <?php
        wp_editor( $body, 'sbgs-tpl-body', array(
          'textarea_name' => 'sbgs_tpl_body',
          'media_buttons'  => false,
          'teeny'          => false,
          'textarea_rows'  => 16,
          'tinymce'        => array(
            'toolbar1' => 'bold italic underline | link unlink | bullist numlist | blockquote | code | removeformat',
          ),
        ) );
        ?>
      </div>
    </div>

    <div class="sbgs-form-actions">
      <button type="button" id="sbgs-save-email-tpl" class="sbgs-btn sbgs-btn--gold">Save Template <span class="sbgs-arrow">→</span></button>
      <span class="sbgs-save-msg" id="sbgs-tpl-save-msg"></span>
    </div>

    <div style="margin-top:32px;">
      <button type="button" id="sbgs-preview-email" class="sbgs-btn sbgs-btn--ghost">Preview Email →</button>
    </div>

  </form>

  <!-- Preview Modal -->
  <div id="sbgs-preview-modal" class="sbgs-modal" style="display:none;" role="dialog" aria-modal="true">
    <div class="sbgs-modal-backdrop"></div>
    <div class="sbgs-modal-inner">
      <div class="sbgs-modal-header">
        <h3>Email Preview</h3>
        <button class="sbgs-modal-close" aria-label="Close">✕</button>
      </div>
      <div class="sbgs-modal-body">
        <iframe id="sbgs-preview-frame" style="width:100%;height:480px;border:none;background:#fff;"></iframe>
      </div>
    </div>
  </div>
</div>
