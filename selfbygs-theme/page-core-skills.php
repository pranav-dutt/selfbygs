<?php
/**
 * Template Name: Core Skills Interventions
 */
add_action( 'wp_enqueue_scripts', function() {
	$css_file = get_template_directory() . '/assets/css/program-core-skills.css';
	if ( file_exists( $css_file ) ) {
		wp_add_inline_style( 'selfbygs-program-detail', file_get_contents( $css_file ) );
	}
}, 20 );
get_header();
?>

<div class="grain"></div>

<!-- ===== Breadcrumb ===== -->
<div class="pd-crumb">
  <div class="pd-crumb-row">
    <nav class="pd-trail" aria-label="Breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="sep"></span>
      <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">Corporate</a><span class="sep"></span>
      <span class="current">Core Skills</span>
    </nav>
    <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to Corporate</span></a>
  </div>
</div>

<!-- ===== Hero ===== -->
<section class="pd-hero" data-screen-label="01 Hero">
  <div class="pd-hero-inner">
    <div>
      <div class="pd-tag reveal"><span class="l"></span><span>Side II · Corporate · Program 02</span></div>
      <h1>
        <span class="reveal-mask"><span>Core <em>Skills</em></span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span><em>Interventions.</em></span></span>
      </h1>
      <p class="pd-tagline reveal" style="--d:340ms">Better skills create <em>better execution.</em></p>
      <div class="pd-hero-cta reveal" style="--d:500ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Core Skills · Clarity Call" data-label="Core Skills · Team Workshop">
          Customise for my team <span class="arrow"></span>
        </button>
      </div>
    </div>
    <div class="pd-hero-meta reveal" style="--d:600ms">
      <div class="pd-meta-row"><div class="lbl">Format</div><div class="val">Custom workshops · No off-the-shelf modules</div></div>
      <div class="pd-meta-row"><div class="lbl">For</div><div class="val">Working professionals · Teams · Cohorts</div></div>
      <div class="pd-meta-row"><div class="lbl">Areas</div><div class="val">Communication · Presentation · Sales · Negotiation · AI · More</div></div>
      <div class="pd-meta-row"><div class="lbl">Designed by</div><div class="val">Gaurav Sharma &amp; Associates</div></div>
    </div>
  </div>
</section>

<!-- ===== Lead ===== -->
<section class="pd-lead">
  <div class="pd-lead-inner">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Why this exists</span></div>
    <h2 class="reveal" style="--d:120ms">Most organisational challenges aren't caused by lack of <em>effort.</em></h2>
    <p class="reveal" style="--d:240ms">They emerge from gaps in communication, collaboration, professional effectiveness, and execution capability. Every Core Skills program is custom-built around your organisation — not a generic catalogue. Experiential, industry-aware, application-led. Designed to improve not only learning, but workplace effectiveness.</p>
  </div>
</section>

<!-- ===== Framework ===== -->
<section class="pd-fw">
  <div class="pd-fw-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>The APPLY Framework</span></div>
    <h2 class="reveal" style="--d:120ms">Capability that <em>shows up at work.</em></h2>
    <p class="reveal" style="--d:240ms">Each letter is a design principle. Skills aren't built in a classroom — they're built through structured practice that translates to the workplace.</p>
  </div>
  <div class="pd-fw-grid is-five">
    <div class="pd-fw-step reveal"><div class="letter">A</div><div><div class="title">Adapt to Context</div><div class="desc">Build skills relevant to real workplace situations.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:100ms"><div class="letter">P</div><div><div class="title">Practice Actively</div><div class="desc">Learn through interaction, activities, and application.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:200ms"><div class="letter">P</div><div><div class="title">Perform Better</div><div class="desc">Strengthen communication, execution, and effectiveness.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:300ms"><div class="letter">L</div><div><div class="title">Learn Continuously</div><div class="desc">Growth-oriented capability building.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:400ms"><div class="letter">Y</div><div><div class="title">Yield Results</div><div class="desc">Workplace efficiency, collaboration, outcomes.</div></div></div>
  </div>
</section>

