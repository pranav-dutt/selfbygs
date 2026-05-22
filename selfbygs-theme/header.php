<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="grain"></div>

<header class="site-header" id="site-header">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-mark">
    <span class="dot"></span>
    <span>SELF</span>
  </a>
  <nav class="nav">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
    <div class="has-menu">
      <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">Corporate</a>
      <div class="nav-dropdown">
        <div class="dd-head">Corporate · Programs</div>
        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>"><span class="num">01</span><span>Executive Effectiveness</span><span class="arrow"></span></a>
        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>"><span class="num">02</span><span>Core Skills Interventions</span><span class="arrow"></span></a>
        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>"><span class="num">03</span><span>Diagnostic Audit &amp; Custom</span><span class="arrow"></span></a>
      </div>
    </div>
    <div class="has-menu">
      <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">Academia</a>
      <div class="nav-dropdown">
        <div class="dd-head">Academia · Programs</div>
        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>"><span class="num">01</span><span>Career Architecture Lab</span><span class="arrow"></span></a>
        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>"><span class="num">02</span><span>Young Leaders Program</span><span class="arrow"></span></a>
        <a class="dd-item" href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>"><span class="num">03</span><span>Beyond Teaching · FDP</span><span class="arrow"></span></a>
      </div>
    </div>
    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Team</a>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
  </nav>
  <button class="nav-cta hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">Book a Clarity Call</button>
  <button class="mobile-toggle" aria-label="Open menu"><span></span><span></span><span></span></button>
</header>

<!-- Mobile drawer -->
<div class="mobile-drawer" id="mobile-drawer">
  <nav class="md-nav">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
    <details>
      <summary>Corporate</summary>
      <div class="md-sub">
        <a href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">Corporate · Overview</a>
        <a href="<?php echo esc_url( home_url( '/programs/executive-effectiveness/' ) ); ?>">Executive Effectiveness</a>
        <a href="<?php echo esc_url( home_url( '/programs/core-skills/' ) ); ?>">Core Skills</a>
        <a href="<?php echo esc_url( home_url( '/programs/diagnostic-audit/' ) ); ?>">Diagnostic Audit</a>
      </div>
    </details>
    <details>
      <summary>Academia</summary>
      <div class="md-sub">
        <a href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">Academia · Overview</a>
        <a href="<?php echo esc_url( home_url( '/programs/career-architecture/' ) ); ?>">Career Architecture</a>
        <a href="<?php echo esc_url( home_url( '/programs/young-leaders/' ) ); ?>">Young Leaders Program</a>
        <a href="<?php echo esc_url( home_url( '/programs/beyond-teaching/' ) ); ?>">Beyond Teaching · FDP</a>
      </div>
    </details>
    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Team</a>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
  </nav>
  <div class="md-foot">
    <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">Book a Clarity Call <span class="arrow"></span></button>
  </div>
</div>
