/* ============================================================
   SELF by GS — shared interactions
   Custom cursor, scroll reveals, header state, lead form modal
   ============================================================ */

// ---------- Cursor accent (gold ring only on opt-in surfaces) ----------
// Native OS cursor stays visible everywhere; the ring is a premium
// accent that fades in over hoverable surfaces only.
(function initCursor() {
  if (matchMedia('(pointer: coarse)').matches) return;
  const ring = document.createElement('div');
  ring.className = 'cursor-ring';
  document.body.appendChild(ring);

  // Surfaces that get the accent ring
  const HOVER_SEL = '.hoverable, [data-cursor="hover"], .journey, .program-card, .voice, .approach-step, .dx-step, .pillar, .arch-card';
  // Larger ring on primary CTAs
  const CTA_SEL = '.btn, .nav-cta';

  let mx = -100, my = -100;
  let rx = mx, ry = my;
  document.addEventListener('mousemove', (e) => {
    mx = e.clientX; my = e.clientY;
  });

  function tick() {
    rx += (mx - rx) * 0.22;
    ry += (my - ry) * 0.22;
    ring.style.transform = `translate(${rx}px, ${ry}px) translate(-50%, -50%) scale(${ring.classList.contains('is-visible') ? 1 : 0.6})`;
    requestAnimationFrame(tick);
  }
  tick();

  document.addEventListener('mouseover', (e) => {
    const t = e.target;
    if (!t || !t.closest) return;
    const onHover = !!t.closest(HOVER_SEL);
    const onCta = !!t.closest(CTA_SEL);
    ring.classList.toggle('is-visible', onHover || onCta);
    ring.classList.toggle('is-cta', onCta);
  });
  document.addEventListener('mouseleave', () => ring.classList.remove('is-visible'));
})();

// ---------- Header scroll state ----------
(function initHeader() {
  const header = document.querySelector('.site-header');
  if (!header) return;
  const onScroll = () => {
    header.classList.toggle('is-scrolled', window.scrollY > 40);
  };
  document.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})();

// ---------- Nav dropdown click-to-toggle (mobile + accessibility) ----------
(function initNavDropdown() {
  document.querySelectorAll('.nav .has-menu').forEach((item) => {
    const trigger = item.querySelector('a');
    if (!trigger) return;
    // On hover-capable devices CSS handles it; intercept click for keyboard/touch.
    trigger.addEventListener('click', (e) => {
      // Allow click-through if the trigger has no dropdown
      if (!item.querySelector('.nav-dropdown')) return;
      e.preventDefault();
      const open = item.classList.toggle('is-open');
      document.querySelectorAll('.nav .has-menu.is-open').forEach((other) => {
        if (other !== item) other.classList.remove('is-open');
      });
    });
  });
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.nav .has-menu')) {
      document.querySelectorAll('.nav .has-menu.is-open').forEach((i) => i.classList.remove('is-open'));
    }
  });
})();

// ---------- Mobile drawer ----------
(function initMobileDrawer() {
  const toggle = document.querySelector('.mobile-toggle');
  const drawer = document.querySelector('.mobile-drawer');
  if (!toggle || !drawer) return;
  const open = () => { toggle.classList.add('is-open'); drawer.classList.add('is-open'); document.body.style.overflow = 'hidden'; };
  const close = () => { toggle.classList.remove('is-open'); drawer.classList.remove('is-open'); document.body.style.overflow = ''; };
  toggle.addEventListener('click', () => {
    if (drawer.classList.contains('is-open')) close(); else open();
  });
  // Close on link click
  drawer.querySelectorAll('a').forEach((a) => {
    a.addEventListener('click', (e) => {
      // Don't close on details summary
      if (a.closest('details summary')) return;
      close();
    });
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer.classList.contains('is-open')) close();
  });
})();

// ---------- Reveal on scroll ----------
(function initReveal() {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        e.target.classList.add('in');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });
  document.querySelectorAll('.reveal, .reveal-mask').forEach((el) => io.observe(el));
})();

// ---------- Magnetic buttons / 3D card tilt ----------
(function initTilt() {
  document.querySelectorAll('[data-tilt]').forEach((card) => {
    const max = parseFloat(card.dataset.tilt) || 6;
    card.style.transformStyle = 'preserve-3d';
    card.style.transition = 'transform 0.4s var(--ease-out)';
    card.addEventListener('mousemove', (e) => {
      const r = card.getBoundingClientRect();
      const x = (e.clientX - r.left) / r.width - 0.5;
      const y = (e.clientY - r.top) / r.height - 0.5;
      card.style.transform = `perspective(900px) rotateY(${x * max}deg) rotateX(${-y * max}deg) translateZ(0)`;
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'perspective(900px) rotateY(0) rotateX(0)';
    });
  });
})();

