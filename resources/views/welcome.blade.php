<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nochi Farm | Peternak Ayam Petelur - Sugihwaras, Kebumen</title>
    
    <meta name="description" content="Nochi Farm adalah peternakan ayam petelur berlokasi di Sugihwaras, Kebumen, Jawa Tengah. Telur segar setiap hari dengan standar pemeliharaan berkualitas.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;1,600;1,700&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Stylesheet with Cache-Buster -->
    <link rel="stylesheet" href="{{ asset('css/nochifarm.css') }}?v={{ file_exists(public_path('css/nochifarm.css')) ? filemtime(public_path('css/nochifarm.css')) : time() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        /* Globally remove all sound/control buttons on both desktop and mobile */
        .hero-video-controls,
        #hero-video-controls,
        .audio-prompt-pill,
        #audio-autoplay-prompt {
            display: none !important;
        }

        @media (max-width: 768px) {
            #hero-video-section.viewport-lock {
                height: 100vh !important;
                height: 100dvh !important;
            }
            .hero-video-element {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
                object-position: center center !important;
                filter: none !important;
                pointer-events: none !important;
            }
            #hero-intro-text,
            .hero-left-content,
            .hero-gradient-overlay {
                display: none !important;
            }
            /* Slider is strictly centered at bottom with zero obstruction */
            .hero-unlock-bar-container {
                position: absolute !important;
                bottom: 22px !important;
                left: 50% !important;
                right: auto !important;
                transform: translateX(-50%) !important;
                z-index: 30 !important;
                width: auto !important;
            }
            .hero-swipe-slider {
                width: min(290px, 86vw) !important;
                padding: 6px 14px 6px 6px !important;
                font-size: 11.5px !important;
                background: rgba(15, 23, 42, 0.75) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                border: 1px solid rgba(240, 90, 40, 0.4) !important;
            }
        }
    </style>
