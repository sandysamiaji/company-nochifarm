<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri & Dokumentasi Kegiatan | Nochi Farm Kebumen</title>
    
    <meta name="description" content="Dokumentasi foto, video, dan log kegiatan pemeliharaan ayam petelur Nochi Farm di Sugihwaras, Kebumen berdasarkan tanggal terbaru.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;1,600;1,700&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/nochifarm.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        /* Galeri Page Custom Styles */
        .galeri-page-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            padding: 56px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .galeri-header-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.08;
            background-image: radial-gradient(#ea580c 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
        }

        .galeri-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(240, 90, 40, 0.18);
            border: 1px solid rgba(240, 90, 40, 0.4);
            color: #fdba74;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: var(--radius-full);
            margin-bottom: 14px;
        }

        .galeri-header-title {
            font-family: var(--font-heading);
            font-size: clamp(30px, 4.2vw, 46px);
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 12px;
        }

        .galeri-header-subtitle {
            font-size: 15.5px;
            color: #cbd5e1;
            max-width: 680px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .galeri-stats-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-md);
            padding: 16px 20px;
        }

        .galeri-stat-col {
            display: flex;
            flex-direction: column;
        }

        .galeri-stat-num {
            font-family: var(--font-heading);
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.1;
        }

        .galeri-stat-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #94a3b8;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Filter Controls */
        .galeri-controls-section {
            background: #ffffff;
            border-bottom: 1px solid var(--border-light);
            padding: 18px 0;
            position: sticky;
            top: 70px;
            z-index: 50;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .filter-tabs-row {
            display: flex;
            align-items: center;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
        }

        .filter-tabs-row::-webkit-scrollbar {
            display: none;
        }

        .filter-pill-btn {
            background: #f1f5f9;
            color: #475569;
            font-size: 13.5px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: var(--radius-full);
            white-space: nowrap;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .filter-pill-btn:hover {
            background: #e2e8f0;
            color: var(--text-heading);
        }

        .filter-pill-btn.active {
            background: var(--orange-primary);
            color: #ffffff;
            box-shadow: 0 3px 10px rgba(240, 90, 40, 0.35);
        }

        /* Gallery Cards Grid */
        .galeri-feed-section {
            padding: 44px 0 80px;
        }

        .galeri-feed-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .activity-card {
            background: #ffffff;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-light);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-card);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .activity-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: #cbd5e1;
        }

        .activity-media-wrap {
            position: relative;
            width: 100%;
            height: 220px;
            background: #0f172a;
            overflow: hidden;
            cursor: pointer;
        }

        .activity-media-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .activity-card:hover .activity-media-img {
            transform: scale(1.05);
        }

        .activity-play-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .activity-card:hover .activity-play-overlay {
            background: rgba(15, 23, 42, 0.2);
        }

        .activity-play-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--orange-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
            transition: transform 0.2s ease;
        }

        .activity-card:hover .activity-play-circle {
            transform: scale(1.1);
        }

        .activity-type-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: var(--radius-full);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(6px);
        }

        .activity-type-badge.badge-video {
            background: rgba(240, 90, 40, 0.9);
            color: #ffffff;
        }

        .activity-type-badge.badge-foto {
            background: rgba(15, 23, 42, 0.85);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-duration-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.75);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .activity-card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .activity-meta-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            gap: 8px;
        }

        .activity-date-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 700;
            color: var(--orange-primary);
        }

        .activity-cat-pill {
            font-size: 10.5px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 4px;
            background: #f1f5f9;
            color: #475569;
            text-transform: uppercase;
        }

        .activity-card-title {
            font-family: var(--font-heading);
            font-size: 17px;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.35;
            margin-bottom: 10px;
        }

        .activity-card-desc {
            font-size: 13.5px;
            color: var(--text-body);
            line-height: 1.6;
            margin-bottom: 16px;
            flex-grow: 1;
        }

        .activity-card-footer {
            border-top: 1px solid var(--border-subtle);
            padding-top: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .activity-badge-value {
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        .badge-value-orange {
            background: #fff7ed;
            color: var(--orange-primary);
            border: 1px solid #fed7aa;
        }

        .badge-value-green {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .btn-back-home {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 13px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: var(--radius-full);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-back-home:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            transform: translateX(-2px);
        }

        @media (max-width: 992px) {
            .galeri-feed-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .galeri-stats-strip {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .galeri-page-header {
                padding: 32px 0 24px;
            }
            .galeri-header-title {
                font-size: 24px;
            }
            .galeri-header-subtitle {
                font-size: 13.5px;
                margin-bottom: 20px;
            }
            .galeri-feed-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .galeri-stats-strip {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                padding: 12px;
            }
            .galeri-stat-num {
                font-size: 18px;
            }
            .galeri-stat-label {
                font-size: 10px;
            }
            .filter-pill-btn {
                padding: 6px 14px;
                font-size: 12px;
            }
            .activity-media-wrap {
                height: 190px;
            }
            .activity-card-body {
                padding: 16px;
            }
            .activity-card-title {
                font-size: 15.5px;
            }
            .activity-card-desc {
                font-size: 13px;
                margin-bottom: 12px;
            }
            .btn-pesan-nav-galeri {
                padding: 7px 14px;
                font-size: 12px;
            }
        }

        .btn-pesan-nav-galeri {
            background: var(--orange-primary);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: var(--radius-full);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: var(--shadow-btn);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-pesan-nav-galeri:hover {
            background: var(--orange-dark);
        }
    </style>
</head>
<body>

    <!-- ==========================================================================
         1. NAVBAR
         ========================================================================== -->
    <nav id="main-navbar">
        <div class="container navbar-inner">
            <a href="{{ route('home') }}" class="brand-wrapper" title="Ke Beranda Nochi Farm">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Nochi Farm Logo" class="brand-badge-img">
                <div class="brand-text-col">
                    <span class="brand-title">NOCHI FARM</span>
                    <span class="brand-sub">PETERNAK AYAM PETELUR</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                <li><a href="{{ route('home') }}#tentang-nochi" class="nav-link">Tentang Kami</a></li>
                <li><a href="{{ route('home') }}#alur-proses" class="nav-link">Peternakan</a></li>
                <li><a href="{{ route('home') }}#produk-kami" class="nav-link">Produk</a></li>
                <li><a href="{{ route('galeri.index') }}" class="nav-link active">Galeri & Dokumentasi</a></li>
                <li><a href="{{ route('home') }}#kontak" class="nav-link">Kontak</a></li>
            </ul>

            <div style="display: flex; align-items: center; gap: 8px;">
                <a href="{{ route('home') }}" class="btn-back-home" style="color: var(--text-heading); border-color: var(--border-light); background: #f8fafc; padding: 7px 14px; font-size: 12.5px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Beranda</span>
                </a>

                <a href="https://wa.me/6285211940604?text=Halo%20Nochi%20Farm,%20saya%20tertarik%20dengan%20kegiatan%20peternakan%20dan%20ingin%20memesan%20telur." target="_blank" rel="noopener noreferrer" class="btn-pesan-nav-galeri">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2z"></path>
                    </svg>
                    <span>Pesan</span>
                </a>
            </div>
        </div>
    </nav>


    <!-- ==========================================================================
         2. PAGE HEADER BANNER WITH LIVE STATS
         ========================================================================== -->
    <header class="galeri-page-header">
        <div class="galeri-header-pattern"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="galeri-badge-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="10"></circle>
                </svg>
                <span>Dokumentasi Resmi • Sugihwaras, Kebumen</span>
            </div>

            <h1 class="galeri-header-title">
                Galeri Foto & Video <span style="color: var(--orange-primary);">Kegiatan Peternakan</span>
            </h1>

            <p class="galeri-header-subtitle">
                Transparansi penuh seluruh aktivitas harian Nochi Farm — mulai dari pemeliharaan ayam Lohmann Brown, pemberian pakan nutrisi, sanitasi kandang, panen telur segar harian, hingga distribusi ke pelanggan berdasarkan tanggal terbaru.
            </p>

            <!-- Live Stats Strip -->
            <div class="galeri-stats-strip">
                <div class="galeri-stat-col">
                    <span class="galeri-stat-num">{{ $totalItems }}</span>
                    <span class="galeri-stat-label">Total Dokumentasi</span>
                </div>
                <div class="galeri-stat-col">
                    <span class="galeri-stat-num" style="color: #fdba74;">{{ $latestDateFormatted }}</span>
                    <span class="galeri-stat-label">Tanggal Terbaru</span>
                </div>
                <div class="galeri-stat-col">
                    <span class="galeri-stat-num" style="color: #6ee7b7;">{{ $totalVideos }} Video</span>
                    <span class="galeri-stat-label">Dokumentasi Video HD</span>
                </div>
                <div class="galeri-stat-col">
                    <span class="galeri-stat-num" style="color: #93c5fd;">{{ $totalPhotos }} Kegiatan</span>
                    <span class="galeri-stat-label">Foto & Log Aktivitas</span>
                </div>
            </div>
        </div>
    </header>


    <!-- ==========================================================================
         3. FILTER CATEGORY TABS
         ========================================================================== -->
    <section class="galeri-controls-section">
        <div class="container">
            <div class="filter-tabs-row">
                <a href="{{ route('galeri.index') }}" class="filter-pill-btn {{ $selectedCategory === 'all' ? 'active' : '' }}">
                    Semua Kegiatan ({{ $totalItems }})
                </a>
                <a href="{{ route('galeri.index', ['category' => 'video']) }}" class="filter-pill-btn {{ $selectedCategory === 'video' ? 'active' : '' }}">
                    🎬 Video Dokumentasi ({{ $totalVideos }})
                </a>
                <a href="{{ route('galeri.index', ['category' => 'foto']) }}" class="filter-pill-btn {{ $selectedCategory === 'foto' ? 'active' : '' }}">
                    📸 Foto Kegiatan ({{ $totalPhotos }})
                </a>
                <a href="{{ route('galeri.index', ['category' => 'panen']) }}" class="filter-pill-btn {{ $selectedCategory === 'panen' ? 'active' : '' }}">
                    🥚 Produksi & Panen
                </a>
                <a href="{{ route('galeri.index', ['category' => 'kesehatan']) }}" class="filter-pill-btn {{ $selectedCategory === 'kesehatan' ? 'active' : '' }}">
                    💊 Kesehatan & Sanitasi
                </a>
                <a href="{{ route('galeri.index', ['category' => 'pakan']) }}" class="filter-pill-btn {{ $selectedCategory === 'pakan' ? 'active' : '' }}">
                    🌿 Pemberian Pakan
                </a>
                <a href="{{ route('galeri.index', ['category' => 'distribusi']) }}" class="filter-pill-btn {{ $selectedCategory === 'distribusi' ? 'active' : '' }}">
                    🚚 Pengiriman & Logistik
                </a>
            </div>
        </div>
    </section>


    <!-- ==========================================================================
         4. GALLERY & ACTIVITY CARDS FEED (SORTED BY NEWEST DATE)
         ========================================================================== -->
    <main class="galeri-feed-section">
        <div class="container">
            <div class="galeri-feed-grid">
                @forelse($allActivities as $act)
                    <div class="activity-card" data-id="{{ $act['id'] }}">
                        <!-- Media Container -->
                        <div class="activity-media-wrap trigger-media-view" 
                             data-type="{{ $act['type'] }}" 
                             data-title="{{ $act['title'] }}" 
                             data-src="{{ $act['media_type'] === 'video' ? $act['media_url'] : $act['media_url'] }}"
                             title="{{ $act['type'] === 'video' ? 'Putar Video Dokumentasi' : 'Lihat Foto Kegiatan' }}">
                            
                            <img src="{{ $act['type'] === 'video' ? ($act['poster'] ?? asset('images/healthy_layer_hens.jpg')) : $act['media_url'] }}" 
                                 alt="{{ $act['title'] }}" 
                                 class="activity-media-img" loading="lazy">
                            
                            <!-- Badges -->
                            <span class="activity-type-badge {{ $act['type'] === 'video' ? 'badge-video' : 'badge-foto' }}">
                                {{ $act['type'] === 'video' ? '🎬 Video' : '📸 Foto' }}
                            </span>

                            @if($act['type'] === 'video')
                                <div class="activity-play-overlay">
                                    <div class="activity-play-circle">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </div>
                                </div>
                                <span class="activity-duration-badge">{{ $act['video_duration'] ?? 'Video HD' }}</span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="activity-card-body">
                            <div class="activity-meta-line">
                                <span class="activity-date-tag">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($act['date'])->translatedFormat('d M Y') }}
                                </span>
                                <span class="activity-cat-pill">{{ $act['category_label'] }}</span>
                            </div>

                            <h3 class="activity-card-title">{{ $act['title'] }}</h3>

                            <p class="activity-card-desc">{{ $act['description'] }}</p>

                            <div class="activity-card-footer">
                                <span>📍 {{ $act['location'] ?? 'Sugihwaras, Kebumen' }}</span>
                                <span class="activity-badge-value {{ ($act['badge_type'] ?? '') === 'green' ? 'badge-value-green' : 'badge-value-orange' }}">
                                    {{ $act['badge'] ?? 'Terverifikasi' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: #ffffff; border-radius: var(--radius-md); border: 1px dashed var(--border-light);">
                        <p style="font-size: 16px; color: var(--text-muted); margin-bottom: 14px;">Belum ada dokumentasi untuk kategori ini.</p>
                        <a href="{{ route('galeri.index') }}" class="btn-pesan-nav">Lihat Semua Dokumentasi</a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>


    <!-- ==========================================================================
         5. MEDIA POPUP MODAL (VIDEO PLAYER & IMAGE LIGHTBOX)
         ========================================================================== -->
    <div id="media-modal-backdrop" class="modal-backdrop">
        <div class="modal-content-card" style="max-width: 880px; position: relative;">
            <button id="media-modal-close-btn" class="modal-float-close-btn" title="Tutup" aria-label="Tutup">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div id="modal-video-container" style="display: none; background: #000000; border-radius: 12px; overflow: hidden;">
                <video id="modal-media-video-player" controls playsinline style="width: 100%; max-height: 72vh; display: block;">
                    <source src="" type="video/mp4">
                </video>
            </div>

            <div id="modal-image-container" style="display: none; background: #0f172a; text-align: center; border-radius: 12px; overflow: hidden; padding: 4px;">
                <img id="modal-media-image-player" src="" alt="Dokumentasi Nochi Farm" style="max-width: 100%; max-height: 72vh; display: inline-block; object-fit: contain;">
            </div>
        </div>
    </div>


    <!-- ==========================================================================
         6. CTA BANNER
         ========================================================================== -->
    <section class="container" style="margin-bottom: 60px;">
        <div class="cta-banner-wrapper">
            <div class="cta-banner-content">
                <div class="cta-text-side">
                    <span class="cta-mini-tag">KUALITAS TERBUKTI</span>
                    <h3 class="cta-title">Ingin Pasokan Telur Rutin dari Peternakan Kami?</h3>
                    <p class="cta-desc">
                        Nochi Farm siap bermitra dengan toko sembako, agen telur, industri martabak, bakery, hingga hotel dan katering dengan suplai telur segar konsisten setiap hari.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="https://wa.me/6285211940604?text=Halo%20Nochi%20Farm,%20saya%20tertarik%20bermitra%20untuk%20pasokan%20telur%20rutin." target="_blank" rel="noopener noreferrer" class="btn-pesan-nav" style="padding: 12px 26px; font-size: 14.5px;">
                            Hubungi Pemilik (Galih) - WhatsApp
                        </a>
                        <a href="{{ route('home') }}" class="btn-back-home" style="color: #ffffff; border-color: rgba(255,255,255,0.4);">
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ==========================================================================
         7. FOOTER
         ========================================================================== -->
    <footer id="kontak">
        <div class="container">
            <div class="footer-main-grid">
                <div class="footer-col-brand">
                    <div class="footer-brand-header">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Nochi Farm Crest" class="footer-logo-img">
                        <div class="brand-text-col">
                            <span class="brand-title" style="color: #ffffff;">NOCHI FARM</span>
                            <span class="brand-sub" style="color: #ea580c;">PETERNAK AYAM PETELUR</span>
                        </div>
                    </div>
                    <p class="footer-brand-desc">
                        Peternakan ayam petelur modern di Sugihwaras, Kebumen, Jawa Tengah. Memprioritaskan kesehatan ayam, kebersihan pakan, dan integritas kualitas telur segar setiap hari.
                    </p>
                </div>

                <div class="footer-col-contact">
                    <h4 class="footer-widget-title">Kontak & Pemesanan</h4>
                    <p class="footer-person-tag">Penanggung Jawab / Pemilik: <strong>Galih</strong></p>
                    <div class="contact-pill-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <a href="https://wa.me/6285211940604" target="_blank" rel="noopener noreferrer">
                            0852 - 1194 - 0604 (WhatsApp)
                        </a>
                    </div>
                </div>

                <div class="footer-col-address">
                    <h4 class="footer-widget-title">Lokasi Peternakan</h4>
                    <p class="address-text-line">
                        Sugihwaras, Kebumen, Jawa Tengah, Indonesia.
                    </p>
                    <a href="https://maps.app.goo.gl/iEbEd2Tv27Jmq2vDA" target="_blank" rel="noopener noreferrer" class="link-maps-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                        <span>Petunjuk Arah Google Maps</span>
                    </a>
                </div>
            </div>

            <div class="footer-bottom-line">
                <p>&copy; {{ date('Y') }} Nochi Farm Kebumen. Hak Cipta Dilindungi.</p>
                <p class="credit-sub">Peternak Ayam Petelur Berkualitas • Sugihwaras, Kebumen</p>
            </div>
        </div>
    </footer>

    <!-- Interactive JS for Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalBackdrop = document.getElementById('media-modal-backdrop');
            const modalCloseBtn = document.getElementById('media-modal-close-btn');
            const modalTitle = document.getElementById('media-modal-title');
            const videoContainer = document.getElementById('modal-video-container');
            const imageContainer = document.getElementById('modal-image-container');
            const videoPlayer = document.getElementById('modal-media-video-player');
            const imagePlayer = document.getElementById('modal-media-image-player');

            document.querySelectorAll('.trigger-media-view').forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const type = trigger.getAttribute('data-type');
                    const title = trigger.getAttribute('data-title');
                    const src = trigger.getAttribute('data-src');

                    modalTitle.innerText = title;

                    if (type === 'video') {
                        imageContainer.style.display = 'none';
                        videoContainer.style.display = 'block';
                        videoPlayer.src = src;
                        videoPlayer.play();
                    } else {
                        videoContainer.style.display = 'none';
                        if (videoPlayer) videoPlayer.pause();
                        imageContainer.style.display = 'block';
                        imagePlayer.src = src;
                    }

                    modalBackdrop.classList.add('open');
                });
            });

            function closeModal() {
                modalBackdrop.classList.remove('open');
                if (videoPlayer) videoPlayer.pause();
            }

            if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
            modalBackdrop.addEventListener('click', (e) => {
                if (e.target === modalBackdrop) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modalBackdrop.classList.contains('open')) closeModal();
            });
        });
    </script>
</body>
</html>