// ---------- Parallax scroll ----------
(function initParallax() {
  const els = document.querySelectorAll('[data-parallax]');
  if (!els.length) return;
  function update() {
    const sy = window.scrollY;
    els.forEach((el) => {
      const speed = parseFloat(el.dataset.parallax) || 0.2;
      const r = el.getBoundingClientRect();
      const off = (r.top + sy - window.innerHeight / 2) * -speed;
      el.style.transform = `translate3d(0, ${off}px, 0)`;
    });
    requestAnimationFrame(update);
  }
  update();
})();

// ---------- Lead form modal ----------
(function initLeadForm() {
  const modal = document.getElementById('lead-modal');
  if (!modal) return;
  const openers = document.querySelectorAll('[data-open-lead]');
  const closeBtn = modal.querySelector('.lead-close');
  const overlay = modal;
  const steps = modal.querySelectorAll('.lead-step');
  const pills = modal.querySelectorAll('.lead-step-pill');
  const nextBtns = modal.querySelectorAll('[data-next]');
  const backBtns = modal.querySelectorAll('[data-back]');
  const submitBtn = modal.querySelector('[data-submit]');
  const successPane = modal.querySelector('.lead-success');
  const stepWrap = modal.querySelector('.lead-step-wrap');
  let idx = 0;

  function show(i) {
    idx = i;
    steps.forEach((s, n) => s.classList.toggle('is-active', n === i));
    pills.forEach((p, n) => {
      p.classList.toggle('is-active', n === i);
      p.classList.toggle('is-done', n < i);
    });
  }
  function open(ctx) {
    document.body.style.overflow = 'hidden';
    if (ctx) {
      const aside = modal.querySelector('.lead-aside h3');
      const eyebrow = modal.querySelector('.lead-aside .meta-row span:last-child');
      if (ctx.title && aside) aside.textContent = ctx.title;
      if (ctx.label && eyebrow) eyebrow.textContent = ctx.label;
    }
    modal.classList.add('is-open');
    show(0);
    successPane.style.display = 'none';
    stepWrap.style.display = 'block';
  }
  function close() {
    modal.classList.remove('is-open');
    document.body.style.overflow = '';
  }
  openers.forEach((b) => b.addEventListener('click', (e) => {
    e.preventDefault();
    const ctx = {
      title: b.dataset.title,
      label: b.dataset.label,
    };
    open(ctx);
  }));
  closeBtn.addEventListener('click', close);
  overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });

  nextBtns.forEach((b) => b.addEventListener('click', () => {
    if (idx < steps.length - 1) show(idx + 1);
  }));
  backBtns.forEach((b) => b.addEventListener('click', () => {
    if (idx > 0) show(idx - 1);
  }));

  // Chip groups (single + multi)
  modal.querySelectorAll('.chip-row').forEach((row) => {
    const multi = row.dataset.multi === 'true';
    row.querySelectorAll('.chip').forEach((c) => {
      c.addEventListener('click', () => {
        if (!multi) row.querySelectorAll('.chip').forEach((x) => x.classList.remove('is-active'));
        c.classList.toggle('is-active');
      });
    });
  });

  if (submitBtn) {
    submitBtn.addEventListener('click', () => {
      stepWrap.style.display = 'none';
      successPane.style.display = 'block';
    });
  }
})();

