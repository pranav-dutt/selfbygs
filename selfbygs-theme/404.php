<?php
/**
 * 404 Not Found template
 *
 * @package selfbygs
 */

get_header();
?>

<section class="pd-hero" style="min-height:60vh; display:flex; align-items:center; justify-content:center; text-align:center; padding: 120px 24px 80px;">
  <div>
    <div class="eyebrow reveal-fade">Error 404</div>
    <h1 class="reveal-fade" style="font-family:var(--f-display); font-size:clamp(48px,8vw,96px); color:var(--gold); margin:0 0 24px;">Page Not Found</h1>
    <p class="reveal-fade" style="font-family:var(--f-serif); font-size:clamp(18px,2vw,24px); color:var(--bone-mute); max-width:480px; margin:0 auto 40px;">The page you're looking for has moved, been removed, or never existed. Let's get you back on track.</p>
    <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;" class="reveal-fade">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--solid hoverable">Back to Home <span class="arrow"></span></a>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline hoverable">Contact Us</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
