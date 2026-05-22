<?php
/**
 * Archive template (blog index + category/tag archives)
 *
 * @package selfbygs
 */

get_header();
?>

<main class="blog-archive" style="background:var(--ivory-soft); min-height:60vh;">

  <header class="blog-archive-hero" style="padding:140px 36px 80px; background:linear-gradient(180deg,var(--ivory) 0%,var(--ivory-soft) 100%);">
    <div style="max-width:1100px; margin:0 auto;">
      <div class="eyebrow reveal" style="color:var(--gold-deep);">
        <?php
        if ( is_category() ) {
          esc_html_e( 'Category', 'selfbygs' );
        } elseif ( is_tag() ) {
          esc_html_e( 'Tag', 'selfbygs' );
        } elseif ( is_author() ) {
          esc_html_e( 'Author', 'selfbygs' );
        } else {
          esc_html_e( 'Blog', 'selfbygs' );
        }
        ?>
      </div>
      <h1 class="reveal" style="font-family:var(--f-serif); font-weight:300; font-size:clamp(40px,5.5vw,80px); line-height:1.04; letter-spacing:-0.015em; color:var(--ink); margin:18px 0 0;">
        <?php
        if ( is_home() && ! is_front_page() ) {
          single_post_title();
        } else {
          the_archive_title();
        }
        ?>
      </h1>
      <?php if ( get_the_archive_description() ) : ?>
      <p class="reveal" style="font-family:var(--f-serif); font-style:italic; font-size:18px; color:rgba(11,11,11,0.65); max-width:600px; margin:20px 0 0;">
        <?php the_archive_description(); ?>
      </p>
      <?php endif; ?>
    </div>
  </header>

  <div style="padding: 80px 36px 120px; max-width: 1400px; margin: 0 auto;">

    <?php if ( have_posts() ) : ?>

    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 36px;">
      <?php while ( have_posts() ) : the_post(); ?>

      <article <?php post_class( 'blog-card reveal' ); ?> style="background:#fff; border:1px solid rgba(11,11,11,0.06); padding:32px; display:flex; flex-direction:column; gap:14px; transition:transform 0.4s var(--ease-out), box-shadow 0.4s, border-color 0.4s; position:relative;">

        <?php if ( has_post_thumbnail() ) : ?>
        <div style="aspect-ratio:16/9; overflow:hidden; margin:-32px -32px 0; flex-shrink:0;">
          <a href="<?php the_permalink(); ?>" tabindex="-1">
            <?php the_post_thumbnail( 'selfbygs-card', array( 'style' => 'width:100%;height:100%;object-fit:cover; transition:transform 0.6s var(--ease-out);' ) ); ?>
          </a>
        </div>
        <?php endif; ?>

        <?php if ( get_the_category() ) : ?>
        <div style="font-size:10px; letter-spacing:0.32em; text-transform:uppercase; color:var(--gold-deep); font-weight:500; margin-top:6px;">
          <?php the_category( ' · ' ); ?>
        </div>
        <?php endif; ?>

        <h2 style="font-family:var(--f-serif); font-weight:400; font-size:22px; line-height:1.3; letter-spacing:-0.005em; margin:0;">
          <a href="<?php the_permalink(); ?>" style="color:var(--ink); text-decoration:none; transition:color 0.3s;"><?php the_title(); ?></a>
        </h2>

        <p style="font-size:14px; line-height:1.65; color:rgba(11,11,11,0.65); margin:0; flex:1;">
          <?php the_excerpt(); ?>
        </p>

        <div style="display:flex; align-items:center; justify-content:space-between; padding-top:14px; border-top:1px solid rgba(11,11,11,0.08); font-size:11px; letter-spacing:0.22em; text-transform:uppercase; color:var(--bone-mute);">
          <span><?php echo get_the_date(); ?></span>
          <a href="<?php the_permalink(); ?>" style="color:var(--gold-deep); text-decoration:none; font-weight:500;">Read →</a>
        </div>

      </article>

      <?php endwhile; ?>
    </div>

    <div style="margin-top:60px; display:flex; justify-content:center;">
      <?php
      the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => '← Previous',
        'next_text' => 'Next →',
      ) );
      ?>
    </div>

    <?php else : ?>
    <p style="text-align:center; font-family:var(--f-serif); font-size:20px; color:var(--bone-mute);">No posts found.</p>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>
