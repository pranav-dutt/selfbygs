<?php
/**
 * SELF by GS — Custom Post Types
 *
 * Registers: sbgs_testimonial, sbgs_logo, sbgs_team
 * All with show_in_rest => true, REST meta registration, and admin meta boxes.
 *
 * @package selfbygs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Register CPTs ────────────────────────────────────────────────────────────
function selfbygs_register_cpts() {

	// Testimonials
	register_post_type( 'sbgs_testimonial', array(
		'labels'       => array(
			'name'               => 'Testimonials',
			'singular_name'      => 'Testimonial',
			'add_new_item'       => 'Add New Testimonial',
			'edit_item'          => 'Edit Testimonial',
			'new_item'           => 'New Testimonial',
			'view_item'          => 'View Testimonial',
			'search_items'       => 'Search Testimonials',
			'not_found'          => 'No testimonials found',
			'not_found_in_trash' => 'No testimonials found in trash',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-format-quote',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'menu_position' => 25,
	) );

	// Logo Partners
	register_post_type( 'sbgs_logo', array(
		'labels'       => array(
			'name'               => 'Logo Partners',
			'singular_name'      => 'Logo Partner',
			'add_new_item'       => 'Add New Logo Partner',
			'edit_item'          => 'Edit Logo Partner',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-awards',
		'supports'      => array( 'title', 'thumbnail' ),
		'menu_position' => 26,
	) );

	// Team Members
	register_post_type( 'sbgs_team', array(
		'labels'       => array(
			'name'               => 'Team Members',
			'singular_name'      => 'Team Member',
			'add_new_item'       => 'Add New Team Member',
			'edit_item'          => 'Edit Team Member',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-groups',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'menu_position' => 27,
	) );
}
add_action( 'init', 'selfbygs_register_cpts' );

// ─── Register Testimonial Taxonomy ───────────────────────────────────────────
function selfbygs_register_taxonomies() {
	register_taxonomy( 'sbgs_testi_cat', 'sbgs_testimonial', array(
		'labels'       => array(
			'name'          => 'Categories',
			'singular_name' => 'Category',
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_rest' => true,
		'hierarchical' => true,
	) );
}
add_action( 'init', 'selfbygs_register_taxonomies' );

// ─── Register REST Meta ───────────────────────────────────────────────────────
function selfbygs_register_cpt_meta() {

	// Testimonial meta
	$testi_meta = array(
		'_sbgs_testi_type'        => array( 'type' => 'string',  'default' => 'text',       'description' => 'video or text' ),
		'_sbgs_testi_video_url'   => array( 'type' => 'string',  'default' => '',           'description' => 'YouTube or embed URL' ),
		'_sbgs_testi_quote'       => array( 'type' => 'string',  'default' => '',           'description' => 'Short pull-quote' ),
		'_sbgs_testi_author_role' => array( 'type' => 'string',  'default' => '',           'description' => 'Role / title' ),
		'_sbgs_testi_author_org'  => array( 'type' => 'string',  'default' => '',           'description' => 'Company / institution' ),
		'_sbgs_testi_category'    => array( 'type' => 'string',  'default' => 'both',       'description' => 'corporate, academia, or both' ),
	);
	foreach ( $testi_meta as $key => $args ) {
		register_post_meta( 'sbgs_testimonial', $key, array(
			'type'          => $args['type'],
			'description'   => $args['description'],
			'single'        => true,
			'default'       => $args['default'],
			'show_in_rest'  => true,
			'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
		) );
	}

	// Logo meta
	register_post_meta( 'sbgs_logo', '_sbgs_logo_url', array(
		'type'         => 'string',
		'description'  => 'Link URL for this logo',
		'single'       => true,
		'default'      => '',
		'show_in_rest' => true,
		'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
	) );

	// Team meta
	$team_meta = array(
		'_sbgs_team_role'      => array( 'type' => 'string',  'default' => '' ),
		'_sbgs_team_short_bio' => array( 'type' => 'string',  'default' => '' ),
		'_sbgs_team_linkedin'  => array( 'type' => 'string',  'default' => '' ),
		'_sbgs_team_is_founder'=> array( 'type' => 'boolean', 'default' => false ),
	);
	foreach ( $team_meta as $key => $args ) {
		register_post_meta( 'sbgs_team', $key, array(
			'type'          => $args['type'],
			'single'        => true,
			'default'       => $args['default'],
			'show_in_rest'  => true,
			'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
		) );
	}
}
add_action( 'init', 'selfbygs_register_cpt_meta' );

// ─── Meta Boxes ───────────────────────────────────────────────────────────────
function selfbygs_add_cpt_meta_boxes() {
	add_meta_box( 'sbgs_testi_meta', 'Testimonial Details', 'selfbygs_render_testi_meta_box', 'sbgs_testimonial', 'normal', 'high' );
	add_meta_box( 'sbgs_logo_meta',  'Logo Partner Details', 'selfbygs_render_logo_meta_box',  'sbgs_logo',        'normal', 'high' );
	add_meta_box( 'sbgs_team_meta',  'Team Member Details',  'selfbygs_render_team_meta_box',  'sbgs_team',        'normal', 'high' );
}
add_action( 'add_meta_boxes', 'selfbygs_add_cpt_meta_boxes' );

// — Testimonial meta box —
function selfbygs_render_testi_meta_box( $post ) {
	wp_nonce_field( 'sbgs_testi_save', 'sbgs_testi_nonce' );
	$type     = get_post_meta( $post->ID, '_sbgs_testi_type', true ) ?: 'text';
	$video    = get_post_meta( $post->ID, '_sbgs_testi_video_url', true );
	$quote    = get_post_meta( $post->ID, '_sbgs_testi_quote', true );
	$role     = get_post_meta( $post->ID, '_sbgs_testi_author_role', true );
	$org      = get_post_meta( $post->ID, '_sbgs_testi_author_org', true );
	$category = get_post_meta( $post->ID, '_sbgs_testi_category', true ) ?: 'both';
	?>
	<style>.sbgs-meta-table{width:100%;border-collapse:collapse}.sbgs-meta-table th{text-align:left;padding:8px 10px 4px;font-weight:600;font-size:12px;color:#555;width:180px;vertical-align:top;padding-top:12px}.sbgs-meta-table td{padding:6px 10px}.sbgs-meta-table input[type=text],.sbgs-meta-table input[type=url],.sbgs-meta-table select,.sbgs-meta-table textarea{width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit}.sbgs-meta-table tr{border-bottom:1px solid #f5f5f5}</style>
	<table class="sbgs-meta-table">
		<tr>
			<th><label for="sbgs_testi_type">Type</label></th>
			<td>
				<select id="sbgs_testi_type" name="sbgs_testi_type">
					<option value="text"  <?php selected( $type, 'text' ); ?>>Text Testimonial</option>
					<option value="video" <?php selected( $type, 'video' ); ?>>Video Testimonial</option>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="sbgs_testi_video_url">Video URL</label></th>
			<td><input type="url" id="sbgs_testi_video_url" name="sbgs_testi_video_url" value="<?php echo esc_attr( $video ); ?>" placeholder="https://selfbygs.com/wp-content/uploads/..." /></td>
		</tr>
		<tr>
			<th><label for="sbgs_testi_quote">Pull Quote</label></th>
			<td><textarea id="sbgs_testi_quote" name="sbgs_testi_quote" rows="3"><?php echo esc_textarea( $quote ); ?></textarea></td>
		</tr>
		<tr>
			<th><label for="sbgs_testi_author_role">Author Role</label></th>
			<td><input type="text" id="sbgs_testi_author_role" name="sbgs_testi_author_role" value="<?php echo esc_attr( $role ); ?>" placeholder="e.g. Director · ICFAI Business School" /></td>
		</tr>
		<tr>
			<th><label for="sbgs_testi_author_org">Organisation</label></th>
			<td><input type="text" id="sbgs_testi_author_org" name="sbgs_testi_author_org" value="<?php echo esc_attr( $org ); ?>" placeholder="Company or institution" /></td>
		</tr>
		<tr>
			<th><label for="sbgs_testi_category">Category</label></th>
			<td>
				<select id="sbgs_testi_category" name="sbgs_testi_category">
					<option value="both"      <?php selected( $category, 'both' ); ?>>Both (show everywhere)</option>
					<option value="corporate" <?php selected( $category, 'corporate' ); ?>>Corporate only</option>
					<option value="academia"  <?php selected( $category, 'academia' ); ?>>Academia only</option>
				</select>
			</td>
		</tr>
	</table>
	<?php
}

// — Logo meta box —
function selfbygs_render_logo_meta_box( $post ) {
	wp_nonce_field( 'sbgs_logo_save', 'sbgs_logo_nonce' );
	$url = get_post_meta( $post->ID, '_sbgs_logo_url', true );
	?>
	<style>.sbgs-meta-table{width:100%;border-collapse:collapse}.sbgs-meta-table th{text-align:left;padding:8px 10px 4px;font-weight:600;font-size:12px;color:#555;width:180px}.sbgs-meta-table td{padding:6px 10px}.sbgs-meta-table input[type=url]{width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;font-size:13px}</style>
	<table class="sbgs-meta-table">
		<tr>
			<th><label for="sbgs_logo_url">Link URL</label></th>
			<td><input type="url" id="sbgs_logo_url" name="sbgs_logo_url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://..." /></td>
		</tr>
	</table>
	<p style="margin:10px 10px 0; font-size:12px; color:#666;">Set the featured image as the logo graphic. Title = display name.</p>
	<?php
}

// — Team meta box —
function selfbygs_render_team_meta_box( $post ) {
	wp_nonce_field( 'sbgs_team_save', 'sbgs_team_nonce' );
	$role       = get_post_meta( $post->ID, '_sbgs_team_role', true );
	$short_bio  = get_post_meta( $post->ID, '_sbgs_team_short_bio', true );
	$linkedin   = get_post_meta( $post->ID, '_sbgs_team_linkedin', true );
	$is_founder = (bool) get_post_meta( $post->ID, '_sbgs_team_is_founder', true );
	?>
	<style>.sbgs-meta-table{width:100%;border-collapse:collapse}.sbgs-meta-table th{text-align:left;padding:8px 10px 4px;font-weight:600;font-size:12px;color:#555;width:180px;vertical-align:top;padding-top:12px}.sbgs-meta-table td{padding:6px 10px}.sbgs-meta-table input[type=text],.sbgs-meta-table input[type=url],.sbgs-meta-table textarea{width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit}.sbgs-meta-table tr{border-bottom:1px solid #f5f5f5}</style>
	<table class="sbgs-meta-table">
		<tr>
			<th><label for="sbgs_team_role">Role / Title</label></th>
			<td><input type="text" id="sbgs_team_role" name="sbgs_team_role" value="<?php echo esc_attr( $role ); ?>" placeholder="e.g. Founder &amp; Chief Mentor · SELF" /></td>
		</tr>
		<tr>
			<th><label for="sbgs_team_short_bio">Short Bio</label></th>
			<td><textarea id="sbgs_team_short_bio" name="sbgs_team_short_bio" rows="4"><?php echo esc_textarea( $short_bio ); ?></textarea></td>
		</tr>
		<tr>
			<th><label for="sbgs_team_linkedin">LinkedIn URL</label></th>
			<td><input type="url" id="sbgs_team_linkedin" name="sbgs_team_linkedin" value="<?php echo esc_attr( $linkedin ); ?>" placeholder="https://www.linkedin.com/in/..." /></td>
		</tr>
		<tr>
			<th>Founder?</th>
			<td><label><input type="checkbox" name="sbgs_team_is_founder" value="1" <?php checked( $is_founder ); ?> /> Mark as founder (shows first in team listing)</label></td>
		</tr>
	</table>
	<?php
}

// ─── Save Meta Boxes ──────────────────────────────────────────────────────────
function selfbygs_save_cpt_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	// Testimonial
	if ( isset( $_POST['sbgs_testi_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sbgs_testi_nonce'] ) ), 'sbgs_testi_save' ) ) {
		update_post_meta( $post_id, '_sbgs_testi_type',        sanitize_text_field( wp_unslash( $_POST['sbgs_testi_type'] ?? 'text' ) ) );
		update_post_meta( $post_id, '_sbgs_testi_video_url',   esc_url_raw( wp_unslash( $_POST['sbgs_testi_video_url'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_testi_quote',       sanitize_textarea_field( wp_unslash( $_POST['sbgs_testi_quote'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_testi_author_role', sanitize_text_field( wp_unslash( $_POST['sbgs_testi_author_role'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_testi_author_org',  sanitize_text_field( wp_unslash( $_POST['sbgs_testi_author_org'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_testi_category',    sanitize_text_field( wp_unslash( $_POST['sbgs_testi_category'] ?? 'both' ) ) );
	}

	// Logo
	if ( isset( $_POST['sbgs_logo_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sbgs_logo_nonce'] ) ), 'sbgs_logo_save' ) ) {
		update_post_meta( $post_id, '_sbgs_logo_url', esc_url_raw( wp_unslash( $_POST['sbgs_logo_url'] ?? '' ) ) );
	}

	// Team
	if ( isset( $_POST['sbgs_team_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sbgs_team_nonce'] ) ), 'sbgs_team_save' ) ) {
		update_post_meta( $post_id, '_sbgs_team_role',       sanitize_text_field( wp_unslash( $_POST['sbgs_team_role'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_team_short_bio',  sanitize_textarea_field( wp_unslash( $_POST['sbgs_team_short_bio'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_team_linkedin',   esc_url_raw( wp_unslash( $_POST['sbgs_team_linkedin'] ?? '' ) ) );
		update_post_meta( $post_id, '_sbgs_team_is_founder', isset( $_POST['sbgs_team_is_founder'] ) ? 1 : 0 );
	}
}
add_action( 'save_post', 'selfbygs_save_cpt_meta' );
