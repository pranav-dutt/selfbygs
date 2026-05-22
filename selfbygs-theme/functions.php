<?php
/**
 * SELF by GS Theme Functions
 *
 * @package selfbygs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Theme Setup ────────────────────────────────────────────────────────────
function selfbygs_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'selfbygs' ),
	) );
}
add_action( 'after_setup_theme', 'selfbygs_setup' );

// ─── Enqueue Scripts & Styles ────────────────────────────────────────────────
function selfbygs_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style(
		'selfbygs-google-fonts',
		'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Manrope:wght@300;400;500;600;700&family=Allison&display=swap',
		array(),
		null
	);

	// Shared CSS
	wp_enqueue_style(
		'selfbygs-shared',
		get_template_directory_uri() . '/assets/css/shared.css',
		array( 'selfbygs-google-fonts' ),
		'1.0.0'
	);

	// Program detail CSS — only on program pages
	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_post() );
		$program_pages = array(
			'career-architecture', 'young-leaders', 'beyond-teaching',
			'executive-effectiveness', 'core-skills', 'diagnostic-audit',
		);
		if ( in_array( $slug, $program_pages, true ) ) {
			wp_enqueue_style(
				'selfbygs-program-detail',
				get_template_directory_uri() . '/assets/css/program-detail.css',
				array( 'selfbygs-shared' ),
				'1.0.0'
			);
		}
	}

	// Shared JS — footer
	wp_enqueue_script(
		'selfbygs-shared',
		get_template_directory_uri() . '/assets/js/shared.js',
		array(),
		'1.0.0',
		true
	);

	// Pass REST API nonce for form submissions
	wp_localize_script( 'selfbygs-shared', 'selfbygsData', array(
		'restUrl' => esc_url_raw( rest_url( 'selfbygs/v1/submit' ) ),
		'nonce'   => wp_create_nonce( 'wp_rest' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'selfbygs_enqueue_assets' );

// ─── Custom Post Type: Program ───────────────────────────────────────────────
function selfbygs_register_post_types() {
	register_post_type( 'selfbygs_program', array(
		'labels'      => array(
			'name'          => esc_html__( 'Programs', 'selfbygs' ),
			'singular_name' => esc_html__( 'Program', 'selfbygs' ),
		),
		'public'      => true,
		'has_archive' => true,
		'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'     => array( 'slug' => 'programs' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'selfbygs_register_post_types' );

// ─── Body Classes ────────────────────────────────────────────────────────────
function selfbygs_body_class( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'page-home';
		$classes[] = 'theme-noir';
	}
	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_post() );
		if ( in_array( $slug, array( 'corporate', 'executive-effectiveness', 'core-skills', 'diagnostic-audit' ), true ) ) {
			$classes[] = 'theme-dark';
		} else {
			$classes[] = 'theme-light';
		}
	}
	if ( is_singular( 'post' ) || is_archive() ) {
		$classes[] = 'theme-light';
	}
	return $classes;
}
add_filter( 'body_class', 'selfbygs_body_class' );

// ─── Nav HTML Helper ─────────────────────────────────────────────────────────
function selfbygs_get_nav_html() {
	ob_start();
	?>
	<header class="site-header" id="site-header">
	  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-mark">
	    <span class="dot"></span>
	    <span>SELF</span>
	  </a>
	  <nav class="nav">
	    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'selfbygs' ); ?></a>
	    <div class="has-menu">
	      <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>"><?php esc_html_e( 'Corporate', 'selfbygs' ); ?></a>
	      <div class="nav-dropdown">
	        <div class="dd-head">Corporate · Programs</div>
	        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>"><span class="num">01</span><span>Executive Effectiveness</span><span class="arrow"></span></a>
	        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>"><span class="num">02</span><span>Core Skills Interventions</span><span class="arrow"></span></a>
	        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>"><span class="num">03</span><span>Diagnostic Audit &amp; Custom</span><span class="arrow"></span></a>
	      </div>
	    </div>
	    <div class="has-menu">
	      <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>"><?php esc_html_e( 'Academia', 'selfbygs' ); ?></a>
	      <div class="nav-dropdown">
	        <div class="dd-head">Academia · Programs</div>
	        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>"><span class="num">01</span><span>Career Architecture Lab</span><span class="arrow"></span></a>
	        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>"><span class="num">02</span><span>Young Leaders Program</span><span class="arrow"></span></a>
	        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>"><span class="num">03</span><span>Beyond Teaching · FDP</span><span class="arrow"></span></a>
	      </div>
	    </div>
	    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>"><?php esc_html_e( 'Team', 'selfbygs' ); ?></a>
	    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'selfbygs' ); ?></a>
	  </nav>
	  <button class="nav-cta hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min"><?php esc_html_e( 'Book a Clarity Call', 'selfbygs' ); ?></button>
	  <button class="mobile-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'selfbygs' ); ?>"><span></span><span></span><span></span></button>
	</header>
	<?php
	return ob_get_clean();
}

// ─── Mobile Drawer HTML Helper ───────────────────────────────────────────────
function selfbygs_get_mobile_drawer_html() {
	ob_start();
	?>
	<div class="mobile-drawer" id="mobile-drawer">
	  <nav class="md-nav">
	    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'selfbygs' ); ?></a>
	    <details>
	      <summary><?php esc_html_e( 'Corporate', 'selfbygs' ); ?></summary>
	      <div class="md-sub">
	        <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">Corporate · Overview</a>
	        <a href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>">Executive Effectiveness</a>
	        <a href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>">Core Skills</a>
	        <a href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>">Diagnostic Audit</a>
	      </div>
	    </details>
	    <details>
	      <summary><?php esc_html_e( 'Academia', 'selfbygs' ); ?></summary>
	      <div class="md-sub">
	        <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">Academia · Overview</a>
	        <a href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>">Career Architecture</a>
	        <a href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>">Young Leaders Program</a>
	        <a href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>">Beyond Teaching · FDP</a>
	      </div>
	    </details>
	    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>"><?php esc_html_e( 'Team', 'selfbygs' ); ?></a>
	    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'selfbygs' ); ?></a>
	  </nav>
	  <div class="md-foot">
	    <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min"><?php esc_html_e( 'Book a Clarity Call', 'selfbygs' ); ?> <span class="arrow"></span></button>
	  </div>
	</div>
	<?php
	return ob_get_clean();
}

// ─── Footer HTML Helper ───────────────────────────────────────────────────────
function selfbygs_get_footer_html( $theme = 'dark' ) {
	$theme_class = ( 'dark' === $theme ) ? 'theme-dark' : 'theme-light';
	ob_start();
	?>
	<footer class="site-footer <?php echo esc_attr( $theme_class ); ?>">
	  <div class="footer-grid">
	    <div>
	      <div class="foot-logo">SELF</div>
	      <div class="foot-by">Self Engineering for Leaders' Fortune</div>
	      <p class="foot-blurb">The development arm of <strong style="color:var(--gold); font-family:var(--f-display); font-weight:500; letter-spacing:0.06em;">Gaurav Sharma &amp; Associates</strong>. Self Development Programs — built quietly, deliberately, and at depth.</p>
	      <div class="foot-social">
	        <a href="https://www.linkedin.com/in/voiceitgaurav/" target="_blank" rel="noopener" aria-label="LinkedIn"><svg viewBox="0 0 24 24"><path d="M19 0h-14C2.24 0 0 2.24 0 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5V5c0-2.76-2.24-5-5-5zM8 19H5V8h3v11zM6.5 6.73C5.53 6.73 4.75 5.95 4.75 5s.78-1.73 1.75-1.73 1.75.78 1.75 1.73-.78 1.73-1.75 1.73zM20 19h-3v-5.6c0-1.1-.9-2-2-2s-2 .9-2 2V19h-3V8h3v1.4c.7-1 1.7-1.6 3-1.6 2.21 0 4 1.79 4 4V19z"/></svg></a>
	        <a href="https://www.instagram.com/voiceitgaurav/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.555.556.9 1.111 1.153 1.772.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 1 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg></a>
	        <a href="https://www.youtube.com/@voiceitgaurav" target="_blank" rel="noopener" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
	        <a href="https://www.facebook.com/profile.php?id=100002611554241" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg></a>
	      </div>
	    </div>
	    <div>
	      <h5>Explore</h5>
	      <ul>
	        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">Corporate</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">Academia</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Team</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
	      </ul>
	    </div>
	    <div>
	      <h5>Programs</h5>
	      <ul>
	        <li><a href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>">Executive Effectiveness</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>">Core Skills</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>">Diagnostic Audit</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>">Career Architecture</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>">Young Leaders · YLP</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>">Beyond Teaching · FDP</a></li>
	      </ul>
	    </div>
	    <div>
	      <h5>Engage</h5>
	      <ul>
	        <li><a href="#" data-open-lead data-title="Book a Clarity Call" data-label="Clarity Call · Free 30 min">Book a Clarity Call</a></li>
	        <li><a href="mailto:namaste@selfbygs.com">namaste@selfbygs.com</a></li>
	        <li><a href="https://wa.me/+917891122201" target="_blank" rel="noopener">WhatsApp · +91 78911 22201</a></li>
	        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a></li>
	      </ul>
	    </div>
	  </div>
	  <div class="footer-bottom">
	    <span>© SELF · <?php echo date( 'Y' ); ?> · Gaurav Sharma &amp; Associates</span>
	    <span>Jaipur · Rajasthan · India</span>
	  </div>
	  <div class="footer-legal">
	    <div class="footer-legal-links">
	      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
	      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
	      <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms</a>
	      <a href="<?php echo esc_url( home_url( '/refund-cancellation/' ) ); ?>">Refund &amp; Cancellation</a>
	    </div>
	    <span class="loc">Jaipur · India · Remote</span>
	  </div>
	</footer>
	<?php
	return ob_get_clean();
}

// ─── Lead Modal HTML Helper ───────────────────────────────────────────────────
function selfbygs_get_lead_modal_html() {
	ob_start();
	?>
	<div class="lead-modal" id="lead-modal" role="dialog" aria-modal="true" aria-labelledby="lead-title">
	  <div class="lead-card">
	    <aside class="lead-aside">
	      <div>
	        <div class="meta-row"><span class="dot"></span><span>Clarity Call · Free 30 min</span></div>
	        <h3 id="lead-title">Begin Your Clarity Call</h3>
	        <p>A short, honest conversation. We listen first, then we tell you whether SELF is a fit — or what is.</p>
	      </div>
	      <div class="quote">Don't choose a path.<br/>Learn how to design one.</div>
	    </aside>

	    <div class="lead-body">
	      <button class="lead-close" aria-label="Close">✕</button>

	      <div class="lead-steps">
	        <span class="lead-step-pill is-active"></span>
	        <span class="lead-step-pill"></span>
	        <span class="lead-step-pill"></span>
	        <span class="lead-step-pill"></span>
	      </div>

	      <div class="lead-step-wrap">

	        <div class="lead-step is-active">
	          <div class="step-eyebrow">Step 01 / 04</div>
	          <h4>Who is this for?</h4>
	          <div class="step-sub">Choose one — we'll tailor the rest of the conversation.</div>
	          <div class="chip-row">
	            <button class="chip">Student · Career clarity</button>
	            <button class="chip">Student · YLP / Placement readiness</button>
	            <button class="chip">Parent · For my child</button>
	            <button class="chip">Educator · School / College</button>
	            <button class="chip">Institution · Bulk programs</button>
	            <button class="chip">L&amp;D · For my team</button>
	            <button class="chip">Founder / Leadership</button>
	          </div>
	          <div class="step-actions">
	            <button class="step-back" data-back disabled>← Back</button>
	            <button class="btn btn--solid hoverable" data-next>Continue <span class="arrow"></span></button>
	          </div>
	        </div>

	        <div class="lead-step">
	          <div class="step-eyebrow">Step 02 / 04</div>
	          <h4>Which intervention?</h4>
	          <div class="step-sub">Pick all that interest you. We'll bring the right person to the call.</div>
	          <div class="chip-row" data-multi="true">
	            <button class="chip">Career Architecture · Decision Lab</button>
	            <button class="chip">Young Leaders Program (YLP)</button>
	            <button class="chip">YLP Pro · Placement</button>
	            <button class="chip">Beyond Teaching · FDP</button>
	            <button class="chip">Executive Effectiveness</button>
	            <button class="chip">Core Skills (Communication, Sales, AI…)</button>
	            <button class="chip">Custom Solution</button>
	            <button class="chip">Not sure yet</button>
	          </div>
	          <div class="step-actions">
	            <button class="step-back" data-back>← Back</button>
	            <button class="btn btn--solid hoverable" data-next>Continue <span class="arrow"></span></button>
	          </div>
	        </div>

	        <div class="lead-step">
	          <div class="step-eyebrow">Step 03 / 04</div>
	          <h4>How should we reach you?</h4>
	          <div class="step-sub">We respond within 1 business day. Always honest, never pushy.</div>
	          <div class="field">
	            <label>Full name</label>
	            <input type="text" name="lead_name" placeholder="Your name" />
	          </div>
	          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">
	            <div class="field">
	              <label>Email</label>
	              <input type="email" name="lead_email" placeholder="you@example.com" />
	            </div>
	            <div class="field">
	              <label>Mobile (with code)</label>
	              <input type="tel" name="lead_phone" placeholder="+91 98xx xx xx xx" />
	            </div>
	          </div>
	          <div class="field">
	            <label>Organisation / Institution (optional)</label>
	            <input type="text" name="lead_org" placeholder="Where you study or work" />
	          </div>
	          <div class="step-actions">
	            <button class="step-back" data-back>← Back</button>
	            <button class="btn btn--solid hoverable" data-next>Continue <span class="arrow"></span></button>
	          </div>
	        </div>

	        <div class="lead-step">
	          <div class="step-eyebrow">Step 04 / 04</div>
	          <h4>One last thing.</h4>
	          <div class="step-sub">In a line or two — what's the real reason you're here?</div>
	          <div class="field">
	            <label>Context</label>
	            <textarea rows="4" name="lead_context" placeholder="I'm trying to figure out…"></textarea>
	          </div>
	          <div class="field">
	            <label>Preferred time</label>
	            <select name="lead_time">
	              <option>Weekday · Morning (10am–12pm IST)</option>
	              <option>Weekday · Afternoon (1pm–4pm IST)</option>
	              <option>Weekday · Evening (5pm–8pm IST)</option>
	              <option>Weekend · I'll pick a slot</option>
	            </select>
	          </div>
	          <div class="step-actions">
	            <button class="step-back" data-back>← Back</button>
	            <button class="btn btn--solid hoverable" data-submit>Request the Call <span class="arrow"></span></button>
	          </div>
	        </div>

	      </div>

	      <div class="lead-success" style="display:none">
	        <div class="check">✓</div>
	        <h4 style="font-family: var(--f-serif); font-size: 32px; margin:0 0 10px;">Thank you — we'll be in touch.</h4>
	        <p style="color: var(--bone-mute); font-size: 15px;">Look out for a personal note from the SELF team within one business day.</p>
	        <div class="gold-rule center" style="margin: 30px 0; justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
	        <p style="color: var(--bone-mute); font-size: 13px; letter-spacing: 0.18em; text-transform: uppercase;">In the meantime · explore the journeys</p>
	      </div>
	    </div>
	  </div>
	</div>
	<?php
	return ob_get_clean();
}

// ─── Image Size Registration ──────────────────────────────────────────────────
function selfbygs_image_sizes() {
	add_image_size( 'selfbygs-hero', 1920, 1080, true );
	add_image_size( 'selfbygs-card', 800, 600, true );
	add_image_size( 'selfbygs-portrait', 600, 800, true );
	add_image_size( 'selfbygs-thumb', 400, 300, true );
}
add_action( 'after_setup_theme', 'selfbygs_image_sizes' );

// ─── Excerpt Length ───────────────────────────────────────────────────────────
function selfbygs_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'selfbygs_excerpt_length' );

function selfbygs_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'selfbygs_excerpt_more' );

// ─── Breadcrumb Helper ────────────────────────────────────────────────────────
function selfbygs_breadcrumb( $parent_label = '', $parent_url = '' ) {
	if ( ! $parent_label ) return;
	?>
	<div class="pd-crumb">
	  <div class="pd-crumb-row">
	    <nav class="pd-trail" aria-label="Breadcrumb">
	      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="sep"></span>
	      <?php if ( $parent_url ) : ?>
	        <a href="<?php echo esc_url( $parent_url ); ?>"><?php echo esc_html( $parent_label ); ?></a><span class="sep"></span>
	      <?php endif; ?>
	      <span class="current"><?php echo esc_html( get_the_title() ); ?></span>
	    </nav>
	    <?php if ( $parent_url ) : ?>
	    <a href="<?php echo esc_url( $parent_url ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to <?php echo esc_html( $parent_label ); ?></span></a>
	    <?php endif; ?>
	  </div>
	</div>
	<?php
}
