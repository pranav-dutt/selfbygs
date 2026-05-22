<?php
/**
 * Template Name: Academia
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/academia.css';
    if ( file_exists($css_file) ) {
        wp_add_inline_style('selfbygs-shared', file_get_contents($css_file));
    }
}, 20);
get_header();
?>

<!-- ===== HERO ===== -->
<section class="aca-hero" data-screen-label="01 Academia Hero">
  <div class="aca-hero-inner">
    <div>
      <div class="aca-eyebrow reveal"><span class="l"></span><span>Side I · Academia · Overview</span></div>

      <h1>
        <span class="reveal-mask"><span>Building more</span></span><br />
        <span class="reveal-mask" style="--d:120ms"><span>prepared, aware &amp;</span></span><br />
        <span class="reveal-mask" style="--d:240ms"><span>capable <em>students &amp; educators.</em></span></span>
      </h1>

      <p class="sub reveal" style="--d:480ms">
        In a world full of information, <span style="color: var(--gold-deep); font-style: normal;">students</span> need more guidance than ever before. Knowledge alone is no longer enough — they need mentoring, direction, decision-making, and a leadership mindset.
      </p>

      <div class="aca-hero-actions reveal" style="--d:640ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Academia Clarity Call" data-label="Academia · Clarity Call">
          Book a Clarity Call <span class="arrow"></span>
        </button>
        <a class="btn hoverable" href="#career-architecture">
          See the Programs <span class="arrow"></span>
        </a>
      </div>
    </div>

    <div class="aca-hero-side reveal" style="--d:800ms">
      <div class="gold-rule" style="margin-bottom:18px"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
      <p class="mini">
        The academic interventions by <strong>Gaurav Sharma &amp; Associates</strong> are designed to support students, educators, and institutions through more thoughtful developmental systems.
      </p>
      <p class="mini" style="margin-top:22px; max-width: 360px;">
        <span class="ladder-line">Awareness <span class="arr"></span> Capability <span class="arr"></span> Leadership</span>
      </p>
    </div>
  </div>

  <div class="aca-hero-meta">
    <span>Designed for · Grades 9–12 · Colleges · Educators · Institutions</span>
    <span>Three Programs · One Practice · Based in Jaipur</span>
  </div>
</section>

<!-- ===== Belief / Approach ===== -->
<section class="aca-belief">
  <div class="container">
    <div class="head">
      <div>
        <div class="eyebrow reveal" style="color:var(--gold-deep)">What We Believe</div>
        <h2 class="reveal" style="--d:120ms">In today's world, <em>mentoring</em> has become as important as education itself.</h2>
      </div>
      <p class="reveal" style="--d:240ms">
        Many students today grow up with more information but less guidance, more exposure but less clarity, more connectivity but fewer meaningful conversations. Which is why development today cannot remain limited to academics alone.
      </p>
    </div>

    <div class="approach-flow">
      <div class="approach-step reveal" data-tilt="3">
        <span class="stage-num">Stage 01</span>
        <h3><em>Awareness</em></h3>
        <p>Helping students understand themselves better — strengths beyond marks, behaviour beyond labels, potential beyond peer comparison.</p>
      </div>
      <div class="approach-step reveal" style="--d:160ms" data-tilt="3">
        <span class="stage-num">Stage 02</span>
        <h3><em>Capability</em></h3>
        <p>Building communication, confidence, decision-making, and execution ability through practice and structured feedback.</p>
      </div>
      <div class="approach-step reveal" style="--d:320ms" data-tilt="3">
        <span class="stage-num">Stage 03</span>
        <h3><em>Leadership</em></h3>
        <p>Developing ownership, initiative, and real-world preparedness — the mindset that carries through every future decision.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== GUIDE framework ===== -->
<section class="guide">
  <div class="guide-head">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line" style="background:var(--gold-deep)"></span><span class="bead" style="background:var(--gold-deep)"></span><span class="line" style="background:var(--gold-deep)"></span></div>
    <div class="eyebrow reveal" style="--d:80ms; color:var(--gold-deep); margin-top:18px">The GUIDE Framework</div>
    <h2 class="reveal" style="--d:160ms">A developmental response to <em>modern</em> student challenges.</h2>
  </div>

  <div class="guide-list">
    <div class="guide-row reveal hoverable">
      <div class="guide-letter">G</div>
      <div class="guide-title">Grow with Awareness</div>
      <div class="guide-desc">Encourage deeper self-understanding and clarity. Recognise the gap between what students know and who they are becoming.</div>
    </div>
    <div class="guide-row reveal hoverable" style="--d:80ms">
      <div class="guide-letter">U</div>
      <div class="guide-title">Understand Human Potential</div>
      <div class="guide-desc">Recognise strengths beyond marks and labels. Let students see possibility before pressure.</div>
    </div>
    <div class="guide-row reveal hoverable" style="--d:160ms">
      <div class="guide-letter">I</div>
      <div class="guide-title">Improve Capability</div>
      <div class="guide-desc">Build practical communication, leadership, and decision-making skills — through participation, not lectures.</div>
    </div>
    <div class="guide-row reveal hoverable" style="--d:240ms">
      <div class="guide-letter">D</div>
      <div class="guide-title">Develop Leadership</div>
      <div class="guide-desc">Strengthen ownership, initiative, and confidence. The shift from being managed to managing oneself.</div>
    </div>
    <div class="guide-row reveal hoverable" style="--d:320ms">
      <div class="guide-letter">E</div>
      <div class="guide-title">Enable Better Futures</div>
      <div class="guide-desc">Prepare students for real-world challenges with guidance and structure — for the world they're actually entering.</div>
    </div>
  </div>
</section>

<!-- ===== Programs Grid (3 cards in a single row) ===== -->
<section class="programs-strip programs-strip--light" id="programs">
  <div class="head">
    <div>
      <div class="eyebrow reveal">Academia Programs</div>
      <h2 class="reveal" style="--d:120ms">Three programs.<br/><em>One philosophy.</em></h2>
    </div>
    <p class="reveal" style="--d:240ms">Each program is designed around a real challenge — not a generic curriculum. Click any program to see its detailed design, framework, and outcomes.</p>
  </div>

  <div class="prog-side">
    <div class="prog-grid" style="grid-template-columns: repeat(3, 1fr);">
      <a class="prog-card reveal" href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>" data-tilt="3">
        <div class="pc-badge">1 : 1</div>
        <div class="side-tag"><span class="l"></span>Students · Grade 9+</div>
        <h4>Career Architecture<br />Decision Design Lab</h4>
        <ul>
          <li>Discover self beyond marks &amp; labels</li>
          <li>Explore real careers, not advertised ones</li>
          <li>Build personal filters &amp; criteria</li>
          <li>Decide with clarity &amp; ownership</li>
        </ul>
        <div class="pc-foot">
          <span>View program →</span>
          <div class="go">→</div>
        </div>
      </a>

      <a class="prog-card reveal" style="--d:120ms" href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>" data-tilt="3">
        <div class="pc-badge">Cohort</div>
        <div class="side-tag"><span class="l"></span>College-Ready Students</div>
        <h4>Young Leaders Program<br />YLP &amp; YLP Pro</h4>
        <ul>
          <li>Communication, presence &amp; storytelling</li>
          <li>Interviews, FAQs &amp; professional grooming</li>
          <li>Leadership, teamwork &amp; emotional intelligence</li>
          <li>AI for students — practical &amp; applied</li>
        </ul>
        <div class="pc-foot">
          <span>View program →</span>
          <div class="go">→</div>
        </div>
      </a>

      <a class="prog-card reveal" style="--d:240ms" href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>" data-tilt="3">
        <div class="pc-badge">FDP</div>
        <div class="side-tag"><span class="l"></span>Educators · Faculty</div>
        <h4>Beyond Teaching<br />Educator Impact</h4>
        <ul>
          <li>Mentoring sensitivity &amp; presence</li>
          <li>Behavioural &amp; communication mastery</li>
          <li>Faculty development beyond pedagogy</li>
          <li>Student-readiness facilitation</li>
        </ul>
        <div class="pc-foot">
          <span>View program →</span>
          <div class="go">→</div>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- ===== Quiet reality callout ===== -->
<section class="quiet">
  <div class="quiet-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <h2 class="reveal" style="--d:120ms">"Students remember far more than what was taught. They remember how they were <span class="gold">spoken to</span>, how they were <span class="gold">understood</span>, how they were <span class="gold">guided</span>."</h2>
    <p class="reveal" style="--d:240ms">A developmental response to modern student challenges — designed quietly, executed deeply, evaluated honestly.</p>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="aca-cta" id="contact">
  <div>
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line" style="background:var(--gold-deep)"></span><span class="bead" style="background:var(--gold-deep)"></span><span class="line" style="background:var(--gold-deep)"></span></div>
    <div class="eyebrow reveal" style="--d:80ms; color:var(--gold-deep); margin-top:18px">Begin</div>
    <h2 class="reveal" style="--d:160ms">A short, honest <em>clarity call.</em></h2>
    <p class="reveal" style="--d:240ms">30 minutes. No pitch. We'll understand where you are, what you're looking for, and tell you honestly whether SELF is the right next step.</p>

    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Academia · Clarity Call" data-label="Academia · Clarity Call">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
