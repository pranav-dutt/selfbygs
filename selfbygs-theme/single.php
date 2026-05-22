<?php
/**
 * Single post template
 *
 * @package selfbygs
 */

get_header();
?>

<main class="blog-single" style="background:var(--ivory-soft); padding: 120px 36px 80px; min-height: 60vh;">
  <div class="container" style="max-width: 760px; margin: 0 auto;">
    <?php while ( have_posts() ) : the_post(); ?>

      <nav aria-label="Breadcrumb" style="font-size:12px; letter-spacing:0.22em; text-transform:uppercase; color:var(--bone-mute); margin-bottom:40px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--gold-deep); text-decoration:none;">Home</a>
        <span style="opacity:.5;">·</span>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" style="color:var(--gold-deep); text-decoration:none;">Blog</a>
        <span style="opacity:.5;">·</span>
        <span style="color:var(--ink); opacity:.6;"><?php the_title(); ?></span>
      </nav>

      <article <?php post_class(); ?>>
        <header style="margin-bottom: 50px;">
          <?php if ( get_the_category() ) : ?>
          <div class="eyebrow" style="margin-bottom:18px;"><?php the_category( ' · ' ); ?></div>
          <?php endif; ?>

          <h1 style="font-family:var(--f-serif); font-weight:300; font-size:clamp(36px,5vw,64px); line-height:1.08; letter-spacing:-0.01em; color:var(--ink); margin:0 0 24px;">
            <?php the_title(); ?>
          </h1>

          <div style="display:flex; gap:24px; align-items:center; font-size:13px; letter-spacing:0.18em; text-transform:uppercase; color:var(--bone-mute); flex-wrap:wrap;">
            <span><?php echo get_the_date(); ?></span>
            <?php if ( get_the_author() ) : ?>
            <span style="opacity:.5;">·</span>
            <span><?php the_author(); ?></span>
            <?php endif; ?>
            <span style="opacity:.5;">·</span>
            <span><?php echo esc_html( ceil( str_word_count( get_the_content() ) / 200 ) ); ?> min read</span>
          </div>

          <?php if ( has_post_thumbnail() ) : ?>
          <div style="margin: 40px 0 0; aspect-ratio: 16/7; overflow: hidden;">
            <?php the_post_thumbnail( 'selfbygs-hero', array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
          </div>
          <?php endif; ?>
        </header>

        <div class="entry-content prose" style="font-family:var(--f-serif); font-size:18px; line-height:1.8; color:var(--ink); margin-top:40px;">
          <?php the_content(); ?>
        </div>

        <?php wp_link_pages(); ?>

        <footer style="margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(11,11,11,0.1);">
          <?php the_tags( '<div class="entry-tags" style="display:flex;gap:8px;flex-wrap:wrap;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;">', '', '</div>' ); ?>
        </footer>
      </article>

      <nav class="post-navigation" style="margin-top:60px; display:grid; grid-template-columns:1fr 1fr; gap:20px;" aria-label="Post navigation">
        <div>
          <?php previous_post_link( '%link', '<span style="display:block;font-size:11px;letter-spacing:0.32em;text-transform:uppercase;color:var(--bone-mute);margin-bottom:8px;">← Previous</span><span style="font-family:var(--f-serif);font-size:18px;color:var(--ink);">%title</span>' ); ?>
        </div>
        <div style="text-align:right;">
          <?php next_post_link( '%link', '<span style="display:block;font-size:11px;letter-spacing:0.32em;text-transform:uppercase;color:var(--bone-mute);margin-bottom:8px;">Next →</span><span style="font-family:var(--f-serif);font-size:18px;color:var(--ink);">%title</span>' ); ?>
        </div>
      </nav>

      <?php if ( comments_open() || get_comments_number() ) : ?>
        <?php comments_template(); ?>
      <?php endif; ?>

    <?php endwhile; ?>
  </div>
</main>

<?php get_footer(); ?>
