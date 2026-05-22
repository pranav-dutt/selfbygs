<?php
/**
 * Template Name: Team
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/team.css';
    if ( file_exists($css_file) ) {
        wp_add_inline_style('selfbygs-shared', file_get_contents($css_file));
    }
}, 20);
get_header();
?>

<!-- ===== HERO ===== -->
<section class="tm-hero" data-screen-label="01 Team Hero">
  <div class="tm-hero-inner">
    <div>
      <div class="tm-eyebrow reveal"><span class="l"></span><span>The Team · Gaurav Sharma &amp; Associates</span></div>
      <h1>
        <span class="reveal-mask"><span>The <em>people</em></span></span><br />
        <span class="reveal-mask" style="--d:160ms"><span>behind <em>SELF.</em></span></span>
      </h1>
      <p class="sub reveal" style="--d:400ms">
        A practice built over 25+ years of entrepreneurial and academic experience — anchored by two architects, supported by a thoughtful network of specialists.
      </p>
    </div>
    <div class="tm-hero-side reveal" style="--d:600ms">
      <div class="gold-rule"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
      <p class="mini" style="margin-top:24px;">
        SELF is the development arm of <strong>Gaurav Sharma &amp; Associates</strong> — designed at the intersection of business reality and human capability. Behaviour, execution, depth — not lecture-led training.
      </p>
    </div>
  </div>

  <div class="tm-hero-meta">
    <span>02 · Core Architects</span>
    <span>+ Extended Expert Network</span>
    <span>MATCH · Collaborative Framework</span>
  </div>
</section>

<!-- ===== GS — Founder ===== -->
<section class="tm-founder" id="gs" data-screen-label="02 Gaurav Sharma">
  <div class="tm-founder-inner">
    <div class="tm-portrait" style="padding:0;overflow:hidden;"><img src="https://course.selfbygs.com/wp-content/uploads/2025/10/IMG_8369-min-scaled.jpg" alt="Gaurav Sharma" style="width:100%;height:100%;object-fit:cover;object-position:top;"></div>

    <div>
      <div class="tm-eyebrow reveal"><span class="l" style="background:var(--gold-deep)"></span><span>Core Architect · 01</span></div>
      <h2 class="tm-name reveal" style="--d:80ms">
        Gaurav Sharma, <em>fondly known as GS</em>
      </h2>
      <div class="tm-role reveal" style="--d:160ms">Founder &amp; Chief Mentor · SELF</div>
      <p class="tm-tag reveal" style="--d:200ms">
        Intelligent Leadership Executive Coach &amp; Mentor · Human &amp; Organisational Development Strategist
      </p>

      <p class="tm-lead reveal" style="--d:280ms">
        Over <strong style="color:var(--gold-deep)">16 years of experience</strong> across leadership development, behavioural interventions, organisational capability building, entrepreneurship, and education.
      </p>

      <div class="tm-block reveal" style="--d:320ms">
        <div class="tm-block-head"><span class="l"></span><span>Credentials &amp; Background</span></div>
        <ul class="tm-list">
          <li><span class="dot"></span><span><strong>Alumnus of IIM Calcutta</strong></span></li>
          <li><span class="dot"></span><span><strong>Master Certified Intelligent Leadership Executive Coach</strong> through John Mattone Global — globally recognised as the former leadership coach to Steve Jobs</span></li>
          <li><span class="dot"></span><span>International Coaching Federation (ICF) aligned coaching pathways currently in progress</span></li>
          <li><span class="dot"></span><span><strong>Published Author</strong> in India and the USA</span></li>
        </ul>
      </div>

      <div class="tm-block reveal" style="--d:360ms">
        <div class="tm-block-head"><span class="l"></span><span>Experience &amp; Impact</span></div>
        <div class="tm-impact-grid">
          <div class="tm-impact">
            <div class="num">1000<span class="gold">+</span></div>
            <div class="lbl">Leadership &amp; behavioural interventions delivered</div>
          </div>
          <div class="tm-impact">
            <div class="num">50,000<span class="gold">+</span></div>
            <div class="lbl">Learners, professionals &amp; leaders impacted</div>
          </div>
          <div class="tm-impact">
            <div class="num">16<span class="gold">YRS</span></div>
            <div class="lbl">Across leadership, communication, employability &amp; capability</div>
          </div>
        </div>
        <p style="font-size: 15px; line-height: 1.65; color: rgba(11,11,11,0.65); margin: 22px 0 0; max-width: 620px;">
          Worked with organisations, institutions, startups, and leadership teams across industries.
        </p>
      </div>

      <div class="tm-block reveal" style="--d:400ms">
        <div class="tm-block-head"><span class="l"></span><span>Areas of Work</span></div>
        <div class="tm-pillgroup">
          <span class="tm-pill">Leadership &amp; Executive Effectiveness</span>
          <span class="tm-pill">Human Behaviour &amp; Personal Effectiveness</span>
          <span class="tm-pill">Organisational Capability Development</span>
          <span class="tm-pill">Communication &amp; Executive Presence</span>
          <span class="tm-pill">Team Alignment &amp; Ownership</span>
          <span class="tm-pill">Transformational Learning &amp; Coaching</span>
          <span class="tm-pill">Public Speaking &amp; Storytelling</span>
        </div>
      </div>

      <div class="tm-block reveal" style="--d:440ms">
        <div class="tm-block-head"><span class="l"></span><span>What Defines His Approach</span></div>
        <p style="font-size: 16px; line-height: 1.65; color: rgba(11,11,11,0.75); margin: 0 0 18px; max-width: 620px;">
          GS combines <strong>behavioural insight · entrepreneurial thinking · leadership science · reflective learning · practical execution</strong> to create interventions that are:
        </p>
        <div class="tm-pillgroup">
          <span class="tm-pill">Experiential</span>
          <span class="tm-pill">Deeply engaging</span>
          <span class="tm-pill">Execution-focused</span>
          <span class="tm-pill">Human-centred</span>
          <span class="tm-pill">Transformational</span>
        </div>
        <div class="tm-approach">
          <p>Known for blending warmth with depth — his sessions are often described as experiences that create not only inspiration, but <strong style="color: var(--gold-deep); font-style: normal;">greater awareness, clarity, ownership, and action</strong>.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== Dr. TSG — Chief Architect ===== -->
<section class="tm-founder dark" id="tsg" data-screen-label="03 Dr. TSG">
  <div class="tm-founder-inner">
    <div class="tm-portrait">replace · Dr. TSG</div>

    <div>
      <div class="tm-eyebrow reveal" style="color: var(--gold);"><span class="l" style="background:var(--gold)"></span><span>Core Architect · 02</span></div>
      <h2 class="tm-name reveal" style="--d:80ms">
        Dr. Tanya <em>Soin Gaurav</em>
      </h2>
      <div class="tm-role reveal" style="--d:160ms">Chief Architect · Learning &amp; Development</div>
      <p class="tm-tag reveal" style="--d:200ms">
        Human Resource Specialist · Organisational &amp; Behavioural Development Strategist &amp; Facilitator · Training &amp; Development Professional
      </p>

      <p class="tm-lead reveal" style="--d:280ms">
        Over <strong style="color:var(--gold)">13 years of experience</strong> across academia, training, mentoring, behavioural development, and organisational capability building.
      </p>

      <div class="tm-block reveal" style="--d:320ms">
        <div class="tm-block-head"><span class="l"></span><span>Credentials &amp; Background</span></div>
        <ul class="tm-list">
          <li><span class="dot"></span><span><strong>Ph.D. in Human Resource Management</strong> (Training and Development)</span></li>
          <li><span class="dot"></span><span><strong>Certified from IIM Rohtak</strong> — HR Analytics</span></li>
          <li><span class="dot"></span><span><strong>NET-JRF Qualified</strong> in HR &amp; Labour Welfare</span></li>
          <li><span class="dot"></span><span>Strong academic and research background in Human Behaviour, Employability, and Organisational Development</span></li>
        </ul>
      </div>

      <div class="tm-block reveal" style="--d:360ms">
        <div class="tm-block-head"><span class="l"></span><span>Experience &amp; Impact</span></div>
        <ul class="tm-list">
          <li><span class="dot"></span><span>Extensive experience across <strong>academic institutions, leadership development, and organisational interventions</strong></span></li>
          <li><span class="dot"></span><span>Conducted <strong>Faculty Development Programs (FDPs)</strong> and <strong>Management Development Programs (MDPs)</strong></span></li>
          <li><span class="dot"></span><span>Worked across student development, educator effectiveness, behavioural capability, and professional readiness initiatives</span></li>
          <li><span class="dot"></span><span>Contributed to organisational consulting, HR practices, communication interventions, and capability-building ecosystems</span></li>
        </ul>
      </div>

      <div class="tm-block reveal" style="--d:400ms">
        <div class="tm-block-head"><span class="l"></span><span>Areas of Work</span></div>
        <div class="tm-pillgroup">
          <span class="tm-pill">Training &amp; Development</span>
          <span class="tm-pill">Human Behaviour &amp; Communication</span>
          <span class="tm-pill">Employability &amp; Professional Readiness</span>
          <span class="tm-pill">Faculty &amp; Educator Development</span>
          <span class="tm-pill">Organisational Capability Development</span>
          <span class="tm-pill">Behavioural &amp; Leadership Interventions</span>
        </div>
      </div>

      <div class="tm-block reveal" style="--d:440ms">
        <div class="tm-block-head"><span class="l"></span><span>What Defines Her Approach</span></div>
        <p style="font-size: 16px; line-height: 1.65; color: var(--bone-mute); margin: 0 0 18px; max-width: 620px;">
          Tanya combines <strong style="color: var(--bone);">academic depth · behavioural understanding · mentoring sensitivity · practical developmental insight · structured capability-building</strong> to create interventions that are:
        </p>
        <div class="tm-pillgroup">
          <span class="tm-pill">Thoughtful</span>
          <span class="tm-pill">Human-centred</span>
          <span class="tm-pill">Practical</span>
          <span class="tm-pill">Engaging</span>
          <span class="tm-pill">Development-focused</span>
        </div>
        <div class="tm-approach">
          <p>Her work is rooted in the belief that meaningful growth happens when people are not only educated — but <strong style="color: var(--gold); font-style: normal;">guided, understood, and developed with clarity and care</strong>.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== Extended Network ===== -->
<section class="tm-network" data-screen-label="04 Extended Network">
  <div class="tm-network-head">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:18px">Extended Expert Network</div>
    <h2 class="reveal" style="--d:140ms">Beyond the core — a <em>curated network</em> of specialists.</h2>
    <p class="reveal" style="--d:240ms">
      Alongside the core team led by Gaurav Sharma &amp; Associates, select interventions may also involve experienced industry, academic, and behavioural professionals — thoughtfully brought in based on your context.
    </p>
  </div>

  <div class="tm-net-grid">
    <article class="tm-net-card reveal">
      <div class="lbl"><span class="l"></span>Specialist Profiles</div>
      <h4>Who joins our interventions</h4>
      <p>Brought in selectively — not by roster, but by relevance — to extend the depth and contextual fit of each engagement.</p>
      <ul class="roster">
        <li>Industry professionals</li>
        <li>Academic experts</li>
        <li>Leadership practitioners</li>
        <li>Behavioural facilitators</li>
        <li>Domain specialists</li>
      </ul>
    </article>

    <article class="tm-net-card reveal" style="--d:160ms">
      <div class="lbl"><span class="l"></span>How We Select</div>
      <h4>The basis of every match</h4>
      <p>Associates are thoughtfully brought in based on the realities of your context — never a generic add-on.</p>
      <ul class="roster">
        <li>Organisational context</li>
        <li>Developmental objectives</li>
        <li>Participant profiles</li>
        <li>Specific capability requirements</li>
      </ul>
    </article>
  </div>
</section>

<!-- ===== MATCH Framework ===== -->
<section class="tm-match" id="match" data-screen-label="05 MATCH Framework">
  <div class="tm-match-head">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:18px">The MATCH Framework</div>
    <h2 class="reveal" style="--d:140ms">How we bring the <em>right people</em> to the right work.</h2>
    <p class="reveal" style="--d:240ms">
      A collaborative model that lets us design interventions that are more contextual, more flexible, more relevant, and more impactful.
    </p>
  </div>

  <div class="tm-match-grid">
    <div class="tm-mstep reveal">
      <div class="letter">M</div>
      <h4>Map the Requirement</h4>
      <p>Understand the real developmental need.</p>
    </div>
    <div class="tm-mstep reveal" style="--d:100ms">
      <div class="letter">A</div>
      <h4>Align the Expertise</h4>
      <p>Bring in specialists relevant to the context.</p>
    </div>
    <div class="tm-mstep reveal" style="--d:200ms">
      <div class="letter">T</div>
      <h4>Tailor the Intervention</h4>
      <p>Design learning experiences around actual realities.</p>
    </div>
    <div class="tm-mstep reveal" style="--d:300ms">
      <div class="letter">C</div>
      <h4>Create Impact</h4>
      <p>Deliver more relevant and effective outcomes.</p>
    </div>
    <div class="tm-mstep reveal" style="--d:400ms">
      <div class="letter">H</div>
      <h4>Hold the Philosophy</h4>
      <p>Every intervention stays aligned with the SELF approach.</p>
    </div>
  </div>

  <div class="tm-match-foot reveal" style="--d:500ms">
    <p class="quote">
      Because meaningful development often requires <span class="gold">not just one perspective,</span><br/>
      but the right combination of experience, insight, and human understanding.
    </p>
  </div>
</section>

<!-- ===== Closing CTA ===== -->
<section class="tm-cta" id="contact">
  <div class="tm-cta-inner">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:22px">Begin a Conversation</div>
    <h2 class="reveal" style="--d:120ms">Book a <em>clarity call</em>.<br/>Meet the people. Decide nothing.</h2>
    <p class="reveal" style="--d:240ms">A 30-minute conversation. No pitch. We listen, we ask the right questions, and we tell you honestly whether SELF is a fit — or what is.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">
        Book a Clarity Call <span class="arrow"></span>
      </button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
