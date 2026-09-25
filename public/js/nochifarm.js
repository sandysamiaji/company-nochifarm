/**
 * NOCHI FARM - Interactive Web Engine
 * Features:
 * - Direct unmuted autoplay on page load (desktop & mobile)
 * - Zero control buttons: completely uninterrupted, clean full-screen experience
 * - Automatic passive gesture audio unlock on mobile (first touch/scroll immediately unmutes)
 * - Anti-pause guard (touching screen never pauses the video)
 * - Responsive portrait (Story_Wa.mp4) / landscape (nochifarm_full.mp4) switching
 * - Smooth swipe/scroll unlock to profile content
 * - Documentation video modal popup
 * - Sticky navbar & mobile navigation drawer
 */

document.addEventListener('DOMContentLoaded', () => {
  const heroSection = document.getElementById('hero-video-section');
  const heroVideo = document.getElementById('hero-video');
  const heroIntroText = document.getElementById('hero-intro-text');
  const body = document.body;
  const swipeSlider = document.getElementById('hero-swipe-slider');
  const brandWatermark = document.getElementById('video-brand-watermark');
  
  // Video Modal Elements
  const videoModal = document.getElementById('video-modal-backdrop');
  const modalCloseBtn = document.getElementById('modal-close-btn');
  const modalVideoPlayer = document.getElementById('modal-video-player');
  const modalVideoTitle = document.getElementById('modal-video-title');
  const videoCards = document.querySelectorAll('.video-item-card');

  let isUnlocked = false;

  // ==========================================================================
  // 1. DIRECT AUDIO & AUTOPLAY ENGINE (ZERO BUTTONS REQUIRED)
  // ==========================================================================

  // Instant unmuting helper - seamlessly sets full volume
  function unmuteDirectly() {
    if (!heroVideo) return;
    heroVideo.muted = false;
    heroVideo.volume = 1.0;
    heroVideo.defaultMuted = false;
    if (heroVideo.paused) {
      heroVideo.play().catch(() => {});
    }
  }

  // Any user touch, swipe, scroll, or click anywhere on the page instantly activates audio
  const passiveGestureEvents = [
    'touchstart', 'touchend', 'touchmove',
    'pointerdown', 'pointerup',
    'click', 'mousedown', 'mouseup',
    'scroll', 'wheel', 'keydown'
  ];

  passiveGestureEvents.forEach(evt => {
    window.addEventListener(evt, unmuteDirectly, { capture: true, passive: true });
    document.addEventListener(evt, unmuteDirectly, { capture: true, passive: true });
  });

  // 1. Initial State: Hero locked in full viewport
  if (heroSection) {
    heroSection.classList.add('viewport-lock');
    body.classList.add('hero-locked');

    // Tapping on hero area immediately activates audio without pausing
    heroSection.addEventListener('pointerdown', unmuteDirectly, { passive: true });
    heroSection.addEventListener('click', unmuteDirectly, { passive: true });
  }

  // 2. Responsive Portrait/Landscape Video Switcher & Direct Unmuted Autoplay
  if (heroVideo) {
    const syncResponsiveVideoSource = () => {
      const isMobilePortrait = window.matchMedia('(max-width: 768px), (orientation: portrait)').matches;
      const desktopSrc = heroVideo.dataset.desktopSrc || 'videos/nochifarm_full.mp4';
      const mobileSrc = heroVideo.dataset.mobileSrc || 'videos/Story_Wa.mp4';
      const targetSrc = isMobilePortrait ? mobileSrc : desktopSrc;

      const currentSrc = heroVideo.currentSrc || heroVideo.src || '';
      const shouldSwitch = isMobilePortrait 
        ? !currentSrc.includes('Story_Wa') 
        : (!currentSrc.includes('nochifarm_full') && currentSrc.includes('Story_Wa'));

      if (shouldSwitch) {
        const wasMuted = heroVideo.muted;
        heroVideo.src = targetSrc;
        heroVideo.load();
        heroVideo.muted = wasMuted;
        heroVideo.play().catch(() => {});
      }
    };

    syncResponsiveVideoSource();
    window.addEventListener('resize', syncResponsiveVideoSource, { passive: true });
    window.addEventListener('orientationchange', syncResponsiveVideoSource, { passive: true });

    const hideIntroText = () => {
      if (heroIntroText) {
        heroIntroText.classList.add('video-playing-hidden');
      }
    };

    // Direct playback initiation: always request unmuted audio
    const startHeroPlayback = () => {
      syncResponsiveVideoSource();
      heroVideo.muted = false;
      heroVideo.volume = 1.0;
      heroVideo.defaultMuted = false;

      const playPromise = heroVideo.play();
      if (playPromise !== undefined) {
        playPromise.then(() => {
          // Unmuted playback started directly
          heroVideo.muted = false;
        }).catch(() => {
          // If browser policy blocks initial sound prior to user gesture on the page,
          // play muted so video moves smoothly, and unmute on first gesture!
          heroVideo.muted = true;
          heroVideo.play().catch(() => {});
        });
      }
    };

    startHeroPlayback();
    heroVideo.addEventListener('loadeddata', startHeroPlayback, { once: true });
    heroVideo.addEventListener('canplay', startHeroPlayback, { once: true });
    window.addEventListener('load', startHeroPlayback, { once: true });
    window.addEventListener('pageshow', startHeroPlayback);

    // Intro text fades out automatically so video is completely clear
    setTimeout(() => {
      hideIntroText();
      startHeroPlayback();
    }, 1500);

    heroVideo.addEventListener('playing', () => {
      setTimeout(hideIntroText, 400);
    });

    // Anti-pause guard: ensure video NEVER stops or pauses when the user touches the screen
    heroVideo.addEventListener('pause', () => {
      if (!isUnlocked) {
        heroVideo.play().catch(() => {});
      }
    });

    // Also unmute if tab regains focus
    document.addEventListener('visibilitychange', () => {
      if (!document.hidden && heroVideo) {
        unmuteDirectly();
      }
    });
  }

  // ==========================================================================
  // 3. UNLOCK SLIDER & GESTURE NAVIGATION
  // ==========================================================================
  function unlockHero(targetId = 'tentang-nochi') {
    if (isUnlocked) return;
    isUnlocked = true;

    // Ensure audio is fully on when entering profile
    unmuteDirectly();

    // Hide top-left brand watermark when user unlocks
    if (brandWatermark) {
      brandWatermark.classList.add('watermark-hidden');
    }

    if (heroSection) {
      heroSection.classList.remove('viewport-lock');
    }
    body.classList.remove('hero-locked');

    // Smooth scroll to target
    setTimeout(() => {
      const target = document.getElementById(targetId);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }, 120);
  }

  // Click watermark to unlock
  if (brandWatermark) {
    const handleWatermarkAction = (e) => {
      e.preventDefault();
      unmuteDirectly();
      unlockHero('tentang-nochi');
    };
    brandWatermark.addEventListener('click', handleWatermarkAction);
    brandWatermark.addEventListener('touchend', handleWatermarkAction);
  }

  // Click / touch swipe slider to unlock
  let lastSliderActionTime = 0;
  if (swipeSlider) {
    const handleSliderAction = (e) => {
      const now = Date.now();
      if (now - lastSliderActionTime < 350) return;
      lastSliderActionTime = now;
      unmuteDirectly();
      unlockHero('tentang-nochi');
    };
    swipeSlider.addEventListener('click', handleSliderAction);
    swipeSlider.addEventListener('touchend', handleSliderAction);
  }

  // Mouse wheel scroll to unlock
  let wheelDelta = 0;
  window.addEventListener('wheel', (e) => {
    if (isUnlocked) return;
    wheelDelta += e.deltaY;
    if (wheelDelta > 25) {
      unlockHero('tentang-nochi');
      wheelDelta = 0;
    }
  }, { passive: true });

  // Touch swipe to unlock
  let touchStartY = 0;
  window.addEventListener('touchstart', (e) => {
    if (isUnlocked) return;
    touchStartY = e.touches[0].clientY;
  }, { passive: true });

  window.addEventListener('touchmove', (e) => {
    if (isUnlocked) return;
    const currentY = e.touches[0].clientY;
    if (touchStartY - currentY > 35) {
      unlockHero('tentang-nochi');
    }
  }, { passive: true });

  // ==========================================================================
  // 4. VIDEO DOKUMENTASI MODAL POPUP
  // ==========================================================================
  videoCards.forEach(card => {
    card.addEventListener('click', () => {
      const title = card.getAttribute('data-title') || 'Video Dokumentasi';
      const videoSrc = card.getAttribute('data-video') || 'videos/nochifarm_full.mov';

      if (modalVideoTitle) modalVideoTitle.innerText = title;
      if (modalVideoPlayer) {
        modalVideoPlayer.src = videoSrc;
        modalVideoPlayer.play();
      }
      if (videoModal) videoModal.classList.add('open');
    });
  });

  if (modalCloseBtn && videoModal) {
    modalCloseBtn.addEventListener('click', () => {
      videoModal.classList.remove('open');
      if (modalVideoPlayer) modalVideoPlayer.pause();
    });

    videoModal.addEventListener('click', (e) => {
      if (e.target === videoModal) {
        videoModal.classList.remove('open');
        if (modalVideoPlayer) modalVideoPlayer.pause();
      }
    });
  }

  // ==========================================================================
  // 5. STICKY NAVBAR & MOBILE NAVIGATION DRAWER
  // ==========================================================================
  window.addEventListener('scroll', () => {
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
      if (window.scrollY > 40) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }
  }, { passive: true });

  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const mobileNavDrawer = document.getElementById('mobile-nav-drawer');
  const mobileNavClose = document.getElementById('mobile-nav-close');
  const mobileNavOverlay = document.getElementById('mobile-nav-overlay');
  const drawerLinks = document.querySelectorAll('.drawer-link');

  function openMobileDrawer() {
    if (mobileNavDrawer) mobileNavDrawer.classList.add('open');
    if (mobileNavOverlay) mobileNavOverlay.classList.add('open');
  }

  function closeMobileDrawer() {
    if (mobileNavDrawer) mobileNavDrawer.classList.remove('open');
    if (mobileNavOverlay) mobileNavOverlay.classList.remove('open');
  }

  if (mobileMenuToggle) mobileMenuToggle.addEventListener('click', openMobileDrawer);
  if (mobileNavClose) mobileNavClose.addEventListener('click', closeMobileDrawer);
  if (mobileNavOverlay) mobileNavOverlay.addEventListener('click', closeMobileDrawer);

  drawerLinks.forEach(link => {
    link.addEventListener('click', () => {
      const href = link.getAttribute('href');
      closeMobileDrawer();
      if (href && href.startsWith('#')) {
        if (!isUnlocked) {
          unlockHero(href.substring(1) || 'tentang-nochi');
        }
      }
    });
  });
});
