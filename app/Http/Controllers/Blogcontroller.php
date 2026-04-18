<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Data artikel statis (ganti dengan model DB jika sudah ada tabel articles)
     */
    private function getArticles(): array
    {
        return [
            [
                'slug'       => 'panduan-qurban',
                'title'      => 'Panduan Lengkap Ibadah Qurban: Syarat, Waktu, dan Tata Cara yang Benar',
                'excerpt'    => 'Memahami ibadah qurban secara menyeluruh agar pelaksanaannya sesuai syariat dan dapat memberikan manfaat maksimal bagi sesama yang membutuhkan.',
                'content'    => '
                    <p>Ibadah qurban adalah salah satu amalan sunnah muakkadah yang sangat dianjurkan bagi setiap muslim yang mampu. Ibadah ini dilaksanakan pada hari raya Idul Adha dan hari-hari tasyriq (11, 12, dan 13 Dzulhijjah).</p>
                    <h2>Syarat Hewan Qurban</h2>
                    <p>Hewan yang sah untuk dijadikan qurban adalah unta, sapi, kerbau, dan kambing/domba. Masing-masing hewan memiliki syarat umur minimum yang berbeda. Kambing minimal berumur 1 tahun, sapi dan kerbau minimal 2 tahun, sedangkan unta minimal 5 tahun.</p>
                    <h2>Waktu Pelaksanaan</h2>
                    <p>Penyembelihan qurban dimulai setelah shalat Idul Adha pada tanggal 10 Dzulhijjah dan berakhir sebelum terbenamnya matahari pada tanggal 13 Dzulhijjah.</p>
                    <h2>Pembagian Daging Qurban</h2>
                    <p>Daging qurban dibagi menjadi tiga bagian: sepertiga untuk shohibul qurban dan keluarganya, sepertiga untuk disedekahkan kepada fakir miskin, dan sepertiga untuk dihadiahkan kepada tetangga dan kerabat.</p>
                ',
                'category'   => 'fiqih',
                'cat_label'  => 'Fiqih & Ibadah',
                'emoji'      => '🌙',
                'bg_color'   => '#1a5c45',
                'date'       => '16 April 2025',
                'read_time'  => '8 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => true,
            ],
            [
                'slug'       => '5-tips-donasi',
                'title'      => '5 Tips Memilih Program Donasi yang Tepat dan Terpercaya di Era Digital',
                'excerpt'    => 'Dengan banyaknya platform donasi online, penting untuk mengetahui cara memilih lembaga yang amanah dan transparan agar bantuan Anda tepat sasaran.',
                'content'    => '
                    <p>Di era digital seperti sekarang, donasi online semakin mudah dilakukan. Namun kemudahan ini juga memunculkan tantangan baru — bagaimana memastikan donasi kita benar-benar sampai kepada yang membutuhkan?</p>
                    <h2>1. Pastikan Lembaga Terdaftar Resmi</h2>
                    <p>Pilih platform atau lembaga amil zakat yang telah terdaftar dan mendapat izin dari Kementerian Agama atau BAZNAS. Lembaga resmi wajib membuat laporan keuangan yang dapat diaudit.</p>
                    <h2>2. Cek Transparansi Laporan</h2>
                    <p>Lembaga terpercaya selalu mempublikasikan laporan penggunaan dana secara berkala. Pastikan Anda bisa mengakses laporan tersebut dengan mudah di website mereka.</p>
                    <h2>3. Baca Ulasan dan Testimoni</h2>
                    <p>Ulasan dari donatur sebelumnya bisa menjadi referensi penting. Cari informasi di media sosial atau forum diskusi untuk mengetahui reputasi lembaga tersebut.</p>
                    <h2>4. Perhatikan Kejelasan Program</h2>
                    <p>Program donasi yang baik memiliki deskripsi jelas tentang tujuan, sasaran penerima, dan target dana yang dibutuhkan. Hindari program yang informasinya samar atau tidak spesifik.</p>
                    <h2>5. Gunakan Metode Pembayaran Resmi</h2>
                    <p>Selalu gunakan metode pembayaran resmi seperti transfer bank, dompet digital terdaftar, atau QRIS. Waspadai permintaan transfer ke rekening pribadi yang tidak jelas.</p>
                ',
                'category'   => 'donasi',
                'cat_label'  => 'Tips Donasi',
                'emoji'      => '💡',
                'bg_color'   => '#1a3d6e',
                'date'       => '14 April 2025',
                'read_time'  => '5 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => true,
            ],
            [
                'slug'       => 'kisah-ahmad',
                'title'      => 'Dari Donatur ke Harapan: Kisah Inspiratif Penerima Beasiswa Berkahin',
                'excerpt'    => 'Perkenalkan Ahmad, siswa berprestasi dari pelosok Sulawesi yang kini berkuliah di universitas impiannya berkat dukungan ribuan donatur Berkahin.',
                'content'    => '
                    <p>Ahmad Fauzi, 19 tahun, tumbuh di sebuah desa kecil di Sulawesi Tengah. Ayahnya seorang petani, ibunya penjual kue. Namun semangat belajarnya tidak pernah padam.</p>
                    <p>Dengan nilai ujian nasional tertinggi di kabupatennya, Ahmad bermimpi kuliah di Universitas Hasanuddin. Namun biaya kuliah menjadi tembok besar yang menghalangi mimpinya.</p>
                    <h2>Berkahin Hadir sebagai Jembatan</h2>
                    <p>Melalui program Beasiswa Berkahin yang didanai oleh ribuan donatur dari seluruh Indonesia, Ahmad mendapatkan beasiswa penuh — termasuk biaya kuliah, akomodasi, dan tunjangan hidup bulanan.</p>
                    <blockquote>"Saya tidak punya kata-kata yang cukup untuk mengucapkan terima kasih. Berkahin benar-benar mengubah hidup saya dan keluarga," ujar Ahmad.</blockquote>
                    <p>Kini Ahmad tengah menempuh semester ketiga di Fakultas Teknik. Nilai akademiknya konsisten masuk 5 besar di angkatannya.</p>
                ',
                'category'   => 'kisah',
                'cat_label'  => 'Cerita Kebaikan',
                'emoji'      => '❤️',
                'bg_color'   => '#7a3800',
                'date'       => '12 April 2025',
                'read_time'  => '6 menit baca',
                'author'     => 'Redaksi Berkahin',
                'featured'   => true,
            ],
            [
                'slug'       => 'zakat-penghasilan',
                'title'      => 'Zakat Penghasilan 2025: Cara Menghitung Nishab dan Kadar yang Wajib Anda Ketahui',
                'excerpt'    => 'Zakat penghasilan wajib dikeluarkan sebesar 2,5% dari gaji yang telah mencapai nishab 85 gram emas per tahun. Simak cara hitungnya.',
                'content'    => '
                    <p>Zakat penghasilan atau zakat profesi adalah bagian dari zakat maal yang wajib dikeluarkan atas harta yang berasal dari pendapatan rutin dari pekerjaan yang halal.</p>
                    <h2>Nishab Zakat Penghasilan 2025</h2>
                    <p>Nishab zakat penghasilan setara dengan 85 gram emas per tahun. Pada tahun 2025, angka ini setara dengan sekitar Rp 85.685.972 per tahun atau Rp 7.140.498 per bulan.</p>
                    <h2>Kadar Zakat</h2>
                    <p>Kadar zakat penghasilan adalah 2,5% dari total penghasilan bersih yang telah mencapai nishab.</p>
                    <h2>Contoh Perhitungan</h2>
                    <p>Jika gaji Anda Rp 10.000.000/bulan, maka zakat yang wajib dibayarkan adalah Rp 10.000.000 × 2,5% = <strong>Rp 250.000/bulan</strong>.</p>
                    <p>Zakat dapat dibayarkan bulanan atau sekaligus setahun penuh. Anda bisa menunaikannya melalui BAZNAS, lembaga amil zakat terpercaya, atau platform seperti Berkahin.</p>
                ',
                'category'   => 'zakat',
                'cat_label'  => 'Zakat & Infak',
                'emoji'      => '💰',
                'bg_color'   => '#2d6a2d',
                'date'       => '10 April 2025',
                'read_time'  => '4 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => true,
            ],
            [
                'slug'       => 'zakat-maal',
                'title'      => 'Zakat Maal: Pengertian, Jenis Harta yang Wajib Dizakati, dan Cara Menghitungnya',
                'excerpt'    => 'Zakat maal dikenakan atas berbagai jenis harta mulai dari emas, tabungan, hasil perdagangan, hingga saham dan investasi yang telah mencapai nishab.',
                'content'    => '
                    <p>Zakat maal adalah zakat yang dikenakan atas harta (maal) yang dimiliki oleh seorang Muslim yang telah memenuhi nishab dan haul (genap satu tahun).</p>
                    <h2>Jenis-jenis Harta yang Wajib Dizakati</h2>
                    <ul>
                        <li><strong>Zakat Emas dan Perak</strong> — atas kepemilikan emas/perak selama satu tahun hijriah</li>
                        <li><strong>Zakat Tabungan</strong> — atas saldo tabungan yang telah mencapai nishab</li>
                        <li><strong>Zakat Perdagangan</strong> — atas barang dagangan yang dimiliki untuk diperjualbelikan</li>
                        <li><strong>Zakat Saham dan Investasi</strong> — atas kepemilikan saham atau instrumen investasi lainnya</li>
                        <li><strong>Zakat Peternakan</strong> — atas hewan ternak seperti sapi, kambing, dan unta</li>
                        <li><strong>Zakat Pertanian</strong> — atas hasil pertanian tertentu seperti padi dan jagung</li>
                    </ul>
                    <h2>Nishab Zakat Emas</h2>
                    <p>Nishab emas adalah 85 gram. Jika emas yang dimiliki telah mencapai 85 gram dan sudah disimpan selama satu tahun, maka wajib dizakati sebesar 2,5%.</p>
                ',
                'category'   => 'zakat',
                'cat_label'  => 'Zakat & Infak',
                'emoji'      => '📿',
                'bg_color'   => '#0f4f3a',
                'date'       => '8 April 2025',
                'read_time'  => '7 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => false,
            ],
            [
                'slug'       => 'manfaat-donasi-islam',
                'title'      => 'Manfaat Berdonasi dalam Islam: Mendekatkan Diri kepada Allah dan Membantu Sesama',
                'excerpt'    => 'Dalam Islam, donasi adalah bentuk sedekah yang tidak memiliki batasan jumlah maupun waktu, dan setiap kebaikan akan dibalas berlipat ganda oleh Allah SWT.',
                'content'    => '
                    <p>Dalam Islam, donasi merupakan bentuk lain dari sedekah. Berbeda dengan zakat yang memiliki ketentuan jumlah dan waktu, donasi (infak/sedekah) tidak dibatasi besaran maupun kapan dilakukannya.</p>
                    <h2>Manfaat Spiritual</h2>
                    <p>Donasi mendekatkan diri kepada Allah SWT. Al-Quran secara jelas memerintahkan umat Muslim untuk bersedekah sebagai bagian dari ibadah. Setiap rupiah yang diberikan dengan ikhlas akan dibalas berlipat ganda.</p>
                    <h2>Manfaat Sosial</h2>
                    <p>Donasi membantu memerangi kelaparan, menyediakan akses pendidikan bagi anak yang kurang mampu, mendukung upaya konservasi lingkungan, serta membantu korban bencana alam.</p>
                    <h2>Hadis tentang Sedekah</h2>
                    <blockquote>"Barang siapa yang memberikan kemudahan kepada orang yang kesusahan, niscaya Allah akan memudahkan urusannya di dunia dan di akhirat." (HR. Muslim)</blockquote>
                    <p>Dengan berdonasi, kita tidak hanya membantu sesama tetapi juga menjadi saluran kebaikan yang Allah titipkan kepada kita.</p>
                ',
                'category'   => 'donasi',
                'cat_label'  => 'Tips Donasi',
                'emoji'      => '🤲',
                'bg_color'   => '#3a2a6e',
                'date'       => '6 April 2025',
                'read_time'  => '5 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => false,
            ],
            [
                'slug'       => 'zakat-fitrah',
                'title'      => 'Zakat Fitrah: Niat, Besaran, dan Waktu Pembayaran yang Tepat Sesuai Syariat',
                'excerpt'    => 'Zakat fitrah wajib ditunaikan setiap jiwa muslim sebelum shalat Idul Fitri, setara 2,5 kg beras per orang, sebagai penyucian diri setelah berpuasa.',
                'content'    => '
                    <p>Zakat fitrah adalah zakat yang wajib ditunaikan oleh setiap jiwa yang beragama Islam — baik laki-laki maupun perempuan, dewasa maupun anak-anak — di bulan Ramadhan sebelum pelaksanaan shalat Idul Fitri.</p>
                    <h2>Besaran Zakat Fitrah</h2>
                    <p>Besaran zakat fitrah adalah makanan pokok setara 2,5 kg atau 3,5 liter beras per jiwa. Jika ingin membayar dalam bentuk uang, sesuaikan dengan harga beras berkualitas standar di wilayah Anda.</p>
                    <h2>Waktu Pembayaran</h2>
                    <p>Zakat fitrah dapat dibayarkan sejak awal Ramadhan. Waktu paling utama adalah pada malam dan pagi Idul Fitri, sebelum pelaksanaan shalat Id. Tidak sah hukumnya jika dibayar setelah shalat Id.</p>
                    <h2>Niat Zakat Fitrah</h2>
                    <p>Niat untuk diri sendiri: <em>"Nawaytu an ukhrija zakaatal fithri an nafsi fardhan lillahi ta ala."</em></p>
                    <p>Artinya: "Aku niat mengeluarkan zakat fitrah untuk diriku sendiri, fardu karena Allah Ta ala."</p>
                ',
                'category'   => 'zakat',
                'cat_label'  => 'Zakat & Infak',
                'emoji'      => '🌾',
                'bg_color'   => '#6e3a00',
                'date'       => '4 April 2025',
                'read_time'  => '5 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => false,
            ],
            [
                'slug'       => 'hukum-zakat-keluarga',
                'title'      => 'Bolehkah Zakat Diberikan kepada Anggota Keluarga? Ini Penjelasan Para Ulama',
                'excerpt'    => 'Zakat boleh disalurkan kepada kerabat seperti paman, bibi, atau keponakan yang masuk dalam 8 asnaf, bahkan dianjurkan karena mempererat silaturahmi.',
                'content'    => '
                    <p>Zakat hanya dapat diberikan kepada 8 golongan (asnaf) yang telah ditetapkan dalam Al-Quran Surah At-Taubah ayat 60: fakir, miskin, amil, mualaf, riqab, gharimin, fisabilillah, dan ibnu sabil.</p>
                    <h2>Keluarga yang Boleh Menerima Zakat</h2>
                    <p>Para ulama membolehkan menyalurkan zakat kepada kerabat dekat seperti paman, bibi, dan keponakan — selama mereka termasuk dalam 8 asnaf. Bahkan hal ini dianjurkan karena selain menunaikan kewajiban, juga mempererat tali silaturahmi.</p>
                    <h2>Keluarga yang Tidak Boleh Menerima Zakat</h2>
                    <p>Orang tua kandung, istri/suami, dan anak-anak kandung tidak boleh menerima zakat dari Anda. Mereka adalah orang-orang yang wajib Anda nafkahi, sehingga zakat kepada mereka tidak sah.</p>
                    <h2>Keutamaan Berzakat kepada Kerabat</h2>
                    <p>Rasulullah SAW bersabda bahwa sedekah kepada kerabat yang berhak memiliki dua pahala: pahala sedekah dan pahala menjaga hubungan kekeluargaan.</p>
                ',
                'category'   => 'fiqih',
                'cat_label'  => 'Fiqih & Ibadah',
                'emoji'      => '👨‍👩‍👧',
                'bg_color'   => '#1e4d5c',
                'date'       => '2 April 2025',
                'read_time'  => '6 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => false,
            ],
            [
                'slug'       => 'eco-masjid',
                'title'      => 'Program Eco Masjid: Sinergi Kebaikan dan Kepedulian Lingkungan dari Komunitas Donatur',
                'excerpt'    => 'Ribuan donatur bersatu membangun masjid ramah lingkungan di pelosok negeri, membuktikan bahwa kebaikan kecil yang berkelanjutan bisa mengubah kehidupan banyak orang.',
                'content'    => '
                    <p>Program Eco Masjid adalah inisiatif pembangunan masjid yang mengedepankan prinsip ramah lingkungan: panel surya untuk energi, sistem penampungan air hujan, dan taman hijau di sekitarnya.</p>
                    <p>Program ini lahir dari keprihatinan akan banyaknya masjid di daerah terpencil yang kekurangan fasilitas memadai, sekaligus menjawab tantangan perubahan iklim dengan solusi berbasis komunitas.</p>
                    <h2>Dampak Program</h2>
                    <p>Hingga April 2025, Program Eco Masjid telah membangun 47 masjid di 12 provinsi di Indonesia, melayani lebih dari 85.000 jamaah setiap harinya.</p>
                    <h2>Cara Berpartisipasi</h2>
                    <p>Anda bisa berdonasi mulai dari Rp 10.000 melalui platform Berkahin. Setiap donasi dicatat transparan dan Anda akan menerima laporan perkembangan pembangunan secara berkala.</p>
                ',
                'category'   => 'kisah',
                'cat_label'  => 'Cerita Kebaikan',
                'emoji'      => '🕌',
                'bg_color'   => '#2a5c2a',
                'date'       => '30 Maret 2025',
                'read_time'  => '4 menit baca',
                'author'     => 'Redaksi Berkahin',
                'featured'   => false,
            ],
            [
                'slug'       => 'sedekah-subuh',
                'title'      => 'Keutamaan Sedekah Subuh: Amalan Ringan Berpahala Besar di Setiap Pagi',
                'excerpt'    => 'Bersedekah di waktu subuh adalah salah satu amalan yang sangat dianjurkan Rasulullah SAW karena membuka pintu rezeki dan keberkahan sepanjang hari.',
                'content'    => '
                    <p>Sedekah subuh adalah kebiasaan bersedekah yang dilakukan di pagi hari, khususnya setelah shalat Subuh. Amalan ini memiliki keutamaan luar biasa dalam Islam.</p>
                    <h2>Dalil Keutamaan Sedekah Subuh</h2>
                    <p>Rasulullah SAW bersabda: "Setiap pagi ada dua malaikat yang turun. Salah satunya berdo\'a: Ya Allah, berilah ganti kepada orang yang berinfak. Dan yang lain berdo\'a: Ya Allah, berilah kebinasaan kepada orang yang menahan hartanya." (HR. Bukhari dan Muslim)</p>
                    <h2>Manfaat Rutin Sedekah Subuh</h2>
                    <p>Memulai hari dengan sedekah menanamkan rasa syukur, membuka hati untuk berbagi, dan membangun kebiasaan dermawan yang secara ilmiah terbukti meningkatkan kebahagiaan dan kesejahteraan psikologis.</p>
                    <h2>Mulai dari yang Kecil</h2>
                    <p>Tidak perlu menunggu kaya untuk bersedekah. Mulailah dari nominal yang Anda mampu — bahkan Rp 1.000 setiap pagi sudah menjadi amalan mulia di sisi Allah SWT.</p>
                ',
                'category'   => 'donasi',
                'cat_label'  => 'Tips Donasi',
                'emoji'      => '🌅',
                'bg_color'   => '#4a1c6e',
                'date'       => '28 Maret 2025',
                'read_time'  => '3 menit baca',
                'author'     => 'Tim Berkahin',
                'featured'   => false,
            ],
        ];
    }

    /**
     * Halaman daftar semua artikel blog
     */
    public function index(Request $request)
    {
        $articles    = $this->getArticles();
        $category    = $request->query('cat', 'semua');
        $validCats   = ['semua', 'fiqih', 'zakat', 'donasi', 'kisah'];

        if (!in_array($category, $validCats)) {
            $category = 'semua';
        }

        $featured = array_filter($articles, fn($a) => $a['featured']);
        $grid     = array_filter($articles, fn($a) => !$a['featured']);

        // Filter per kategori jika bukan "semua"
        if ($category !== 'semua') {
            $featured = array_filter($featured, fn($a) => $a['category'] === $category);
            $grid     = array_filter($grid,     fn($a) => $a['category'] === $category);
        }

        return view('blog.index', [
            'featured'        => array_values($featured),
            'grid'            => array_values($grid),
            'activeCategory'  => $category,
            'categories'      => [
                'semua'  => 'Semua',
                'fiqih'  => 'Fiqih & Ibadah',
                'zakat'  => 'Zakat & Infak',
                'donasi' => 'Tips Donasi',
                'kisah'  => 'Cerita Kebaikan',
            ],
        ]);
    }

    /**
     * Halaman detail artikel berdasarkan slug
     */
    public function show(string $slug)
    {
        $articles = $this->getArticles();

        // Cari artikel dengan slug yang cocok
        $article = collect($articles)->firstWhere('slug', $slug);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        // Artikel terkait: kategori sama, bukan artikel ini sendiri, max 3
        $related = collect($articles)
            ->filter(fn($a) => $a['category'] === $article['category'] && $a['slug'] !== $slug)
            ->take(3)
            ->values()
            ->all();

        return view('blog.show', [
            'article' => $article,
            'related' => $related,
        ]);
    }
}