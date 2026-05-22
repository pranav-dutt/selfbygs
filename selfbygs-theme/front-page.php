<?php
/**
 * Homepage Template
 *
 * @package selfbygs
 */
get_header();
?>
<style>
/* ============ LANDING (noir hero on dark; transitions into ivory) ============ */
:root {
  --hero-bg: #07070A;
}
body {
  background: var(--ivory-soft);
  color: var(--ink);
}
body.theme-noir { background: var(--hero-bg); }

/* Preloader */
.preloader {
  position: fixed;
  inset: 0;
  z-index: 500;
  display: grid;
  place-items: center;
  background: #07070A;
  color: var(--gold);
  transition: opacity 0.9s var(--ease-out), visibility 0.9s;
}
.preloader.gone { opacity: 0; visibility: hidden; pointer-events: none; }
.preloader .mark {
  font-family: var(--f-display);
  font-weight: 600;
  letter-spacing: 0.36em;
  font-size: 32px;
  display: flex; gap: 24px;
}
.preloader .mark span {
  opacity: 0;
  transform: translateY(20px);
  animation: prel 0.7s var(--ease-out) forwards;
}
.preloader .mark span:nth-child(1) { animation-delay: 0.05s; }
.preloader .mark span:nth-child(2) { animation-delay: 0.18s; }
.preloader .mark span:nth-child(3) { animation-delay: 0.31s; }
.preloader .mark span:nth-child(4) { animation-delay: 0.44s; }
.preloader .rule {
  width: 0;
  height: 1px;
  background: var(--gold);
  margin-top: 18px;
  animation: ruleGrow 1.3s var(--ease-out) 0.7s forwards;
}
@keyframes prel {
  to { opacity: 1; transform: translateY(0); }
}
@keyframes ruleGrow {
  to { width: 240px; }
}

/* ============ HERO ============ */
.hero {
  position: relative;
  min-height: 100vh;
  color: #F7F2E6;
  overflow: hidden;
  isolation: isolate;
  display: flex;
  align-items: center;
  padding: 140px 36px 80px;
}
.hero-bg-yt {
  position: absolute;
  inset: 0;
  z-index: -3;
  overflow: hidden;
  pointer-events: none;
}
.hero-bg-yt iframe {
  position: absolute;
  top: 50%; left: 50%;
  width: 100vw;
  height: 56.25vw;
  min-height: 100vh;
  min-width: 177.78vh;
  transform: translate(-50%, -50%) scale(1.06);
  border: 0;
  pointer-events: none;
  filter: saturate(0.85) brightness(0.55) contrast(1.05);
}
.hero-bg-fallback {
  position: absolute;
  inset: 0;
  z-index: -4;
  background:
    radial-gradient(ellipse at 30% 20%, rgba(201,162,77,0.16) 0%, transparent 50%),
    radial-gradient(ellipse at 70% 80%, rgba(201,162,77,0.10) 0%, transparent 60%),
    linear-gradient(180deg, #0A090B 0%, #050507 100%);
}
.hero::before {
  content: '';
  position: absolute;
  inset: 0;
  z-index: -2;
  background:
    linear-gradient(180deg, rgba(7,7,10,0.4) 0%, rgba(7,7,10,0.7) 60%, rgba(7,7,10,0.95) 100%),
    radial-gradient(ellipse at center, transparent 30%, rgba(7,7,10,0.7) 100%);
}
.hero::after {
  content: '';
  position: absolute;
  inset: 0;
  z-index: -1;
  background-image:
    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
  background-size: 80px 80px;
  mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
  -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
  pointer-events: none;
}

.hero-inner {
  position: relative;
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
  display: grid;
  grid-template-columns: 1.4fr 1fr;
  gap: 80px;
  align-items: end;
}
.hero-eyebrow {
  display: flex;
  align-items: center;
  gap: 14px;
  font-size: 11px;
  letter-spacing: 0.5em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 32px;
}
.hero-eyebrow .l { width: 40px; height: 1px; background: var(--gold); }

.hero h1 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(48px, 7.2vw, 112px);
  line-height: 0.98;
  letter-spacing: -0.01em;
  margin: 0;
  color: #FCF8EE;
}
.hero h1 .gold { color: var(--gold); font-style: italic; }

.hero .sub {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(18px, 1.4vw, 22px);
  line-height: 1.6;
  color: rgba(247, 242, 230, 0.78);
  max-width: 540px;
  margin: 36px 0 0;
  font-style: italic;
}

.hero-side {
  display: flex;
  flex-direction: column;
  gap: 28px;
  padding-bottom: 8px;
}
.hero-side .gold-rule .line { width: 30px; }
.hero-mini {
  font-family: var(--f-sans);
  font-size: 14px;
  line-height: 1.7;
  color: rgba(247,242,230,0.75);
  max-width: 320px;
}

.hero-actions {
  margin-top: 44px;
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}

.hero-meta-row {
  position: absolute;
  bottom: 40px; left: 0; right: 0;
  padding: 0 36px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 11px;
  letter-spacing: 0.32em;
  text-transform: uppercase;
  color: rgba(247,242,230,0.55);
}
.hero-meta-row .pill {
  display: flex; align-items: center; gap: 10px;
}
.hero-meta-row .pill .dot {
  width: 6px; height: 6px;
  background: var(--gold);
  border-radius: 50%;
  animation: pulse 2s infinite;
}
.hero-scroll-cue {
  display: flex; flex-direction: column; align-items: center; gap: 6px;
}
.hero-scroll-cue .stem {
  width: 1px; height: 38px;
  background: linear-gradient(180deg, transparent, var(--gold));
  animation: dropDown 1.8s var(--ease-out) infinite;
}
@keyframes dropDown {
  0% { transform: scaleY(0); transform-origin: top; opacity: 0; }
  40% { transform: scaleY(1); opacity: 1; transform-origin: top; }
  41% { transform-origin: bottom; }
  100% { transform: scaleY(0); opacity: 0; transform-origin: bottom; }
}

@media (max-width: 1000px) {
  .hero-inner { grid-template-columns: 1fr; gap: 40px; }
  .hero-meta-row { flex-direction: column; gap: 16px; align-items: flex-start; }
  .hero-side { padding-bottom: 0; }
}

/* ============ Tagline marquee ============ */
.tagline-marquee {
  background: #07070A;
  color: var(--gold);
  padding: 22px 0;
  overflow: hidden;
  position: relative;
  border-top: 1px solid rgba(201,162,77,0.18);
  border-bottom: 1px solid rgba(201,162,77,0.18);
}
.tagline-marquee .marquee-inner {
  display: flex;
  gap: 64px;
  white-space: nowrap;
  animation: marquee 38s linear infinite;
  font-family: var(--f-display);
  letter-spacing: 0.38em;
  font-size: 14px;
  text-transform: uppercase;
}
.tagline-marquee .marquee-inner span { display: inline-flex; align-items: center; gap: 64px; }
.tagline-marquee .sep {
  width: 5px; height: 5px;
  background: var(--gold);
  border-radius: 50%;
  display: inline-block;
}
@keyframes marquee {
  to { transform: translateX(-50%); }
}

/* ============ Mission section (ivory) ============ */
.mission {
  background: var(--ivory-soft);
  color: var(--ink);
  padding: 160px 36px;
}
.mission .container { position: relative; }
.mission .quote {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(34px, 4.2vw, 64px);
  line-height: 1.14;
  letter-spacing: -0.01em;
  max-width: 1100px;
  margin: 0 auto;
  text-align: center;
}
.mission .quote .gold { color: var(--gold-deep); font-style: italic; }
.mission .quote em {
  font-family: var(--f-script);
  font-style: normal;
  font-size: 1em;
  color: var(--gold-deep);
}