<!-- ===== Inclusions ===== -->
<section class="pd-include">
  <div class="pd-include-inner">
    <div>
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Capability areas</span></div>
      <h2 class="reveal" style="--d:120ms">Nine working capabilities. <em>Custom-built.</em></h2>
      <p class="lede reveal" style="--d:240ms">Each capability is a starting point — every engagement is sculpted to your team, sector, and stage. No pre-packaged modules.</p>
    </div>
    <ul class="pd-include-list">
      <li class="reveal"><div class="num">01</div><div class="item">Communication Skills<span class="sub">Workplace communication, clarity, confidence, and collaboration.</span></div></li>
      <li class="reveal" style="--d:80ms"><div class="num">02</div><div class="item">Presentation Mastery<span class="sub">Structured thinking, impactful presentations, audience engagement.</span></div></li>
      <li class="reveal" style="--d:160ms"><div class="num">03</div><div class="item">Sales Skills<span class="sub">Professional conversations, persuasion, relationship-building, conversion.</span></div></li>
      <li class="reveal" style="--d:240ms"><div class="num">04</div><div class="item">Negotiation Skills<span class="sub">Handle conversations, expectations, and outcomes more effectively.</span></div></li>
      <li class="reveal" style="--d:320ms"><div class="num">05</div><div class="item">Team Collaboration<span class="sub">Coordination, participation, and collective execution.</span></div></li>
      <li class="reveal" style="--d:400ms"><div class="num">06</div><div class="item">Time &amp; Priority<span class="sub">Work with greater structure, focus, and efficiency.</span></div></li>
      <li class="reveal" style="--d:480ms"><div class="num">07</div><div class="item">AI Productivity<span class="sub">Practical usage of AI for workplace productivity and smarter execution.</span></div></li>
      <li class="reveal" style="--d:560ms"><div class="num">08</div><div class="item">Custom Capability<span class="sub">Industry-specific challenges, team requirements, organisational goals.</span></div></li>
      <li class="reveal" style="--d:640ms"><div class="num">09</div><div class="item">Train the Trainer<span class="sub">For institutions building stronger internal capability systems.</span></div></li>
    </ul>
  </div>
</section>

<!-- ===== Outcomes ===== -->
<section class="pd-outcomes">
  <div class="pd-outcomes-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What changes</span></div>
    <h2 class="reveal" style="--d:120ms">Skills <em>that translate.</em></h2>
  </div>
  <div class="pd-outcomes-grid">
    <div class="pd-out-card reveal">
      <div class="ic">01 · Individual</div>
      <h4>Sharper Working Professionals</h4>
      <p>Individuals leave with capability they actively use on the job — not certificates that sit in a drawer.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:140ms">
      <div class="ic">02 · Team</div>
      <h4>Better Coordination</h4>
      <p>Teams develop shared language, smoother handoffs, and stronger collective execution.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:280ms">
      <div class="ic">03 · Org</div>
      <h4>Reduced Friction</h4>
      <p>Workplace effectiveness improves where it matters: meetings, conversations, decisions, outcomes.</p>
    </div>
  </div>
</section>

<!-- ===== Audience ===== -->
<section class="pd-audience">
  <div class="pd-aud-inner">
    <div class="pd-aud-head">
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Who this is for</span></div>
      <h2 class="reveal" style="--d:120ms">For <em>any team</em> serious about capability.</h2>
    </div>
    <div class="pd-aud-grid">
      <div class="pd-aud-cell"><div class="num">01</div><h4>Founders &amp; Leadership</h4><p>Building the skills the founding team needs to scale.</p></div>
      <div class="pd-aud-cell"><div class="num">02</div><h4>Sales &amp; GTM Teams</h4><p>Sharper conversations, better negotiation, higher conversion.</p></div>
      <div class="pd-aud-cell"><div class="num">03</div><h4>Cross-Functional</h4><p>Teams that need stronger collaboration and clearer communication.</p></div>
      <div class="pd-aud-cell"><div class="num">04</div><h4>Specific Roles</h4><p>Custom programs for managers, ICs, or specialised functions.</p></div>
    </div>
  </div>
</section>

<!-- ===== Other programs ===== -->
<section class="pd-other">
  <div class="pd-other-head">
    <div>
      <div class="pd-section-eyebrow"><span style="width:40px;height:1px;background:currentColor;"></span><span>Continue the journey</span></div>
      <h2>Other <em>Corporate</em> programs</h2>
    </div>
    <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>" class="btn hoverable" style="color: var(--gold); border-color: var(--gold);">Back to Corporate <span class="arrow"></span></a>
  </div>
  <div class="pd-other-grid">
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>">
      <div class="tag">Program 01 · B2B</div>
      <h4>Executive Effectiveness Programs</h4>
      <p>Behaviour, communication, alignment. Built around real workplace realities and team dynamics — not lecture-led training.</p>
      <div class="foot"><span>View program →</span><div class="go">→</div></div>
    </a>
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>">
      <div class="tag">Program 03 · Bespoke</div>
      <h4>Diagnostic Audit &amp; Custom Solutions</h4>
      <p>Diagnose first. Then design. The CLEAR framework helps organisations move beyond symptoms to root causes.</p>
      <div class="foot"><span>View program →</span><div class="go">→</div></div>
    </a>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="pd-cta" id="contact">
  <div class="pd-cta-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="pd-section-eyebrow reveal" style="--d:80ms; color:var(--gold)"><span style="width:40px;height:1px;background:currentColor;"></span><span>Begin</span></div>
    <h2 class="reveal" style="--d:160ms">Don't buy training. <em>Design capability.</em></h2>
    <p class="reveal" style="--d:240ms">A 30-minute clarity call. Tell us what your team needs and the realities they're working in — we'll design something that actually fits.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Core Skills · Clarity Call" data-label="Core Skills · Team Workshop">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
