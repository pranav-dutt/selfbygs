<?php
/**
 * SELF by GS — Theme Options Admin Page
 *
 * Registers WP Admin → SELF Settings with tabbed sections.
 * Uses a single serialized option: selfbygs_options.
 *
 * @package selfbygs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Helper: get option value ─────────────────────────────────────────────────
if ( ! function_exists( 'selfbygs_opt' ) ) {
	function selfbygs_opt( $key, $default = '' ) {
		$opts = get_option( 'selfbygs_options', array() );
		return ( isset( $opts[ $key ] ) && '' !== $opts[ $key ] ) ? $opts[ $key ] : $default;
	}
}

// ─── Admin Menu ───────────────────────────────────────────────────────────────
function selfbygs_options_menu() {
	add_menu_page(
		__( 'SELF Settings', 'selfbygs' ),
		__( 'SELF Settings', 'selfbygs' ),
		'manage_options',
		'selfbygs-settings',
		'selfbygs_options_page',
		'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="2"/><path d="M19.07 4.93a10 10 0 1 0 0 14.14"/></svg>' ),
		60
	);
}
add_action( 'admin_menu', 'selfbygs_options_menu' );

// ─── Sanitize options ─────────────────────────────────────────────────────────
function selfbygs_sanitize_options( array $input ) {
	$clean = array();

	$text_fields = array(
		'site_tagline', 'contact_email', 'whatsapp', 'address_line1', 'address_line2',
		'ga_id', 'fb_pixel',
		'linkedin_url', 'instagram_url', 'youtube_url', 'facebook_url',
		'hero_headline_1', 'hero_headline_2', 'hero_tagline', 'hero_video_id',
		'mission_title', 'cta_text',
		'num1_count', 'num1_label', 'num2_count', 'num2_label',
		'num3_count', 'num3_label', 'num4_count', 'num4_label',
		'modal_title', 'modal_subtitle',
	);
	$textarea_fields = array(
		'hero_description', 'mission_body', 'modal_quote', 'modal_success',
		'footer_blurb', 'footer_about',
	);
	$url_fields = array( 'linkedin_url', 'instagram_url', 'youtube_url', 'facebook_url' );

	foreach ( $text_fields as $field ) {
		if ( isset( $input[ $field ] ) ) {
			if ( in_array( $field, $url_fields, true ) ) {
				$clean[ $field ] = esc_url_raw( $input[ $field ] );
			} elseif ( 'contact_email' === $field ) {
				$clean[ $field ] = sanitize_email( $input[ $field ] );
			} else {
				$clean[ $field ] = sanitize_text_field( $input[ $field ] );
			}
		}
	}
	foreach ( $textarea_fields as $field ) {
		if ( isset( $input[ $field ] ) ) {
			$clean[ $field ] = sanitize_textarea_field( $input[ $field ] );
		}
	}
	return $clean;
}

// ─── Options Page Render ──────────────────────────────────────────────────────
function selfbygs_options_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$saved    = false;
	$tab      = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'general';
	$tabs_map = array(
		'general'  => 'General',
		'social'   => 'Social Links',
		'homepage' => 'Homepage',
		'modal'    => 'Lead Modal',
		'footer'   => 'Footer',
	);
	if ( ! array_key_exists( $tab, $tabs_map ) ) {
		$tab = 'general';
	}

	// Handle save
	if (
		isset( $_POST['selfbygs_options_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['selfbygs_options_nonce'] ) ), 'selfbygs_save_options' ) &&
		current_user_can( 'manage_options' )
	) {
		$existing = get_option( 'selfbygs_options', array() );
		$posted   = isset( $_POST['selfbygs_options'] ) ? (array) wp_unslash( $_POST['selfbygs_options'] ) : array();
		$clean    = selfbygs_sanitize_options( $posted );
		$merged   = array_merge( $existing, $clean );
		update_option( 'selfbygs_options', $merged );
		$saved = true;
	}

	$opts = get_option( 'selfbygs_options', array() );
	?>
	<div class="wrap" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;">
		<h1 style="font-size:22px;margin-bottom:0;padding-bottom:0;">SELF Settings</h1>
		<p style="color:#666;margin-top:4px;font-size:13px;">Theme options for SELF by GS. Changes take effect immediately on the front end.</p>

		<?php if ( $saved ) : ?>
		<div class="notice notice-success is-dismissible" style="margin-top:16px;"><p><?php esc_html_e( 'Settings saved.', 'selfbygs' ); ?></p></div>
		<?php endif; ?>

		<style>
		.sbgs-opts-tabs{display:flex;gap:0;border-bottom:2px solid #c9a24d;margin:20px 0 0}
		.sbgs-opts-tab{padding:10px 22px;font-size:13px;font-weight:600;cursor:pointer;color:#555;text-decoration:none;border:1px solid transparent;border-bottom:none;margin-bottom:-2px;transition:all .2s}
		.sbgs-opts-tab.active{color:#0b0b0b;background:#fff;border-color:#c9a24d #c9a24d #fff #c9a24d}
		.sbgs-opts-tab:hover:not(.active){color:#0b0b0b;background:#fdf6e8}
		.sbgs-opts-panel{background:#fff;border:1px solid #c9a24d;border-top:none;padding:28px 30px;max-width:860px}
		.sbgs-opts-row{display:grid;grid-template-columns:210px 1fr;gap:14px 20px;align-items:start;padding:14px 0;border-bottom:1px solid #f0ebe0}
		.sbgs-opts-row:last-child{border-bottom:none}
		.sbgs-opts-label{font-size:13px;font-weight:600;color:#333;padding-top:6px}
		.sbgs-opts-desc{font-size:11px;color:#999;margin-top:3px;font-weight:400}
		.sbgs-opts-input{width:100%;padding:8px 10px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit;transition:border .2s}
		.sbgs-opts-input:focus{border-color:#c9a24d;outline:none;box-shadow:0 0 0 2px rgba(201,162,77,.2)}
		.sbgs-opts-textarea{width:100%;padding:8px 10px;border:1px solid #ddd;border-radius:3px;font-size:13px;font-family:inherit;resize:vertical;min-height:80px}
		.sbgs-opts-textarea:focus{border-color:#c9a24d;outline:none;box-shadow:0 0 0 2px rgba(201,162,77,.2)}
		.sbgs-opts-save{margin-top:24px;display:flex;align-items:center;gap:14px}
		.sbgs-opts-save-btn{background:#c9a24d;color:#0b0b0b;border:none;padding:12px 28px;font-weight:700;font-size:14px;border-radius:2px;cursor:pointer;font-family:inherit;transition:background .2s}
		.sbgs-opts-save-btn:hover{background:#b58c3c}
		.sbgs-num-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
		.sbgs-num-cell{display:flex;flex-direction:column;gap:4px}
		.sbgs-num-cell label{font-size:11px;color:#888;text-transform:uppercase;letter-spacing:.12em}
		</style>

		<!-- Tabs -->
		<div class="sbgs-opts-tabs">
			<?php foreach ( $tabs_map as $key => $label ) : ?>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=selfbygs-settings&tab=' . urlencode( $key ) ) ); ?>" class="sbgs-opts-tab<?php echo $tab === $key ? ' active' : ''; ?>">
				<?php echo esc_html( $label ); ?>
			</a>
			<?php endforeach; ?>
		</div>

		<form method="post" action="">
			<?php wp_nonce_field( 'selfbygs_save_options', 'selfbygs_options_nonce' ); ?>

			<div class="sbgs-opts-panel">

			<?php if ( 'general' === $tab ) : ?>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Site Tagline<div class="sbgs-opts-desc">Short brand tagline</div></div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[site_tagline]" value="<?php echo esc_attr( $opts['site_tagline'] ?? '' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Contact Email</div>
					<input type="email" class="sbgs-opts-input" name="selfbygs_options[contact_email]" value="<?php echo esc_attr( $opts['contact_email'] ?? 'namaste@selfbygs.com' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">WhatsApp Number</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[whatsapp]" value="<?php echo esc_attr( $opts['whatsapp'] ?? '+917891122201' ); ?>" placeholder="+917891122201" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Address Line 1</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[address_line1]" value="<?php echo esc_attr( $opts['address_line1'] ?? 'Jaipur' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Address Line 2</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[address_line2]" value="<?php echo esc_attr( $opts['address_line2'] ?? 'Rajasthan · India' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Google Analytics ID<div class="sbgs-opts-desc">e.g. G-XXXXXXXXXX</div></div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[ga_id]" value="<?php echo esc_attr( $opts['ga_id'] ?? '' ); ?>" placeholder="G-XXXXXXXXXX" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Facebook Pixel ID</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[fb_pixel]" value="<?php echo esc_attr( $opts['fb_pixel'] ?? '' ); ?>" />
				</div>

			<?php elseif ( 'social' === $tab ) : ?>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">LinkedIn URL</div>
					<input type="url" class="sbgs-opts-input" name="selfbygs_options[linkedin_url]" value="<?php echo esc_attr( $opts['linkedin_url'] ?? 'https://www.linkedin.com/in/voiceitgaurav/' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Instagram URL</div>
					<input type="url" class="sbgs-opts-input" name="selfbygs_options[instagram_url]" value="<?php echo esc_attr( $opts['instagram_url'] ?? 'https://www.instagram.com/voiceitgaurav/' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">YouTube URL</div>
					<input type="url" class="sbgs-opts-input" name="selfbygs_options[youtube_url]" value="<?php echo esc_attr( $opts['youtube_url'] ?? 'https://www.youtube.com/@voiceitgaurav' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Facebook URL</div>
					<input type="url" class="sbgs-opts-input" name="selfbygs_options[facebook_url]" value="<?php echo esc_attr( $opts['facebook_url'] ?? 'https://www.facebook.com/profile.php?id=100002611554241' ); ?>" />
				</div>

			<?php elseif ( 'homepage' === $tab ) : ?>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Hero Headline Line 1</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[hero_headline_1]" value="<?php echo esc_attr( $opts['hero_headline_1'] ?? 'Built not by chance' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Hero Headline Line 2<div class="sbgs-opts-desc">Renders in italic / gold style</div></div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[hero_headline_2]" value="<?php echo esc_attr( $opts['hero_headline_2'] ?? 'by design.' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Hero Tagline</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[hero_tagline]" value="<?php echo esc_attr( $opts['hero_tagline'] ?? 'Two journeys. One philosophy.' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Hero Description</div>
					<textarea class="sbgs-opts-textarea" name="selfbygs_options[hero_description]"><?php echo esc_textarea( $opts['hero_description'] ?? '' ); ?></textarea>
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Hero Video ID<div class="sbgs-opts-desc">YouTube video ID for background</div></div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[hero_video_id]" value="<?php echo esc_attr( $opts['hero_video_id'] ?? 'hbzORcKxYeI' ); ?>" placeholder="hbzORcKxYeI" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Mission Section Title</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[mission_title]" value="<?php echo esc_attr( $opts['mission_title'] ?? '' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Mission Section Body</div>
					<textarea class="sbgs-opts-textarea" name="selfbygs_options[mission_body]"><?php echo esc_textarea( $opts['mission_body'] ?? '' ); ?></textarea>
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">CTA Button Text</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[cta_text]" value="<?php echo esc_attr( $opts['cta_text'] ?? 'Book a Clarity Call' ); ?>" />
				</div>
				<div class="sbgs-opts-row" style="align-items:start">
					<div class="sbgs-opts-label" style="padding-top:6px">Numbers Block 1</div>
					<div class="sbgs-num-grid">
						<div class="sbgs-num-cell"><label>Count</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num1_count]" value="<?php echo esc_attr( $opts['num1_count'] ?? '25+' ); ?>" /></div>
						<div class="sbgs-num-cell"><label>Label</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num1_label]" value="<?php echo esc_attr( $opts['num1_label'] ?? 'Years Combined Experience' ); ?>" /></div>
					</div>
				</div>
				<div class="sbgs-opts-row" style="align-items:start">
					<div class="sbgs-opts-label" style="padding-top:6px">Numbers Block 2</div>
					<div class="sbgs-num-grid">
						<div class="sbgs-num-cell"><label>Count</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num2_count]" value="<?php echo esc_attr( $opts['num2_count'] ?? '3000+' ); ?>" /></div>
						<div class="sbgs-num-cell"><label>Label</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num2_label]" value="<?php echo esc_attr( $opts['num2_label'] ?? 'Lives Impacted' ); ?>" /></div>
					</div>
				</div>
				<div class="sbgs-opts-row" style="align-items:start">
					<div class="sbgs-opts-label" style="padding-top:6px">Numbers Block 3</div>
					<div class="sbgs-num-grid">
						<div class="sbgs-num-cell"><label>Count</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num3_count]" value="<?php echo esc_attr( $opts['num3_count'] ?? '120+' ); ?>" /></div>
						<div class="sbgs-num-cell"><label>Label</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num3_label]" value="<?php echo esc_attr( $opts['num3_label'] ?? 'Programs Delivered' ); ?>" /></div>
					</div>
				</div>
				<div class="sbgs-opts-row" style="align-items:start">
					<div class="sbgs-opts-label" style="padding-top:6px">Numbers Block 4</div>
					<div class="sbgs-num-grid">
						<div class="sbgs-num-cell"><label>Count</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num4_count]" value="<?php echo esc_attr( $opts['num4_count'] ?? '2' ); ?>" /></div>
						<div class="sbgs-num-cell"><label>Label</label><input type="text" class="sbgs-opts-input" name="selfbygs_options[num4_label]" value="<?php echo esc_attr( $opts['num4_label'] ?? 'Journeys One Philosophy' ); ?>" /></div>
					</div>
				</div>

			<?php elseif ( 'modal' === $tab ) : ?>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Modal Title</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[modal_title]" value="<?php echo esc_attr( $opts['modal_title'] ?? 'Begin Your Clarity Call' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Modal Subtitle</div>
					<input type="text" class="sbgs-opts-input" name="selfbygs_options[modal_subtitle]" value="<?php echo esc_attr( $opts['modal_subtitle'] ?? '' ); ?>" />
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Modal Quote<div class="sbgs-opts-desc">Shown at bottom of aside panel</div></div>
					<textarea class="sbgs-opts-textarea" name="selfbygs_options[modal_quote]"><?php echo esc_textarea( $opts['modal_quote'] ?? "Don't choose a path. Learn how to design one." ); ?></textarea>
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Success Message<div class="sbgs-opts-desc">Shown after form submission</div></div>
					<textarea class="sbgs-opts-textarea" name="selfbygs_options[modal_success]"><?php echo esc_textarea( $opts['modal_success'] ?? "Thank you — we'll be in touch within one business day." ); ?></textarea>
				</div>

			<?php elseif ( 'footer' === $tab ) : ?>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Footer Blurb<div class="sbgs-opts-desc">Short text below the logo</div></div>
					<textarea class="sbgs-opts-textarea" name="selfbygs_options[footer_blurb]"><?php echo esc_textarea( $opts['footer_blurb'] ?? '' ); ?></textarea>
				</div>
				<div class="sbgs-opts-row">
					<div class="sbgs-opts-label">Footer About Text</div>
					<textarea class="sbgs-opts-textarea" name="selfbygs_options[footer_about]"><?php echo esc_textarea( $opts['footer_about'] ?? '' ); ?></textarea>
				</div>
			<?php endif; ?>

			</div><!-- /.sbgs-opts-panel -->

			<div class="sbgs-opts-save">
				<input type="submit" class="sbgs-opts-save-btn" value="Save Settings" />
			</div>
		</form>
	</div>
	<?php
}