.mission .attribution {
  text-align: center;
  margin-top: 60px;
  font-family: var(--f-display);
  letter-spacing: 0.4em;
  font-size: 12px;
  text-transform: uppercase;
  color: rgba(11,11,11,0.5);
}
.mission .attribution .script {
  font-family: var(--f-script);
  font-size: 26px;
  letter-spacing: 0;
  color: var(--ink);
  text-transform: none;
  display: block;
  margin-top: 12px;
}

/* ============ Two journeys split ============ */
.journeys {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 92vh;
  position: relative;
  isolation: isolate;
}
.journey {
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 80px 60px;
  transition: flex 0.8s var(--ease-out);
  text-decoration: none;
}
.journey--academia {
  background: var(--ivory);
  color: var(--ink);
}
.journey--corporate {
  background: #0B0B0E;
  color: var(--bone);
}
.journey::before {
  content: '';
  position: absolute;
  inset: 0;
  background-position: center;
  background-size: cover;
  opacity: 0;
  transition: opacity 0.8s var(--ease-out);
  z-index: 0;
}
.journey--academia::before {
  background:
    radial-gradient(ellipse at 30% 30%, rgba(201,162,77,0.18) 0%, transparent 60%),
    linear-gradient(180deg, #F7EFDF 0%, #EAD9B9 100%);
}
.journey--corporate::before {
  background:
    radial-gradient(ellipse at 70% 40%, rgba(201,162,77,0.22) 0%, transparent 60%),
    linear-gradient(180deg, #161318 0%, #050505 100%);
}
.journey:hover::before { opacity: 1; }
.journey > * { position: relative; z-index: 1; }

.journey-num {
  font-family: var(--f-display);
  letter-spacing: 0.3em;
  font-size: 11px;
  color: var(--gold);
  display: flex;
  align-items: center;
  gap: 12px;
}
.journey-num .line { width: 40px; height: 1px; background: var(--gold); }

.journey h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(48px, 5.5vw, 88px);
  line-height: 0.96;
  letter-spacing: -0.02em;
  margin: 32px 0 0;
  max-width: 540px;
}
.journey h2 em {
  font-style: italic;
  color: var(--gold);
}
.journey--academia h2 em { color: var(--gold-deep); }

.journey p {
  font-family: var(--f-serif);
  font-style: italic;
  font-weight: 300;
  font-size: 19px;
  line-height: 1.5;
  margin: 28px 0 0;
  max-width: 440px;
  opacity: 0.78;
}

.journey-meta {
  margin-top: 44px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.journey-meta .row {
  display: flex; align-items: center; gap: 18px;
  font-size: 13px;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  opacity: 0.75;
}
.journey-meta .row .num {
  font-family: var(--f-display);
  font-weight: 500;
  color: var(--gold);
  width: 36px;
  font-size: 12px;
}
.journey--academia .journey-meta .row .num { color: var(--gold-deep); }

.journey-cta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 60px;
  padding-top: 28px;
  border-top: 1px solid currentColor;
  border-color: rgba(127,127,127,0.2);
}
.journey-cta .label {
  font-family: var(--f-sans);
  font-size: 13px;
  letter-spacing: 0.28em;
  text-transform: uppercase;
}
.journey-cta .icon {
  width: 44px; height: 44px;
  border-radius: 50%;
  border: 1px solid currentColor;
  display: grid; place-items: center;
  transition: background 0.3s, color 0.3s, transform 0.4s var(--ease-out);
}
.journey:hover .icon {
  background: var(--gold);
  color: #0B0B0B;
  border-color: var(--gold);
  transform: translateX(8px);
}

.journey-watermark {
  position: absolute;
  bottom: -50px;
  right: -20px;
  z-index: 0;
  font-family: var(--f-display);
  font-weight: 600;
  font-size: clamp(140px, 18vw, 280px);
  letter-spacing: 0;
  line-height: 1;
  opacity: 0.06;
  pointer-events: none;
  user-select: none;
}
.journey--academia .journey-watermark { color: var(--gold-deep); opacity: 0.12; }
.journey--corporate .journey-watermark { color: var(--gold); opacity: 0.08; }

@media (max-width: 900px) {
  .journeys { grid-template-columns: 1fr; }
  .journey { padding: 60px 32px; }
}

/* ============ Founders / Architects ============ */
.architects {
  background: var(--ivory);
  color: var(--ink);
  padding: 160px 36px;
}
.arch-head {
  max-width: 1100px;
  margin: 0 auto 90px;
  text-align: center;
}
.arch-head .eyebrow { display: inline-block; }
.arch-head .eyebrow { margin-bottom: 24px; }
.arch-head h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(40px, 4.6vw, 72px);
  line-height: 1.04;
  margin: 22px auto 0;
  letter-spacing: -0.01em;
  max-width: 900px;
}
.arch-head h2 em { color: var(--gold-deep); font-style: italic; }
.arch-head p {
  font-size: 17px;
  line-height: 1.65;
  color: rgba(11,11,11,0.7);
  max-width: 480px;
  margin: 0 auto;
}

.arch-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  max-width: 1400px;
  margin: 0 auto;
}
.arch-card {
  display: grid;
  grid-template-columns: 220px 1fr;
  gap: 32px;
}
.arch-portrait {
  aspect-ratio: 3 / 4;
  background:
    repeating-linear-gradient(135deg, rgba(11,11,11,0.06) 0 6px, transparent 6px 14px),
    linear-gradient(135deg, #E8D9B6 0%, #C9A24D 100%);
  border: 1px solid rgba(201,162,77,0.4);
  position: relative;
  display: grid;
  place-items: end;
  padding: 18px;
  font-family: monospace;
  font-size: 10px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(11,11,11,0.5);
}
.arch-portrait::before {
  content: 'PORTRAIT';
  position: absolute;
  top: 18px; left: 18px;
  font-family: monospace;
  font-size: 9px;
  letter-spacing: 0.32em;
  color: rgba(11,11,11,0.45);
}
.arch-card h3 {
  font-family: var(--f-serif);
  font-weight: 400;
  font-size: 32px;
  margin: 0 0 6px;
  letter-spacing: -0.01em;
}
.arch-card .role {
  font-size: 11px;
  letter-spacing: 0.32em;
  text-transform: uppercase;
  color: var(--gold-deep);
  margin-bottom: 18px;
}
.arch-card .bio {
  font-size: 15px;
  line-height: 1.7;
  color: rgba(11,11,11,0.7);
}

@media (max-width: 900px) {
  .arch-grid { grid-template-columns: 1fr; gap: 60px; }
  .arch-card { grid-template-columns: 1fr; }
  .arch-portrait { max-width: 240px; }
}

/* ============ Pillars (Why SELF) ============ */
.pillars {
  background: var(--ink);
  color: var(--bone);
  padding: 180px 36px;
  position: relative;
  overflow: hidden;
}
.pillars::before {
  content: 'SELF';
  position: absolute;
  bottom: -120px;
  left: 50%;
  transform: translateX(-50%);
  font-family: var(--f-display);
  font-weight: 600;
  font-size: 480px;
  letter-spacing: 0.04em;
  color: rgba(201,162,77,0.04);
  line-height: 1;
  pointer-events: none;
}
.pillars-head {
  text-align: center;
  margin-bottom: 80px;
  position: relative;
}
.pillars-head h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(36px, 4vw, 64px);
  line-height: 1.1;
  margin: 18px 0 0;
  letter-spacing: -0.01em;
}
.pillars-head h2 em { color: var(--gold); font-style: italic; }

