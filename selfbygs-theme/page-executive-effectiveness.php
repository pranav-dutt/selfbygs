<?php
/**
 * Template Name: Executive Effectiveness
 */
add_action( 'wp_enqueue_scripts', function() {
	$css_file = get_template_directory() . '/assets/css/program-executive-effectiveness.css';
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
      <span class="current">Executive Effectiveness</span>
    </nav>
    <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to Corporate</span></a>
  </div>
</div>

<!-- ===== Hero ===== -->
<section class="pd-hero" data-screen-label="01 Hero">
  <div class="pd-hero-inner">
    <div>
      <div class="pd-tag reveal"><span class="l"></span><span>Side II · Corporate · Program 01</span></div>
      <h1>
        <span class="reveal-mask"><span>Executive</span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span><em>Effectiveness Programs.</em></span></span>
      </h1>
      <p class="pd-tagline reveal" style="--d:340ms">Organisations become more effective <em>when people become more effective.</em></p>
      <div class="pd-hero-cta reveal" style="--d:500ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Executive Effectiveness · Clarity Call" data-label="Executive Effectiveness Program">
          Discuss your team <span class="arrow"></span>
        </button>
      </div>
    </div>
    <div class="pd-hero-meta reveal" style="--d:600ms">
      <div class="pd-meta-row"><div class="lbl">Format</div><div class="val">B2B · Cohort or 1:1 leadership coaching</div></div>
      <div class="pd-meta-row"><div class="lbl">For</div><div class="val">Leadership · Managers · High-potential employees</div></div>
      <div class="pd-meta-row"><div class="lbl">Delivery</div><div class="val">On-site · Workshop series + coaching follow-through</div></div>
      <div class="pd-meta-row"><div class="lbl">Designed by</div><div class="val">Gaurav Sharma &amp; Associates</div></div>
    </div>
  </div>
</section>

<!-- ===== Lead ===== -->
<section class="pd-lead">
  <div class="pd-lead-inner">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Why this exists</span></div>
    <h2 class="reveal" style="--d:120ms">Growth doesn't depend only on <em>targets &amp; strategies.</em> It depends on <em>capability.</em></h2>
    <p class="reveal" style="--d:240ms">Growth depends on communication, ownership, execution, leadership, and team alignment. These programs are not lecture-led corporate training — they are behaviour-first, execution-focused, and deeply experiential. Designed for the leadership layers that actually deliver.</p>
  </div>
</section>

<!-- ===== Framework ===== -->
<section class="pd-fw">
  <div class="pd-fw-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>The LEAD Framework</span></div>
    <h2 class="reveal" style="--d:120ms">Four shifts. <em>One layer of leaders.</em></h2>
    <p class="reveal" style="--d:240ms">Each letter is a capability shift — the working leadership outcomes we design for in every engagement.</p>
  </div>
  <div class="pd-fw-grid is-four">
    <div class="pd-fw-step reveal"><div class="letter">L</div><div><div class="title">Lead Self First</div><div class="desc">Build ownership, awareness, and consistency.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:100ms"><div class="letter">E</div><div><div class="title">Engage People Better</div><div class="desc">Strengthen communication and team effectiveness.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:200ms"><div class="letter">A</div><div><div class="title">Align Teams &amp; Execution</div><div class="desc">Improve coordination, accountability, collaboration.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:300ms"><div class="letter">D</div><div><div class="title">Drive Growth</div><div class="desc">Sustainable performance through people capability.</div></div></div>
  </div>
</section>

<!-- ===== Inclusions ===== -->
<section class="pd-include">
  <div class="pd-include-inner">
    <div>
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Where we work</span></div>
      <h2 class="reveal" style="--d:120ms">Five capability layers. <em>Designed in depth.</em></h2>
      <p class="lede reveal" style="--d:240ms">Each engagement is shaped to the organisation's reality — not pulled from a deck. We work across the layers that move the needle most.</p>
    </div>
    <ul class="pd-include-list">
      <li class="reveal"><div class="num">01</div><div class="item">Leadership &amp; Ownership<span class="sub">Initiative, accountability, decision-making ability.</span></div></li>
      <li class="reveal" style="--d:80ms"><div class="num">02</div><div class="item">Communication Effectiveness<span class="sub">Clarity, collaboration, feedback, difficult conversations.</span></div></li>
      <li class="reveal" style="--d:160ms"><div class="num">03</div><div class="item">Execution &amp; Team Alignment<span class="sub">Structure, responsibility, coordination, follow-through.</span></div></li>
      <li class="reveal" style="--d:240ms"><div class="num">04</div><div class="item">Professional Effectiveness<span class="sub">Workplace behaviour, presence, reliability.</span></div></li>
      <li class="reveal" style="--d:320ms"><div class="num">05</div><div class="item">People &amp; Team Capability<span class="sub">Interpersonal and managerial effectiveness across the team.</span></div></li>
    </ul>
  </div>
</section>

<!-- ===== Outcomes ===== -->
<section class="pd-outcomes">
  <div class="pd-outcomes-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What changes</span></div>
    <h2 class="reveal" style="--d:120ms">Behavioural. <em>Measurable. Lasting.</em></h2>
  </div>
  <div class="pd-outcomes-grid">
    <div class="pd-out-card reveal">
      <div class="ic">01 · Behaviour</div>
      <h4>Behavioural Shifts</h4>
      <p>Leaders stop reacting and start leading. Ownership, alignment, and communication change first.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:140ms">
      <div class="ic">02 · Execution</div>
      <h4>Sharper Execution</h4>
      <p>Better coordination, clearer accountability, less friction across teams.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:280ms">
      <div class="ic">03 · Culture</div>
      <h4>Compounding Capability</h4>
      <p>Capability that scales as the organisation scales. Not a one-off training event.</p>
    </div>
  </div>
</section>

<!-- ===== Audience ===== -->
<section class="pd-audience">
  <div class="pd-aud-inner">
    <div class="pd-aud-head">
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Who this is for</span></div>
      <h2 class="reveal" style="--d:120ms">Built for the <em>leadership layers</em> that deliver.</h2>
    </div>
    <div class="pd-aud-grid">
      <div class="pd-aud-cell"><div class="num">01</div><h4>Leadership Teams</h4><p>Founders, CXOs, senior leaders aligning on direction and execution.</p></div>
      <div class="pd-aud-cell"><div class="num">02</div><h4>Managers &amp; Team Leads</h4><p>The middle that translates strategy into outcomes.</p></div>
      <div class="pd-aud-cell"><div class="num">03</div><h4>High-Potential Employees</h4><p>Future leaders being prepared for the next stretch.</p></div>
      <div class="pd-aud-cell"><div class="num">04</div><h4>Cross-Functional Teams</h4><p>Teams that need shared language, trust, and execution rhythm.</p></div>
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
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>">
      <div class="tag">Program 02 · Custom</div>
      <h4>Core Skills · Interventions</h4>
      <p>Communication, sales, negotiation, AI productivity. Every program is custom-built around your team — not a generic catalogue.</p>
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
    <h2 class="reveal" style="--d:160ms">Not every challenge needs <em>more pressure.</em><br/>Sometimes it needs better alignment.</h2>
    <p class="reveal" style="--d:240ms">A 30-minute clarity call. We listen to the organisation's reality, then propose what would actually move the needle — or honestly say what wouldn't.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Executive Effectiveness · Clarity Call" data-label="Executive Effectiveness Program">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
