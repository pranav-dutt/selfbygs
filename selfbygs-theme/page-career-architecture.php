<?php
/**
 * Template Name: Career Architecture Lab
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/program-career-architecture.css';
    if ( file_exists($css_file) ) {
        wp_add_inline_style('selfbygs-program-detail', file_get_contents($css_file));
    }
}, 20);
get_header();
?>

<div class="grain"></div>

<!-- ===== Breadcrumb ===== -->
<div class="pd-crumb">
  <div class="pd-crumb-row">
    <nav class="pd-trail" aria-label="Breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="sep"></span>
      <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">Academia</a><span class="sep"></span>
      <span class="current">Career Architecture</span>
    </nav>
    <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to Academia</span></a>
  </div>
</div>

<!-- ===== Hero ===== -->
<section class="pd-hero" data-screen-label="01 Hero">
  <div class="pd-hero-inner">
    <div>
      <div class="pd-tag reveal"><span class="l"></span><span>Side I · Academia · Program 01</span></div>
      <h1>
        <span class="reveal-mask"><span>Career <em>Architecture</em></span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span>Decision Design <em>Lab.</em></span></span>
      </h1>
      <p class="pd-tagline reveal" style="--d:340ms">
        Clarity is not found. <em>It is designed.</em>
      </p>
      <div class="pd-hero-cta reveal" style="--d:500ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Career Architecture · Clarity Call" data-label="Career Architecture Lab">
          Apply for the Lab <span class="arrow"></span>
        </button>
      </div>
    </div>
    <div class="pd-hero-meta reveal" style="--d:600ms">
      <div class="pd-meta-row"><div class="lbl">Format</div><div class="val">1 : 1 with student &amp; family</div></div>
      <div class="pd-meta-row"><div class="lbl">For</div><div class="val">Grade 9–12 · Post-12 stuck · College reconsidering</div></div>
      <div class="pd-meta-row"><div class="lbl">Cohort</div><div class="val">Very limited · 2026 intake</div></div>
      <div class="pd-meta-row"><div class="lbl">Designed by</div><div class="val">Gaurav Sharma &amp; Dr. Tanya Soin Gaurav</div></div>
    </div>
  </div>
</section>

<!-- ===== Lead ===== -->
<section class="pd-lead">
  <div class="pd-lead-inner">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Why this exists</span></div>
    <h2 class="reveal" style="--d:120ms">Most students don't struggle because they lack <em>options.</em> They struggle because no one taught them how to <em>decide.</em></h2>
    <p class="reveal" style="--d:240ms">A structured, thinking-first career lab — for students who want to choose with clarity, not confusion. Not a counselling questionnaire. Not an aptitude PDF. A wholesome, designed thinking journey that builds the decision-making capability students will use for the rest of their lives.</p>
  </div>
</section>

<!-- ===== Framework ===== -->
<section class="pd-fw">
  <div class="pd-fw-head">
    <div class="gold-rule center reveal" style="justify-content:center;display:flex;"><span class="line" style="background:var(--gold-deep)"></span><span class="bead" style="background:var(--gold-deep)"></span><span class="line" style="background:var(--gold-deep)"></span></div>
    <div class="pd-section-eyebrow reveal" style="--d:80ms;color:var(--gold-deep);margin-top:18px"><span style="width:40px;height:1px;background:currentColor;"></span><span>The SELF Decision Framework</span></div>
    <h2 class="reveal" style="--d:120ms">Six stages. Used <em>deeply.</em></h2>
    <p class="reveal" style="--d:240ms">A simple structure used in depth — across multiple sessions, conversations, and reflections with the student and family.</p>
  </div>
  <ul class="decide-list">
    <li class="decide-row reveal hoverable">
      <div class="decide-letter">D</div>
      <div class="decide-title">Discover Self</div>
      <div class="decide-desc">Go beyond marks, subjects, and labels. See yourself as you are — and as you could be.</div>
    </li>
    <li class="decide-row reveal hoverable" style="--d:80ms">
      <div class="decide-letter">E</div>
      <div class="decide-title">Explore Real Options</div>
      <div class="decide-desc">See careers, roles, and paths as they actually are — not as they are advertised.</div>
    </li>
    <li class="decide-row reveal hoverable" style="--d:160ms">
      <div class="decide-letter">C</div>
      <div class="decide-title">Create Decision Filters</div>
      <div class="decide-desc">Build your own criteria. Decide what fits, what doesn't, and why.</div>
    </li>
    <li class="decide-row reveal hoverable" style="--d:240ms">
      <div class="decide-letter">I</div>
      <div class="decide-title">Integrate Inputs</div>
      <div class="decide-desc">Align self, opportunity, and reality. Hold the whole picture at once.</div>
    </li>
    <li class="decide-row reveal hoverable" style="--d:320ms">
      <div class="decide-letter">D</div>
      <div class="decide-title">Decide with Clarity</div>
      <div class="decide-desc">Choose with ownership — not pressure, not noise, not guesswork.</div>
    </li>
    <li class="decide-row reveal hoverable" style="--d:400ms">
      <div class="decide-letter">E</div>
      <div class="decide-title">Evolve Continuously</div>
      <div class="decide-desc">Because one decision is not your whole life. Capability compounds.</div>
    </li>
  </ul>
</section>

<!-- ===== Inclusions ===== -->
<section class="pd-include">
  <div class="pd-include-inner">
    <div>
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What's inside the lab</span></div>
      <h2 class="reveal" style="--d:120ms">Not advice. <em>Capability.</em></h2>
      <p class="lede reveal" style="--d:240ms">Each lab is a multi-session journey with the student — and often, the family. Designed around the student's actual reality, not a generic curriculum.</p>
    </div>
    <ul class="pd-include-list">
      <li class="reveal"><div class="num">01</div><div class="item">Deep self-discovery sessions<span class="sub">Strengths beyond marks, behaviour beyond labels, potential beyond peer comparison.</span></div></li>
      <li class="reveal" style="--d:80ms"><div class="num">02</div><div class="item">Real-world options mapping<span class="sub">Careers as they actually exist — sectors, roles, growth paths, lived realities.</span></div></li>
      <li class="reveal" style="--d:160ms"><div class="num">03</div><div class="item">Decision filter design<span class="sub">A personal criteria framework the student builds and owns.</span></div></li>
      <li class="reveal" style="--d:240ms"><div class="num">04</div><div class="item">Family-aligned conversation<span class="sub">Bringing parents into the picture — not as judges, but as collaborators.</span></div></li>
      <li class="reveal" style="--d:320ms"><div class="num">05</div><div class="item">Decision rehearsal &amp; ownership<span class="sub">Choosing on paper before choosing in life. Practising the muscle.</span></div></li>
      <li class="reveal" style="--d:400ms"><div class="num">06</div><div class="item">Continuous follow-through<span class="sub">A decision-making system that holds up across the next 10 years.</span></div></li>
    </ul>
  </div>
</section>

<!-- ===== Outcomes ===== -->
<section class="pd-outcomes">
  <div class="pd-outcomes-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What you walk away with</span></div>
    <h2 class="reveal" style="--d:120ms">Three quiet outcomes. <em>For life.</em></h2>
  </div>
  <div class="pd-outcomes-grid">
    <div class="pd-out-card reveal">
      <div class="ic">01 · Direction</div>
      <h4>Clear direction aligned with your strengths</h4>
      <p>Not a list of "good careers." A direction that fits who you actually are.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:140ms">
      <div class="ic">02 · System</div>
      <h4>A decision-making system you'll use for life</h4>
      <p>The next career decision, the next big call — you'll have a way to think through it.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:280ms">
      <div class="ic">03 · Confidence</div>
      <h4>Confidence to choose — not guess</h4>
      <p>Ownership over the decision. Capability to defend it. Courage to evolve it.</p>
    </div>
  </div>
</section>

<!-- ===== Audience ===== -->
<section class="pd-audience">
  <div class="pd-aud-inner">
    <div class="pd-aud-head">
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Who this is for</span></div>
      <h2 class="reveal" style="--d:120ms">Designed for the moments <em>that matter.</em></h2>
    </div>
    <div class="pd-aud-grid">
      <div class="pd-aud-cell"><div class="num">01</div><h4>Grade 9–10</h4><p>Choosing streams. Building self-awareness early.</p></div>
      <div class="pd-aud-cell"><div class="num">02</div><h4>Grade 11–12</h4><p>Choosing colleges, programs, and direction with depth.</p></div>
      <div class="pd-aud-cell"><div class="num">03</div><h4>After 12th — Stuck</h4><p>Re-evaluating direction without losing time or confidence.</p></div>
      <div class="pd-aud-cell"><div class="num">04</div><h4>College · Questioning</h4><p>Mid-degree clarity for students re-thinking their path.</p></div>
    </div>
  </div>
</section>

<!-- ===== Other programs ===== -->
<section class="pd-other">
  <div class="pd-other-head">
    <div>
      <div class="pd-section-eyebrow"><span style="width:40px;height:1px;background:currentColor;"></span><span>Continue the journey</span></div>
      <h2>Other <em>Academia</em> programs</h2>
    </div>
    <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>" class="btn hoverable" style="color: var(--gold-deep); border-color: var(--gold-deep);">Back to Academia <span class="arrow"></span></a>
  </div>
  <div class="pd-other-grid">
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>">
      <div class="tag">Program 02 · Cohort</div>
      <h4>Young Leaders Program · YLP &amp; YLP Pro</h4>
      <p>Communication, presence, interviews, leadership. A high-engagement system built around the BUILD framework — for college-ready students.</p>
      <div class="foot"><span>View program →</span><div class="go">→</div></div>
    </a>
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>">
      <div class="tag">Program 03 · FDP</div>
      <h4>Beyond Teaching · Educator Impact</h4>
      <p>Not "teach the teachers" — enhance the effectiveness, presence, and mentoring capability of already capable educators.</p>
      <div class="foot"><span>View program →</span><div class="go">→</div></div>
    </a>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="pd-cta" id="contact">
  <div class="pd-cta-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="pd-section-eyebrow reveal" style="--d:80ms; color:var(--gold)"><span style="width:40px;height:1px;background:currentColor;"></span><span>Begin</span></div>
    <h2 class="reveal" style="--d:160ms">Don't choose a path.<br/><em>Learn how to design one.</em></h2>
    <p class="reveal" style="--d:240ms">A 30-minute clarity call. No pitch. We'll understand the student, the family, the reality — and tell you honestly whether the Lab is the right next step.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Career Architecture · Clarity Call" data-label="Career Architecture Lab">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
