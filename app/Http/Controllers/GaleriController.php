<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        // 1. Fetch real recent activities from database nochifram
        $dbActivities = collect();

        try {
            // Health treatments (Vaksin, Obat, Vitamin)
            $treatments = DB::table('health_treatments')
                ->orderBy('date', 'desc')
                ->take(8)
                ->get();

            foreach ($treatments as $t) {
                $dbActivities->push([
                    'id' => 'health_' . $t->id,
                    'type' => 'foto',
                    'category' => 'kesehatan',
                    'category_label' => 'Kesehatan & Sanitasi',
                    'date' => $t->date,
                    'title' => 'Pemberian ' . ucfirst($t->type) . ': ' . $t->medicine_name,
                    'description' => ($t->notes ? $t->notes . '. ' : '') . 'Aplikasi via ' . ($t->application_method ?: 'Air Minum') . ' dengan dosis ' . ($t->dosage ?: 'standar') . ' guna menjaga kebugaran ayam petelur.',
                    'media_type' => 'image',
                    'media_url' => asset('images/healthy_layer_hens.jpg'),
                    'badge' => $t->dosage ?: ucfirst($t->type),
                    'badge_type' => 'green',
                    'location' => 'Kandang Nochi Farm, Sugihwaras',
                    'operator' => 'Tim Peternakan Nochi Farm',
                ]);
            }

            // Egg productions (Panen & Produksi Telur)
            $productions = DB::table('egg_productions')
                ->orderBy('date', 'desc')
                ->take(8)
                ->get();

            foreach ($productions as $p) {
                $goodEggs = $p->good_eggs ?: $p->total_eggs;
                $dbActivities->push([
                    'id' => 'prod_' . $p->id,
                    'type' => 'foto',
                    'category' => 'panen',
                    'category_label' => 'Panen & Produksi Telur',
                    'date' => $p->date,
                    'title' => 'Panen Telur Segar: ' . number_format($goodEggs, 0, ',', '.') . ' Butir Telur',
                    'description' => ($p->notes ? $p->notes . '. ' : '') . 'Hasil panen telur segar kualitas utuh seberat ' . number_format($p->weight_kg, 1, ',', '.') . ' kg (' . (float)$p->crates_count . ' peti) langsung melalui proses sortir kebersihan.',
                    'media_type' => 'image',
                    'media_url' => asset('images/step4_produksi.jpg'),
                    'badge' => number_format($goodEggs, 0, ',', '.') . ' Butir Telur',
                    'badge_type' => 'orange',
                    'location' => 'Ruang Sortir & Kandang, Sugihwaras',
                    'operator' => 'Tim Sortir Nochi Farm',
                ]);
            }
        } catch (\Throwable $e) {
            // Handled gracefully if DB query issues arise
        }

        // 2. High-Definition Curated Videos of Nochi Farm with actual activity timestamps
        $videoActivities = collect([
            [
                'id' => 'vid_story',
                'type' => 'video',
                'category' => 'kandang',
                'category_label' => 'Story Peternakan (Portrait)',
                'date' => '2026-09-25',
                'title' => 'Story Dokumentasi Vertikal Peternakan Nochi Farm',
                'description' => 'Video dokumentasi vertikal (9:16) memperlihatkan aktivitas peternakan ayam petelur Nochi Farm secara dekat, dioptimalkan khusus untuk perangkat mobile & smartphone.',
                'media_type' => 'video',
                'media_url' => asset('videos/Story_Wa.mp4'),
                'video_duration' => '00:30',
                'poster' => asset('images/healthy_layer_hens.jpg'),
                'badge' => 'Story Vertikal 9:16',
                'badge_type' => 'orange',
                'location' => 'Kandang Nochi Farm, Sugihwaras',
                'operator' => 'Tim Media Nochi Farm',
            ],
            [
                'id' => 'vid_1',
                'type' => 'video',
                'category' => 'kandang',
                'category_label' => 'Kandang & Ayam Petelur',
                'date' => '2026-09-25',
                'title' => 'Dokumentasi Video Lengkap Operasional Nochi Farm',
                'description' => 'Rekaman video dokumentasi lengkap peternakan ayam petelur Nochi Farm di Sugihwaras, Kebumen. Memperlihatkan alur pemeliharaan harian, kebersihan kandang baterai, dan kesehatan ayam Lohmann Brown.',
                'media_type' => 'video',
                'media_url' => asset('videos/nochifarm_full.mp4'),
                'video_duration' => '04:25',
                'poster' => asset('images/healthy_layer_hens.jpg'),
                'badge' => 'Video Utama (4:25 Min)',
                'badge_type' => 'orange',
                'location' => 'Sugihwaras, Kebumen',
                'operator' => 'Nochi Farm Official',
            ],
            [
                'id' => 'vid_2',
                'type' => 'video',
                'category' => 'pakan',
                'category_label' => 'Pemberian Pakan',
                'date' => '2026-09-24',
                'title' => 'Pemberian Pakan Formula Nutrisi Seimbang',
                'description' => 'Aktivitas pengisian dan takaran pakan formula bernutrisi tinggi sesuai fase layer agar metabolisme ayam terjaga optimal dan cangkang telur tebal alami.',
                'media_type' => 'video',
                'media_url' => asset('videos/nochifarm_full.mp4'),
                'video_duration' => '01:48',
                'poster' => asset('images/step2_pakan.jpg'),
                'badge' => 'Formula Layer Nutrisi',
                'badge_type' => 'orange',
                'location' => 'Lini Pakan Kandang Baterai',
                'operator' => 'Tim Pakan Nochi Farm',
            ],
            [
                'id' => 'vid_3',
                'type' => 'video',
                'category' => 'panen',
                'category_label' => 'Panen & Pengambilan Telur',
                'date' => '2026-09-24',
                'title' => 'Pengambilan Telur Segar Pagi dari Talang Telur',
                'description' => 'Proses pengambilan telur dari talang otomatis kandang baterai dilakukan secara higienis setiap pagi tanpa kontaminasi kotoran ayam.',
                'media_type' => 'video',
                'media_url' => asset('videos/nochifarm_full.mp4'),
                'video_duration' => '02:32',
                'poster' => asset('images/step4_produksi.jpg'),
                'badge' => 'Panen Pagi Rutin',
                'badge_type' => 'orange',
                'location' => 'Talang Telur Otomatis',
                'operator' => 'Tim Panen Nochi Farm',
            ],
            [
                'id' => 'vid_4',
                'type' => 'video',
                'category' => 'panen',
                'category_label' => 'Sortir & Packing',
                'date' => '2026-09-23',
                'title' => 'Sortir Mutu Telur & Pengemasan Peti Kayu',
                'description' => 'Setiap butir telur diperiksa kebersihan cangkangnya, ditimbang bobotnya, dan dikemas dengan rapi menggunakan peti kayu berlapis sekam kering pelindung goncangan.',
                'media_type' => 'video',
                'media_url' => asset('videos/nochifarm_full.mp4'),
                'video_duration' => '02:36',
                'poster' => asset('images/step5_packing.jpg'),
                'badge' => 'Grade A Telur Bersih',
                'badge_type' => 'orange',
                'location' => 'Gudang Packaging',
                'operator' => 'Tim Packing Nochi Farm',
            ],
            [
                'id' => 'vid_5',
                'type' => 'video',
                'category' => 'kandang',
                'category_label' => 'Kandang & Lingkungan',
                'date' => '2026-09-22',
                'title' => 'Inspeksi Sirkulasi Udara & Bio-Security Lingkungan',
                'description' => 'Pengecekan kipas blower ventilasi, sanitasi alas kandang, dan disinfeksi kendaraan operasional guna memastikan biosecurity peternakan bebas penyakit.',
                'media_type' => 'video',
                'media_url' => asset('videos/nochifarm_full.mp4'),
                'video_duration' => '01:55',
                'poster' => asset('images/step3_kandang.jpg'),
                'badge' => 'Standar Biosecurity',
                'badge_type' => 'green',
                'location' => 'Area Peternakan Kebumen',
                'operator' => 'Supervisor Kandang',
            ],
            [
                'id' => 'vid_6',
                'type' => 'video',
                'category' => 'distribusi',
                'category_label' => 'Distribusi & Pengiriman',
                'date' => '2026-09-21',
                'title' => 'Armada Pengiriman Telur Segar Siap Meluncur',
                'description' => 'Pemuatan peti-peti telur segar ke armada logistik Nochi Farm untuk dikirimkan tepat waktu ke mitra toko sembako, agen, martabak, dan UMKM bakery.',
                'media_type' => 'video',
                'media_url' => asset('videos/nochifarm_full.mp4'),
                'video_duration' => '02:08',
                'poster' => asset('images/nochi_delivery_van.jpg'),
                'badge' => 'Distribusi Harian',
                'badge_type' => 'orange',
                'location' => 'Loading Dock Peternakan',
                'operator' => 'Tim Logistik & Supir',
            ],
        ]);

        // 3. High-Definition Curated Photo Activities of Nochi Farm
        $photoActivities = collect([
            [
                'id' => 'img_1',
                'type' => 'foto',
                'category' => 'panen',
                'category_label' => 'Kualitas Telur',
                'date' => '2026-09-25',
                'title' => 'Koleksi Telur Segar Nochi Farm: Bersih dan Berwarna Cokelat Cerah',
                'description' => 'Telur Nochi Farm dihasilkan dari ayam ras Lohmann Brown dengan kulit cangkang cokelat cerah alami, bersih tanpa kotoran menempel, dan memiliki kuning telur bulat kental.',
                'media_type' => 'image',
                'media_url' => asset('images/fresh_clean_eggs.jpg'),
                'badge' => 'Cangkang Bersih Alami',
                'badge_type' => 'orange',
                'location' => 'Meja Sortir Telur',
                'operator' => 'Tim Quality Control',
            ],
            [
                'id' => 'img_2',
                'type' => 'foto',
                'category' => 'panen',
                'category_label' => 'Uji Mutu Laboratorium',
                'date' => '2026-09-24',
                'title' => 'Uji Kekentalan Putih Telur & Kepekatan Kuning Telur Nochi Farm',
                'description' => 'Pemeriksaan rutin mutu telur segar Nochi Farm membuktikan putih telur kental bertingkat tebal dan kuning telur yang kokoh tidak mudah pecah.',
                'media_type' => 'image',
                'media_url' => asset('images/egg_comparison_quality.jpg'),
                'badge' => 'Kekentalan Tinggi Grade A',
                'badge_type' => 'green',
                'location' => 'Laboratorium Mutu Telur',
                'operator' => 'Tim Quality Assurance',
            ],
            [
                'id' => 'img_3',
                'type' => 'foto',
                'category' => 'kandang',
                'category_label' => 'Kandang & Lingkungan',
                'date' => '2026-09-23',
                'title' => 'Pemandangan Panorama Peternakan Nochi Farm di Sugihwaras, Kebumen',
                'description' => 'Peternakan Nochi Farm berlokasi di daerah Sugihwaras, Kebumen yang asri dan sejuk, menjamin lingkungan ideal bagi produktivitas ayam petelur tanpa polusi.',
                'media_type' => 'image',
                'media_url' => asset('images/farm_exterior_kebumen.jpg'),
                'badge' => 'Sugihwaras, Kebumen',
                'badge_type' => 'green',
                'location' => 'Desa Sugihwaras, Kebumen, Jateng',
                'operator' => 'Nochi Farm Kebumen',
            ],
            [
                'id' => 'img_4',
                'type' => 'foto',
                'category' => 'distribusi',
                'category_label' => 'Armada Logistik',
                'date' => '2026-09-22',
                'title' => 'Armada Pengiriman Nochi Farm Siap Pasok Kebutuhan Rutin',
                'description' => 'Mobil pengiriman khusus telur Nochi Farm siap mengantar pasokan telur segar setiap pagi langsung ke tempat usaha dan toko Anda.',
                'media_type' => 'image',
                'media_url' => asset('images/nochi_delivery_van.jpg'),
                'badge' => 'Armada Logistik Sendiri',
                'badge_type' => 'orange',
                'location' => 'Rute Kebumen & Sekitarnya',
                'operator' => 'Tim Pengiriman',
            ],
        ]);

        // Merge DB activities + Video items + Photo items
        $allActivities = $videoActivities->concat($photoActivities)->concat($dbActivities);

        // Sort descending by date (berdasarkan dari tanggal terbaru)
        $allActivities = $allActivities->sortByDesc(function ($item) {
            return $item['date'];
        })->values();

        // Optional filter from query string ?category=video | foto | panen | etc.
        $selectedCategory = $request->query('category', 'all');
        if ($selectedCategory !== 'all') {
            $allActivities = $allActivities->filter(function ($item) use ($selectedCategory) {
                if ($selectedCategory === 'video') return $item['type'] === 'video';
                if ($selectedCategory === 'foto') return $item['type'] === 'foto';
                return $item['category'] === $selectedCategory;
            })->values();
        }

        // Stats calculation
        $totalItems = $allActivities->count();
        $totalVideos = $videoActivities->count();
        $totalPhotos = $photoActivities->count() + $dbActivities->count();
        $latestDateFormatted = Carbon::parse($allActivities->first()['date'] ?? now())->translatedFormat('d F Y');

        return view('galeri', compact(
            'allActivities',
            'selectedCategory',
            'totalItems',
            'totalVideos',
            'totalPhotos',
            'latestDateFormatted'
        ));
    }
}
