<?php
/**
 * Template Name: Contact
 */
add_action('wp_enqueue_scripts', function() {
    $css_file = get_template_directory() . '/assets/css/contact.css';
    if ( file_exists($css_file) ) {
        wp_add_inline_style('selfbygs-shared', file_get_contents($css_file));
    }
}, 20);
get_header();
?>

<!-- ===== Hero ===== -->
<section class="ct-hero" data-screen-label="01 Contact Hero">
  <div class="ct-hero-inner">
    <div>
      <div class="ct-eyebrow reveal"><span class="l"></span><span>Get In Touch</span></div>
      <h1>
        <span class="reveal-mask"><span>Contact <em>Us.</em></span></span>
      </h1>
      <p class="lede reveal" style="--d:240ms">
        For any support related issues — reach out. We respond within one business day, always honestly, never pushy.
      </p>
    </div>
    <div class="ct-hero-side reveal" style="--d:400ms">
      <div class="ladder"><span class="ladder-line">Awareness <span class="arr"></span> Capability <span class="arr"></span> Leadership</span></div>
      <p class="mini">
        The development arm of <strong>Gaurav Sharma &amp; Associates</strong>. Registered in Jaipur, Rajasthan.
      </p>
    </div>
  </div>
</section>

<!-- ===== Contact Methods ===== -->
<section class="ct-methods">
  <div class="ct-methods-grid">
    <a class="ct-card reveal hoverable" href="mailto:namaste@selfbygs.com">
      <div class="ic">
        <svg viewBox="0 0 24 24"><path d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/></svg>
      </div>
      <div class="ct-label">Email</div>
      <h3>Write to us</h3>
      <div class="ct-val">namaste@selfbygs.com</div>
      <p>For program enquiries, partnerships, or anything else — drop us a line and we'll respond within a business day.</p>
      <div class="ct-go"><span>Send email</span><div class="arr">→</div></div>
    </a>

    <a class="ct-card reveal hoverable" style="--d:120ms" href="https://wa.me/+917891122201" target="_blank" rel="noopener">
      <div class="ic">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      </div>
      <div class="ct-label">WhatsApp</div>
      <h3>Need support? <em style="color: var(--gold-deep)">WhatsApp us</em></h3>
      <div class="ct-val">+91 78911 22201</div>
      <p>Faster turnaround on quick questions, scheduling, or sharing details about your context.</p>
      <div class="ct-go"><span>Open chat</span><div class="arr">→</div></div>
    </a>

    <a class="ct-card reveal hoverable" style="--d:240ms" href="#" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">
      <div class="ic">
        <svg viewBox="0 0 24 24"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.58l2.2-2.21c.28-.27.36-.66.25-1.01C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM12 3v10l3-3h6V3h-9z"/></svg>
      </div>
      <div class="ct-label">Clarity Call</div>
      <h3>Book a 30-min call</h3>
      <div class="ct-val">Free · No pitch · Honest</div>
      <p>The best way to start. We listen first, then we tell you whether SELF is a fit — or what is.</p>
      <div class="ct-go"><span>Book a slot</span><div class="arr">→</div></div>
    </a>
  </div>
</section>

<!-- ===== Office / Address ===== -->
<section class="ct-office">
  <div class="ct-office-inner">
    <div>
      <div class="ct-eyebrow reveal"><span class="l"></span><span>Registered Office</span></div>
      <h2 class="reveal" style="--d:120ms">Find us in <em>Jaipur.</em></h2>

      <div class="addr reveal" style="--d:240ms">
        <strong>SELF · Registered Office</strong>
        1/3 A, Yudhister Marg,<br/>
        ESIC Colony, C-Scheme,<br/>
        Jaipur, Rajasthan 302001<br/>
        India
      </div>

      <div class="meta reveal" style="--d:360ms">
        <div class="row"><span class="lbl">Email</span><a href="mailto:namaste@selfbygs.com" style="color: var(--ink);">namaste@selfbygs.com</a></div>
        <div class="row"><span class="lbl">WhatsApp</span><a href="https://wa.me/+917891122201" target="_blank" rel="noopener" style="color: var(--ink);">+91 78911 22201</a></div>
        <div class="row"><span class="lbl">Hours</span><span>Mon – Fri · 10am – 6pm IST</span></div>
        <div class="row"><span class="lbl">Mode</span><span>In-person · Hybrid · Remote (India &amp; Global)</span></div>
      </div>
    </div>

    <div class="map-card reveal" style="--d:200ms" aria-hidden="true">
      <div class="corner">SELF · IN</div>
      <div class="corner r">26.91° N<br/>75.79° E</div>
      <div class="pin-label">Jaipur · Rajasthan</div>
      <div class="pin"></div>
      <div class="coords">N 26°54'36" · E 75°47'24"</div>
    </div>
  </div>
</section>

<!-- ===== Info strip ===== -->
<section class="ct-info">
  <div class="ct-info-grid">
    <div class="ct-info-cell reveal">
      <div class="lbl">Response Time</div>
      <h4>Within 1 business day</h4>
      <p>Always honest, never pushy. We read every message ourselves.</p>
    </div>
    <div class="ct-info-cell reveal" style="--d:120ms">
      <div class="lbl">Working Across</div>
      <h4>India &amp; Global</h4>
      <p>In-person engagements across India. Remote programs across the world.</p>
    </div>
    <div class="ct-info-cell reveal" style="--d:240ms">
      <div class="lbl">For Press / Speaking</div>
      <h4>Direct line</h4>
      <p>For media, podcast invites, or speaking enquiries — email with subject line "Press".</p>
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="ct-cta">
  <div class="ct-cta-inner">
    <div class="gold-rule center reveal" style="justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="--d:80ms; margin-top:18px">Begin</div>
    <h2 class="reveal" style="--d:160ms">Or just <em>book a clarity call</em>.<br/>It's free, it's honest, it's 30 minutes.</h2>
    <p class="reveal" style="--d:240ms">We listen. We ask the right questions. We tell you honestly whether SELF is a fit — or what is.</p>
    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">Book a Clarity Call <span class="arrow"></span></button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
