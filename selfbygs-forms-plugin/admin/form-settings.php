<?php
/**
 * Admin: Form field settings / drag-reorder
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$forms       = SelfByGS_Form_Settings::get_all_forms();
$active_form = sanitize_text_field( $_GET['form_id'] ?? 'lead' );
if ( ! array_key_exists( $active_form, $forms ) ) {
	$active_form = 'lead';
}
$settings = SelfByGS_Form_Settings::get( $active_form );
$fields   = $settings['fields'] ?? array();
$config   = $settings['config'] ?? array();
$nonce    = wp_create_nonce( 'selfbygs_forms_nonce' );

$field_types = array( 'text', 'email', 'tel', 'number', 'textarea', 'select', 'chips', 'checkbox', 'radio' );

?>
<div class="wrap sbgs-admin">
  <h1 class="sbgs-page-title">Form Settings <span class="sbgs-dot"></span></h1>

  <!-- Form selector tabs -->
  <div class="sbgs-tabs">
    <?php foreach ( $forms as $id => $form ) : ?>
    <a href="<?php echo esc_url( admin_url( 'admin.php?page=selfbygs-form-settings&form_id=' . urlencode( $id ) ) ); ?>" class="sbgs-tab <?php echo $id === $active_form ? 'is-active' : ''; ?>">
      <?php echo esc_html( $form['label'] ); ?>
    </a>
    <?php endforeach; ?>
  </div>

  <form id="sbgs-form-settings-form" data-form-id="<?php echo esc_attr( $active_form ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">

    <!-- General config -->
    <div class="sbgs-card" style="margin-bottom:24px;">
      <h2 class="sbgs-card-title">General</h2>
      <div class="sbgs-field-grid">
        <div class="sbgs-field">
          <label class="sbgs-field-label">Admin Label</label>
          <input type="text" name="config[admin_label]" class="sbgs-input" value="<?php echo esc_attr( $config['admin_label'] ?? '' ); ?>" />
        </div>
        <div class="sbgs-field">
          <label class="sbgs-field-label">Notification Email</label>
          <input type="email" name="config[notify_email]" class="sbgs-input" value="<?php echo esc_attr( $config['notify_email'] ?? '' ); ?>" />
        </div>
        <div class="sbgs-field sbgs-field--full">
          <label class="sbgs-field-label">Success Message</label>
          <input type="text" name="config[success_msg]" class="sbgs-input" value="<?php echo esc_attr( $config['success_msg'] ?? '' ); ?>" />
        </div>
      </div>
    </div>

    <!-- Fields drag-and-drop editor -->
    <div class="sbgs-card">
      <div class="sbgs-card-header">
        <h2 class="sbgs-card-title">Form Fields</h2>
        <p class="sbgs-card-sub">Drag rows to reorder. Toggle "Enabled" to show/hide fields. Click a row to edit.</p>
      </div>

      <div id="sbgs-fields-list" class="sbgs-fields-list">
        <?php foreach ( $fields as $i => $field ) : ?>
        <div class="sbgs-field-row" data-index="<?php echo (int) $i; ?>">
          <span class="sbgs-drag-handle" title="Drag to reorder">⠿</span>

          <label class="sbgs-field-row-label">
            <input type="checkbox" name="fields[<?php echo (int) $i; ?>][enabled]" value="1" <?php checked( ! empty( $field['enabled'] ) ); ?> class="sbgs-toggle-enabled" />
            Enabled
          </label>

          <span class="sbgs-field-row-key"><?php echo esc_html( $field['key'] ); ?></span>
          <span class="sbgs-field-row-type"><?php echo esc_html( $field['type'] ); ?></span>
          <span class="sbgs-field-row-name"><?php echo esc_html( $field['label'] ); ?></span>

          <label class="sbgs-field-row-label">
            <input type="checkbox" name="fields[<?php echo (int) $i; ?>][required]" value="1" <?php checked( ! empty( $field['required'] ) ); ?> />
            Required
          </label>

          <input type="hidden" name="fields[<?php echo (int) $i; ?>][key]" value="<?php echo esc_attr( $field['key'] ); ?>" />
          <input type="hidden" name="fields[<?php echo (int) $i; ?>][type]" value="<?php echo esc_attr( $field['type'] ); ?>" />
          <input type="hidden" name="fields[<?php echo (int) $i; ?>][label]" value="<?php echo esc_attr( $field['label'] ); ?>" />
          <input type="hidden" name="fields[<?php echo (int) $i; ?>][placeholder]" value="<?php echo esc_attr( $field['placeholder'] ?? '' ); ?>" />
          <?php foreach ( ( $field['options'] ?? array() ) as $opt ) : ?>
          <input type="hidden" name="fields[<?php echo (int) $i; ?>][options][]" value="<?php echo esc_attr( $opt ); ?>" />
          <?php endforeach; ?>

          <button type="button" class="sbgs-action-btn sbgs-edit-field-btn" data-index="<?php echo (int) $i; ?>">Edit</button>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Inline field editor (shown on Edit click) -->
      <div id="sbgs-field-editor" class="sbgs-field-editor" style="display:none;">
        <h3>Edit Field</h3>
        <div class="sbgs-field-grid">
          <div class="sbgs-field">
            <label class="sbgs-field-label">Key (no spaces)</label>
            <input type="text" id="sfe-key" class="sbgs-input" />
          </div>
          <div class="sbgs-field">
            <label class="sbgs-field-label">Label</label>
            <input type="text" id="sfe-label" class="sbgs-input" />
          </div>
          <div class="sbgs-field">
            <label class="sbgs-field-label">Type</label>
            <select id="sfe-type" class="sbgs-select">
              <?php foreach ( $field_types as $type ) : ?>
              <option value="<?php echo esc_attr( $type ); ?>"><?php echo esc_html( $type ); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="sbgs-field">
            <label class="sbgs-field-label">Placeholder</label>
            <input type="text" id="sfe-placeholder" class="sbgs-input" />
          </div>
          <div class="sbgs-field sbgs-field--full" id="sfe-options-wrap">
            <label class="sbgs-field-label">Options (one per line, for chips/select/radio)</label>
            <textarea id="sfe-options" class="sbgs-textarea" rows="5"></textarea>
          </div>
        </div>
        <div class="sbgs-field-actions">
          <button type="button" id="sfe-apply" class="sbgs-btn sbgs-btn--gold">Apply Changes</button>
          <button type="button" id="sfe-cancel" class="sbgs-btn sbgs-btn--ghost">Cancel</button>
        </div>
      </div>
    </div>

    <div class="sbgs-form-actions">
      <button type="button" id="sbgs-save-settings" class="sbgs-btn sbgs-btn--gold">Save Settings <span class="sbgs-arrow">→</span></button>
      <span class="sbgs-save-msg" id="sbgs-save-msg"></span>
    </div>

  </form>
</div>
