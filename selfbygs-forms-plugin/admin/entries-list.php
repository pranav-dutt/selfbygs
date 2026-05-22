<?php
/**
 * Admin: All Entries list view
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$per_page    = 20;
$current_page = absint( $_GET['paged'] ?? 1 );
$search      = sanitize_text_field( $_GET['s'] ?? '' );
$status      = sanitize_text_field( $_GET['status'] ?? '' );
$form_filter = sanitize_text_field( $_GET['form_id'] ?? '' );

$counts  = SelfByGS_DB::get_counts_by_status();
$total   = $counts['all'] ?? 0;
$entries = SelfByGS_DB::get_entries( array(
	'per_page' => $per_page,
	'page'     => $current_page,
	'search'   => $search,
	'status'   => $status,
	'form_id'  => $form_filter,
) );
$total_filtered = SelfByGS_DB::count_entries( array(
	'search'  => $search,
	'status'  => $status,
	'form_id' => $form_filter,
) );

$statuses = array( 'new' => 'New', 'contacted' => 'Contacted', 'replied' => 'Replied', 'scheduled' => 'Scheduled', 'converted' => 'Converted', 'closed' => 'Closed' );
$base_url = admin_url( 'admin.php?page=selfbygs-forms' );
$export_nonce = wp_create_nonce( 'selfbygs_export' );

?>
<div class="wrap sbgs-admin">
  <h1 class="sbgs-page-title">SELF · Form Entries <span class="sbgs-dot"></span></h1>

  <!-- Status tabs -->
  <div class="sbgs-tabs">
    <a href="<?php echo esc_url( $base_url ); ?>" class="sbgs-tab <?php echo ! $status ? 'is-active' : ''; ?>">
      All <span class="sbgs-count"><?php echo esc_html( $counts['all'] ?? 0 ); ?></span>
    </a>
    <?php foreach ( $statuses as $slug => $label ) : ?>
    <a href="<?php echo esc_url( add_query_arg( 'status', $slug, $base_url ) ); ?>" class="sbgs-tab <?php echo $status === $slug ? 'is-active' : ''; ?>">
      <?php echo esc_html( $label ); ?> <span class="sbgs-count"><?php echo esc_html( $counts[ $slug ] ?? 0 ); ?></span>
    </a>
    <?php endforeach; ?>
  </div>

  <!-- Toolbar -->
  <div class="sbgs-toolbar">
    <form method="get" action="">
      <input type="hidden" name="page" value="selfbygs-forms" />
      <?php if ( $status ) : ?><input type="hidden" name="status" value="<?php echo esc_attr( $status ); ?>" /><?php endif; ?>
      <div class="sbgs-search-wrap">
        <input type="search" name="s" value="<?php echo esc_attr( $search ); ?>" placeholder="Search name, email, phone…" class="sbgs-search-input" />
        <button type="submit" class="sbgs-btn sbgs-btn--outline">Search</button>
      </div>
    </form>
    <div class="sbgs-toolbar-right">
      <a href="<?php echo esc_url( add_query_arg( array( 'selfbygs_export' => '1', '_wpnonce' => $export_nonce ), admin_url( 'admin.php' ) ) ); ?>" class="sbgs-btn sbgs-btn--ghost">↓ Export CSV</a>
    </div>
  </div>

  <!-- Table -->
  <?php if ( $entries ) : ?>
  <div class="sbgs-table-wrap">
    <table class="sbgs-table">
      <thead>
        <tr>
          <th style="width:40px;"><input type="checkbox" id="sbgs-check-all" /></th>
          <th>#</th>
          <th>Name</th>
          <th>Contact</th>
          <th>Who / Programs</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ( $entries as $e ) : ?>
        <tr class="sbgs-row status-<?php echo esc_attr( $e->status ); ?>" data-id="<?php echo (int) $e->id; ?>">
          <td><input type="checkbox" name="entry_ids[]" value="<?php echo (int) $e->id; ?>" /></td>
          <td class="sbgs-id">#<?php echo (int) $e->id; ?></td>
          <td class="sbgs-name">
            <strong><?php echo esc_html( $e->name ?: '—' ); ?></strong>
            <?php if ( $e->organisation ) : ?>
            <br><span class="sbgs-org"><?php echo esc_html( $e->organisation ); ?></span>
            <?php endif; ?>
          </td>
          <td class="sbgs-contact">
            <?php if ( $e->email ) : ?><a href="mailto:<?php echo esc_attr( $e->email ); ?>"><?php echo esc_html( $e->email ); ?></a><br><?php endif; ?>
            <?php if ( $e->phone ) : ?><a href="tel:<?php echo esc_attr( $e->phone ); ?>"><?php echo esc_html( $e->phone ); ?></a><?php endif; ?>
          </td>
          <td class="sbgs-programs">
            <?php if ( $e->who ) : ?><span class="sbgs-who-chip"><?php echo esc_html( $e->who ); ?></span><?php endif; ?>
            <?php if ( $e->programs ) : ?><span class="sbgs-prog-text"><?php echo esc_html( $e->programs ); ?></span><?php endif; ?>
          </td>
          <td class="sbgs-status-cell">
            <select class="sbgs-status-select sbgs-inline-select" data-id="<?php echo (int) $e->id; ?>">
              <?php foreach ( $statuses as $slug => $label ) : ?>
              <option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $e->status, $slug ); ?>><?php echo esc_html( $label ); ?></option>
              <?php endforeach; ?>
            </select>
          </td>
          <td class="sbgs-date"><?php echo esc_html( mysql2date( 'M j, Y', $e->created_at ) ); ?></td>
          <td class="sbgs-actions">
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=selfbygs-entry-detail&id=' . (int) $e->id ) ); ?>" class="sbgs-action-btn sbgs-action-view" title="View">View</a>
            <button type="button" class="sbgs-action-btn sbgs-action-delete sbgs-delete-btn" data-id="<?php echo (int) $e->id; ?>" title="Delete">✕</button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <?php
  $total_pages = ceil( $total_filtered / $per_page );
  if ( $total_pages > 1 ) :
  ?>
  <div class="sbgs-pagination">
    <?php for ( $i = 1; $i <= $total_pages; $i++ ) : ?>
    <a href="<?php echo esc_url( add_query_arg( 'paged', $i, $base_url . ( $status ? '&status=' . urlencode( $status ) : '' ) . ( $search ? '&s=' . urlencode( $search ) : '' ) ) ); ?>" class="sbgs-page-btn <?php echo $i === $current_page ? 'is-active' : ''; ?>"><?php echo (int) $i; ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>

  <?php else : ?>
  <div class="sbgs-empty">
    <p>No entries found<?php echo $search ? ' for "<strong>' . esc_html( $search ) . '</strong>"' : ''; ?>.</p>
  </div>
  <?php endif; ?>
</div>