.pillars-list {
  max-width: 1100px;
  margin: 0 auto;
  position: relative;
}
.pillar-row {
  display: grid;
  grid-template-columns: 96px 280px 1fr;
  gap: 40px;
  padding: 32px 0;
  border-top: 1px solid rgba(201,162,77,0.14);
  align-items: center;
  transition: padding 0.4s var(--ease-out), background 0.4s;
}
.pillar-row:last-child { border-bottom: 1px solid rgba(201,162,77,0.14); }
.pillar-row:hover { padding: 32px 32px; background: rgba(201,162,77,0.04); }
.pillar-letter {
  font-family: var(--f-display);
  font-weight: 600;
  font-size: 64px;
  color: var(--gold);
  letter-spacing: 0;
  line-height: 1;
}
.pillar-title {
  font-family: var(--f-serif);
  font-weight: 400;
  font-size: 26px;
  letter-spacing: -0.01em;
  color: var(--bone);
  line-height: 1.2;
}
.pillar-desc {
  font-size: 15px;
  line-height: 1.7;
  color: var(--bone-mute);
}
@media (max-width: 900px) {
  .pillar-row { grid-template-columns: 60px 1fr; gap: 18px; padding: 22px 0; }
  .pillar-letter { font-size: 40px; }
  .pillar-row .pillar-desc { grid-column: 1 / -1; margin-top: 6px; }
  .pillar-row:hover { padding: 22px 16px; }
}

/* ============ Numbers strip ============ */
.numbers {
  padding: 100px 36px;
  background: var(--ivory);
  color: var(--ink);
  border-top: 1px solid rgba(201,162,77,0.25);
  border-bottom: 1px solid rgba(201,162,77,0.25);
}
.numbers-grid {
  max-width: 1400px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 60px;
}
.numbers-grid .stat { text-align: left; }
.numbers-grid .num {
  font-family: var(--f-display);
  font-weight: 600;
  font-size: clamp(40px, 5vw, 72px);
  letter-spacing: -0.02em;
  color: var(--ink);
  display: flex;
  align-items: baseline;
  gap: 6px;
}
.numbers-grid .num .gold {
  color: var(--gold-deep);
  font-size: 0.6em;
  letter-spacing: 0;
}
.numbers-grid .lbl {
  font-size: 12px;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: rgba(11,11,11,0.6);
  margin-top: 8px;
  border-top: 1px solid rgba(11,11,11,0.18);
  padding-top: 12px;
}
@media (max-width: 900px) {
  .numbers-grid { grid-template-columns: 1fr 1fr; gap: 40px; }
}

/* ============ Voices (testimonials) ============ */
.voices {
  padding: 160px 36px;
  background: var(--ivory-soft);
  color: var(--ink);
}
.voices-head { max-width: 1400px; margin: 0 auto 60px; text-align: center; }
.voices-head h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(36px, 4vw, 64px);
  margin: 18px 0 0;
  letter-spacing: -0.01em;
}
.voices-grid {
  max-width: 1400px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}
.voice {
  background: #fff;
  border: 1px solid rgba(11,11,11,0.06);
  padding: 36px 32px;
  position: relative;
  transition: transform 0.5s var(--ease-out), box-shadow 0.5s;
}
.voice:hover {
  transform: translateY(-8px);
  box-shadow: 0 30px 80px -20px rgba(11,11,11,0.18);
}
.voice .gold-rule { margin-bottom: 18px; }
.voice blockquote {
  font-family: var(--f-serif);
  font-style: italic;
  font-weight: 300;
  font-size: 20px;
  line-height: 1.5;
  margin: 0 0 24px;
  color: var(--ink);
}
.voice .author {
  display: flex; gap: 14px; align-items: center;
}
.voice .avatar {
  width: 44px; height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, #E8D9B6, #C9A24D);
  font-family: var(--f-display);
  display: grid; place-items: center;
  color: #0B0B0B;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.04em;
}
.voice .meta { font-size: 13px; line-height: 1.4; }
.voice .meta strong { display: block; font-weight: 600; }
.voice .meta span { color: rgba(11,11,11,0.55); font-size: 12px; }
@media (max-width: 900px) {
  .voices-grid { grid-template-columns: 1fr; }
}

/* ============ CTA / Lead capture invitation ============ */
.lead-cta {
  background: linear-gradient(180deg, #0B0B0E 0%, #050507 100%);
  color: var(--bone);
  padding: 180px 36px 140px;
  position: relative;
  overflow: hidden;
}
.lead-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 80% 20%, rgba(201,162,77,0.16), transparent 60%),
    radial-gradient(ellipse at 10% 80%, rgba(201,162,77,0.08), transparent 60%);
}
.lead-cta-inner {
  max-width: 1100px;
  margin: 0 auto;
  position: relative;
  text-align: center;
}
.lead-cta h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(44px, 5.4vw, 88px);
  line-height: 1.04;
  margin: 22px 0 0;
  letter-spacing: -0.02em;
}
.lead-cta h2 em { font-style: italic; color: var(--gold); }
.lead-cta p {
  font-size: 17px;
  line-height: 1.7;
  color: var(--bone-mute);
  max-width: 620px;
  margin: 28px auto 0;
}
.lead-cta .btn-row {
  display: flex;
  justify-content: center;
  gap: 18px;
  margin-top: 50px;
  flex-wrap: wrap;
}
.lead-cta .clarity-row {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 14px;
  margin-top: 38px;
  font-size: 12px;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: var(--bone-mute);
}
.lead-cta .clarity-row .dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--gold);
  animation: pulse 2s infinite;
}

/* ============ Footer ============ */
.site-footer.theme-dark {
  background: #050507;
  color: var(--bone);
  border-top: 1px solid rgba(201,162,77,0.2);
}
.theme-dark .footer-grid h5 { color: var(--gold); opacity: 1; }
.theme-dark .footer-grid li a { color: var(--bone); }
.theme-dark .footer-bottom { color: var(--bone-mute); border-color: rgba(201,162,77,0.18); }

.foot-logo {
  font-family: var(--f-display);
  font-size: 28px;
  letter-spacing: 0.22em;
  color: var(--gold);
  margin-bottom: 8px;
  font-weight: 600;
}
.foot-by {
  font-family: var(--f-serif);
  font-style: italic;
  font-size: 18px;
  color: var(--bone);
  letter-spacing: 0;
  font-weight: 300;
}
.foot-blurb {
  margin-top: 18px;
  font-size: 14px;
  line-height: 1.7;
  color: var(--bone-mute);
  max-width: 320px;
}

