<?php
/**
 * Template Name: Corporate
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/corporate.css';
    if ( file_exists($css_file) ) {
        wp_add_inline_style('selfbygs-shared', file_get_contents($css_file));
    }
}, 20);
get_header();
?>

<div class="grain"></div>

<!-- ===== HERO ===== -->
<section class="cp-hero" data-screen-label="01 Corporate Hero">
  <div class="cp-hero-inner">
    <div>
      <div class="cp-eyebrow reveal"><span class="l"></span><span>Side II · Corporate · Overview</span></div>

      <h1>
        <span class="reveal-mask"><span>Building</span></span><br />
        <span class="reveal-mask" style="--d:120ms"><span><em>effective</em></span></span><br />
        <span class="reveal-mask" style="--d:240ms"><span><em>organisations.</em></span></span>
      </h1>

      <p class="sub reveal" style="--d:480ms">
        <span style="color: var(--gold); font-style: normal;">Organisations</span> grow when people grow with them. Behind every business challenge, there is usually a people challenge. Leadership, communication, ownership, alignment, team effectiveness — and more.
      </p>

      <div class="cp-hero-actions reveal" style="--d:640ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Corporate · Clarity Call" data-label="Corporate · Clarity Call">
          Book a Clarity Call <span class="arrow"></span>
        </button>
      </div>
    </div>

    <div class="cp-hero-side reveal" style="--d:800ms">
      <div class="gold-rule" style="margin-bottom:18px"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
      <p class="mini">
        The corporate interventions by <strong>Gaurav Sharma &amp; Associates</strong> are designed to strengthen the human side of organisational performance. Behavioural, experiential, execution-focused.
      </p>
      <p class="mini" style="margin-top:22px; max-width: 360px;">
        <span class="ladder-line">Diagnose <span class="arr"></span> Develop <span class="arr"></span> Transform</span>
      </p>
    </div>
  </div>

  <div class="cp-hero-meta">
    <span>For · Leadership · Managers · Cross-functional teams</span>
    <span>25+ Years · Based in Jaipur · India · Remote</span>
  </div>
</section>

<!-- ===== Belief / DDT ===== -->
<section class="cp-belief">
  <div class="container">
    <div class="head">
      <div>
        <div class="eyebrow reveal" style="color:var(--gold)">What We Believe</div>
        <h2 class="reveal" style="--d:120ms">Organisational growth and employee growth are <em>not separate</em> journeys.</h2>
      </div>
      <p class="reveal" style="--d:240ms">
        When people feel connected, capable, aligned, and valued — teams perform better, and businesses grow better. Effectiveness is rarely built by accident. We design for it.
      </p>
    </div>

    <div class="dx-flow">
      <div class="dx-step reveal" data-tilt="3">
        <span class="stage-num">Stage 01</span>
        <h3><em>Diagnose</em></h3>
        <p>Understand the real challenge before designing interventions. Most off-the-shelf programs solve the wrong problem.</p>
      </div>
      <div class="dx-step reveal" style="--d:160ms" data-tilt="3">
        <span class="stage-num">Stage 02</span>
        <h3><em>Develop</em></h3>
        <p>Build stronger leadership, communication, management, and team capability — behaviour-first, execution-focused.</p>
      </div>
      <div class="dx-step reveal" style="--d:320ms" data-tilt="3">
        <span class="stage-num">Stage 03</span>
        <h3><em>Transform</em></h3>
        <p>Create more aligned, effective, and growth-oriented organisations. Capability that compounds inside the business.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== ALIGN framework ===== -->
<section class="align-fw">
  <div class="align-head">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="--d:80ms; margin-top:18px">Let's ALIGN</div>
    <h2 class="reveal" style="--d:160ms">A simple but <em>powerful</em> alignment model.</h2>
  </div>

  <div class="align-list">
    <div class="align-row reveal hoverable">
      <div class="align-letter">A</div>
      <div class="align-title">Align Vision</div>
      <div class="align-desc">Connect organisational and team growth. The two cannot run on different rails.</div>
    </div>
    <div class="align-row reveal hoverable" style="--d:80ms">
      <div class="align-letter">L</div>
      <div class="align-title">Lead Effectively</div>
      <div class="align-desc">Strengthen leadership and ownership across the layers that actually deliver.</div>
    </div>
    <div class="align-row reveal hoverable" style="--d:160ms">
      <div class="align-letter">I</div>
      <div class="align-title">Improve Capability</div>
      <div class="align-desc">Build practical execution skills — communication, collaboration, decision-making.</div>
    </div>
    <div class="align-row reveal hoverable" style="--d:240ms">
      <div class="align-letter">G</div>
      <div class="align-title">Grow Together</div>
      <div class="align-desc">Create interdependence between people and performance, not pressure.</div>
    </div>
    <div class="align-row reveal hoverable" style="--d:320ms">
      <div class="align-letter">N</div>
      <div class="align-title">Nurture Culture</div>
      <div class="align-desc">Build trust, accountability, and collaboration. The compounding asset.</div>
    </div>
  </div>
</section>

<!-- ===== Programs Grid (3 cards in a single row) ===== -->
<section class="programs-strip programs-strip--dark" id="programs">
  <div class="head">
    <div>
      <div class="eyebrow reveal" style="color: var(--gold);">Corporate Programs</div>
      <h2 class="reveal" style="--d:120ms">Three practices.<br/><em>All custom-built.</em></h2>
    </div>
    <p class="reveal" style="--d:240ms">Every engagement is shaped to your organisation's reality — not pulled from a deck. Click any program to see its detailed design, framework, and outcomes.</p>
  </div>

  <div class="prog-side">
    <div class="prog-grid" style="grid-template-columns: repeat(3, 1fr);">
      <a class="prog-card dark reveal" href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>" data-tilt="3">
        <div class="pc-badge">B2B</div>
        <div class="side-tag"><span class="l"></span>Leadership · Managers</div>
        <h4>Executive Effectiveness<br />Programs</h4>
        <ul>
          <li>Behaviour, ownership &amp; alignment</li>
          <li>Communication &amp; team effectiveness</li>
          <li>Real workplace realities — not lectures</li>
          <li>LEAD framework · execution-focused</li>
        </ul>
        <div class="pc-foot">
          <span>View program →</span>
          <div class="go">→</div>
        </div>
      </a>

      <a class="prog-card dark reveal" style="--d:120ms" href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>" data-tilt="3">
        <div class="pc-badge">Custom</div>
        <div class="side-tag"><span class="l"></span>Capability · Workshops</div>
        <h4>Core Skills<br />Interventions</h4>
        <ul>
          <li>Communication, presentation &amp; sales</li>
          <li>Negotiation, collaboration, ownership</li>
          <li>AI productivity for working professionals</li>
          <li>Experiential &amp; custom-built for your team</li>
        </ul>
        <div class="pc-foot">
          <span>View program →</span>
          <div class="go">→</div>
        </div>
      </a>

      <a class="prog-card dark reveal" style="--d:240ms" href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>" data-tilt="3">
        <div class="pc-badge">Custom</div>
        <div class="side-tag"><span class="l"></span>Diagnostics · Bespoke</div>
        <h4>Diagnostic Audit<br />&amp; Custom Solutions</h4>
        <ul>
          <li>Capture reality &amp; locate gaps (CLEAR)</li>
          <li>Move beyond symptoms to root causes</li>
          <li>Designed around your organisational reality</li>
          <li>Built on radical candor &amp; real growth</li>
        </ul>
        <div class="pc-foot">
          <span>View program →</span>
          <div class="go">→</div>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="cp-cta" id="contact">
  <div class="cp-cta-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="--d:80ms; margin-top:18px">Begin</div>
    <h2 class="reveal" style="--d:160ms">Not every challenge needs <em>more pressure.</em><br/>Sometimes it needs better alignment.</h2>
    <p class="reveal" style="--d:240ms">Book a 30-minute clarity call. We listen, we ask the right questions, and we tell you honestly whether SELF is a fit — or what is.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Corporate · Clarity Call" data-label="Corporate · Clarity Call">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
