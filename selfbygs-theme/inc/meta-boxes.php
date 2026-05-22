<?php
/**
 * SELF by GS — Page Meta Boxes
 *
 * Registers meta fields for pages using custom page templates.
 * Used by program pages, corporate, academia, etc.
 *
 * @package selfbygs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Register Page Meta ───────────────────────────────────────────────────────
function selfbygs_register_page_meta() {
	$page_meta_fields = array(
		'_sbgs_hero_eyebrow'          => 'string',
		'_sbgs_hero_headline_1'       => 'string',
		'_sbgs_hero_headline_2'       => 'string',
		'_sbgs_hero_tagline'          => 'string',
		'_sbgs_cta_label'             => 'string',
		'_sbgs_cta_form'              => 'string',
		'_sbgs_page_intro'            => 'string',
		'_sbgs_page_framework_title'  => 'string',
		'_sbgs_page_framework_name'   => 'string',
		'_sbgs_meta_format'           => 'string',
		'_sbgs_meta_for'              => 'string',
		'_sbgs_meta_delivery'         => 'string',
		'_sbgs_meta_designed_by'      => 'string',
	);

	foreach ( $page_meta_fields as $key => $type ) {
		register_post_meta( 'page', $key, array(
			'type'          => $type,
			'single'        => true,
			'default'       => '',
			'show_in_rest'  => true,
			'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
		) );
	}
}
add_action( 'init', 'selfbygs_register_page_meta' );

// ─── Add Meta Box ─────────────────────────────────────────────────────────────
function selfbygs_add_page_meta_boxes() {
	// Only on pages that have a custom template assigned
	add_meta_box(
		'sbgs_page_content_meta',
		'SELF — Page Content (Hero &amp; Meta)',
		'selfbygs_render_page_meta_box',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'selfbygs_add_page_meta_boxes' );

// ─── Conditionally show only when template is assigned ───────────────────────
function selfbygs_page_meta_box_conditional( $post ) {
	// We keep the meta box always visible on pages — the template check is done at render
	// to avoid complexity with admin AJAX template switching.
	return true;
}

// ─── Render Meta Box ──────────────────────────────────────────────────────────
function selfbygs_render_page_meta_box( $post ) {
	wp_nonce_field( 'sbgs_page_meta_save', 'sbgs_page_meta_nonce' );

	$template = get_page_template_slug( $post->ID );

	// Only show full content if a custom template is assigned
	if ( ! $template ) {
		echo '<p style="color:#888; font-size:13px; padding:6px 0;">Assign a page template to unlock hero &amp; meta fields.</p>';
		return;
	}

	$eyebrow         = get_post_meta( $post->ID, '_sbgs_hero_eyebrow', true );
	$headline_1      = get_post_meta( $post->ID, '_sbgs_hero_headline_1', true );
	$headline_2      = get_post_meta( $post->ID, '_sbgs_hero_headline_2', true );
	$tagline         = get_post_meta( $post->ID, '_sbgs_hero_tagline', true );
	$cta_label       = get_post_meta( $post->ID, '_sbgs_cta_label', true );
	$cta_form        = get_post_meta( $post->ID, '_sbgs_cta_form', true ) ?: 'main';
	$page_intro      = get_post_meta( $post->ID, '_sbgs_page_intro', true );
	$fw_title        = get_post_meta( $post->ID, '_sbgs_page_framework_title', true );
	$fw_name         = get_post_meta( $post->ID, '_sbgs_page_framework_name', true );
	$meta_format     = get_post_meta( $post->ID, '_sbgs_meta_format', true );
	$meta_for        = get_post_meta( $post->ID, '_sbgs_meta_for', true );
	$meta_delivery   = get_post_meta( $post->ID, '_sbgs_meta_delivery', true );
	$meta_designed   = get_post_meta( $post->ID, '_sbgs_meta_designed_by', true );
	?>
	<style>
	.sbgs-pm-section{margin:0 0 18px;padding-bottom:18px;border-bottom:1px solid #f0ebe0}
	.sbgs-pm-section:last-child{border-bottom:none;margin-bottom:0}
	.sbgs-pm-section-head{font-size:11px;letter-spacing:.22em;text-transform:uppercase;color:#c9a24d;font-weight:700;margin:0 0 10px}
	.sbgs-pm-grid{display:grid;grid-template-columns:180px 1fr;gap:8px 14px;align-items:start}
	.sbgs-pm-label{font-size:12px;font-weight:600;color:#444;padding-top:7px}
	.sbgs-pm-desc{font-size:11px;color:#999;font-weight:400}
	.sbgs-pm-input{width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit}
	.sbgs-pm-input:focus{border-color:#c9a24d;outline:none}
	.sbgs-pm-textarea{width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit;resize:vertical;min-height:80px}
	.sbgs-pm-select{width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit}
	</style>

	<p style="font-size:12px;color:#888;margin:0 0 14px">Template: <code><?php echo esc_html( $template ); ?></code> — Leave any field blank to use the hardcoded template default.</p>

	<div class="sbgs-pm-section">
		<div class="sbgs-pm-section-head">Hero</div>
		<div class="sbgs-pm-grid">
			<div class="sbgs-pm-label">Eyebrow<div class="sbgs-pm-desc">e.g. "Side II · Corporate · Program 01"</div></div>
			<input type="text" class="sbgs-pm-input" name="sbgs_hero_eyebrow" value="<?php echo esc_attr( $eyebrow ); ?>" placeholder="Side II · Corporate · Program 01" />

			<div class="sbgs-pm-label">Headline Line 1</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_hero_headline_1" value="<?php echo esc_attr( $headline_1 ); ?>" />

			<div class="sbgs-pm-label">Headline Line 2<div class="sbgs-pm-desc">Renders italic</div></div>
			<input type="text" class="sbgs-pm-input" name="sbgs_hero_headline_2" value="<?php echo esc_attr( $headline_2 ); ?>" />

			<div class="sbgs-pm-label">Tagline</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_hero_tagline" value="<?php echo esc_attr( $tagline ); ?>" />

			<div class="sbgs-pm-label">CTA Button Label</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_cta_label" value="<?php echo esc_attr( $cta_label ); ?>" placeholder="Discuss your team" />

			<div class="sbgs-pm-label">CTA Form<div class="sbgs-pm-desc">Which modal opens</div></div>
			<select class="sbgs-pm-select" name="sbgs_cta_form">
				<option value="main"      <?php selected( $cta_form, 'main' ); ?>>Main (all options)</option>
				<option value="corporate" <?php selected( $cta_form, 'corporate' ); ?>>Corporate</option>
				<option value="academia"  <?php selected( $cta_form, 'academia' ); ?>>Academia</option>
			</select>
		</div>
	</div>

	<div class="sbgs-pm-section">
		<div class="sbgs-pm-section-head">Lead / Intro Section</div>
		<div class="sbgs-pm-grid">
			<div class="sbgs-pm-label">Page Intro<div class="sbgs-pm-desc">Opening paragraph after hero</div></div>
			<textarea class="sbgs-pm-textarea" name="sbgs_page_intro"><?php echo esc_textarea( $page_intro ); ?></textarea>
		</div>
	</div>

	<div class="sbgs-pm-section">
		<div class="sbgs-pm-section-head">Framework</div>
		<div class="sbgs-pm-grid">
			<div class="sbgs-pm-label">Framework Section Title</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_page_framework_title" value="<?php echo esc_attr( $fw_title ); ?>" placeholder="The LEAD Framework" />

			<div class="sbgs-pm-label">Framework Acronym<div class="sbgs-pm-desc">e.g. LEAD, CLEAR, LAUNCH</div></div>
			<input type="text" class="sbgs-pm-input" name="sbgs_page_framework_name" value="<?php echo esc_attr( $fw_name ); ?>" placeholder="LEAD" />
		</div>
	</div>

	<div class="sbgs-pm-section">
		<div class="sbgs-pm-section-head">Hero Meta Panel</div>
		<div class="sbgs-pm-grid">
			<div class="sbgs-pm-label">Format</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_meta_format" value="<?php echo esc_attr( $meta_format ); ?>" placeholder="B2B · Cohort or 1:1 leadership coaching" />

			<div class="sbgs-pm-label">For</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_meta_for" value="<?php echo esc_attr( $meta_for ); ?>" placeholder="Leadership · Managers · High-potential employees" />

			<div class="sbgs-pm-label">Delivery</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_meta_delivery" value="<?php echo esc_attr( $meta_delivery ); ?>" placeholder="On-site · Workshop series + coaching follow-through" />

			<div class="sbgs-pm-label">Designed By</div>
			<input type="text" class="sbgs-pm-input" name="sbgs_meta_designed_by" value="<?php echo esc_attr( $meta_designed ); ?>" placeholder="Gaurav Sharma &amp; Associates" />
		</div>
	</div>
	<?php
}

// ─── Save Page Meta ───────────────────────────────────────────────────────────
function selfbygs_save_page_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['sbgs_page_meta_nonce'] ) ) return;
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sbgs_page_meta_nonce'] ) ), 'sbgs_page_meta_save' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$text_fields = array(
		'sbgs_hero_eyebrow'          => '_sbgs_hero_eyebrow',
		'sbgs_hero_headline_1'       => '_sbgs_hero_headline_1',
		'sbgs_hero_headline_2'       => '_sbgs_hero_headline_2',
		'sbgs_hero_tagline'          => '_sbgs_hero_tagline',
		'sbgs_cta_label'             => '_sbgs_cta_label',
		'sbgs_cta_form'              => '_sbgs_cta_form',
		'sbgs_page_framework_title'  => '_sbgs_page_framework_title',
		'sbgs_page_framework_name'   => '_sbgs_page_framework_name',
		'sbgs_meta_format'           => '_sbgs_meta_format',
		'sbgs_meta_for'              => '_sbgs_meta_for',
		'sbgs_meta_delivery'         => '_sbgs_meta_delivery',
		'sbgs_meta_designed_by'      => '_sbgs_meta_designed_by',
	);

	foreach ( $text_fields as $post_key => $meta_key ) {
		if ( isset( $_POST[ $post_key ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) ) );
		}
	}

	// Page intro (textarea)
	if ( isset( $_POST['sbgs_page_intro'] ) ) {
		update_post_meta( $post_id, '_sbgs_page_intro', sanitize_textarea_field( wp_unslash( $_POST['sbgs_page_intro'] ) ) );
	}
}
add_action( 'save_post_page', 'selfbygs_save_page_meta' );
