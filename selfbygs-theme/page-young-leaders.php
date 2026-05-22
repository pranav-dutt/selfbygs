<?php
/**
 * Template Name: Young Leaders Program
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/program-young-leaders.css';
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
      <span class="current">Young Leaders · YLP</span>
    </nav>
    <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to Academia</span></a>
  </div>
</div>

<!-- ===== Hero ===== -->
<section class="pd-hero" data-screen-label="01 Hero">
  <div class="pd-hero-inner">
    <div>
      <div class="pd-tag reveal"><span class="l"></span><span>Side I · Academia · Program 02</span></div>
      <h1>
        <span class="reveal-mask"><span>Young Leaders</span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span>Program · <em>YLP &amp; YLP Pro.</em></span></span>
      </h1>
      <p class="pd-tagline reveal" style="--d:340ms">Students don't lack potential. They lack <em>preparation</em> for the real world.</p>
      <div class="pd-hero-cta reveal" style="--d:500ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="YLP · Clarity Call" data-label="Young Leaders Program">
          Apply for YLP / YLP Pro <span class="arrow"></span>
        </button>
      </div>
    </div>
    <div class="pd-hero-meta reveal" style="--d:600ms">
      <div class="pd-meta-row"><div class="lbl">Format</div><div class="val">Cohort-based · Limited seats</div></div>
      <div class="pd-meta-row"><div class="lbl">For</div><div class="val">College students · Placement-ready · Industry-bound</div></div>
      <div class="pd-meta-row"><div class="lbl">Tracks</div><div class="val">YLP (full journey) · YLP Pro (placement-focused)</div></div>
      <div class="pd-meta-row"><div class="lbl">Designed by</div><div class="val">Gaurav Sharma &amp; Dr. Tanya Soin Gaurav</div></div>
    </div>
  </div>
</section>

<!-- ===== Lead ===== -->
<section class="pd-lead">
  <div class="pd-lead-inner">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Why this exists</span></div>
    <h2 class="reveal" style="--d:120ms">Students don't lack <em>knowledge.</em> They lack <em>practice</em> in being heard, seen, and ready.</h2>
    <p class="reveal" style="--d:240ms">A high-engagement development system. Not passive learning — students actively practice, present, communicate, interview, participate, and improve. Built around the BUILD framework — five capabilities every college-ready student needs to walk into the real world with confidence.</p>
  </div>
</section>

<!-- ===== Framework ===== -->
<section class="pd-fw">
  <div class="pd-fw-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>The BUILD Framework</span></div>
    <h2 class="reveal" style="--d:120ms">Five capabilities. <em>One leader.</em></h2>
    <p class="reveal" style="--d:240ms">Each letter is a working capability, not a topic. Students don't just learn about it — they practise it across the cohort journey.</p>
  </div>
  <div class="pd-fw-grid is-five">
    <div class="pd-fw-step reveal"><div class="letter">B</div><div><div class="title">Build Awareness</div><div class="desc">Strengths, gaps, behaviour, potential. The work begins by seeing clearly.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:100ms"><div class="letter">U</div><div><div class="title">Upgrade Communication</div><div class="desc">Speak, present, write, express — with clarity and presence.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:200ms"><div class="letter">I</div><div><div class="title">Interact Professionally</div><div class="desc">Interviews, group discussions, real-world situations.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:300ms"><div class="letter">L</div><div><div class="title">Lead Self First</div><div class="desc">Initiative, discipline, confidence, ownership.</div></div></div>
    <div class="pd-fw-step reveal" style="--d:400ms"><div class="letter">D</div><div><div class="title">Deliver Consistently</div><div class="desc">Perform with preparation and presence — every time.</div></div></div>
  </div>
</section>

<!-- ===== Inclusions ===== -->
<section class="pd-include">
  <div class="pd-include-inner">
    <div>
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What students actually work on</span></div>
      <h2 class="reveal" style="--d:120ms">Not theory. <em>Real practice.</em></h2>
      <p class="lede reveal" style="--d:240ms">Every session is participative. Students speak, present, write, interview, and reflect — with structured feedback that compounds session over session.</p>
    </div>
    <ul class="pd-include-list">
      <li class="reveal"><div class="num">01</div><div class="item">Communication, group discussions, presentations &amp; mock presentations<span class="sub">Continuous practice with structured feedback.</span></div></li>
      <li class="reveal" style="--d:80ms"><div class="num">02</div><div class="item">Written communication — email, WhatsApp, professional digital writing<span class="sub">The real channels professionals use today.</span></div></li>
      <li class="reveal" style="--d:160ms"><div class="num">03</div><div class="item">Resume, video profile, LinkedIn &amp; digital presence<span class="sub">Building the professional self students will be evaluated through.</span></div></li>
      <li class="reveal" style="--d:240ms"><div class="num">04</div><div class="item">Mock interviews, FAQs, grooming &amp; professional presence<span class="sub">High-stakes practice in low-stakes settings.</span></div></li>
      <li class="reveal" style="--d:320ms"><div class="num">05</div><div class="item">Leadership, teamwork, emotional intelligence, "Chak De" goal-setting<span class="sub">The mindset that makes capability translate into outcomes.</span></div></li>
      <li class="reveal" style="--d:400ms"><div class="num">06</div><div class="item">AI for students — practical, applied, modern<span class="sub">How to use the tools the world is already using.</span></div></li>
    </ul>
  </div>
</section>

<!-- ===== Outcomes ===== -->
<section class="pd-outcomes">
  <div class="pd-outcomes-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>YLP vs YLP Pro</span></div>
    <h2 class="reveal" style="--d:120ms">Two tracks. <em>One philosophy.</em></h2>
  </div>
  <div class="pd-outcomes-grid">
    <div class="pd-out-card reveal">
      <div class="ic">01 · YLP</div>
      <h4>YLP · Full Journey</h4>
      <p>A structured journey for college students. Communication, leadership, professionalism, career readiness — through continuous practice across the program.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:140ms">
      <div class="ic">02 · YLP Pro</div>
      <h4>YLP Pro · Placement Sharp</h4>
      <p>A placement-focused, sharp program for high-stakes interviews, group discussions, internships, and professional positioning.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:280ms">
      <div class="ic">03 · Both</div>
      <h4>Designed Around Where You Are</h4>
      <p>Students join the track that fits their stage. Clarity call helps us recommend the right path.</p>
    </div>
  </div>
</section>

<!-- ===== Audience ===== -->
<section class="pd-audience">
  <div class="pd-aud-inner">
    <div class="pd-aud-head">
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Who this is for</span></div>
      <h2 class="reveal" style="--d:120ms">Built for the <em>college-ready</em> moment.</h2>
    </div>
    <div class="pd-aud-grid">
      <div class="pd-aud-cell"><div class="num">01</div><h4>Year 1–2 College</h4><p>Building communication and leadership early in college life.</p></div>
      <div class="pd-aud-cell"><div class="num">02</div><h4>Final Year</h4><p>Preparing for placements, GDs, interviews, and industry entry.</p></div>
      <div class="pd-aud-cell"><div class="num">03</div><h4>Internship-Bound</h4><p>Sharpening the professional self before high-stakes opportunities.</p></div>
      <div class="pd-aud-cell"><div class="num">04</div><h4>Recent Graduates</h4><p>Closing the gap between college and the first big role.</p></div>
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
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>">
      <div class="tag">Program 01 · 1:1</div>
      <h4>Career Architecture · Decision Design Lab</h4>
      <p>A wholesome, designed thinking journey for students who want to choose with clarity, not confusion.</p>
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
    <h2 class="reveal" style="--d:160ms">The world is asking different questions.<br/><em>Help students answer them.</em></h2>
    <p class="reveal" style="--d:240ms">A 30-minute clarity call. No pitch. We listen to what the student or institution needs, and tell you honestly whether YLP fits — or what does.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="YLP · Clarity Call" data-label="Young Leaders Program">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
