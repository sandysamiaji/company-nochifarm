/**
 * NOCHI FARM - Interactive Engine (Exact Mockup Behavior)
 * Handles: Fullscreen Locked Video Hero, 3s Autoplay with Intro Text,
 * Swipe/Scroll Unlock, Video Controls, Documentation Modal Popup, & WhatsApp Links.
 */

document.addEventListener('DOMContentLoaded', () => {
  const heroSection = document.getElementById('hero-video-section');
  const heroVideo = document.getElementById('hero-video');
  const heroIntroText = document.getElementById('hero-intro-text');
  const body = document.body;
  const swipeSlider = document.getElementById('hero-swipe-slider');
  const videoMuteBtn = document.getElementById('video-mute-btn');
  const videoFullscreenBtn = document.getElementById('video-fullscreen-btn');
  
  // Video Modal Elements
  const videoModal = document.getElementById('video-modal-backdrop');
  const modalCloseBtn = document.getElementById('modal-close-btn');
  const modalVideoPlayer = document.getElementById('modal-video-player');
  const modalVideoTitle = document.getElementById('modal-video-title');
  const videoCards = document.querySelectorAll('.video-item-card');

  let isUnlocked = false;

  const audioPrompt = document.getElementById('audio-autoplay-prompt');

  // Helper to render volume button state
  function updateVolumeButtonUI(isMuted) {
    if (!videoMuteBtn) return;
    if (isMuted) {
      videoMuteBtn.classList.remove('is-unmuted');
      videoMuteBtn.setAttribute('title', 'Nyalakan Suara');
      videoMuteBtn.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
          <line x1="23" y1="9" x2="17" y2="15"></line>
          <line x1="17" y1="9" x2="23" y2="15"></line>
        </svg>
      `;
    } else {
      videoMuteBtn.classList.add('is-unmuted');
      videoMuteBtn.setAttribute('title', 'Matikan Suara');
      videoMuteBtn.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
          <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
        </svg>
      `;
    }
  }

  // Core helper to unmute and play video with sound on mobile & desktop
  function unmuteHeroAudio() {
    if (!heroVideo) return;
    try {
      heroVideo.muted = false;
      heroVideo.volume = 1.0;
      heroVideo.defaultMuted = false;
      const playPromise = heroVideo.play();
      if (playPromise !== undefined) {
        playPromise.then(() => {
          updateVolumeButtonUI(false);
          if (audioPrompt) audioPrompt.classList.add('hidden');
        }).catch(err => {
          console.warn('Playback notice:', err);
        });
      } else {
        updateVolumeButtonUI(false);
        if (audioPrompt) audioPrompt.classList.add('hidden');
      }
    } catch (err) {
      console.warn('Direct unmute error:', err);
    }
  }

  // Automatic touch audio unlock: any touch anywhere on mobile or desktop turns on audio instantly without pausing
  const handleUserGestureUnmute = (e) => {
    if (!heroVideo) return;
    // Don't trigger if user is interacting with navigation or modals
    if (e.target && e.target.closest && e.target.closest('#mobile-drawer, #mobile-nav-toggle, #video-modal-backdrop')) return;
    if (heroVideo.muted) {
      unmuteHeroAudio();
    }
  };

  ['touchstart', 'touchend', 'pointerdown', 'pointerup', 'click'].forEach(evt => {
    window.addEventListener(evt, handleUserGestureUnmute, { capture: true, passive: true });
    document.addEventListener(evt, handleUserGestureUnmute, { capture: true, passive: true });
  });

  // 1. Initial State: Hero locked in full viewport
  if (heroSection) {
    heroSection.classList.add('viewport-lock');
    body.classList.add('hero-locked');

    // Tapping on hero section turns on sound immediately and ensures video keeps playing
    heroSection.addEventListener('click', (e) => {
      if (e.target && e.target.closest && e.target.closest('button, a, #hero-swipe-slider, #mobile-nav-toggle')) return;
      if (heroVideo) {
        unmuteHeroAudio();
        heroVideo.play().catch(() => {});
      }
    });
  }

  // 2. Direct Autoplay Video with DIRECT AUDIO & Responsive Portrait/Landscape Switching
  if (heroVideo) {
    // Helper to ensure proper portrait (Story_Wa.mp4) vs landscape (nochifarm_full.mp4) video source
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

    // Attempt direct unmuted playback
    const startPlay = () => {
      syncResponsiveVideoSource();
      heroVideo.muted = false;
      heroVideo.volume = 1.0;
      heroVideo.defaultMuted = false;
      const p = heroVideo.play();

      if (p !== undefined) {
        p.then(() => {
          // Direct unmuted playback succeeded!
          updateVolumeButtonUI(false);
          if (audioPrompt) audioPrompt.classList.add('hidden');
        }).catch(err => {
          // If browser policy temporarily pauses until first user gesture:
          // Keep video rolling smoothly, it will unmute on the first touch!
          heroVideo.muted = true;
          heroVideo.play().catch(() => {});
          updateVolumeButtonUI(true);
        });
      }
    };

    startPlay();
    heroVideo.addEventListener('loadeddata', startPlay, { once: true });
    heroVideo.addEventListener('canplay', startPlay, { once: true });

    // Text disappears automatically, video plays directly
    setTimeout(() => {
      hideIntroText();
      startPlay();
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
  }

  // Audio prompt pill click/touch handler
  if (audioPrompt) {
    const handlePromptAction = (e) => {
      e.preventDefault();
      e.stopPropagation();
      unmuteHeroAudio();
    };
    audioPrompt.addEventListener('click', handlePromptAction);
    audioPrompt.addEventListener('touchend', handlePromptAction);
  }

  // 3. Unlock Function
  function unlockHero(targetId = 'tentang-nochi') {
    if (isUnlocked) return;
    isUnlocked = true;

    // Hide top-left brand watermark when user performs swipe/unlock action
    const brandWatermark = document.getElementById('video-brand-watermark');
    if (brandWatermark) {
      brandWatermark.classList.add('watermark-hidden');
    }

    // Also ensure audio is activated on unlock
    unmuteHeroAudio();

    if (heroSection) {
      heroSection.classList.remove('viewport-lock');
    }
    body.classList.remove('hero-locked');

    // Scroll to target
    setTimeout(() => {
      const target = document.getElementById(targetId);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }, 150);
  }

  // 4. Trigger unlock on Swipe Slider or Brand Watermark click
  const brandWatermark = document.getElementById('video-brand-watermark');
  if (brandWatermark) {
    const handleWatermarkAction = (e) => {
      e.preventDefault();
      unmuteHeroAudio();
      unlockHero('tentang-nochi');
    };
    brandWatermark.addEventListener('click', handleWatermarkAction);
    brandWatermark.addEventListener('touchend', handleWatermarkAction);
  }

  if (swipeSlider) {
    const handleSliderAction = (e) => {
      unmuteHeroAudio();
      unlockHero('tentang-nochi');
    };
    swipeSlider.addEventListener('click', handleSliderAction);
    swipeSlider.addEventListener('touchend', handleSliderAction);
  }

  // 5. Mouse wheel & touch gestures to unlock
  let wheelDelta = 0;
  window.addEventListener('wheel', (e) => {
    if (isUnlocked) return;
    wheelDelta += e.deltaY;
    if (wheelDelta > 25) {
      unlockHero('tentang-nochi');
      wheelDelta = 0;
    }
  }, { passive: true });

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

  // 6. Audio Mute / Unmute Button Click & Touch
  if (videoMuteBtn && heroVideo) {
    const handleMuteBtnAction = (e) => {
      e.preventDefault();
      e.stopPropagation();
      if (heroVideo.muted) {
        unmuteHeroAudio();
      } else {
        heroVideo.muted = true;
        updateVolumeButtonUI(true);
      }
    };
    videoMuteBtn.addEventListener('click', handleMuteBtnAction);
    videoMuteBtn.addEventListener('touchend', handleMuteBtnAction);
  }

  // 7. Fullscreen Toggle
  if (videoFullscreenBtn && heroSection) {
    videoFullscreenBtn.addEventListener('click', () => {
      if (!document.fullscreenElement) {
        if (heroSection.requestFullscreen) heroSection.requestFullscreen();
      } else {
        if (document.exitFullscreen) document.exitFullscreen();
      }
    });
  }

  // 8. Video Dokumentasi Modal Popup
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

  // 9. Sticky Navbar Shadow
  window.addEventListener('scroll', () => {
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
      if (window.scrollY > 40) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }
  });

  // 10. Mobile Slide-out Drawer Navigation
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
