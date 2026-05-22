<?php
/**
 * Template Name: Diagnostic Audit & Custom Solutions
 */
add_action( 'wp_enqueue_scripts', function() {
	$css_file = get_template_directory() . '/assets/css/program-diagnostic-audit.css';
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
      <span class="current">Diagnostic Audit</span>
    </nav>
    <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to Corporate</span></a>
  </div>
</div>

<!-- ===== Hero ===== -->
<section class="pd-hero" data-screen-label="01 Hero">
  <div class="pd-hero-inner">
    <div>
      <div class="pd-tag reveal"><span class="l"></span><span>Side II · Corporate · Program 03</span></div>
      <h1>
        <span class="reveal-mask"><span>Diagnostic <em>Audit</em></span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span>&amp; <em>Custom Solutions.</em></span></span>
      </h1>
      <p class="pd-tagline reveal" style="--d:340ms">Before solving a challenge, it helps to <em>understand it clearly.</em></p>
      <div class="pd-hero-cta reveal" style="--d:500ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Diagnostic Audit · Clarity Call" data-label="Diagnostic Audit">
          Request a Diagnostic <span class="arrow"></span>
        </button>
      </div>
    </div>
    <div class="pd-hero-meta reveal" style="--d:600ms">
      <div class="pd-meta-row"><div class="lbl">Format</div><div class="val">Bespoke · Diagnostic-led design</div></div>
      <div class="pd-meta-row"><div class="lbl">Phases</div><div class="val">Pulse-Check → Decode &amp; Analyse → Align &amp; Roadmap</div></div>
      <div class="pd-meta-row"><div class="lbl">Outcome</div><div class="val">Custom intervention pathway · Or honest no-fit signal</div></div>
      <div class="pd-meta-row"><div class="lbl">Designed by</div><div class="val">Gaurav Sharma &amp; Team</div></div>
    </div>
  </div>
</section>

<!-- ===== Lead ===== -->
<section class="pd-lead">
  <div class="pd-lead-inner">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Why this exists</span></div>
    <h2 class="reveal" style="--d:120ms">Many organisational challenges are <em>symptoms</em> — not causes.</h2>
    <p class="reveal" style="--d:240ms">Low ownership, communication gaps, inconsistent execution, team misalignment, slowing growth — these often appear as the problem, but are usually downstream of deeper capability and structural gaps. The Diagnostic Audit helps organisations move beyond assumptions and gain clarity on the human side of performance.</p>
  </div>
</section>

<!-- ===== Framework ===== -->
<section class="pd-fw">
  <div class="pd-fw-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>The CLEAR Framework</span></div>
    <h2 class="reveal" style="--d:120ms">From <em>symptoms</em> to <em>root causes.</em></h2>
    <p class="reveal" style="--d:240ms">A working diagnostic structure used across every engagement — designed to surface what's actually getting in the way.</p>
  </div>
  <div class="pd-fw-grid is-five">
    <div class="pd-fw-step reveal"><div class="letter">C</div><div><div class="title">Capture Reality</div><div class="desc">Observe workplace and team dynamics as they actually are.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:100ms"><div class="letter">L</div><div><div class="title">Locate Gaps</div><div class="desc">Identify the capability and execution challenges underneath.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:200ms"><div class="letter">E</div><div><div class="title">Evaluate Alignment</div><div class="desc">Understand leadership–team alignment, or its absence.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:300ms"><div class="letter">A</div><div><div class="title">Analyse Deeply</div><div class="desc">Move past symptoms to underlying root causes.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:400ms"><div class="letter">R</div><div><div class="title">Recommend Direction</div><div class="desc">Design clearer intervention pathways — or honestly say no fit.</div></div></div>
  </div>
</section>

<!-- ===== Inclusions ===== -->
<section class="pd-include">
  <div class="pd-include-inner">
    <div>
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>How it works</span></div>
      <h2 class="reveal" style="--d:120ms">Three stages. <em>Designed for clarity.</em></h2>
      <p class="lede reveal" style="--d:240ms">Low-friction at the start, deeper as needed. Built for organisations that need clarity without disruption.</p>
    </div>
    <ul class="pd-include-list">
      <li class="reveal"><div class="num">01</div><div class="item">The Pulse-Check<span class="sub">A rapid, low-friction audit through surveys, observations, and one-on-one interactions. Built for high-velocity teams that need clarity without disruption.</span></div></li>
      <li class="reveal" style="--d:80ms"><div class="num">02</div><div class="item">Decode &amp; Analyse<span class="sub">A deeper organisational "biopsy" to identify patterns, bottlenecks, strengths, and capability gaps.</span></div></li>
      <li class="reveal" style="--d:160ms"><div class="num">03</div><div class="item">Align &amp; Roadmap<span class="sub">A focused strategic discussion around priorities, insights, and next steps. The path forward becomes visible.</span></div></li>
    </ul>
  </div>
</section>

<!-- ===== Outcomes ===== -->
<section class="pd-outcomes">
  <div class="pd-outcomes-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What we design around</span></div>
    <h2 class="reveal" style="--d:120ms">Built around <em>your</em> organisation. <em>Not a library.</em></h2>
  </div>
  <div class="pd-outcomes-grid">
    <div class="pd-out-card reveal">
      <div class="ic">01 · Industry</div>
      <h4>Industry Realities</h4>
      <p>Sector-specific challenges, dynamics, and operating norms. No copy-paste solutions.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:140ms">
      <div class="ic">02 · Stage</div>
      <h4>Growth Stage</h4>
      <p>Where the organisation is on its journey — and what capability that stage actually needs.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:280ms">
      <div class="ic">03 · Leadership</div>
      <h4>Leadership Challenges</h4>
      <p>The specific gaps in alignment, execution, and culture that matter right now.</p>
    </div>
  </div>
</section>

<!-- ===== Audience ===== -->
<section class="pd-audience">
  <div class="pd-aud-inner">
    <div class="pd-aud-head">
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Who this is for</span></div>
      <h2 class="reveal" style="--d:120ms">For <em>organisations</em> serious about clarity.</h2>
    </div>
    <div class="pd-aud-grid">
      <div class="pd-aud-cell"><div class="num">01</div><h4>Scaling Companies</h4><p>Where complexity is outpacing the systems and capability in place.</p></div>
      <div class="pd-aud-cell"><div class="num">02</div><h4>Post-Transition</h4><p>After a merger, leadership change, or significant restructure.</p></div>
      <div class="pd-aud-cell"><div class="num">03</div><h4>Misaligned Teams</h4><p>When friction across teams suggests deeper structural issues.</p></div>
      <div class="pd-aud-cell"><div class="num">04</div><h4>Pre-Intervention</h4><p>Before investing in training — making sure the right thing gets built.</p></div>
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
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>">
      <div class="tag">Program 02 · Custom</div>
      <h4>Core Skills · Interventions</h4>
      <p>Communication, sales, negotiation, AI productivity. Every program is custom-built around your team.</p>
      <div class="foot"><span>View program →</span><div class="go">→</div></div>
    </a>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="pd-cta" id="contact">
  <div class="pd-cta-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="pd-section-eyebrow reveal" style="--d:80ms; color:var(--gold)"><span style="width:40px;height:1px;background:currentColor;"></span><span>Begin</span></div>
    <h2 class="reveal" style="--d:160ms">Better interventions <em>begin with better understanding.</em></h2>
    <p class="reveal" style="--d:240ms">A 30-minute clarity call. Tell us what feels off in the organisation — we'll listen first, and tell you honestly whether a diagnostic helps or what would.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Diagnostic Audit · Clarity Call" data-label="Diagnostic Audit">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
