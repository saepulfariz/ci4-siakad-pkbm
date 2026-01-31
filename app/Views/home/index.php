<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKBM HAYATI NUSANTARA - SIPENA - Belajar Tertata, Nilai Terdata</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="<?= asset_url(); ?>assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= asset_url(); ?>assets/frontend/css/animate.css">
    <link rel="stylesheet" href="<?= asset_url(); ?>assets/frontend/css/aos.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #172B55;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);

        }

        .gradient-overlay {
            background: linear-gradient(135deg, rgba(23, 43, 85, 0.95), rgba(245, 183, 59, 0.85));
        }

        .background-img {
            background: url('<?= asset_url(); ?>assets/images/pkbm.webp') center center no-repeat;
            background-size: cover;
        }

        .section-padding {
            padding: 60px 0;
        }

        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 12px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
</head>

<body>

    <nav style="background: #172B55; box-shadow: 0 2px 12px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 100;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 16px 24px;">
            <div
                style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div style="display: flex; align-items: center; gap: 16px;"><img
                        src="<?= asset_url(); ?>assets/images/logo.png"
                        alt="Logo PKBM Hayati Nusantara" style="height: 50px; width: auto;"
                        onerror="this.src=''; this.alt='Logo PKBM Hayati Nusantara'; this.style.display='none';">
                    <div>
                        <div id="nav-title" style="font-size: 20px; font-weight: 700; color: #FAFFFE;">
                            PKBM Hayati Nusantara
                        </div>
                        <div style="font-size: 12px; color: #F5B73B;">
                            NPSN : P9999412
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <a class="page-scroll" href="#beranda"
                        style="color: rgb(250, 255, 254); text-decoration: none; padding: 8px 16px; border-radius: 6px; transition: 0.3s; font-weight: 500; background: transparent;"
                        onmouseover="this.style.background='rgba(245,183,59,0.2)'"
                        onmouseout="this.style.background='transparent'">Beranda</a>
                    <a class="page-scroll" href="#tentang"
                        style="color: rgb(250, 255, 254); text-decoration: none; padding: 8px 16px; border-radius: 6px; transition: 0.3s; font-weight: 500; background: transparent;"
                        onmouseover="this.style.background='rgba(245,183,59,0.2)'"
                        onmouseout="this.style.background='transparent'">Tentang</a>
                    <a class="page-scroll" href="#program"
                        style="color: rgb(250, 255, 254); text-decoration: none; padding: 8px 16px; border-radius: 6px; transition: 0.3s; font-weight: 500; background: transparent;"
                        onmouseover="this.style.background='rgba(245,183,59,0.2)'"
                        onmouseout="this.style.background='transparent'">Program</a>
                    <a class="page-scroll" href="#kontak"
                        style="color: rgb(250, 255, 254); text-decoration: none; padding: 8px 16px; border-radius: 6px; transition: 0.3s; font-weight: 500; background: transparent;"
                        onmouseover="this.style.background='rgba(245,183,59,0.2)'"
                        onmouseout="this.style.background='transparent'">Kontak</a>
                    <a href="<?= base_url('login'); ?>" id="btn-login" class="btn-primary"
                        style="text-decoration:none;padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; font-size: 14px;">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <section id="beranda" style="position: relative; height: 600px; overflow: hidden;">
        <!-- <div class="hero-slider">
            <div class="slide">
                <img src="" alt="Gedung Sekolah"
                    onerror="this.src=''; this.alt='Gedung Sekolah'; this.style.display='none';" style="display: none;">
            </div>
            <div class="slide active">
                <img src="" alt="Gedung Sekolah"
                    onerror="this.src=''; this.alt='Gedung Sekolah'; this.style.display='none';" style="display: none;">
            </div>
            <div class="slide">
                <img src="" alt="Gedung Sekolah"
                    onerror="this.src=''; this.alt='Gedung Sekolah'; this.style.display='none';" style="display: none;">
            </div>
        </div> -->
        <div class="background-img"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
            <div style="text-align: center; color: #FAFFFE; padding: 24px; max-width: 900px;">
                <h1 data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100" id="hero-title" class="fade-in"
                    style="font-size: 56px; font-weight: 700; margin-bottom: 16px; text-shadow: 2px 2px 8px rgba(0,0,0,0.3);">
                    PKBM Hayati Nusantara</h1>
                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" id="hero-slogan" class="fade-in"
                    style="font-size: 28px; margin-bottom: 32px; font-weight: 300; animation-delay: 0.2s; text-shadow: 1px 1px 4px rgba(0,0,0,0.3);">
                    Pendidikan Setara, Masa Depan Bermakna</p>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;" class="fade-in">
                    <a data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300" href="#kontak" id="btn-register" class="btn-primary page-scroll text-decoration-none"
                        style="padding: 16px 40px; border-radius: 12px; border: none; cursor: pointer; font-weight: 600; font-size: 16px;">Daftar
                        Sekarang</a>
                    <a data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300" href="#kontak" id="btn-contact" class="btn-secondary page-scroll text-decoration-none"
                        style="padding: 16px 40px; border-radius: 12px; border: none; cursor: pointer; font-weight: 600; font-size: 16px;">Hubungi
                        Kami</a>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" style="padding: 80px 24px; background: #FAFFFE;">
        <div style="max-width: 1280px; margin: 0 auto;">
            <h2 id="about-title" class="section-title"
                style="font-size: 42px; font-weight: 700; margin-bottom: 48px; text-align: center; color: #172B55;">
                Tentang Kami</h2>
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; margin-bottom: 64px;">
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100">
                    <div class="hover-lift"
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <h3 style="font-size: 24px; font-weight: 600; color: #172B55; margin-bottom: 16px;">Sejarah</h3>
                        <p style="line-height: 1.8; color: #2C3E50;">PKBM Hayati Nusantara didirikan dengan komitmen untuk
                            memberikan akses pendidikan berkualitas bagi seluruh lapisan masyarakat. Kami percaya bahwa
                            setiap individu berhak mendapatkan pendidikan yang setara dan bermakna.</p>
                    </div>
                </div>
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                    <div class="hover-lift"
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <h3 id="vision-title"
                            style="font-size: 24px; font-weight: 600; color: #172B55; margin-bottom: 16px;">Visi</h3>
                        <p style="line-height: 1.8; color: #2C3E50;">Mewujudkan masyarakat yang cerdas dan mandiri melalui pendidikan sepanjang hayat.</p>
                    </div>
                </div>
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="300">

                    <div class="hover-lift"
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <h3 id="mission-title"
                            style="font-size: 24px; font-weight: 600; color: #172B55; margin-bottom: 16px;">Misi</h3>
                        <ul style="line-height: 1.8; color: #2C3E50; padding-left: 20px;">
                            <li>Menyelenggarakan program pendidikan nonformal yang bermutu dan sesuai dengan kebutuhan masyarakat, seperti keaksaraan, kesetaraan (Paket A, B, C), dan keterampilan</li>
                            <li>Meningkatkan kualitas sumber daya manusia melalui pembelajaran yang berorientasi pada pengembangan potensi diri dan keterampilan hidup (life skills).</li>

                            <li>Mendorong partisipasi aktif masyarakat dalam proses belajar-mengajar serta pengelolaan PKBM secara partisipatif dan berkelanjutan.</li>
                            <li>Membangun kemitraan dengan berbagai pihak (pemerintah, swasta, dan masyarakat) untuk memperluas akses dan mutu layanan pendidikan.</li>
                            <li> Mewujudkan masyarakat pembelajar sepanjang hayat yang memiliki karakter, etika, dan kepedulian sosial.</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 80px 24px; background: linear-gradient(135deg, #172B55 0%, #2a4a7f 100%);">
        <div style="max-width: 1000px; margin: 0 auto;">
            <div
                style="background: white; border-radius: 24px; padding: 48px; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                <h2 data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100" class="section-title"
                    style="font-size: 42px; font-weight: 700; margin-bottom: 48px; text-align: center; color: #172B55;">
                    Sambutan Kepala Sekolah</h2>
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200" style="display: flex; gap: 40px; align-items: center; flex-wrap: wrap;"><img
                        src="<?= asset_url(); ?>assets/dist/img/user.png"
                        alt="Kepala Sekolah"
                        style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; border: 6px solid #F5B73B; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"
                        onerror="this.src=''; this.alt='Kepala Sekolah'; this.style.display='none';">
                    <div style="flex: 1; min-width: 300px;" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                        <p style="line-height: 1.9; color: #2C3E50; margin-bottom: 24px; font-size: 16px;">
                            Assalamu'alaikum Warahmatullahi Wabarakatuh. Selamat datang di PKBM Hayati Nusantara. Kami
                            berkomitmen untuk memberikan pendidikan berkualitas yang dapat mengubah kehidupan dan
                            membuka peluang masa depan yang lebih cerah bagi setiap peserta didik kami.</p>
                        <p id="principal-name" style="font-weight: 600; color: #172B55; font-size: 18px;">M. Yahya Soeharyanto, S.ag. M.ba</p>
                        <p style="color: #F5B73B; font-weight: 500;">Kepala Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="program" style="padding: 80px 24px; background: #f8f9fa;">
        <div style="max-width: 1280px; margin: 0 auto;">
            <h2 class="section-title"
                style="font-size: 42px; font-weight: 700; margin-bottom: 48px; text-align: center; color: #172B55;">
                Program Akademik</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100" class="aos-init aos-animate">
                        <div class="hover-lift" style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-top: 6px solid #F5B73B;">
                            <div style="width: 64px; height: 64px; background: #F5B73B; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#172B55" stroke-width="2">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <h3 style="font-size: 26px; font-weight: 600; color: #172B55; margin-bottom: 16px;">Paket B (Setara
                                SMP)</h3>
                            <p style="line-height: 1.8; color: #2C3E50; margin-bottom: 20px;">Program pendidikan kesetaraan
                                tingkat SMP dengan kurikulum yang komprehensif dan metode pembelajaran yang fleksibel,
                                disesuaikan dengan kebutuhan peserta didik.</p>
                            <ul style="list-style: none; padding: 0;">
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span style="width: 8px; height: 8px; background: #F5B73B; border-radius: 50%; margin-right: 12px;"></span>
                                    Durasi 3 tahun</li>
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span style="width: 8px; height: 8px; background: #F5B73B; border-radius: 50%; margin-right: 12px;"></span>
                                    Ijazah setara SMP</li>
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span style="width: 8px; height: 8px; background: #F5B73B; border-radius: 50%; margin-right: 12px;"></span>
                                    Jadwal fleksibel</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                        <div class="hover-lift"
                            style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-top: 6px solid #172B55;">
                            <div
                                style="width: 64px; height: 64px; background: #172B55; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F5B73B" stroke-width="2">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                                </svg>
                            </div>
                            <h3 style="font-size: 26px; font-weight: 600; color: #172B55; margin-bottom: 16px;">Paket C (Setara
                                SMA)</h3>
                            <p style="line-height: 1.8; color: #2C3E50; margin-bottom: 20px;">Program pendidikan kesetaraan
                                tingkat SMA dengan pilihan jurusan IPA dan IPS, dilengkapi dengan pelatihan keterampilan untuk
                                mempersiapkan masa depan yang lebih baik.</p>
                            <ul style="list-style: none; padding: 0;">
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span
                                        style="width: 8px; height: 8px; background: #172B55; border-radius: 50%; margin-right: 12px;"></span>
                                    Durasi 3 tahun</li>
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span
                                        style="width: 8px; height: 8px; background: #172B55; border-radius: 50%; margin-right: 12px;"></span>
                                    Ijazah setara SMA</li>
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span
                                        style="width: 8px; height: 8px; background: #172B55; border-radius: 50%; margin-right: 12px;"></span>
                                    Jurusan IPS</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 80px 24px; background: linear-gradient(135deg, #172B55 0%, #2a4a7f 100%);">
        <div style="max-width: 1280px; margin: 0 auto;">
            <h2 class="section-title"
                style="font-size: 42px; font-weight: 700; margin-bottom: 48px; text-align: center; color: #FAFFFE;">
                Testimoni</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px;">
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100">
                    <div
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);" class="hover-lift">
                        <div style="display: flex; gap: 16px; margin-bottom: 20px; align-items: center;">
                            <div
                                style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #F5B73B, #e5a722); display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: white;">
                                A
                            </div>
                            <div>
                                <h4 style="font-size: 18px; font-weight: 600; color: #172B55; margin-bottom: 4px;">Andi
                                    Setiawan</h4>
                                <p style="font-size: 14px; color: #2C3E50;">Alumni Paket C 2023</p>
                            </div>
                        </div>
                        <p style="color: #2C3E50; line-height: 1.8; font-style: italic;">"PKBM Hayati Nusantara memberikan
                            kesempatan kedua untuk saya melanjutkan pendidikan. Sekarang saya bisa kuliah dan meraih
                            cita-cita saya. Terima kasih atas dukungan luar biasa dari para guru!"</p>
                    </div>
                </div>
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">

                    <div class="hover-lift"
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                        <div style="display: flex; gap: 16px; margin-bottom: 20px; align-items: center;">
                            <div
                                style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #172B55, #2a4a7f); display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: white;">
                                S
                            </div>
                            <div>
                                <h4 style="font-size: 18px; font-weight: 600; color: #172B55; margin-bottom: 4px;">Siti
                                    Nurhaliza</h4>
                                <p style="font-size: 14px; color: #2C3E50;">Siswa Paket C</p>
                            </div>
                        </div>
                        <p style="color: #2C3E50; line-height: 1.8; font-style: italic;">"Jadwal belajar yang fleksibel
                            memungkinkan saya untuk tetap bekerja sambil sekolah. Guru-gurunya sangat perhatian dan metode
                            pembelajarannya sangat menarik. Saya sangat senang belajar di sini!"</p>
                    </div>
                </div>
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="300">

                    <div class="hover-lift"
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                        <div style="display: flex; gap: 16px; margin-bottom: 20px; align-items: center;">
                            <div
                                style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #F5B73B, #e5a722); display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: white;">
                                B
                            </div>
                            <div>
                                <h4 style="font-size: 18px; font-weight: 600; color: #172B55; margin-bottom: 4px;">Budi
                                    Santoso</h4>
                                <p style="font-size: 14px; color: #2C3E50;">Alumni Paket B 2022</p>
                            </div>
                        </div>
                        <p style="color: #2C3E50; line-height: 1.8; font-style: italic;">"Keterampilan yang saya pelajari di
                            ekstrakurikuler tata boga sangat berguna. Sekarang saya sudah punya usaha catering
                            kecil-kecilan. Terima kasih PKBM Hayati Nusantara!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="kontak" style="padding: 80px 24px; background: #FAFFFE;">
        <div style="max-width: 1280px; margin: 0 auto;">
            <h2 class="section-title"
                style="font-size: 42px; font-weight: 700; margin-bottom: 48px; text-align: center; color: #172B55;">
                Hubungi Kami</h2>
            <div class="row">

                <div class="col-md-6 mb-3">
                    <h3 style="font-size: 24px; font-weight: 600; color: #172B55; margin-bottom: 24px;">Informasi Kontak
                    </h3>
                    <div style="margin-bottom: 20px; display: flex; align-items: start; gap: 16px;">
                        <div
                            style="width: 40px; height: 40px; background: #F5B73B; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            📍
                        </div>
                        <div>
                            <p style="font-weight: 600; color: #172B55; margin-bottom: 4px;">Alamat</p>
                            <p style="color: #2C3E50; line-height: 1.7;">
                                <a href="https://maps.app.goo.gl/vgTTDsvXMTqMqZAL6" target="_blank" class="text-reset">
                                    Kp. Ciawitali RT.17 RW.09, Desa Cijengkol,
                                    Kecamatan Serangpanjang, Kabupaten Subang, Jawa Barat
                                </a>
                            </p>
                        </div>
                    </div>
                    <div style="margin-bottom: 20px; display: flex; align-items: start; gap: 16px;">
                        <div
                            style="width: 40px; height: 40px; background: #F5B73B; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            📞
                        </div>
                        <div>
                            <p style="font-weight: 600; color: #172B55; margin-bottom: 4px;">Telepon/Whatsapp</p>
                            <p style="color: #2C3E50; line-height: 1.7;">
                                <a class="text-reset" href="https://api.whatsapp.com/send?phone=6282115896770&text=Halo%2C%20saya%20ingin%20daftar%20dengan%20di%20PKBM%20Hayati%20Nusantara." target="_blank">0821-1589-6770</a>

                            </p>
                        </div>
                    </div>
                    <div style="margin-bottom: 32px; display: flex; align-items: start; gap: 16px;">
                        <div
                            style="width: 40px; height: 40px; background: #F5B73B; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            ✉️
                        </div>
                        <div>
                            <p style="font-weight: 600; color: #172B55; margin-bottom: 4px;">Email</p>
                            <p style="color: #2C3E50; line-height: 1.7;">
                                <a href="mailto:pkbmhayatinusantara@gmail.com" target="_blank" class="text-reset">pkbmhayatinusantara@gmail.com</a>
                            </p>
                        </div>
                    </div>
                    <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3962.829711085634!2d107.62107999999999!3d-6.668012999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwNDAnMDQuOSJTIDEwN8KwMzcnMTUuOSJF!5e0!3m2!1sid!2sid!4v1769816137134!5m2!1sid!2sid"
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <h3 style="font-size: 24px; font-weight: 600; color: #172B55; margin-bottom: 24px;">Kirim Pesan</h3>
                    <form id="contact-form" style="display: flex; flex-direction: column; gap: 20px;">
                        <div><label for="name"
                                style="display: block; font-weight: 500; color: #172B55; margin-bottom: 8px;">Nama
                                Lengkap</label> <input type="text" id="name" required=""
                                style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                onfocus="this.style.borderColor='#F5B73B'" onblur="this.style.borderColor='#e0e0e0'">
                        </div>
                        <div><label for="email"
                                style="display: block; font-weight: 500; color: #172B55; margin-bottom: 8px;">Email</label>
                            <input type="email" id="email" required=""
                                style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                onfocus="this.style.borderColor='#F5B73B'" onblur="this.style.borderColor='#e0e0e0'">
                        </div>
                        <div><label for="message"
                                style="display: block; font-weight: 500; color: #172B55; margin-bottom: 8px;">Pesan</label>
                            <textarea id="message" rows="5" required=""
                                style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; resize: vertical; transition: border-color 0.3s;"
                                onfocus="this.style.borderColor='#F5B73B'"
                                onblur="this.style.borderColor='#e0e0e0'"></textarea>
                        </div><button type="submit" class="btn-primary"
                            style="padding: 16px 32px; border-radius: 10px; border: none; cursor: pointer; font-weight: 600; font-size: 16px; width: 100%;">Kirim
                            Pesan</button>
                    </form>
                    <div id="form-message" style="margin-top: 16px; padding: 12px; border-radius: 8px; display: none;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer style="background: #172B55; color: #FAFFFE; padding: 48px 24px 24px;">
        <div style="max-width: 1280px; margin: 0 auto;">
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">
                <div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #F5B73B;">PKBM Hayati
                        Nusantara</h3>
                    <div>
                        <small>NPSN : P9999412</small>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <small>Izin Operasional : PK.01.01/KEP-0001/DPMPTSP/2024</small>
                    </div>

                    <p style="line-height: 1.8; opacity: 0.9;">Memberikan akses pendidikan berkualitas untuk semua
                        dengan program kesetaraan yang fleksibel dan berorientasi pada masa depan.</p>
                </div>
                <div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #F5B73B;">Link Cepat</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <a class="page-scroll" href="#beranda"
                            style="color: rgb(250, 255, 254); text-decoration: none; opacity: 0.9; transition: opacity 0.3s;"
                            onmouseover="this.style.opacity='1'; this.style.color='#F5B73B'"
                            onmouseout="this.style.opacity='0.9'; this.style.color='#FAFFFE'">Beranda</a>
                        <a class="page-scroll" href="#tentang"
                            style="color: #FAFFFE; text-decoration: none; opacity: 0.9; transition: opacity 0.3s;"
                            onmouseover="this.style.opacity='1'; this.style.color='#F5B73B'"
                            onmouseout="this.style.opacity='0.9'; this.style.color='#FAFFFE'">Tentang Kami</a>
                        <a class="page-scroll" href="#program"
                            style="color: #FAFFFE; text-decoration: none; opacity: 0.9; transition: opacity 0.3s;"
                            onmouseover="this.style.opacity='1'; this.style.color='#F5B73B'"
                            onmouseout="this.style.opacity='0.9'; this.style.color='#FAFFFE'">Program</a>
                        <a class="page-scroll" href="#kontak"
                            style="color: #FAFFFE; text-decoration: none; opacity: 0.9; transition: opacity 0.3s;"
                            onmouseover="this.style.opacity='1'; this.style.color='#F5B73B'"
                            onmouseout="this.style.opacity='0.9'; this.style.color='#FAFFFE'">Kontak</a>
                    </div>
                </div>
                <div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #F5B73B;">Pembelajaran </h3>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <a class="page-scroll" href="<?= base_url('materials'); ?>"
                            style="color: rgb(250, 255, 254); text-decoration: none; opacity: 0.9; transition: opacity 0.3s;"
                            onmouseover="this.style.opacity='1'; this.style.color='#F5B73B'"
                            onmouseout="this.style.opacity='0.9'; this.style.color='#FAFFFE'">Materi</a>
                        <a class="page-scroll" href="<?= base_url('assignments'); ?>"
                            style="color: #FAFFFE; text-decoration: none; opacity: 0.9; transition: opacity 0.3s;"
                            onmouseover="this.style.opacity='1'; this.style.color='#F5B73B'"
                            onmouseout="this.style.opacity='0.9'; this.style.color='#FAFFFE'">Tugas</a>
                    </div>
                </div>
            </div>
            <div
                style="border-top: 1px solid rgba(245,183,59,0.3); padding-top: 24px; text-align: center; opacity: 0.9;">
                <p>© 2026 PKBM Hayati Nusantara. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>



    <script src="<?= asset_url(); ?>assets/frontend/js/jquery-3.5.1.min.js"></script>
    <script src="<?= asset_url(); ?>assets/frontend/js/jquery.easing.1.3.js"></script>
    <script src="<?= asset_url(); ?>assets/frontend/js/popper.min.js"></script>
    <script src="<?= asset_url(); ?>assets/frontend/js/bootstrap.min.js"></script>

    <script src="<?= asset_url(); ?>assets/frontend/js/aos.js"></script>

    <script>
        AOS.init({
            once: true
        });


        $('.page-scroll').on('click', function(e) {
            const tujuan = $(this).attr('href');
            const elemenTujuan = $(tujuan);
            // console.log(elemenTujuan);
            // $('body').scrollTop(elemenTujuan.offset().top);

            $('html, body').animate({
                scrollTop: elemenTujuan.offset().top - 55
            }, 1250);


            e.preventDefault();
        })
    </script>
    <script>
        document.getElementById("contact-form").addEventListener("submit", function(e) {
            e.preventDefault();

            const nama = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const pesan = document.getElementById("message").value;


            // const emailTo = "pkbmhayatinusantara@gmail.com";
            // const subject = encodeURIComponent("Halo");
            // const body = encodeURIComponent(
            //     "Nama: " + nama + "\n" +
            //     "Email: " + email + "\n\n" +
            //     "Pesan:\n" + pesan
            // );

            // const mailtoLink = `mailto:${emailTo}?subject=${subject}&body=${body}`;

            // window.location.href = mailtoLink;

            const phone = "6282115896770"; // ganti nomor tujuan

            const text =
                "Halo..%0A%0A" +
                "Nama: " + nama + "%0A" +
                "Email: " + email + "%0A%0A" +
                "Pesan:%0A" + pesan;

            const waLink = `https://api.whatsapp.com/send?phone=${phone}&text=${text}`;

            window.open(waLink, "_blank");
        });
    </script>
</body>

</html>