// ---------- Reels (horizontal card scroll with prev/next) ----------
(function initReels() {
  const reels = [
    { wrap: '[data-vreel]',  track: '[data-vreel-track]',  prev: '.vreel-prev',  next: '.vreel-next'  },
    { wrap: '[data-treel]',  track: '[data-treel-track]',  prev: '.treel-prev',  next: '.treel-next'  },
  ];
  reels.forEach((sel) => {
    document.querySelectorAll(sel.wrap).forEach((wrap) => {
      const track = wrap.querySelector(sel.track);
      const prev = wrap.querySelector(sel.prev);
      const next = wrap.querySelector(sel.next);
      if (!track) return;

      const stepBy = () => {
        const child = track.firstElementChild;
        if (!child) return 320;
        const style = getComputedStyle(track);
        const gap = parseFloat(style.columnGap || style.gap || '24');
        return child.getBoundingClientRect().width + gap;
      };

      const updateState = () => {
        const max = track.scrollWidth - track.clientWidth - 2;
        if (prev) prev.classList.toggle('is-disabled', track.scrollLeft <= 1);
        if (next) next.classList.toggle('is-disabled', track.scrollLeft >= max);
      };

      if (prev) prev.addEventListener('click', () => track.scrollBy({ left: -stepBy(), behavior: 'smooth' }));
      if (next) next.addEventListener('click', () => track.scrollBy({ left:  stepBy(), behavior: 'smooth' }));
      track.addEventListener('scroll', () => requestAnimationFrame(updateState), { passive: true });
      window.addEventListener('resize', updateState);
      updateState();

      // Drag-to-scroll (desktop)
      let down = false, sx = 0, sl = 0;
      track.addEventListener('mousedown', (e) => {
        if (e.target.closest('a, button')) return;
        down = true; sx = e.pageX; sl = track.scrollLeft;
        track.style.cursor = 'grabbing';
      });
      document.addEventListener('mousemove', (e) => {
        if (!down) return;
        e.preventDefault();
        track.scrollLeft = sl - (e.pageX - sx);
      });
      document.addEventListener('mouseup', () => { down = false; track.style.cursor = ''; });
    });
  });
})();

// ---------- Carousels (prev/next + state) ----------
(function initCarousels() {
  document.querySelectorAll('[data-carousel]').forEach((wrap) => {
    const track = wrap.querySelector('[data-carousel-track]');
    const prev = wrap.querySelector('.carousel-prev');
    const next = wrap.querySelector('.carousel-next');
    if (!track) return;

    const scrollAmount = () => {
      const child = track.firstElementChild;
      if (!child) return 320;
      const style = getComputedStyle(track);
      const gap = parseFloat(style.columnGap || style.gap || '24');
      return child.getBoundingClientRect().width + gap;
    };

    const updateState = () => {
      const max = track.scrollWidth - track.clientWidth - 2;
      if (prev) prev.classList.toggle('is-disabled', track.scrollLeft <= 1);
      if (next) next.classList.toggle('is-disabled', track.scrollLeft >= max);
    };

    if (prev) prev.addEventListener('click', () => {
      track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
    });
    if (next) next.addEventListener('click', () => {
      track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
    });

    track.addEventListener('scroll', () => requestAnimationFrame(updateState), { passive: true });
    window.addEventListener('resize', updateState);
    updateState();

    // Drag-to-scroll on desktop
    let isDown = false, startX = 0, startScroll = 0;
    track.addEventListener('mousedown', (e) => {
      // Don't hijack clicks on links/buttons within cards
      if (e.target.closest('a, button')) return;
      isDown = true;
      track.style.cursor = 'grabbing';
      startX = e.pageX;
      startScroll = track.scrollLeft;
    });
    document.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      track.scrollLeft = startScroll - (e.pageX - startX);
    });
    document.addEventListener('mouseup', () => { isDown = false; track.style.cursor = ''; });
  });
})();

// ---------- Marquee duplicate (for seamless loops) ----------
(function initMarquee() {
  document.querySelectorAll('[data-marquee]').forEach((m) => {
    const inner = m.querySelector('.marquee-inner');
    if (!inner) return;
    inner.innerHTML += inner.innerHTML;
  });
  document.querySelectorAll('[data-marquee-track]').forEach((track) => {
    track.innerHTML += track.innerHTML;
  });
  document.querySelectorAll('[data-moments-track]').forEach((track) => {
    track.innerHTML += track.innerHTML;
  });
})();

// ---------- Video testimonial cards (click to load) ----------
(function initVidCards() {
  document.querySelectorAll('.vid-card[data-video]').forEach((card) => {
    card.addEventListener('click', () => {
      const url = card.dataset.video;
      if (!url) return; // placeholder card — do nothing
      const thumb = card.querySelector('.vid-thumb');
      if (!thumb || thumb.querySelector('iframe')) return;
      // Detect YouTube vs Vimeo and build embed
      let embed = url;
      const ytMatch = url.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|watch\?v=|shorts\/))([\w-]{6,})/);
      if (ytMatch) {
        embed = `https://www.youtube-nocookie.com/embed/${ytMatch[1]}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
      }
      const iframe = document.createElement('iframe');
      iframe.src = embed;
      iframe.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture; fullscreen');
      iframe.setAttribute('allowfullscreen', '');
      iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:0;z-index:5;';
      thumb.appendChild(iframe);
    });
  });
})();
