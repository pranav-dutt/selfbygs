<?php
/**
 * Admin: Single entry detail view
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$entry_id = absint( $_GET['id'] ?? 0 );
if ( ! $entry_id ) {
	wp_redirect( admin_url( 'admin.php?page=selfbygs-forms' ) );
	exit;
}

$entry = SelfByGS_DB::get_entry( $entry_id );
if ( ! $entry ) {
	wp_die( esc_html__( 'Entry not found.', 'selfbygs-forms' ) );
}

$notes    = SelfByGS_DB::get_notes( $entry_id );
$statuses = array( 'new' => 'New', 'contacted' => 'Contacted', 'replied' => 'Replied', 'scheduled' => 'Scheduled', 'converted' => 'Converted', 'closed' => 'Closed' );
$nonce    = wp_create_nonce( 'selfbygs_forms_nonce' );

?>
<div class="wrap sbgs-admin sbgs-detail">
  <div class="sbgs-detail-header">
    <a href="<?php echo esc_url( admin_url( 'admin.php?page=selfbygs-forms' ) ); ?>" class="sbgs-back-link">← All Entries</a>
    <h1 class="sbgs-page-title">Entry #<?php echo (int) $entry->id; ?> <span class="sbgs-dot"></span></h1>
    <div class="sbgs-detail-meta">
      <span class="sbgs-status-badge status-<?php echo esc_attr( $entry->status ); ?>"><?php echo esc_html( $statuses[ $entry->status ] ?? $entry->status ); ?></span>
      <span class="sbgs-date-meta"><?php echo esc_html( mysql2date( 'M j, Y · g:i a', $entry->created_at ) ); ?></span>
    </div>
  </div>

  <div class="sbgs-detail-grid">
    <!-- Left: entry data -->
    <div class="sbgs-detail-main">
      <div class="sbgs-card">
        <h2 class="sbgs-card-title">Lead Information</h2>
        <div class="sbgs-field-grid">
          <div class="sbgs-field">
            <span class="sbgs-field-label">Name</span>
            <span class="sbgs-field-value"><?php echo esc_html( $entry->name ?: '—' ); ?></span>
          </div>
          <div class="sbgs-field">
            <span class="sbgs-field-label">Email</span>
            <span class="sbgs-field-value">
              <?php if ( $entry->email ) : ?>
              <a href="mailto:<?php echo esc_attr( $entry->email ); ?>"><?php echo esc_html( $entry->email ); ?></a>
              <?php else : ?>—<?php endif; ?>
            </span>
          </div>
          <div class="sbgs-field">
            <span class="sbgs-field-label">Phone</span>
            <span class="sbgs-field-value">
              <?php if ( $entry->phone ) : ?>
              <a href="tel:<?php echo esc_attr( $entry->phone ); ?>"><?php echo esc_html( $entry->phone ); ?></a>
              <?php else : ?>—<?php endif; ?>
            </span>
          </div>
          <div class="sbgs-field">
            <span class="sbgs-field-label">Organisation</span>
            <span class="sbgs-field-value"><?php echo esc_html( $entry->organisation ?: '—' ); ?></span>
          </div>
          <div class="sbgs-field sbgs-field--full">
            <span class="sbgs-field-label">Who</span>
            <span class="sbgs-field-value"><?php echo esc_html( $entry->who ?: '—' ); ?></span>
          </div>
          <div class="sbgs-field sbgs-field--full">
            <span class="sbgs-field-label">Programs Interested</span>
            <span class="sbgs-field-value"><?php echo esc_html( $entry->programs ?: '—' ); ?></span>
          </div>
          <div class="sbgs-field">
            <span class="sbgs-field-label">Preferred Time</span>
            <span class="sbgs-field-value"><?php echo esc_html( $entry->preferred_time ?: '—' ); ?></span>
          </div>
          <div class="sbgs-field">
            <span class="sbgs-field-label">Source Page</span>
            <span class="sbgs-field-value"><?php echo esc_html( $entry->source_page ?: '—' ); ?></span>
          </div>
          <?php if ( $entry->context ) : ?>
          <div class="sbgs-field sbgs-field--full">
            <span class="sbgs-field-label">Context (in their words)</span>
            <blockquote class="sbgs-context-quote"><?php echo nl2br( esc_html( $entry->context ) ); ?></blockquote>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Status control -->
      <div class="sbgs-card sbgs-card--inline">
        <span class="sbgs-card-title">Status</span>
        <select class="sbgs-status-select" id="sbgs-status-main" data-id="<?php echo (int) $entry->id; ?>">
          <?php foreach ( $statuses as $slug => $label ) : ?>
          <option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $entry->status, $slug ); ?>><?php echo esc_html( $label ); ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Reply form -->
      <?php if ( $entry->email ) : ?>
      <div class="sbgs-card" id="sbgs-reply-card">
        <h2 class="sbgs-card-title">Send Reply</h2>
        <div class="sbgs-field">
          <label for="sbgs-reply-subject" class="sbgs-field-label">Subject</label>
          <input type="text" id="sbgs-reply-subject" class="sbgs-input" value="Re: Your inquiry — SELF by GS" />
        </div>
        <div class="sbgs-field">
          <label for="sbgs-reply-body" class="sbgs-field-label">Message</label>
          <?php
          wp_editor( "Dear {$entry->name},\n\nThank you for reaching out to SELF by GS.\n\n\n\nWarm regards,\nGaurav Sharma\nSELF by GS · Gaurav Sharma & Associates\nnamaste@selfbygs.com", 'sbgs-reply-body', array(
            'textarea_name' => 'sbgs_reply_body',
            'media_buttons'  => false,
            'teeny'          => true,
            'textarea_rows'  => 10,
          ) );
          ?>
        </div>
        <div class="sbgs-field-actions">
          <button type="button" id="sbgs-send-reply" class="sbgs-btn sbgs-btn--gold" data-id="<?php echo (int) $entry->id; ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">
            Send Email Reply <span class="sbgs-arrow">→</span>
          </button>
          <span class="sbgs-reply-status" id="sbgs-reply-msg"></span>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Right: notes -->
    <div class="sbgs-detail-sidebar">
      <div class="sbgs-card">
        <h2 class="sbgs-card-title">Internal Notes</h2>

        <div class="sbgs-notes-list" id="sbgs-notes-list">
          <?php if ( $notes ) : ?>
            <?php foreach ( $notes as $note ) : ?>
            <div class="sbgs-note">
              <p class="sbgs-note-text"><?php echo nl2br( esc_html( $note->note ) ); ?></p>
              <div class="sbgs-note-meta">
                <?php echo esc_html( $note->display_name ?: 'Admin' ); ?> · <?php echo esc_html( mysql2date( 'M j, Y g:i a', $note->created_at ) ); ?>
              </div>
            </div>
            <?php endforeach; ?>
          <?php else : ?>
          <p class="sbgs-no-notes">No notes yet.</p>
          <?php endif; ?>
        </div>

        <div class="sbgs-add-note">
          <textarea id="sbgs-note-input" class="sbgs-textarea" rows="3" placeholder="Add an internal note…"></textarea>
          <button type="button" id="sbgs-save-note" class="sbgs-btn sbgs-btn--outline" data-id="<?php echo (int) $entry->id; ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">Add Note</button>
        </div>
      </div>

      <div class="sbgs-card sbgs-card--meta">
        <h2 class="sbgs-card-title">Metadata</h2>
        <div class="sbgs-field">
          <span class="sbgs-field-label">Form</span>
          <span class="sbgs-field-value"><?php echo esc_html( $entry->form_id ); ?></span>
        </div>
        <div class="sbgs-field">
          <span class="sbgs-field-label">IP Address</span>
          <span class="sbgs-field-value"><?php echo esc_html( $entry->ip_address ?: '—' ); ?></span>
        </div>
        <div class="sbgs-field">
          <span class="sbgs-field-label">Submitted</span>
          <span class="sbgs-field-value"><?php echo esc_html( mysql2date( 'M j, Y · g:i a T', $entry->created_at ) ); ?></span>
        </div>
        <div class="sbgs-field">
          <span class="sbgs-field-label">Last Updated</span>
          <span class="sbgs-field-value"><?php echo esc_html( mysql2date( 'M j, Y · g:i a T', $entry->updated_at ) ); ?></span>
        </div>
        <div style="margin-top:20px;">
          <?php if ( $entry->email ) : ?>
          <a href="mailto:<?php echo esc_attr( $entry->email ); ?>" class="sbgs-btn sbgs-btn--outline sbgs-btn--sm" style="margin-right:8px;">Email</a>
          <?php endif; ?>
          <?php if ( $entry->phone ) : ?>
          <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $entry->phone ) ); ?>" target="_blank" rel="noopener" class="sbgs-btn sbgs-btn--outline sbgs-btn--sm">WhatsApp</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="sbgs-card sbgs-card--danger">
        <button type="button" class="sbgs-btn sbgs-btn--danger sbgs-delete-btn" data-id="<?php echo (int) $entry->id; ?>" data-redirect="<?php echo esc_url( admin_url( 'admin.php?page=selfbygs-forms' ) ); ?>">
          Delete Entry
        </button>
      </div>
    </div>
  </div>
</div>
