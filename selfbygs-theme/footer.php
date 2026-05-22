<?php
$email    = selfbygs_opt( 'contact_email', 'namaste@selfbygs.com' );
$whatsapp = selfbygs_opt( 'whatsapp', '+917891122201' );
$wa_clean = preg_replace( '/[^0-9+]/', '', $whatsapp );
$addr1    = selfbygs_opt( 'address_line1', 'Jaipur' );
$addr2    = selfbygs_opt( 'address_line2', 'Rajasthan · India' );
$blurb    = selfbygs_opt( 'footer_blurb', 'The development arm of <strong style="color:var(--gold);font-family:var(--f-display);font-weight:500;letter-spacing:0.06em;">Gaurav Sharma &amp; Associates</strong>. Self Development Programs — built quietly, deliberately, and at depth.' );
$li_url   = selfbygs_opt( 'linkedin_url', 'https://www.linkedin.com/in/voiceitgaurav/' );
$ig_url   = selfbygs_opt( 'instagram_url', 'https://www.instagram.com/voiceitgaurav/' );
$yt_url   = selfbygs_opt( 'youtube_url', 'https://www.youtube.com/@voiceitgaurav' );
$fb_url   = selfbygs_opt( 'facebook_url', 'https://www.facebook.com/profile.php?id=100002611554241' );
$modal_title   = selfbygs_opt( 'modal_title', 'Begin Your Clarity Call' );
$modal_quote   = selfbygs_opt( 'modal_quote', "Don't choose a path.\nLearn how to design one." );
$modal_success = selfbygs_opt( 'modal_success', "Thank you — we'll be in touch." );
?>
<footer class="site-footer theme-dark">
  <div class="footer-grid">
    <div>
      <div class="foot-logo">SELF</div>
      <div class="foot-by">Self Engineering for Leaders' Fortune</div>
      <p class="foot-blurb"><?php echo wp_kses_post( $blurb ); ?></p>
      <div class="foot-social">
        <?php if ( $li_url ) : ?>
        <a href="<?php echo esc_url( $li_url ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><svg viewBox="0 0 24 24"><path d="M19 0h-14C2.24 0 0 2.24 0 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5V5c0-2.76-2.24-5-5-5zM8 19H5V8h3v11zM6.5 6.73C5.53 6.73 4.75 5.95 4.75 5s.78-1.73 1.75-1.73 1.75.78 1.75 1.73-.78 1.73-1.75 1.73zM20 19h-3v-5.6c0-1.1-.9-2-2-2s-2 .9-2 2V19h-3V8h3v1.4c.7-1 1.7-1.6 3-1.6 2.21 0 4 1.79 4 4V19z"/></svg></a>
        <?php endif; ?>
        <?php if ( $ig_url ) : ?>
        <a href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.555.556.9 1.111 1.153 1.772.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 1 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg></a>
        <?php endif; ?>
        <?php if ( $yt_url ) : ?>
        <a href="<?php echo esc_url( $yt_url ); ?>" target="_blank" rel="noopener" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
        <?php endif; ?>
        <?php if ( $fb_url ) : ?>
        <a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg></a>
        <?php endif; ?>
      </div>
    </div>
    <div>
      <h5>Explore</h5>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
        <li><a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">Corporate</a></li>
        <li><a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">Academia</a></li>
        <li><a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Team</a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
      </ul>
    </div>
    <div>
      <h5>Programs</h5>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>">Executive Effectiveness</a></li>
        <li><a href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>">Core Skills</a></li>
        <li><a href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>">Diagnostic Audit</a></li>
        <li><a href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>">Career Architecture</a></li>
        <li><a href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>">Young Leaders · YLP</a></li>
        <li><a href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>">Beyond Teaching · FDP</a></li>
      </ul>
    </div>
    <div>
      <h5>Engage</h5>
      <ul>
        <li><a href="#" data-open-lead data-title="Book a Clarity Call" data-label="Clarity Call · Free 30 min">Book a Clarity Call</a></li>
        <li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
        <li><a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" rel="noopener">WhatsApp · <?php echo esc_html( $whatsapp ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© SELF · <?php echo esc_html( date( 'Y' ) ); ?> · Gaurav Sharma &amp; Associates</span>
    <span><?php echo esc_html( $addr1 ); ?> · <?php echo esc_html( $addr2 ); ?></span>
  </div>
  <div class="footer-legal">
    <div class="footer-legal-links">
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
      <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms</a>
      <a href="<?php echo esc_url( home_url( '/refund-cancellation/' ) ); ?>">Refund &amp; Cancellation</a>
    </div>
    <span class="loc"><?php echo esc_html( $addr1 ); ?> · India · Remote</span>
  </div>
</footer>