/* ============ Moments / sliding gallery ============ */
.moments {
  padding: 140px 0 110px;
  background: #08080A;
  color: var(--bone);
  overflow: hidden;
  position: relative;
  border-top: 1px solid rgba(201,162,77,0.18);
}
.moments-head {
  text-align: center;
  max-width: 1100px;
  margin: 0 auto 60px;
  padding: 0 36px;
}
.moments-head h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(36px, 4vw, 60px);
  line-height: 1.06;
  margin: 18px 0 0;
  letter-spacing: -0.01em;
  color: var(--bone);
}
.moments-head h2 em { color: var(--gold); font-style: italic; }
.moments-head p {
  font-size: 16px;
  line-height: 1.7;
  color: var(--bone-mute);
  max-width: 620px;
  margin: 24px auto 0;
}
.moments-track-wrap {
  position: relative;
  width: 100%;
}
.moments-track-wrap::before,
.moments-track-wrap::after {
  content: '';
  position: absolute;
  top: 0; bottom: 0;
  width: 140px;
  z-index: 3;
  pointer-events: none;
}
.moments-track-wrap::before { left: 0;  background: linear-gradient(90deg,  #08080A, transparent); }
.moments-track-wrap::after  { right: 0; background: linear-gradient(270deg, #08080A, transparent); }
.moments-track {
  display: flex;
  gap: 28px;
  width: max-content;
  animation: moments-scroll 60s linear infinite;
  padding: 8px 28px;
}
.moments-track:hover { animation-play-state: paused; }
@keyframes moments-scroll {
  to { transform: translateX(-50%); }
}
.moment-tile {
  flex: 0 0 auto;
  width: 520px;
  aspect-ratio: 6 / 4;
  position: relative;
  overflow: hidden;
  background: var(--bg, linear-gradient(135deg, #1A1812, #C9A24D));
  border: 1px solid rgba(201,162,77,0.18);
  transition: transform 0.5s var(--ease-out), border-color 0.4s;
}
.moment-tile:hover {
  transform: translateY(-6px);
  border-color: rgba(201,162,77,0.5);
}
.moment-tile img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
  transition: transform 0.6s var(--ease-out);
}
.moment-tile:hover img { transform: scale(1.04); }
.moment-tile::before {
  content: '';
  position: absolute;
  inset: 0;
  z-index: 1;
  background:
    linear-gradient(180deg, transparent 50%, rgba(0,0,0,0.65) 100%),
    radial-gradient(ellipse at 50% 30%, rgba(201,162,77,0.20), transparent 60%);
}
@media (max-width: 700px) {
  .moment-tile { width: 280px; }
  .moments-track { gap: 18px; padding: 8px 18px; }
}

/* ============ Video Voices reel ============ */
.vreel {
  position: relative;
  max-width: 1400px;
  margin: 0 auto;
}
.vreel-track {
  display: grid;
  grid-auto-flow: column;
  grid-auto-columns: calc((100% - 36px*2 - 24px*2) / 3);
  gap: 24px;
  padding: 8px 36px 18px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  scrollbar-width: none;
}
.vreel-track::-webkit-scrollbar { display: none; }
.vreel-track > * { scroll-snap-align: start; }

@media (max-width: 1100px) { .vreel-track { grid-auto-columns: calc((100% - 36px*2 - 18px) / 2); } }
@media (max-width: 700px)  { .vreel-track { grid-auto-columns: 78vw; padding: 8px 22px 18px; } }

.vreel-card {
  position: relative;
  background: transparent;
  border: none;
  overflow: visible;
  transition: transform 0.45s var(--ease-out);
  cursor: pointer;
  display: flex;
  flex-direction: column;
}
.vreel-card .vreel-media {
  border: 1px solid rgba(201,162,77,0.18);
  overflow: hidden;
  border-radius: 4px;
  transition: border-color 0.4s, box-shadow 0.5s;
}
.vreel-card:hover { transform: translateY(-5px); }
.vreel-card:hover .vreel-media {
  border-color: rgba(201,162,77,0.5);
  box-shadow: 0 24px 50px -20px rgba(0,0,0,0.6);
}
.vreel-media {
  position: relative;
  aspect-ratio: 1 / 1;
  background:
    radial-gradient(ellipse at 50% 30%, rgba(201,162,77,0.20), transparent 60%),
    linear-gradient(135deg, #1B1812 0%, #06060A 100%);
  overflow: hidden;
}
.vreel-media iframe {
  position: absolute;
  inset: 0;
  width: 100%; height: 100%;
  border: 0;
  z-index: 4;
}
.vreel-mute {
  position: absolute;
  top: 12px; right: 12px;
  z-index: 10;
  width: 36px; height: 36px;
  border-radius: 50%;
  background: rgba(10,10,12,0.60);
  border: 1px solid rgba(255,255,255,0.20);
  backdrop-filter: blur(6px);
  display: grid;
  place-items: center;
  cursor: pointer;
  opacity: 0;
  pointer-events: none;
  transition: background 0.2s, opacity 0.25s, transform 0.2s;
}
.vreel-card.is-playing .vreel-mute { opacity: 1; pointer-events: auto; }
.vreel-mute svg { width: 16px; height: 16px; fill: #fff; }
.vreel-play {
  position: absolute;
  bottom: 14px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 8;
  display: flex;
  align-items: center;
  pointer-events: auto;
  transition: opacity 0.3s;
}
.vreel-play-btn {
  width: 52px; height: 52px;
  border-radius: 50%;
  border: 1.5px solid rgba(255,255,255,0.85);
  background: rgba(10,10,12,0.55);
  backdrop-filter: blur(8px);
  display: grid;
  place-items: center;
  cursor: pointer;
  transition: background 0.25s, border-color 0.25s, transform 0.25s;
  color: #fff;
}
.vreel-play-btn svg { width: 20px; height: 20px; fill: #fff; }
.vreel-card:not(.is-playing) .vreel-play { opacity: 0; }
.vreel-card:not(.is-playing):hover .vreel-play { opacity: 1; }
.vreel-card.is-playing .vreel-play { opacity: 1; }
.vreel-tap-overlay { display: none; position: absolute; inset: 0; z-index: 6; cursor: pointer; }
.vreel-card.is-playing .vreel-tap-overlay { display: block; }
.vreel-cover { transition: opacity 0.5s ease; z-index: 1; }
.vreel-below { padding: 14px 4px 0; text-align: center; }
.vreel-name { font-family: var(--f-sans); font-weight: 600; font-size: 14px; color: var(--bone); display: block; }
.vreel-role { font-family: var(--f-display); font-size: 9px; letter-spacing: 0.24em; text-transform: uppercase; color: var(--gold); margin-top: 4px; display: block; }
.vreel-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 36px 0;
  max-width: 1400px;
  margin: 18px auto 0;
}
.vreel-hint { font-family: var(--f-display); font-size: 10px; letter-spacing: 0.32em; text-transform: uppercase; color: var(--gold); opacity: 0.55; }
.vreel-btns { display: flex; gap: 10px; }
.vreel-btn {
  width: 44px; height: 44px;
  border-radius: 50%;
  border: 1px solid var(--gold);
  background: transparent;
  cursor: pointer;
  display: grid;
  place-items: center;
  transition: background 0.3s, color 0.3s, opacity 0.3s;
  color: var(--gold);
}
.vreel-btn:hover { background: var(--gold); color: #0B0B0B; }
.vreel-btn.is-disabled { opacity: 0.3; pointer-events: none; }
.vreel-btn .ar { display: inline-block; width: 14px; height: 1px; background: currentColor; position: relative; }
.vreel-btn .ar::after { content: ''; position: absolute; right: 0; top: 50%; width: 6px; height: 6px; border-top: 1px solid currentColor; border-right: 1px solid currentColor; transform: translateY(-50%) rotate(45deg); }
.vreel-prev .ar { transform: scaleX(-1); }

/* ============ Text Voices reel ============ */
.text-voices {
  padding: 140px 36px;
  background: var(--ivory-soft);
  color: var(--ink);
  border-top: 1px solid rgba(201,162,77,0.18);
}
.text-voices-head { max-width: 1100px; margin: 0 auto 50px; text-align: center; }
.text-voices-head h2 {
  font-family: var(--f-serif);
  font-weight: 300;
  font-size: clamp(34px, 4vw, 56px);
  margin: 18px 0 0;
  letter-spacing: -0.01em;
}
.text-voices-head h2 em { color: var(--gold-deep); font-style: italic; }

.treel { position: relative; max-width: 1400px; margin: 0 auto; }
.treel-track {
  display: grid;
  grid-auto-flow: column;
  grid-auto-columns: calc((100% - 24px*2) / 3);
  gap: 24px;
  padding: 8px 4px 24px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  scrollbar-width: none;
}
.treel-track::-webkit-scrollbar { display: none; }
.treel-track > * { scroll-snap-align: start; }
@media (max-width: 1100px) { .treel-track { grid-auto-columns: calc((100% - 18px) / 2); } }
@media (max-width: 700px)  { .treel-track { grid-auto-columns: 82vw; } }

.treel-card {
  margin: 0;
  background: #fff;
  border: 1px solid rgba(11,11,11,0.06);
  padding: 38px 32px 32px;
  position: relative;
  transition: transform 0.45s var(--ease-out), box-shadow 0.45s, border-color 0.4s;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.treel-card:hover {
  transform: translateY(-6px);
  border-color: rgba(201,162,77,0.4);
  box-shadow: 0 30px 60px -25px rgba(11,11,11,0.18);
}
.treel-card .tv-mark {
  font-family: var(--f-serif);
  font-size: 80px;
  line-height: 0.6;
  color: var(--gold);
  opacity: 0.55;
  margin: -4px 0 4px;
  font-weight: 500;
}
.treel-card blockquote {
  font-family: var(--f-serif);
  font-style: italic;
  font-weight: 300;
  font-size: 20px;
  line-height: 1.5;
  margin: 0 0 22px;
  color: var(--ink);
  flex: 1;
}
.treel-card figcaption {
  display: flex;
  flex-direction: column;
  gap: 4px;
  padding-top: 18px;
  border-top: 1px solid rgba(11,11,11,0.1);
}
.treel-card .who-name { font-family: var(--f-sans); font-weight: 600; font-size: 14px; color: var(--ink); }
.treel-card .who-role { font-family: var(--f-display); font-size: 10px; letter-spacing: 0.32em; text-transform: uppercase; color: var(--gold-deep); font-weight: 500; }

.treel-controls { display: flex; justify-content: space-between; align-items: center; padding-top: 18px; }
.treel-hint { font-family: var(--f-display); font-size: 10px; letter-spacing: 0.32em; text-transform: uppercase; color: var(--gold-deep); opacity: 0.7; }
.treel-btns { display: flex; gap: 10px; }
.treel-btn {
  width: 44px; height: 44px;
  border-radius: 50%;
  border: 1px solid var(--gold-deep);
  background: var(--ivory);
  cursor: pointer;
  display: grid;
  place-items: center;
  transition: background 0.3s, color 0.3s, opacity 0.3s;
  color: var(--gold-deep);
}
.treel-btn:hover { background: var(--gold-deep); color: var(--ivory); }
.treel-btn.is-disabled { opacity: 0.3; pointer-events: none; }
.treel-btn .ar { display: inline-block; width: 14px; height: 1px; background: currentColor; position: relative; }
.treel-btn .ar::after { content: ''; position: absolute; right: 0; top: 50%; width: 6px; height: 6px; border-top: 1px solid currentColor; border-right: 1px solid currentColor; transform: translateY(-50%) rotate(45deg); }
.treel-prev .ar { transform: scaleX(-1); }
</style>

<!-- ===== Preloader ===== -->
<div class="preloader" id="preloader">
  <div style="text-align:center">
    <div class="mark">
      <span>S</span><span>E</span><span>L</span><span>F</span>
    </div>
    <div class="rule"></div>
  </div>
</div>

<!-- ===== HERO ===== -->
<section class="hero" data-screen-label="01 Hero">
  <div class="hero-bg-fallback"></div>
  <div class="hero-bg-yt">
    <iframe
      src="https://www.youtube-nocookie.com/embed/LpTm7BVB-Kw?autoplay=1&mute=1&loop=1&playlist=LpTm7BVB-Kw&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&iv_load_policy=3&disablekb=1&fs=0&cc_load_policy=0"
      title="SELF"
      allow="autoplay; encrypted-media; picture-in-picture"
      allowfullscreen></iframe>
  </div>

  <div class="hero-inner">
    <div>
      <div class="hero-eyebrow reveal">
        <span class="l"></span>
        <span>Self Engineering for Leaders' Fortune</span>
      </div>

      <h1>
        <span class="reveal-mask"><span>Built not by chance</span></span><br />
        <span class="reveal-mask" style="--d:200ms"><span><span class="gold">by design.</span></span></span>
      </h1>

      <p class="sub reveal" style="--d:600ms">
        Two journeys.&nbsp;&nbsp;One philosophy.<br />
        Capability built quietly, deliberately, and at depth — for the
        <span style="color: var(--gold); font-style: normal;">students</span> who will lead,
        and the <span style="color: var(--gold); font-style: normal;">organisations</span>
        that need them to.
      </p>

      <div class="hero-actions reveal" style="--d:800ms">
        <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">
          Book a Clarity Call <span class="arrow"></span>
        </button>
      </div>
    </div>

    <div class="hero-side reveal" style="--d:1000ms">
      <div class="gold-rule"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
      <p class="hero-mini">
        The development arm of <strong style="color:var(--gold); font-family: var(--f-display); font-weight: 500; letter-spacing: 0.08em;">Gaurav Sharma &amp; Associates</strong> — 25+ years of combined entrepreneurial and academic experience translated into programs that build leadership, communication, and capability from the inside out.
      </p>
      <div class="hero-mini" style="font-family: var(--f-display); font-size: 13px; line-height: 1.6; letter-spacing: 0.22em; text-transform: uppercase; color: var(--gold); font-weight: 500;">
        by Gaurav Sharma &amp; Associates
      </div>
    </div>
  </div>

  <div class="hero-meta-row">
    <div class="pill"><span class="dot"></span><span>Active Cohorts · 2026</span></div>
    <div class="hero-scroll-cue">
      <span>Scroll</span>
      <span class="stem"></span>
    </div>
    <div class="pill">Jaipur · India · Remote</div>
  </div>
</section>

<!-- ===== Tagline marquee ===== -->
<div class="tagline-marquee" data-marquee>
  <div class="marquee-inner">
    <span>SELF Development Programs <span class="sep"></span></span>
    <span>www.selfbygs.com <span class="sep"></span></span>
    <span>Self Engineering for Leaders' Fortune <span class="sep"></span></span>
    <span>By Gaurav Sharma &amp; Associates <span class="sep"></span></span>
    <span>Awareness · Capability · Leadership <span class="sep"></span></span>
    <span>Based in Jaipur <span class="sep"></span></span>
    <span>SELF Development Programs <span class="sep"></span></span>
    <span>www.selfbygs.com <span class="sep"></span></span>
    <span>Self Engineering for Leaders' Fortune <span class="sep"></span></span>
    <span>By Gaurav Sharma &amp; Associates <span class="sep"></span></span>
    <span>Awareness · Capability · Leadership <span class="sep"></span></span>
    <span>Based in Jaipur <span class="sep"></span></span>
  </div>
</div>

<!-- ===== Mission ===== -->
<section class="mission" id="approach">
  <div class="container">
    <p class="quote reveal">
      In a world full of information,<br />
      <span class="gold">students</span> need <em>more guidance</em> than ever<br />
      and <span class="gold">organisations</span> need people who can lead.
    </p>
    <div class="attribution reveal" style="--d:200ms">
      A Developmental Response
      <span class="script" style="font-family: var(--f-display); font-weight: 500; font-size: 13px; letter-spacing: 0.32em; text-transform: uppercase; color: var(--ink); display: block; margin-top: 14px;">by Gaurav Sharma &amp; Associates</span>
    </div>
  </div>
</section>

<!-- ===== Two journeys split ===== -->
<section class="journeys" data-screen-label="02 Journeys">

  <a class="journey journey--corporate hoverable" href="<?php echo esc_url( home_url( '/corporate/' ) ); ?>">
    <div>
      <div class="journey-num"><span class="line"></span><span>I · Corporate</span></div>
      <h2>Building <em>effective organisations</em> from the inside.</h2>
      <p>Behaviour, ownership, alignment. The human side of organisational performance — diagnosed, developed, transformed.</p>
    </div>

    <div class="journey-meta">
      <div class="row"><span class="num">01</span><span>Executive Effectiveness Programs</span></div>
      <div class="row"><span class="num">02</span><span>Core Skills Interventions</span></div>
      <div class="row"><span class="num">03</span><span>Custom Solutions &amp; Diagnostics</span></div>
    </div>

    <div class="journey-cta">
      <div class="label">Enter Corporate</div>
      <div class="icon">→</div>
    </div>

    <div class="journey-watermark">C</div>
  </a>

  <a class="journey journey--academia hoverable" href="<?php echo esc_url( home_url( '/academia/' ) ); ?>">
    <div>
      <div class="journey-num"><span class="line"></span><span>II · Academia</span></div>
      <h2>Building more prepared, aware &amp; capable <em>students &amp; educators.</em></h2>
      <p>Mentoring, direction, decision-making — for the students, educators, and institutions shaping what comes next.</p>
    </div>

    <div class="journey-meta">
      <div class="row"><span class="num">01</span><span>Career Architecture Lab</span></div>
      <div class="row"><span class="num">02</span><span>Young Leaders Program · YLP &amp; YLP Pro</span></div>
      <div class="row"><span class="num">03</span><span>Educator Impact · Beyond Teaching</span></div>
    </div>

    <div class="journey-cta">
      <div class="label">Enter Academia</div>
      <div class="icon">→</div>
    </div>

    <div class="journey-watermark">A</div>
  </a>
</section>

<!-- ===== Architects ===== -->
<section class="architects">
  <div class="arch-head">
    <div>
      <div class="eyebrow reveal">The Architects</div>
      <h2 class="reveal" style="--d:120ms">A practice built over <em>25+ years</em> of entrepreneurial and academic experience.</h2>
    </div>
  </div>

  <div class="arch-grid">
    <article class="arch-card reveal" data-tilt="3">
      <div class="arch-portrait" style="padding:0;overflow:hidden;"><img src="https://course.selfbygs.com/wp-content/uploads/2025/10/IMG_8369-min-scaled.jpg" alt="Gaurav Sharma" style="width:100%;height:100%;object-fit:cover;object-position:top;"></div>
      <div>
        <h3>Gaurav Sharma</h3>
        <div class="role">Founder &amp; Chief Mentor · SELF</div>
        <p class="bio">
          <strong style="color:var(--ink); font-weight:600;">IIM Calcutta</strong> alumnus and <strong style="color:var(--ink); font-weight:600;">Master Certified Intelligent Leadership Executive Coach</strong>, GS brings <strong style="color:var(--gold-deep); font-weight:600;">16+ years</strong> of experience in leadership and human capability development across institutions and organisations.
        </p>
        <a href="<?php echo esc_url( home_url( '/team/#gs' ) ); ?>" class="btn hoverable" style="margin-top: 18px; padding: 12px 22px; font-size: 11px; color: var(--gold-deep); border-color: var(--gold-deep);">Read full profile <span class="arrow"></span></a>
      </div>
    </article>

    <article class="arch-card reveal" style="--d:160ms" data-tilt="3">
      <div class="arch-portrait">replace · Dr. TSG</div>
      <div>
        <h3>Dr. Tanya Soin Gaurav</h3>
        <div class="role">Chief Architect · Learning &amp; Development</div>
        <p class="bio">
          <strong style="color:var(--ink); font-weight:600;">Doctorate in Human Resource Management</strong> and HR Analytics certified from <strong style="color:var(--ink); font-weight:600;">IIM Rohtak</strong>, Tanya brings <strong style="color:var(--gold-deep); font-weight:600;">13+ years</strong> of experience in behavioural development, Training &amp; Development, and organisational learning.
        </p>
        <a href="<?php echo esc_url( home_url( '/team/#tsg' ) ); ?>" class="btn hoverable" style="margin-top: 18px; padding: 12px 22px; font-size: 11px; color: var(--gold-deep); border-color: var(--gold-deep);">Read full profile <span class="arrow"></span></a>
      </div>
    </article>
  </div>

  <div style="text-align:center; margin-top: 70px;" class="reveal">
    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>" class="btn hoverable" style="color: var(--gold-deep); border-color: var(--gold-deep);">Meet the full team <span class="arrow"></span></a>
  </div>
</section>

<!-- ===== Pillars (Why SELF — IMPACT) ===== -->
<section class="pillars" id="why-self">
  <div class="pillars-head">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:18px">Why SELF</div>
    <h2 class="reveal" style="--d:140ms">For the <em>Real IMPACT.</em></h2>
    <p class="reveal" style="--d:240ms; font-size:16px; line-height:1.65; color:var(--bone-mute); max-width:680px; margin:28px auto 0;">Six working commitments behind every program — academic or corporate. The reason participants describe SELF as something they remember, long after the program ends.</p>
  </div>

  <div class="pillars-list">
    <div class="pillar-row reveal hoverable">
      <div class="pillar-letter">I</div>
      <div class="pillar-title">Individual Attention</div>
      <div class="pillar-desc">Every participant matters — not just the group outcome. Programs are designed around the people in the room, not a generic curriculum.</div>
    </div>
    <div class="pillar-row reveal hoverable" style="--d:80ms">
      <div class="pillar-letter">M</div>
      <div class="pillar-title">More Than Expected</div>
      <div class="pillar-desc">We believe in delivering deeper value beyond the defined scope. The work is judged by what changes — not by what was scheduled.</div>
    </div>
    <div class="pillar-row reveal hoverable" style="--d:160ms">
      <div class="pillar-letter">P</div>
      <div class="pillar-title">Practical Experience</div>
      <div class="pillar-desc">Experiential, application-oriented learning over passive training. Capability is built through doing — not by being told.</div>
    </div>
    <div class="pillar-row reveal hoverable" style="--d:240ms">
      <div class="pillar-letter">A</div>
      <div class="pillar-title">Aligned Customisation</div>
      <div class="pillar-desc">Programs designed around organisational culture, industry, and real developmental needs. Never a pulled-from-the-shelf deck.</div>
    </div>
    <div class="pillar-row reveal hoverable" style="--d:320ms">
      <div class="pillar-letter">C</div>
      <div class="pillar-title">Continued Engagement</div>
      <div class="pillar-desc">Structured follow-ups and reinforcement beyond one-time interventions. The work continues after the workshop closes.</div>
    </div>
    <div class="pillar-row reveal hoverable" style="--d:400ms">
      <div class="pillar-letter">T</div>
      <div class="pillar-title">Transformation-Oriented</div>
      <div class="pillar-desc">Focused on measurable behavioural, leadership, communication, and execution outcomes. Not certificates. Real change.</div>
    </div>
  </div>
</section>

<!-- ===== Programs strip · CORPORATE (dark) ===== -->
<section class="programs-strip programs-strip--dark">
  <div class="head">
    <div>
      <div class="eyebrow reveal">Programs</div>
      <h2 class="reveal" style="--d:120ms">Three programs.<br/><em>One philosophy.</em></h2>
    </div>
    <p class="reveal" style="--d:240ms">Each program is designed around a real challenge — not a generic curriculum. Click any program to see its detailed design, framework, and outcomes.</p>
  </div>

  <div class="prog-side">
    <div class="prog-side-head reveal">
      <div class="prog-side-title">
        <span class="roman">I · Corporate</span>
        <h3>For <em>organisations</em></h3>
      </div>
      <div class="prog-side-meta">3 Practices · All Custom Built</div>
    </div>

    <div class="prog-grid">
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

<!-- ===== Programs strip · ACADEMIA (light) ===== -->
<section class="programs-strip programs-strip--light">
  <div class="prog-side">
    <div class="prog-side-head reveal">
      <div class="prog-side-title">
        <span class="roman">II · Academia</span>
        <h3>For <em>students &amp; educators</em></h3>
      </div>
      <div class="prog-side-meta">3 Programs · Cohort-based</div>
    </div>

    <div class="prog-grid">
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

<!-- ===== Moments / sliding gallery ===== -->
<section class="moments" aria-label="Moments from our sessions">
  <div class="moments-head">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:18px">In the room</div>
    <h2 class="reveal" style="--d:120ms">Moments from <em>the work.</em></h2>
    <p class="reveal" style="--d:240ms">A glimpse of cohorts, workshops, and conversations across academia and corporate engagements.</p>
  </div>

  <div class="moments-track-wrap">
    <div class="moments-track" data-moments-track>
      <div class="moment-tile" style="--bg:#1A1812;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/1-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#1F1F25;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/2-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#0E0E12;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/3-1.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#14130E;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/4-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#1B1B1F;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/5-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#0A0A0C;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/6-3.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#181820;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/7-3.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#13130E;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/8-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <!-- Duplicate for seamless loop -->
      <div class="moment-tile" style="--bg:#1A1812;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/1-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#1F1F25;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/2-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#0E0E12;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/3-1.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#14130E;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/4-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#1B1B1F;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/5-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#0A0A0C;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/6-3.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#181820;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/7-3.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
      <div class="moment-tile" style="--bg:#13130E;"><img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/8-2.png?fit=1800%2C1200&ssl=1" alt="SELF Sessions" loading="lazy"></div>
    </div>
  </div>
</section>

<!-- ===== Logo slider · credentials & affiliations ===== -->
<section class="logo-slider" aria-label="Credentials and affiliations">
  <div class="ls-head">Built on credentials that hold weight</div>
  <div class="ls-track" data-marquee-track>
    <div class="ls-item">IIM <span class="small">Calcutta</span></div>
    <div class="ls-item">IIM <span class="small">Rohtak</span></div>
    <div class="ls-item">John Mattone <span class="small">Global</span></div>
    <div class="ls-item">ICF <span class="small">Aligned</span></div>
    <div class="ls-item">Master CMC <span class="small">Coaching</span></div>
    <div class="ls-item">NET–JRF <span class="small">Qualified</span></div>
    <div class="ls-item script">Published</div>
    <div class="ls-item">Gaurav Sharma <span class="small">&amp; Associates</span></div>
    <div class="ls-item">IIM <span class="small">Calcutta</span></div>
    <div class="ls-item">IIM <span class="small">Rohtak</span></div>
    <div class="ls-item">John Mattone <span class="small">Global</span></div>
    <div class="ls-item">ICF <span class="small">Aligned</span></div>
    <div class="ls-item">Master CMC <span class="small">Coaching</span></div>
    <div class="ls-item">NET–JRF <span class="small">Qualified</span></div>
    <div class="ls-item script">Published</div>
    <div class="ls-item">Gaurav Sharma <span class="small">&amp; Associates</span></div>
  </div>
</section>

<!-- ===== Numbers ===== -->
<section class="numbers">
  <div class="numbers-grid">
    <div class="stat reveal">
      <div class="num">25<span class="gold">YRS+</span></div>
      <div class="lbl">Combined entrepreneurial &amp; academic practice</div>
    </div>
    <div class="stat reveal" style="--d:120ms">
      <div class="num">2<span class="gold">JOURNEYS</span></div>
      <div class="lbl">Academia · Corporate · One philosophy</div>
    </div>
    <div class="stat reveal" style="--d:240ms">
      <div class="num">7<span class="gold">PROGRAMS</span></div>
      <div class="lbl">Across leadership, capability &amp; readiness</div>
    </div>
    <div class="stat reveal" style="--d:360ms">
      <div class="num">∞<span class="gold">DEPTH</span></div>
      <div class="lbl">Designed for cohorts, not for content libraries</div>
    </div>
  </div>
</section>

<!-- ===== Voices · Video testimonials ===== -->
<section class="video-voices" id="voices">
  <div class="video-voices-head">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:18px">Voices · Video</div>
    <h2 class="reveal" style="--d:120ms">What participants <em>remember.</em></h2>
    <p class="reveal" style="--d:240ms; font-size:16px; line-height:1.65; color:var(--bone-mute); max-width:680px; margin:28px auto 0;">Short reflections from students, leaders, and educators — recorded in their own words at the end of each program.</p>
  </div>

  <div class="vreel" data-vreel>
    <div class="vreel-track" data-vreel-track>
      <article class="vreel-card reveal" data-video="https://selfbygs.com/wp-content/uploads/2025/09/IMG_7789.webm">
        <div class="vreel-media">
          <img class="vreel-cover" src="<?php echo esc_url( get_template_directory_uri() . '/assets/cover-shweta.png' ); ?>" alt="Dr. Shweta Jain" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Dr. Shweta Jain</span>
          <span class="vreel-role">Director · ICFAI Business School, Jaipur</span>
        </div>
      </article>
      <article class="vreel-card reveal" style="--d:80ms" data-video="https://selfbygs.com/wp-content/uploads/2025/08/WhatsApp-Video-2025-08-08-at-14.16.51.mp4">
        <div class="vreel-media">
          <img class="vreel-cover" src="<?php echo esc_url( get_template_directory_uri() . '/assets/cover-neetika.png' ); ?>" alt="Neetika Agrawal" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Neetika Agrawal</span>
          <span class="vreel-role">Student · IIFT Delhi</span>
        </div>
      </article>
      <article class="vreel-card reveal" style="--d:160ms" data-video="https://selfbygs.com/wp-content/uploads/2025/09/Prep-Hero-1.webm">
        <div class="vreel-media">
          <img class="vreel-cover" src="<?php echo esc_url( get_template_directory_uri() . '/assets/cover-diya.png' ); ?>" alt="Diya Kumari ji" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Diya Kumari ji</span>
          <span class="vreel-role">Deputy CM · Rajasthan</span>
        </div>
      </article>
      <article class="vreel-card reveal" style="--d:240ms" data-video="https://selfbygs.com/wp-content/uploads/2025/07/vid.mp4">
        <div class="vreel-media">
          <img class="vreel-cover" src="<?php echo esc_url( get_template_directory_uri() . '/assets/cover-shrey.png' ); ?>" alt="Shrey Sharma" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Shrey Sharma</span>
          <span class="vreel-role">Founder &amp; CEO · Cyntexa</span>
        </div>
      </article>
      <article class="vreel-card reveal" style="--d:320ms" data-video="https://selfbygs.com/wp-content/uploads/2025/08/InShot_20250811_124748132.mp4">
        <div class="vreel-media">
          <img class="vreel-cover" src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/7-1.png?w=1920&ssl=1" alt="Chinmaya" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Chinmaya</span>
          <span class="vreel-role">SELF · Program</span>
        </div>
      </article>
      <article class="vreel-card reveal" style="--d:400ms" data-video="https://selfbygs.com/wp-content/uploads/2025/08/WhatsApp-Video-2025-08-11-at-15.13.03.mp4">
        <div class="vreel-media">
          <img class="vreel-cover" src="<?php echo esc_url( get_template_directory_uri() . '/assets/cover-shaurya.png' ); ?>" alt="Shaurya Vig" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Shaurya Vig</span>
          <span class="vreel-role">BA Economics · Amity University</span>
        </div>
      </article>
      <article class="vreel-card reveal" style="--d:480ms" data-video="https://selfbygs.com/wp-content/uploads/2025/09/overtheyears.webm">
        <div class="vreel-media">
          <img class="vreel-cover" src="<?php echo esc_url( get_template_directory_uri() . '/assets/cover-rashi.png' ); ?>" alt="Rashi Sharma" loading="lazy" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
          <button class="vreel-mute" aria-label="Mute"><svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg></button>
          <div class="vreel-tap-overlay" aria-label="Pause"></div>
          <div class="vreel-play"><button class="vreel-play-btn" aria-label="Play"><svg viewBox="0 0 24 24" class="icon-play"><path d="M8 5v14l11-7z"/></svg><svg viewBox="0 0 24 24" class="icon-pause" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></button></div>
        </div>
        <div class="vreel-below">
          <span class="vreel-name">Rashi Sharma</span>
          <span class="vreel-role">Business Development · NamAstro</span>
        </div>
      </article>
    </div>

    <div class="vreel-controls">
      <span class="vreel-hint">Drag · swipe · scroll</span>
      <div class="vreel-btns">
        <button class="vreel-btn vreel-prev" aria-label="Previous"><span class="ar"></span></button>
        <button class="vreel-btn vreel-next" aria-label="Next"><span class="ar"></span></button>
      </div>
    </div>
  </div>
</section>

<!-- ===== Voices · Written testimonials ===== -->
<section class="text-voices">
  <div class="text-voices-head">
    <div class="eyebrow reveal">Voices · Written</div>
    <h2 class="reveal" style="--d:120ms">In their <em>own words.</em></h2>
  </div>

  <div class="treel" data-treel>
    <div class="treel-track" data-treel-track>
      <figure class="treel-card reveal">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/07/3-1.png?fit=500%2C500&ssl=1" alt="Divyansh Kachaloia" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>Being mentored by GS taught me to face fear, embrace change, and take pride in who I am. His words stayed with me at every stage, creating a space where growth feels safe, strength builds quietly, and discovering yourself becomes part of the journey.</blockquote>
        <figcaption>
          <span class="who-name">Divyansh Kachaloia</span>
          <span class="who-role">India's Celebrated Beatboxer · Winner of India's Got Talent</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:80ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/07/1-1.png?fit=500%2C500&ssl=1" alt="Sayema Rahman" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>Watching Gaurav with his students was a reminder of what real learning looks like: open, honest, and barrier-free. The space he creates is exactly what so many learners need today — safe, empowering, and full of possibility.</blockquote>
        <figcaption>
          <span class="who-name">Sayema Rahman</span>
          <span class="who-role">RJ · Radio Mirchi</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:160ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/07/2.png?fit=500%2C500&ssl=1" alt="Avani Chaturvedi" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>Gaurav Sir inspired me to stretch my limits and believe in what once felt impossible. His words, energy, and guidance helped shape my mindset early on — pushing boundaries, staying grounded in values, and unlocking what's truly possible with the right attitude.</blockquote>
        <figcaption>
          <span class="who-name">Avani Chaturvedi</span>
          <span class="who-role">India's first woman fighter pilot</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:240ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/07/Screenshot_20250701-152246_Instagram.jpg?fit=857%2C864&ssl=1" alt="Harshika Agarwal" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>Sometimes all it takes is a small spark to ignite something bigger. Gaurav Sir helped me see a new world of possibilities — a turning point that shaped my journey. Every challenge became a chance to grow, and that mindset made all the difference.</blockquote>
        <figcaption>
          <span class="who-name">Harshika Agarwal</span>
          <span class="who-role">Alumna · XLRI</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:320ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/Screenshot_20250812-121957_Instagram.jpg?fit=958%2C1208&ssl=1" alt="Pinky Mittal" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>Before meeting Gaurav Sir, I saw leadership as something big and far away. He showed me it's about small actions, staying grounded, and leading with kindness. Now I work with more clarity, confidence, and purpose. It's not just a course, it's a way of thinking that stays with you.</blockquote>
        <figcaption>
          <span class="who-name">Pinky Mittal</span>
          <span class="who-role">Content Creator &amp; Mom</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:400ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/Screenshot_20250812-122214_Google.jpg?fit=958%2C955&ssl=1" alt="Dr. Samir Kapoor" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>I've seen Gaurav with students and professionals — he connects instantly, listens deeply, and makes everyone feel heard. His calm, clear approach turns even complex situations into simple, actionable steps. That ability to guide without overwhelming is rare, and it leaves a lasting impact.</blockquote>
        <figcaption>
          <span class="who-name">Dr. Samir Kapoor</span>
          <span class="who-role">Serial Entrepreneur, Mindset Coach &amp; Author</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:480ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/Screenshot_20250812-121757_LinkedIn.jpg?fit=1079%2C979&ssl=1" alt="Umang Maheshwari" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>Gaurav Sir brought a fresh way of thinking — clear, practical, and deeply insightful. His sessions made me see challenges differently, communicate with more impact, and create solutions that work in the real world. It's rare to meet someone who can simplify complexity so effortlessly.</blockquote>
        <figcaption>
          <span class="who-name">Umang Maheshwari</span>
          <span class="who-role">Head, Consulting &amp; Research Practice · Schbang</span>
        </figcaption>
      </figure>
      <figure class="treel-card reveal" style="--d:560ms">
        <div class="tv-mark">"</div>
        <div class="treel-avatar-wrap" style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <img src="https://i0.wp.com/selfbygs.com/wp-content/uploads/2025/08/Screenshot_20250812-122301_Instagram.jpg?fit=741%2C832&ssl=1" alt="Yash Jain" loading="lazy" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
        </div>
        <blockquote>I converted IIM Shillong, and Gaurav Sir was a big part of my journey. The mock interviews, clear tips, and honest feedback made GDPI prep so much easier. By the final day, I wasn't nervous — I was ready.</blockquote>
        <figcaption>
          <span class="who-name">Yash Jain</span>
          <span class="who-role">IIM Shillong convert</span>
        </figcaption>
      </figure>
    </div>

    <div class="treel-controls">
      <span class="treel-hint">Drag · swipe · scroll</span>
      <div class="treel-btns">
        <button class="treel-btn treel-prev" aria-label="Previous"><span class="ar"></span></button>
        <button class="treel-btn treel-next" aria-label="Next"><span class="ar"></span></button>
      </div>
    </div>
  </div>
</section>

<!-- ===== Lead CTA ===== -->
<section class="lead-cta" id="contact">
  <div class="lead-cta-inner">
    <div class="gold-rule center reveal"><span class="line"></span><span class="bead"></span><span class="line"></span></div>
    <div class="eyebrow reveal" style="margin-top:22px">A Quiet Beginning</div>
    <h2 class="reveal" style="--d:120ms">Book a <em>clarity call</em>.<br />Decide nothing. Discover something.</h2>
    <p class="reveal" style="--d:240ms">A 30-minute conversation. No pitch. We listen, we ask the right questions, and we tell you honestly whether SELF is a fit — or what is.</p>

    <div class="btn-row reveal" style="--d:360ms">
      <button class="btn btn--solid hoverable" data-open-lead data-title="Begin Your Clarity Call" data-label="Clarity Call · Free 30 min">
        Book a Clarity Call <span class="arrow"></span>
      </button>
    </div>

    <div class="clarity-row reveal" style="--d:480ms">
      <span class="dot"></span>
      <span class="ladder-line">Awareness <span class="arr"></span> Capability <span class="arr"></span> Leadership</span>
    </div>
  </div>
</section>

<script>
  // Preloader fade
  window.addEventListener('load', function() {
    setTimeout(function() {
      var pre = document.getElementById('preloader');
      if (pre) pre.classList.add('gone');
    }, 1700);
  });
</script>

<?php get_footer(); ?>
