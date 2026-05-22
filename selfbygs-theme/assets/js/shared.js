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
  const hasHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  document.querySelectorAll('.nav .has-menu').forEach((item) => {
    const trigger = item.querySelector('a');
    if (!trigger) return;
    // On hover-capable devices, CSS handles dropdown show on hover.
    // Let the link navigate normally on click. Only toggle for touch/keyboard.
    trigger.addEventListener('click', (e) => {
      // Allow click-through if the trigger has no dropdown
      if (!item.querySelector('.nav-dropdown')) return;
      // On desktop (hover device): if dropdown is not open, open it;
      // if already open, navigate (let default happen).
      if (hasHover) {
        if (item.classList.contains('is-open')) {
          // Second click → navigate; let default through
          item.classList.remove('is-open');
          return;
        }
        // First click → just show dropdown, prevent nav
        e.preventDefault();
        item.classList.add('is-open');
        document.querySelectorAll('.nav .has-menu.is-open').forEach((other) => {
          if (other !== item) other.classList.remove('is-open');
        });
        return;
      }
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
  const errBox = modal.querySelector('#lead-form-error');
  let idx = 0;
  let currentFormType = 'main';

  function applyFormType(type) {
    currentFormType = type || 'main';
    modal.dataset.formType = currentFormType;
    modal.querySelectorAll('.chip[data-forms]').forEach((chip) => {
      const allowed = (chip.dataset.forms || 'main').split(',');
      chip.style.display = allowed.includes(currentFormType) ? '' : 'none';
      chip.classList.remove('is-active');
    });
  }

  function show(i) {
    idx = i;
    steps.forEach((s, n) => s.classList.toggle('is-active', n === i));
    pills.forEach((p, n) => {
      p.classList.toggle('is-active', n === i);
      p.classList.toggle('is-done', n < i);
    });
    if (errBox) errBox.style.display = 'none';
  }

  function open(ctx) {
    document.body.style.overflow = 'hidden';
    const formType = ctx && ctx.form ? ctx.form : 'main';
    applyFormType(formType);
    if (ctx) {
      const aside = modal.querySelector('.lead-modal-title');
      const eyebrow = modal.querySelector('.lead-modal-label');
      if (ctx.title && aside) aside.textContent = ctx.title;
      if (ctx.label && eyebrow) eyebrow.textContent = ctx.label;
    }
    // Reset all fields
    modal.querySelectorAll('input, textarea').forEach((f) => (f.value = ''));
    modal.querySelectorAll('select').forEach((s) => (s.selectedIndex = 0));
    modal.classList.add('is-open');
    show(0);
    successPane.style.display = 'none';
    stepWrap.style.display = 'block';
    if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Request the Call '; const span = document.createElement('span'); span.className = 'arrow'; submitBtn.appendChild(span); }
  }

  function close() {
    modal.classList.remove('is-open');
    document.body.style.overflow = '';
  }

  openers.forEach((b) => b.addEventListener('click', (e) => {
    e.preventDefault();
    open({ title: b.dataset.title, label: b.dataset.label, form: b.dataset.form || 'main' });
  }));
  if (closeBtn) closeBtn.addEventListener('click', close);
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

  function collectFormData() {
    const data = { form_id: currentFormType };
    // Step 1 chips (who)
    const whoChips = [];
    steps[0] && steps[0].querySelectorAll('.chip.is-active').forEach((c) => whoChips.push(c.textContent.trim()));
    data.who = whoChips[0] || '';
    // Step 2 chips (programs)
    const progChips = [];
    steps[1] && steps[1].querySelectorAll('.chip.is-active').forEach((c) => progChips.push(c.textContent.trim()));
    data.programs = progChips;
    // Step 3 fields
    const nameEl  = modal.querySelector('[name="lead_name"]');
    const emailEl = modal.querySelector('[name="lead_email"]');
    const phoneEl = modal.querySelector('[name="lead_phone"]');
    const orgEl   = modal.querySelector('[name="lead_org"]');
    data.lead_name  = nameEl  ? nameEl.value.trim()  : '';
    data.lead_email = emailEl ? emailEl.value.trim() : '';
    data.lead_phone = phoneEl ? phoneEl.value.trim() : '';
    data.lead_org   = orgEl   ? orgEl.value.trim()   : '';
    // Step 4 fields
    const ctxEl  = modal.querySelector('[name="lead_context"]');
    const timeEl = modal.querySelector('[name="lead_time"]');
    data.lead_context = ctxEl  ? ctxEl.value.trim()  : '';
    data.lead_time    = timeEl ? timeEl.value        : '';
    data.source_page  = (typeof selfbygsData !== 'undefined') ? (selfbygsData.sourcePage || '') : '';
    return data;
  }

  if (submitBtn) {
    submitBtn.addEventListener('click', () => {
      const payload = collectFormData();
      // Validate email or phone
      if (!payload.lead_email && !payload.lead_phone) {
        if (errBox) { errBox.textContent = 'Please provide your email or phone number.'; errBox.style.display = 'block'; }
        return;
      }
      submitBtn.disabled = true;
      submitBtn.textContent = 'Sending…';
      const restUrl = (typeof selfbygsData !== 'undefined') ? selfbygsData.restUrl : '/wp-json/selfbygs/v1/submit';
      const nonce   = (typeof selfbygsData !== 'undefined') ? selfbygsData.nonce : '';
      fetch(restUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': nonce },
        body: JSON.stringify(payload),
      })
        .then((r) => r.json())
        .then((res) => {
          if (res.success) {
            stepWrap.style.display = 'none';
            successPane.style.display = 'block';
          } else {
            if (errBox) { errBox.textContent = res.message || 'Something went wrong. Please try again.'; errBox.style.display = 'block'; }
            submitBtn.disabled = false;
            submitBtn.textContent = 'Request the Call ';
            const span = document.createElement('span'); span.className = 'arrow'; submitBtn.appendChild(span);
          }
        })
        .catch(() => {
          if (errBox) { errBox.textContent = 'Network error. Please check your connection and try again.'; errBox.style.display = 'block'; }
          submitBtn.disabled = false;
          submitBtn.textContent = 'Request the Call ';
        });
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
      const prev  = wrap.querySelector(sel.prev);
      const next  = wrap.querySelector(sel.next);
      if (!track) return;

      // Step size = one card + gap
      const stepBy = () => {
        const child = track.firstElementChild;
        if (!child) return 320;
        const gap = parseFloat(getComputedStyle(track).columnGap || '24');
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

      // ── Momentum drag-to-scroll ──────────────────────────────────────────
      let isDragging = false, startX = 0, startScroll = 0;
      let lastX = 0, lastTime = 0, velX = 0, rafId = null, didDrag = false;

      const cancelMomentum = () => { if (rafId) { cancelAnimationFrame(rafId); rafId = null; } };

      const applyMomentum = () => {
        velX *= 0.90;
        if (Math.abs(velX) < 0.4) { cancelMomentum(); return; }
        track.scrollLeft += velX;
        rafId = requestAnimationFrame(applyMomentum);
      };

      track.style.cursor = 'grab';
      track.style.userSelect = 'none';

      track.addEventListener('mousedown', (e) => {
        if (e.button !== 0) return;
        cancelMomentum();
        isDragging = true; didDrag = false;
        startX = e.clientX; startScroll = track.scrollLeft;
        lastX = e.clientX; lastTime = performance.now(); velX = 0;
        track.style.cursor = 'grabbing';
        e.preventDefault();
      });

      window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        const dx = e.clientX - startX;
        if (Math.abs(dx) > 5) didDrag = true;
        const now = performance.now();
        const dt  = Math.max(now - lastTime, 1);
        velX = (e.clientX - lastX) / dt * 14;   // positive = scroll left
        lastX = e.clientX; lastTime = now;
        track.scrollLeft = startScroll - dx;
      }, { passive: true });

      window.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;
        track.style.cursor = 'grab';
        if (Math.abs(velX) > 1) rafId = requestAnimationFrame(applyMomentum);
      });

      // Suppress click after drag
      track.addEventListener('click', (e) => {
        if (didDrag) { e.stopPropagation(); e.preventDefault(); didDrag = false; }
      }, true);

      // Touch with momentum
      let tStartX = 0, tStartScroll = 0;
      track.addEventListener('touchstart', (e) => {
        cancelMomentum();
        tStartX = e.touches[0].clientX; tStartScroll = track.scrollLeft;
        lastX = tStartX; lastTime = performance.now(); velX = 0;
      }, { passive: true });
      track.addEventListener('touchmove', (e) => {
        const cx = e.touches[0].clientX;
        const now = performance.now(); const dt = Math.max(now - lastTime, 1);
        velX = (lastX - cx) / dt * 14;
        lastX = cx; lastTime = now;
        track.scrollLeft = tStartScroll - (cx - tStartX);
      }, { passive: true });
      track.addEventListener('touchend', () => {
        if (Math.abs(velX) > 1) rafId = requestAnimationFrame(applyMomentum);
      }, { passive: true });
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

// ── Vreel video cards — play / pause / mute with smooth state ──────────────
(function initVreelCards() {

  // SVG icons
  const ICONS = {
    play:   '<svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>',
    pause:  '<svg viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>',
    sound:  '<svg viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>',
    muted:  '<svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.796 8.796 0 0 0 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3 3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.99 8.99 0 0 0 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4 9.91 6.09 12 8.18V4z"/></svg>',
  };

  document.querySelectorAll('.vreel-card[data-video]').forEach((card) => {
    const media      = card.querySelector('.vreel-media');
    const cover      = card.querySelector('.vreel-cover');
    const playWrap   = card.querySelector('.vreel-play');
    const playBtn    = card.querySelector('.vreel-play-btn');
    const tapOverlay = card.querySelector('.vreel-tap-overlay');
    const muteBtn    = card.querySelector('.vreel-mute');
    if (!media || !playBtn) return;

    const url = (card.dataset.video || '').trim();
    let vid = null;   // the <video> element, null until first play

    // ── helpers ──────────────────────────────────────────────────────────────
    const setPlayIcon  = (playing) => {
      playBtn.innerHTML = playing ? ICONS.pause : ICONS.play;
      playBtn.setAttribute('aria-label', playing ? 'Pause' : 'Play');
    };

    const setMuteIcon  = (muted) => {
      muteBtn.innerHTML = muted ? ICONS.muted : ICONS.sound;
      muteBtn.setAttribute('aria-label', muted ? 'Unmute' : 'Mute');
      card.classList.toggle('is-muted', muted);
    };

    const markPlaying  = (yes) => {
      card.classList.toggle('is-playing', yes);
      setPlayIcon(yes);
    };

    // ── load video on first play ──────────────────────────────────────────
    const loadAndPlay = () => {
      if (vid) return;                // already created
      if (!url) return;

      vid = document.createElement('video');
      vid.src         = url;
      vid.playsInline = true;
      vid.preload     = 'auto';
      vid.muted       = false;
      vid.style.cssText =
        'position:absolute;inset:0;width:100%;height:100%;' +
        'object-fit:cover;z-index:5;background:#000;';
      media.appendChild(vid);

      // Fade cover out smoothly
      if (cover) {
        cover.style.transition = 'opacity 0.5s ease';
        cover.style.opacity    = '0';
        cover.style.zIndex     = '0';
      }

      vid.addEventListener('playing', () => markPlaying(true));
      vid.addEventListener('pause',   () => markPlaying(false));
      vid.addEventListener('ended',   () => {
        markPlaying(false);
        // Replay from start on end
        vid.currentTime = 0;
      });

      // If autoplay is blocked by browser policy, try muted first
      vid.play().catch(() => {
        vid.muted = true;
        setMuteIcon(true);
        vid.play().catch(() => {});
      });

      markPlaying(true);
      setMuteIcon(vid.muted);
    };

    // ── toggle play / pause ──────────────────────────────────────────────
    const togglePlay = (e) => {
      e.stopPropagation();
      if (!vid) { loadAndPlay(); return; }
      if (vid.paused) {
        vid.play().catch(() => {});
      } else {
        vid.pause();
      }
    };

    // ── toggle mute ──────────────────────────────────────────────────────
    const toggleMute = (e) => {
      e.stopPropagation();
      if (!vid) { loadAndPlay(); return; }
      vid.muted = !vid.muted;
      setMuteIcon(vid.muted);
    };

    // ── event wiring ─────────────────────────────────────────────────────
    // Play button click
    playBtn.addEventListener('click', togglePlay);

    // Tap overlay (covers video while playing) → pause
    if (tapOverlay) {
      tapOverlay.addEventListener('click', (e) => {
        e.stopPropagation();
        if (vid && !vid.paused) vid.pause();
      });
    }

    // Mute button
    muteBtn.addEventListener('click', toggleMute);

    // Prevent card drag from triggering play (check didDrag flag set by initReels)
    media.addEventListener('click', (e) => {
      // if the click was already handled by playBtn or muteBtn, skip
      if (e.target === playBtn || playBtn.contains(e.target)) return;
      if (e.target === muteBtn || muteBtn.contains(e.target)) return;
      if (e.target === tapOverlay) return;
      // Only trigger on the cover / pre-play media area
      if (!vid) loadAndPlay();
    });
  });
})();
