<?php
/**
 * Template Name: Beyond Teaching FDP
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/program-beyond-teaching.css';
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
      <span class="current">Beyond Teaching · FDP</span>
    </nav>
    <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>" class="pd-back hoverable"><span class="ar"></span><span>Back to Academia</span></a>
  </div>
</div>

<!-- ===== Hero ===== -->
<section class="pd-hero" data-screen-label="01 Hero">
  <div class="pd-hero-inner">
    <div>
      <div class="pd-tag reveal"><span class="l"></span><span>Side I · Academia · Program 03</span></div>
      <h1>
        <span class="reveal-mask"><span>Beyond <em>Teaching</em></span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span>Educator <em>Impact Program.</em></span></span>
      </h1>
      <p class="pd-tagline reveal" style="--d:340ms">Great educators do more than teach. They shape how students <em>experience</em> learning.</p>
      <div class="pd-hero-cta reveal" style="--d:500ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Beyond Teaching · Clarity Call" data-label="Beyond Teaching · FDP">
          Bring this to your Institution <span class="arrow"></span>
        </button>
      </div>
    </div>
    <div class="pd-hero-meta reveal" style="--d:600ms">
      <div class="pd-meta-row"><div class="lbl">Format</div><div class="val">FDP / MDP · Workshop series</div></div>
      <div class="pd-meta-row"><div class="lbl">For</div><div class="val">Schools · Colleges · Institutions</div></div>
      <div class="pd-meta-row"><div class="lbl">Delivery</div><div class="val">On-site · Custom-built around your faculty</div></div>
      <div class="pd-meta-row"><div class="lbl">Designed by</div><div class="val">Dr. Tanya Soin Gaurav &amp; Gaurav Sharma</div></div>
    </div>
  </div>
</section>

<!-- ===== Lead ===== -->
<section class="pd-lead">
  <div class="pd-lead-inner">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Why this exists</span></div>
    <h2 class="reveal" style="--d:120ms">Most educators already have <em>subject expertise.</em> What can grow is student <em>connection.</em></h2>
    <p class="reveal" style="--d:240ms">Most educators already possess subject expertise, commitment, and intent. What often remains underdeveloped is deeper student connection, modern engagement methods, and mentoring capability. Not "teach the teachers" — enhance the effectiveness, presence, and impact of already capable educators.</p>
  </div>
</section>

<!-- ===== Framework ===== -->
<section class="pd-fw">
  <div class="pd-fw-head">
    <div class="gold-rule center reveal" style="justify-content:center;display:flex;"><span class="line" style="background:var(--gold-deep)"></span><span class="bead" style="background:var(--gold-deep)"></span><span class="line" style="background:var(--gold-deep)"></span></div>
    <div class="pd-section-eyebrow reveal" style="--d:80ms;color:var(--gold-deep);margin-top:18px"><span style="width:40px;height:1px;background:currentColor;"></span><span>The CONNECT Framework</span></div>
    <h2 class="reveal" style="--d:120ms">Seven habits of the <em>modern educator.</em></h2>
    <p class="reveal" style="--d:240ms">A framework built on how great educators actually create impact — by connecting before they instruct.</p>
  </div>
  <ul class="connect-list">
    <li class="connect-row reveal hoverable">
      <div class="connect-letter">C</div>
      <div class="connect-title">Communicate with Clarity</div>
      <div class="connect-desc">Create stronger understanding and participation in every classroom interaction.</div>
    </li>
    <li class="connect-row reveal hoverable" style="--d:80ms">
      <div class="connect-letter">O</div>
      <div class="connect-title">Observe Deeply</div>
      <div class="connect-desc">Recognise behaviour, motivation, and learning patterns — before intervening.</div>
    </li>
    <li class="connect-row reveal hoverable" style="--d:160ms">
      <div class="connect-letter">N</div>
      <div class="connect-title">Navigate Modern Learning</div>
      <div class="connect-desc">Adapt to digital realities and the changing needs of today's classrooms.</div>
    </li>
    <li class="connect-row reveal hoverable" style="--d:240ms">
      <div class="connect-letter">N</div>
      <div class="connect-title">Nurture Trust</div>
      <div class="connect-desc">Build mentor-like relationships that measurably improve student outcomes.</div>
    </li>
    <li class="connect-row reveal hoverable" style="--d:320ms">
      <div class="connect-letter">E</div>
      <div class="connect-title">Enable Growth</div>
      <div class="connect-desc">Support students beyond academics — with presence, empathy, and clarity.</div>
    </li>
    <li class="connect-row reveal hoverable" style="--d:400ms">
      <div class="connect-letter">C</div>
      <div class="connect-title">Create Presence</div>
      <div class="connect-desc">Strengthen classroom impact and deepen engagement through intentional energy.</div>
    </li>
    <li class="connect-row reveal hoverable" style="--d:480ms">
      <div class="connect-letter">T</div>
      <div class="connect-title">Transform Continuously</div>
      <div class="connect-desc">Evolve as the world of education evolves — never stop becoming a better teacher.</div>
    </li>
  </ul>
</section>

<!-- ===== Inclusions ===== -->
<section class="pd-include">
  <div class="pd-include-inner">
    <div>
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Areas we work on</span></div>
      <h2 class="reveal" style="--d:120ms">Four <em>capability</em> tracks.</h2>
      <p class="lede reveal" style="--d:240ms">Each track is designed around the working educator — not the abstract one. Custom-fit to schools, colleges, and faculty teams.</p>
    </div>
    <ul class="pd-include-list">
      <li class="reveal"><div class="num">01</div><div class="item">Educator Communication &amp; Engagement<span class="sub">Facilitation effectiveness, participation techniques, classroom presence.</span></div></li>
      <li class="reveal" style="--d:80ms"><div class="num">02</div><div class="item">Teacher as Mentor<span class="sub">Building trust, empathy, and structure in the educator–student relationship.</span></div></li>
      <li class="reveal" style="--d:160ms"><div class="num">03</div><div class="item">Modern Educator Readiness<span class="sub">AI tools, digital learning, evolving classroom environments.</span></div></li>
      <li class="reveal" style="--d:240ms"><div class="num">04</div><div class="item">Train-the-Trainer<span class="sub">For institutions building stronger internal capability systems.</span></div></li>
    </ul>
  </div>
</section>

<!-- ===== Outcomes ===== -->
<section class="pd-outcomes">
  <div class="pd-outcomes-head">
    <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>What changes</span></div>
    <h2 class="reveal" style="--d:120ms">For the <em>educator.</em> For the <em>institution.</em></h2>
  </div>
  <div class="pd-outcomes-grid">
    <div class="pd-out-card reveal">
      <div class="ic">01 · Educator</div>
      <h4>Stronger Classroom Presence</h4>
      <p>Educators leave with sharper communication, deeper engagement, and a clearer mentoring style.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:140ms">
      <div class="ic">02 · Student</div>
      <h4>Better Learning Experience</h4>
      <p>Students feel seen, heard, and supported — not just instructed. The classroom experience itself shifts.</p>
    </div>
    <div class="pd-out-card reveal" style="--d:280ms">
      <div class="ic">03 · Institution</div>
      <h4>Compounding Capability</h4>
      <p>A faculty team that grows together, sharing methods and language — building the institution's long-term capability.</p>
    </div>
  </div>
</section>

<!-- ===== Audience ===== -->
<section class="pd-audience">
  <div class="pd-aud-inner">
    <div class="pd-aud-head">
      <div class="pd-section-eyebrow reveal"><span style="width:40px;height:1px;background:currentColor;"></span><span>Who this is for</span></div>
      <h2 class="reveal" style="--d:120ms">For <em>institutions</em> investing in their faculty.</h2>
    </div>
    <div class="pd-aud-grid">
      <div class="pd-aud-cell"><div class="num">01</div><h4>Schools</h4><p>K–12 faculty teams ready to evolve engagement and mentoring.</p></div>
      <div class="pd-aud-cell"><div class="num">02</div><h4>Colleges</h4><p>Higher education faculty preparing students for the real world.</p></div>
      <div class="pd-aud-cell"><div class="num">03</div><h4>Training Institutions</h4><p>Professional training bodies building internal capability.</p></div>
      <div class="pd-aud-cell"><div class="num">04</div><h4>Specific Departments</h4><p>Department-level FDPs tailored to discipline and student profile.</p></div>
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
    <a class="pd-other-card" href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>">
      <div class="tag">Program 02 · Cohort</div>
      <h4>Young Leaders Program · YLP &amp; YLP Pro</h4>
      <p>Communication, presence, interviews, leadership — a high-engagement system for college-ready students.</p>
      <div class="foot"><span>View program →</span><div class="go">→</div></div>
    </a>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="pd-cta" id="contact">
  <div class="pd-cta-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="pd-section-eyebrow reveal" style="--d:80ms; color:var(--gold)"><span style="width:40px;height:1px;background:currentColor;"></span><span>Begin</span></div>
    <h2 class="reveal" style="--d:160ms">Students remember <em>how</em> they were taught.<br/>Not just <em>what</em> they were taught.</h2>
    <p class="reveal" style="--d:240ms">A 30-minute clarity call with the institution's leadership. We listen to the faculty's reality and propose what would actually move the needle.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Beyond Teaching · Clarity Call" data-label="Beyond Teaching · FDP">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