<!-- Lead Modal — single modal, chip sets filtered per form type (main / corporate / academia) -->
<div class="lead-modal" id="lead-modal" role="dialog" aria-modal="true" aria-labelledby="lead-title" data-form-type="main">
  <div class="lead-card">
    <aside class="lead-aside">
      <div>
        <div class="meta-row"><span class="dot"></span><span class="lead-modal-label">Clarity Call · Free 30 min</span></div>
        <h3 id="lead-title" class="lead-modal-title"><?php echo esc_html( $modal_title ); ?></h3>
        <p>A short, honest conversation. We listen first, then we tell you whether SELF is a fit — or what is.</p>
      </div>
      <div class="quote"><?php echo nl2br( esc_html( $modal_quote ) ); ?></div>
    </aside>

    <div class="lead-body">
      <button class="lead-close" aria-label="Close">✕</button>

      <div class="lead-steps">
        <span class="lead-step-pill is-active"></span>
        <span class="lead-step-pill"></span>
        <span class="lead-step-pill"></span>
        <span class="lead-step-pill"></span>
      </div>

      <div class="lead-step-wrap">

        <div class="lead-step is-active">
          <div class="step-eyebrow">Step 01 / 04</div>
          <h4>Who is this for?</h4>
          <div class="step-sub">Choose one — we'll tailor the rest of the conversation.</div>
          <div class="chip-row">
            <button class="chip" data-forms="main,academia">Student · Career clarity</button>
            <button class="chip" data-forms="main,academia">Student · YLP / Placement readiness</button>
            <button class="chip" data-forms="main,academia">Parent · For my child</button>
            <button class="chip" data-forms="main,academia">Educator · School / College</button>
            <button class="chip" data-forms="main,academia">Institution · Bulk programs</button>
            <button class="chip" data-forms="main,corporate">L&amp;D · For my team</button>
            <button class="chip" data-forms="main,corporate">Founder / Leadership</button>
          </div>
          <div class="step-actions">
            <button class="step-back" data-back disabled>← Back</button>
            <button class="btn btn--solid hoverable" data-next>Continue <span class="arrow"></span></button>
          </div>
        </div>

        <div class="lead-step">
          <div class="step-eyebrow">Step 02 / 04</div>
          <h4>Which intervention?</h4>
          <div class="step-sub">Pick all that interest you. We'll bring the right person to the call.</div>
          <div class="chip-row" data-multi="true">
            <button class="chip" data-forms="main,academia">Career Architecture · Decision Lab</button>
            <button class="chip" data-forms="main,academia">Young Leaders Program (YLP)</button>
            <button class="chip" data-forms="main,academia">YLP Pro · Placement</button>
            <button class="chip" data-forms="main,academia">Beyond Teaching · FDP</button>
            <button class="chip" data-forms="main,corporate">Executive Effectiveness</button>
            <button class="chip" data-forms="main,corporate">Core Skills (Communication, Sales, AI…)</button>
            <button class="chip" data-forms="main,corporate">Diagnostic Audit &amp; Custom</button>
            <button class="chip" data-forms="main,academia,corporate">Custom Solution</button>
            <button class="chip" data-forms="main,academia,corporate">Not sure yet</button>
          </div>
          <div class="step-actions">
            <button class="step-back" data-back>← Back</button>
            <button class="btn btn--solid hoverable" data-next>Continue <span class="arrow"></span></button>
          </div>
        </div>

        <div class="lead-step">
          <div class="step-eyebrow">Step 03 / 04</div>
          <h4>How should we reach you?</h4>
          <div class="step-sub">We respond within 1 business day. Always honest, never pushy.</div>
          <div class="field">
            <label>Full name</label>
            <input type="text" name="lead_name" placeholder="Your name" />
          </div>
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="field">
              <label>Email</label>
              <input type="email" name="lead_email" placeholder="you@example.com" />
            </div>
            <div class="field">
              <label>Mobile (with code)</label>
              <input type="tel" name="lead_phone" placeholder="+91 98xx xx xx xx" />
            </div>
          </div>
          <div class="field">
            <label>Organisation / Institution (optional)</label>
            <input type="text" name="lead_org" placeholder="Where you study or work" />
          </div>
          <div class="step-actions">
            <button class="step-back" data-back>← Back</button>
            <button class="btn btn--solid hoverable" data-next>Continue <span class="arrow"></span></button>
          </div>
        </div>

        <div class="lead-step">
          <div class="step-eyebrow">Step 04 / 04</div>
          <h4>One last thing.</h4>
          <div class="step-sub">In a line or two — what's the real reason you're here?</div>
          <div class="field">
            <label>Context</label>
            <textarea rows="4" name="lead_context" placeholder="I'm trying to figure out…"></textarea>
          </div>
          <div class="field">
            <label>Preferred time</label>
            <select name="lead_time">
              <option>Weekday · Morning (10am–12pm IST)</option>
              <option>Weekday · Afternoon (1pm–4pm IST)</option>
              <option>Weekday · Evening (5pm–8pm IST)</option>
              <option>Weekend · I'll pick a slot</option>
            </select>
          </div>
          <div id="lead-form-error" style="display:none;color:#e05555;font-size:13px;margin-top:8px;padding:8px;border-radius:3px;background:rgba(224,85,85,0.1);"></div>
          <div class="step-actions">
            <button class="step-back" data-back>← Back</button>
            <button class="btn btn--solid hoverable" data-submit>Request the Call <span class="arrow"></span></button>
          </div>
        </div>

      </div>

      <div class="lead-success" style="display:none">
        <div class="check">✓</div>
        <h4 style="font-family: var(--f-serif); font-size: 32px; margin:0 0 10px;"><?php echo esc_html( $modal_success ); ?></h4>
        <p style="color: var(--bone-mute); font-size: 15px;">Look out for a personal note from the SELF team within one business day.</p>
        <div class="gold-rule center" style="margin: 30px 0; justify-content:center; display:flex;"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
        <p style="color: var(--bone-mute); font-size: 13px; letter-spacing: 0.18em; text-transform: uppercase;">In the meantime · explore the journeys</p>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