</head>
<body class="hero-locked">

    <!-- ==========================================================================
         1. NAVBAR
         ========================================================================== -->
    <nav id="main-navbar">
        <div class="container navbar-inner">
            <a href="#beranda" class="brand-wrapper">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Nochi Farm Logo" class="brand-badge-img">
                <div class="brand-text-col">
                    <span class="brand-title">NOCHI FARM</span>
                    <span class="brand-sub">PETERNAK AYAM PETELUR</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#beranda" class="nav-link active">Beranda</a></li>
                <li><a href="#tentang-nochi" class="nav-link">Tentang Kami</a></li>
                <li><a href="#alur-proses" class="nav-link">Peternakan</a></li>
                <li><a href="#produk-kami" class="nav-link">Produk</a></li>
                <li><a href="#keunggulan" class="nav-link">Standar Peternakan</a></li>
                <li><a href="{{ route('galeri.index') }}" class="nav-link">Galeri</a></li>
                <li><a href="#kontak" class="nav-link">Kontak</a></li>
            </ul>

            <div class="navbar-actions-group">
                <a href="https://wa.me/6285211940604?text=Halo%20Nochi%20Farm,%20saya%20ingin%20memesan%20telur%20segar." target="_blank" rel="noopener noreferrer" class="btn-pesan-nav">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2z"/>
                    </svg>
                    <span>Pesan Telur</span>
                </a>

                <a href="https://wa.me/6285211940604?text=Halo%20Nochi%20Farm,%20saya%20ingin%20memesan%20telur%20segar." target="_blank" rel="noopener noreferrer" class="btn-pesan-mobile" aria-label="Pesan Telur via WhatsApp">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2z"/>
                    </svg>
                    <span>Pesan</span>
                </a>

                <button id="mobile-menu-toggle" class="btn-mobile-menu" aria-label="Menu Navigasi">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Slide-out Navigation Drawer -->
    <div id="mobile-nav-drawer" class="mobile-nav-drawer">
        <div class="drawer-header">
            <div class="brand-wrapper">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Nochi Farm Logo" class="brand-badge-img" style="width: 36px; height: 36px;">
                <div class="brand-text-col">
                    <span class="brand-title" style="font-size: 15px;">NOCHI FARM</span>
                    <span class="brand-sub" style="font-size: 8.5px;">PETERNAK AYAM PETELUR</span>
                </div>
            </div>
            <button id="mobile-nav-close" class="drawer-close-btn" aria-label="Tutup Menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <ul class="mobile-drawer-links">
            <li><a href="#beranda" class="drawer-link active">🏠 Beranda</a></li>
            <li><a href="#tentang-nochi" class="drawer-link">🐔 Tentang Nochi Farm</a></li>
            <li><a href="#alur-proses" class="drawer-link">🌾 Alur Peternakan</a></li>
            <li><a href="#produk-kami" class="drawer-link">🥚 Produk Telur Segar</a></li>
            <li><a href="#keunggulan" class="drawer-link">✨ Standar Mutu</a></li>
            <li><a href="{{ route('galeri.index') }}" class="drawer-link highlight-galeri">🎬 Galeri & Video Lengkap</a></li>
            <li><a href="#kontak" class="drawer-link">📞 Hubungi Kami</a></li>
        </ul>
        <div class="drawer-footer">
            <a href="https://wa.me/6285211940604?text=Halo%20Nochi%20Farm,%20saya%20ingin%20memesan%20telur%20segar." target="_blank" rel="noopener noreferrer" class="btn-pesan-drawer">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2z"/>
                </svg>
                <span>WhatsApp Pemilik (Galih)</span>
            </a>
        </div>
    </div>
    <div id="mobile-nav-overlay" class="mobile-nav-overlay"></div>


    <!-- ==========================================================================
         2. HERO VIDEO SECTION (AUTOPLAY & LOCKED UNTIL USER SWIPES/SCROLLS)
         ========================================================================== -->
    <header id="hero-video-section" class="viewport-lock">
        <!-- Direct Autoplay Video with Direct Audio (Landscape for Desktop, Portrait Story_Wa for Mobile) -->
        <video id="hero-video" class="hero-video-element" autoplay loop playsinline webkit-playsinline preload="auto"
               data-desktop-src="{{ asset('videos/nochifarm_full.mp4') }}"
               data-mobile-src="{{ asset('videos/Story_Wa.mp4') }}">
            <!-- Portrait Video for Mobile Phone Screens -->
            <source src="{{ asset('videos/Story_Wa.mp4') }}" type="video/mp4" media="(max-width: 768px), (orientation: portrait)">
            <source src="{{ asset('videos/Story_Wa.mov') }}" type="video/quicktime" media="(max-width: 768px), (orientation: portrait)">
            <!-- Landscape Video for Desktop / Laptop Screens -->
            <source src="{{ asset('videos/nochifarm_full.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/nochifarm_full.mov') }}" type="video/mp4">
            <source src="{{ asset('videos/nochifarm_full.mov') }}" type="video/quicktime">
            <source src="{{ asset('videos/hero-dummy.mp4') }}" type="video/mp4">
        </video>

        <div class="hero-gradient-overlay"></div>

        <!-- Video Top-Left Brand Watermark (Always visible to identify video ownership) -->
        <a href="#tentang-nochi" id="video-brand-watermark" class="video-brand-watermark" title="Nochi Farm - Peternak Ayam Petelur Kebumen">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Nochi Farm Logo" class="watermark-logo-img">
            <div class="watermark-text-col">
                <span class="watermark-title">NOCHI <span class="highlight-orange">FARM</span></span>
                <span class="watermark-subtitle">Peternakan Kebumen</span>
            </div>
        </a>

        <div class="container hero-content-inner">
            <!-- Left Info & Branding (Hides immediately as video plays) -->
            <div id="hero-intro-text" class="hero-left-content">
                <span class="hero-script-tag">Telur Segar Berkualitas</span>
                
                <h1 class="hero-big-title">
                    NOCHI <span class="highlight-orange">FARM</span>
                </h1>
                
                <span class="hero-sub-title-badge">PETERNAK AYAM PETELUR</span>

                <p class="hero-quote-text">
                    “Diproduksi dengan standar peternakan yang terjaga dan kualitas yang konsisten. Dari peternakan kami di Sugihwaras, Kebumen untuk kebutuhan telur Anda.”
                </p>
            </div>
        </div>


        <!-- Gesture / Swipe Unlock Bar -->
        <div class="hero-unlock-bar-container">
            <div id="hero-swipe-slider" class="hero-swipe-slider" title="Klik atau Geser ke Bawah untuk Membuka Profil">
                <div class="swipe-circle-thumb">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <polyline points="19 12 12 19 5 12"></polyline>
                    </svg>
                </div>
                <span>Geser atau Scroll ke Bawah untuk Menjelajahi</span>
            </div>
        </div>
    </header>


    <!-- ==========================================================================
         3. HIGHLIGHT STRIP & STATS BADGES
         ========================================================================== -->
    <main>
        <div id="keunggulan" class="container">
            <!-- 5 Highlights Icons Strip (Exact Mockup 2) -->
            <div class="highlights-strip-card">
                <div class="highlight-item">
                    <div class="highlight-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                        </svg>
                    </div>
                    <div class="highlight-text-box">
                        <h4>FRESH SETIAP HARI</h4>
                        <p>Telur segar dari peternakan sendiri</p>
                    </div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                    </div>
                    <div class="highlight-text-box">
                        <h4>KUALITAS TERJAMIN</h4>
                        <p>Diproduksi dengan standar yang terjaga</p>
                    </div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
                            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
                        </svg>
                    </div>
                    <div class="highlight-text-box">
                        <h4>NUTRISI SEIMBANG</h4>
                        <p>Pakan berkualitas sesuai fase ayam</p>
                    </div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                    </div>
                    <div class="highlight-text-box">
                        <h4>AYAM SEHAT PRODUKTIF</h4>
                        <p>Lingkungan kandang yang terawat</p>
                    </div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <div class="highlight-text-box">
                        <h4>SIAP SUPPLY RUTIN</h4>
                        <p>Melayani eceran, grosir & bisnis</p>
                    </div>
                </div>
            </div>

            <!-- 4 Numbers Stats Strip (Exact Mockup 1) -->
            <div class="stats-strip-wrapper">
                <div class="stat-item">
                    <div class="stat-icon-wrap">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8 2 5 6 5 12c0 5 3.5 9 7 9s7-4 7-9c0-6-3-10-7-10z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-number-title">{{ number_format($totalActiveChickens ?? 2250, 0, ',', '.') }}+</div>
                        <div class="stat-sub-text">Ayam Petelur ({{ $primaryBreed ?? 'Lohmann Brown-Extra' }})</div>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon-wrap">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="currentColor">
                            <circle cx="12" cy="12" r="10"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-number-title">Fresh</div>
                        <div class="stat-sub-text">Setiap Hari (Produksi Telur)</div>
                    </div>
                </div>

                <a href="https://maps.app.goo.gl/iEbEd2Tv27Jmq2vDA" target="_blank" rel="noopener noreferrer" class="stat-item" title="Buka Lokasi Nochi Farm di Google Maps" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon-wrap">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-number-title">Sugihwaras</div>
                        <div class="stat-sub-text">Kebumen, Jawa Tengah</div>
                    </div>
                </a>

                <div class="stat-item">
                    <div class="stat-icon-wrap">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-number-title">Supply</div>
                        <div class="stat-sub-text">Rutin untuk Pelanggan</div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ==========================================================================
             4. SECTION: TENTANG NOCHI FARM
             ========================================================================== -->
        <section id="tentang-nochi" class="section-padding">
            <div class="container">
                <div class="about-nochifarm-grid">
                    <div>
                        <h2 class="about-heading">
                            Tentang <span>Nochi Farm</span>
                        </h2>

                        <p class="about-body-text">
                            <strong>Nochi Farm</strong> adalah peternakan ayam petelur yang berlokasi di Sugihwaras, Kebumen, Jawa Tengah. Kami berfokus pada pemeliharaan ayam petelur dengan memperhatikan kesehatan ayam, kebersihan kandang, kualitas pakan, serta konsistensi proses produksi untuk menghasilkan telur yang berkualitas.
                        </p>

                        <a href="#alur-proses" class="btn-selengkapnya">
                            <span>Selengkapnya</span>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>

                    <div class="about-photo-wrapper">
                        <img src="{{ asset('images/farm_exterior_kebumen.jpg') }}" alt="Peternakan Nochi Farm Sugihwaras Kebumen" class="about-photo-img">
                    </div>
                </div>
            </div>
        </section>


        <!-- ==========================================================================
             5. SECTION: DARI AYAM MENJADI TELUR (6 STEPS WORKFLOW)
             ========================================================================== -->
        <section id="alur-proses" class="section-padding">
            <div class="container">
                <div class="section-title-wrap">
                    <h2 class="section-main-title">
                        Dari Ayam <span>Menjadi Telur</span>
                    </h2>
                    <p class="section-subtitle-text">
                        Proses pemeliharaan yang terjaga, menghasilkan telur berkualitas untuk pelanggan.
                    </p>
                </div>

                <div class="workflow-steps-grid">
                    <!-- Step 1 -->
                    <div class="workflow-step-card">
                        <div class="step-photo-wrap">
                            <img src="{{ asset('images/healthy_layer_hens.jpg') }}" alt="Ayam Sehat" class="step-photo-img">
                        </div>
                        <div class="step-body">
                            <span class="step-number-badge">1</span>
                            <div class="step-info-col">
                                <h5>Ayam Sehat</h5>
                                <p>Pemeliharaan terkontrol</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="workflow-step-card">
                        <div class="step-photo-wrap">
                            <img src="{{ asset('images/step2_pakan.jpg') }}" alt="Pakan Berkualitas" class="step-photo-img">
                        </div>
                        <div class="step-body">
                            <span class="step-number-badge">2</span>
                            <div class="step-info-col">
                                <h5>Pakan Berkualitas</h5>
                                <p>Sesuai fase umur</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="workflow-step-card">
                        <div class="step-photo-wrap">
                            <img src="{{ asset('images/step3_kandang.jpg') }}" alt="Perawatan Kandang" class="step-photo-img">
                        </div>
                        <div class="step-body">
                            <span class="step-number-badge">3</span>
                            <div class="step-info-col">
                                <h5>Perawatan Kandang</h5>
                                <p>Kebersihan terjaga</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="workflow-step-card">
                        <div class="step-photo-wrap">
                            <img src="{{ asset('images/step4_produksi.jpg') }}" alt="Produksi Telur" class="step-photo-img">
                        </div>
                        <div class="step-body">
                            <span class="step-number-badge">4</span>
                            <div class="step-info-col">
                                <h5>Produksi Telur</h5>
                                <p>Setiap hari</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="workflow-step-card">
                        <div class="step-photo-wrap">
                            <img src="{{ asset('images/step5_packing.jpg') }}" alt="Sortir & Pengemasan" class="step-photo-img">
                        </div>
                        <div class="step-body">
                            <span class="step-number-badge">5</span>
                            <div class="step-info-col">
                                <h5>Sortir & Pengemasan</h5>
                                <p>Telur dipilih dengan baik</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="workflow-step-card">
                        <div class="step-photo-wrap">
                            <img src="{{ asset('images/nochi_delivery_van.jpg') }}" alt="Distribusi" class="step-photo-img">
                        </div>
                        <div class="step-body">
                            <span class="step-number-badge">6</span>
                            <div class="step-info-col">
                                <h5>Distribusi</h5>
                                <p>Sampai ke pelanggan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ==========================================================================
             6. SECTION: PRODUK KAMI (3 CARDS)
             ========================================================================== -->
        <section id="produk-kami" class="section-padding">
            <div class="container">
                <div class="section-title-wrap">
                    <h2 class="section-main-title">
                        Produk <span>Kami</span>
                    </h2>
                </div>

                <div class="products-cards-grid">
                    <!-- Product 1 -->
                    <div class="product-row-card">
                        <img src="{{ asset('images/fresh_clean_eggs.jpg') }}" alt="Telur Ayam Segar" class="product-card-thumb">
                        <div class="product-card-body">
                            <div class="product-badge-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                            </div>
                            <h4 class="product-card-title">Telur Ayam Segar</h4>
                            <p class="product-card-desc">
                                Telur ayam ras petelur untuk kebutuhan rumah tangga, warung, toko, dan pelanggan usaha.
                            </p>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="product-row-card">
                        <img src="{{ asset('images/step5_packing.jpg') }}" alt="Supply Rutin" class="product-card-thumb">
                        <div class="product-card-body">
                            <div class="product-badge-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                </svg>
                            </div>
                            <h4 class="product-card-title">Supply Rutin</h4>
                            <p class="product-card-desc">
                                Pasokan telur untuk pelanggan dengan kebutuhan harian maupun rutin.
                            </p>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="product-row-card">
                        <img src="{{ asset('images/nochi_delivery_van.jpg') }}" alt="Distribusi Armada" class="product-card-thumb">
                        <div class="product-card-body">
                            <div class="product-badge-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </div>
                            <h4 class="product-card-title">Distribusi</h4>
                            <p class="product-card-desc">
                                Pengiriman menggunakan armada Nochi Farm untuk menjangkau pelanggan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ==========================================================================
             7. SECTION: VIDEO DOKUMENTASI (6 ITEMS)
             ========================================================================== -->
        <section id="galeri-video" class="section-padding">
            <div class="container">
                <div class="video-section-header">
                    <h2 class="section-main-title">
                        Video <span>Dokumentasi</span>
                    </h2>
                    <a href="{{ route('galeri.index') }}" class="link-all-videos" title="Buka Halaman Galeri Foto & Video Kegiatan Lengkap">
                        <span>Lihat Semua Galeri</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

                <div class="video-grid-container">
                    <!-- Video 1 -->
                    <div class="video-item-card" data-title="Aktivitas Pagi di Kandang" data-video="{{ asset('videos/nochifarm_full.mp4') }}">
                        <div class="video-thumb-box">
                            <img src="{{ asset('images/healthy_layer_hens.jpg') }}" alt="Aktivitas Pagi" class="video-thumb-img">
                            <div class="video-thumb-overlay">
                                <div class="thumb-play-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                            <span class="video-duration-tag">02:15</span>
                        </div>
                        <h5 class="video-item-title">Aktivitas Pagi di Kandang</h5>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-item-card" data-title="Pemberian Pakan Berkualitas" data-video="{{ asset('videos/nochifarm_full.mp4') }}">
                        <div class="video-thumb-box">
                            <img src="{{ asset('images/step2_pakan.jpg') }}" alt="Pemberian Pakan" class="video-thumb-img">
                            <div class="video-thumb-overlay">
                                <div class="thumb-play-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                            <span class="video-duration-tag">01:48</span>
                        </div>
                        <h5 class="video-item-title">Pemberian Pakan</h5>
                    </div>

                    <!-- Video 3 -->
                    <div class="video-item-card" data-title="Pengambilan Telur Segar" data-video="{{ asset('videos/nochifarm_full.mp4') }}">
                        <div class="video-thumb-box">
                            <img src="{{ asset('images/step4_produksi.jpg') }}" alt="Pengambilan Telur" class="video-thumb-img">
                            <div class="video-thumb-overlay">
                                <div class="thumb-play-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                            <span class="video-duration-tag">02:32</span>
                        </div>
                        <h5 class="video-item-title">Pengambilan Telur</h5>
                    </div>

                    <!-- Video 4 -->
                    <div class="video-item-card" data-title="Proses Packing & Sortir" data-video="{{ asset('videos/nochifarm_full.mp4') }}">
                        <div class="video-thumb-box">
                            <img src="{{ asset('images/step5_packing.jpg') }}" alt="Proses Packing" class="video-thumb-img">
                            <div class="video-thumb-overlay">
                                <div class="thumb-play-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                            <span class="video-duration-tag">02:36</span>
                        </div>
                        <h5 class="video-item-title">Proses Packing</h5>
                    </div>

                    <!-- Video 5 -->
                    <div class="video-item-card" data-title="Persiapan Distribusi Telur" data-video="{{ asset('videos/nochifarm_full.mp4') }}">
                        <div class="video-thumb-box">
                            <img src="{{ asset('images/step3_kandang.jpg') }}" alt="Persiapan Distribusi" class="video-thumb-img">
                            <div class="video-thumb-overlay">
                                <div class="thumb-play-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                            <span class="video-duration-tag">01:36</span>
                        </div>
                        <h5 class="video-item-title">Persiapan Distribusi</h5>
                    </div>

                    <!-- Video 6 -->
                    <div class="video-item-card" data-title="Pengiriman ke Pelanggan Armada Nochi Farm" data-video="{{ asset('videos/nochifarm_full.mp4') }}">
                        <div class="video-thumb-box">
                            <img src="{{ asset('images/nochi_delivery_van.jpg') }}" alt="Pengiriman ke Pelanggan" class="video-thumb-img">
                            <div class="video-thumb-overlay">
                                <div class="thumb-play-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                            <span class="video-duration-tag">01:58</span>
                        </div>
                        <h5 class="video-item-title">Pengiriman ke Pelanggan</h5>
                    </div>
                </div>
            </div>
        </section>


        <!-- ==========================================================================
             8. SECTION: BUTUH PASOKAN TELUR SECARA RUTIN? (CTA BANNER)
             ========================================================================== -->
        <section class="container">
            <div class="cta-banner-wrapper">
                <div class="cta-banner-content">
                    <div class="cta-text-side">
                        <h2 class="cta-title">Butuh pasokan telur secara rutin?</h2>
                        <p class="cta-desc">
                            Nochi Farm melayani kebutuhan telur untuk pelanggan dengan kebutuhan harian maupun rutin.
                        </p>
                        <a href="https://wa.me/6285211940604?text=Halo%20Nochi%20Farm,%20saya%20ingin%20berkonsultasi%20pasokan%20telur%20rutin." target="_blank" rel="noopener noreferrer" class="btn-hubungi-orange">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2z"/>
                            </svg>
                            <span>Hubungi Nochi Farm</span>
                        </a>
                    </div>

                    <div class="cta-img-side">
                        <img src="{{ asset('images/fresh_clean_eggs.jpg') }}" alt="Tumpukan Telur Segar Nochi Farm" class="cta-crates-photo">
                        <img src="{{ asset('images/healthy_layer_hens.jpg') }}" alt="Ayam Petelur Nochi Farm" class="cta-crates-photo" style="height: 180px;">
                    </div>
                </div>

                <!-- Segments Strip (Exact Mockup 2) -->
                <div class="cta-segments-strip">
                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="8"></circle></svg>
                        <span>Eceran</span>
                    </div>

                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="3" width="18" height="18" rx="2"></rect></svg>
                        <span>Grosir</span>
                    </div>

                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                        <span>Toko & Warung</span>
                    </div>

                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path></svg>
                        <span>Rumah Makan</span>
                    </div>

                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Reseller</span>
                    </div>

                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"></path></svg>
                        <span>Usaha Kuliner</span>
                    </div>

                    <div class="segment-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"></rect><line x1="9" y1="6" x2="9" y2="6.01"></line><line x1="15" y1="6" x2="15" y2="6.01"></line></svg>
                        <span>Instansi</span>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <!-- ==========================================================================
         9. FOOTER (EXACT MOCKUP)
         ========================================================================== -->
    <footer id="kontak" class="site-footer-mockup">
        <div class="container">
            <div class="footer-main-grid">
                <!-- Col 1: Brand Logo & Tagline -->
                <div>
                    <div class="footer-brand-logo-wrap">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Nochi Farm Emblem" class="footer-brand-logo-img">
                        <div>
                            <div class="brand-title">NOCHI FARM</div>
                            <div class="brand-sub">PETERNAK AYAM PETELUR</div>
                        </div>
                    </div>
                    <p class="footer-tagline-motto">
                        Merawat dengan Tanggung Jawab,<br>
                        Menghasilkan Telur Berkualitas
                    </p>
                </div>

                <!-- Col 2: Lokasi Kami -->
                <div>
                    <h4 class="footer-col-header">Lokasi Kami</h4>
                    <p class="footer-location-text">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--orange-primary); flex-shrink: 0; margin-top: 2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>Sugihwaras, Kebumen<br>Jawa Tengah</span>
                    </p>
                    <a href="https://maps.app.goo.gl/iEbEd2Tv27Jmq2vDA" target="_blank" rel="noopener noreferrer" class="btn-gmaps">
                        Lihat di Google Maps
                    </a>
                </div>

                <!-- Col 3: Kontak -->
                <div>
                    <h4 class="footer-col-header">Kontak</h4>
                    <div class="footer-contact-box">
                        <svg class="wa-icon-green" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2z"/>
                        </svg>
                        <div>
                            <span class="contact-name">Galih</span>
                            <a href="https://wa.me/6285211940604" target="_blank" rel="noopener noreferrer" class="contact-phone">
                                0852 - 1194 - 0604
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Col 4: Ikuti Kami -->
                <div>
                    <h4 class="footer-col-header">Ikuti Kami</h4>
                    <a href="https://instagram.com/nochifarm.kebumen" target="_blank" rel="noopener noreferrer" class="ig-handle-link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #e1306c;"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        <span>@nochifarm.kebumen</span>
                    </a>
                </div>
            </div>

            <!-- Footer Bottom Line -->
            <div class="footer-bottom-line">
                <ul class="footer-bottom-nav">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#tentang-nochi">Tentang Kami</a></li>
                    <li><a href="#alur-proses">Peternakan</a></li>
                    <li><a href="#produk-kami">Produk</a></li>
                    <li><a href="#keunggulan">Standar Peternakan</a></li>
                    <li><a href="#galeri-video">Galeri</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>

                <div>&copy; 2026 Nochi Farm. All Rights Reserved.</div>
            </div>
        </div>
    </footer>


    <!-- ==========================================================================
         10. VIDEO MODAL POPUP
         ========================================================================== -->
    <div id="video-modal-backdrop">
        <div class="modal-video-card">
            <button id="modal-close-btn" class="modal-close-btn" type="button" aria-label="Tutup Video">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <video id="modal-video-player" class="modal-video-frame" controls playsinline>
                <source src="{{ asset('videos/nochifarm_full.mp4') }}" type="video/mp4">
            </video>
            <div class="modal-video-caption">
                <span id="modal-video-title" style="font-weight: 700;">Dokumentasi Nochi Farm</span>
                <span style="color: var(--orange-primary); font-size: 13px; font-weight: 700;">Nochi Farm Official</span>
            </div>
        </div>
    </div>

    <!-- Script Engine with Cache-Buster -->
    <script src="{{ asset('js/nochifarm.js') }}?v={{ file_exists(public_path('js/nochifarm.js')) ? filemtime(public_path('js/nochifarm.js')) : time() }}"></script>
</body>
</html>
