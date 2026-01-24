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
                        src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgjPZsGn5j_amemJB29prRMzCEZofearpQMoZmPSXYHHTkApJdia_7iErvu03J2sR8nsVkjCwoTSSM0wg12o18V65P269bhI82VgryKCN15vIOoYi8xhSgjR2f2EPqRhoNZSxERCKIskQ3GOXoDfED0TwV9DMMS5Bgaz5AUGrpCl9lgpmrJGnQUN7LQ9QI/w1684-h1069-p-k-no-nu/Desain%20tanpa%20judul%20(1).png"
                        alt="Logo PKBM Hayati Nusantara" style="height: 50px; width: auto;"
                        onerror="this.src=''; this.alt='Logo PKBM Hayati Nusantara'; this.style.display='none';">
                    <div>
                        <div id="nav-title" style="font-size: 20px; font-weight: 700; color: #FAFFFE;">
                            PKBM Hayati Nusantara
                        </div>
                        <div style="font-size: 12px; color: #F5B73B;">
                            Pendidikan Berkualitas
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
        <div class="gradient-overlay"
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
                        <p style="line-height: 1.8; color: #2C3E50;">Menjadi pusat kegiatan belajar masyarakat yang unggul,
                            inovatif, dan berkarakter, serta memberikan layanan pendidikan kesetaraan yang berkualitas untuk
                            membentuk generasi yang cerdas, terampil, dan berakhlak mulia.</p>
                    </div>
                </div>
                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="300">

                    <div class="hover-lift"
                        style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <h3 id="mission-title"
                            style="font-size: 24px; font-weight: 600; color: #172B55; margin-bottom: 16px;">Misi</h3>
                        <ul style="line-height: 1.8; color: #2C3E50; padding-left: 20px;">
                            <li>Menyelenggarakan pendidikan kesetaraan yang berkualitas</li>
                            <li>Mengembangkan keterampilan hidup yang aplikatif</li>
                            <li>Membentuk karakter yang berintegritas</li>
                            <li>Memberikan pelayanan pendidikan yang fleksibel</li>
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
                        src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgGqsyUYUiR51MHBmRJbcshLQtyt2tfkFtEolb5Cx0hJvR1Fw8r4w-7ZdNVTQYQ6Ab8tw3ClYdfrZnHk0h9osFSkXcKD0BPsGpnS6QsZOWOHnVNxNQ7G_7wKf6ERGVRQvqDZ0X8OBGj91BNbYVFex2Kju9BZfD_YASD2mV6YFzEVmyx_dEiBTQmfvSWGWg/s320/wawan%20ridwan.png"
                        alt="Kepala Sekolah"
                        style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; border: 6px solid #F5B73B; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"
                        onerror="this.src=''; this.alt='Kepala Sekolah'; this.style.display='none';">
                    <div style="flex: 1; min-width: 300px;" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                        <p style="line-height: 1.9; color: #2C3E50; margin-bottom: 24px; font-size: 16px;">
                            Assalamu'alaikum Warahmatullahi Wabarakatuh. Selamat datang di PKBM Hayati Nusantara. Kami
                            berkomitmen untuk memberikan pendidikan berkualitas yang dapat mengubah kehidupan dan
                            membuka peluang masa depan yang lebih cerah bagi setiap peserta didik kami.</p>
                        <p id="principal-name" style="font-weight: 600; color: #172B55; font-size: 18px;">Wawan Ridwan,
                            S.Pd., M.M.</p>
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
                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100">
                        <div class="hover-lift"
                            style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-top: 6px solid #F5B73B;">
                            <div
                                style="width: 64px; height: 64px; background: #F5B73B; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
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
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span
                                        style="width: 8px; height: 8px; background: #F5B73B; border-radius: 50%; margin-right: 12px;"></span>
                                    Durasi 3 tahun</li>
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span
                                        style="width: 8px; height: 8px; background: #F5B73B; border-radius: 50%; margin-right: 12px;"></span>
                                    Ijazah setara SMP</li>
                                <li style="padding: 8px 0; color: #2C3E50; display: flex; align-items: center;"><span
                                        style="width: 8px; height: 8px; background: #F5B73B; border-radius: 50%; margin-right: 12px;"></span>
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
                                    Jurusan IPA &amp; IPS</li>
                            </ul>
                        </div>

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
                            <p style="color: #2C3E50; line-height: 1.7;">Kp. Ciawitali RT.17 RW.09, Desa Cijengkol,
                                Kecamatan Serangpanjang, Kabupaten Subang, Jawa Barat</p>
                        </div>
                    </div>
                    <div style="margin-bottom: 20px; display: flex; align-items: start; gap: 16px;">
                        <div
                            style="width: 40px; height: 40px; background: #F5B73B; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            📞
                        </div>
                        <div>
                            <p style="font-weight: 600; color: #172B55; margin-bottom: 4px;">Telepon</p>
                            <p style="color: #2C3E50; line-height: 1.7;">(021) 1234-5678</p>
                        </div>
                    </div>
                    <div style="margin-bottom: 32px; display: flex; align-items: start; gap: 16px;">
                        <div
                            style="width: 40px; height: 40px; background: #F5B73B; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            ✉️
                        </div>
                        <div>
                            <p style="font-weight: 600; color: #172B55; margin-bottom: 4px;">Email</p>
                            <p style="color: #2C3E50; line-height: 1.7;">info@pkbmhayatinusantara.sch.id</p>
                        </div>
                    </div>
                    <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d34928.91194662046!2d107.64946225654782!3d-6.719252806994286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e692127cfad688b%3A0xd25ae16439c79cb8!2sYAYASAN%20NUR%20INSANI%20%2F%20PKBM%20NUR%20INSANI!5e0!3m2!1sid!2sid!4v1768669789790!5m2!1sid!2sid"
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
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #F5B73B;">Ikuti Kami</h3>
                    <div style="display: flex; gap: 12px;">
                        <a href="#"
                            style="width: 40px; height: 40px; background: rgba(245,183,59,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px; transition: all 0.3s;"
                            onmouseover="this.style.background='#F5B73B'; this.style.transform='scale(1.1)'"
                            onmouseout="this.style.background='rgba(245,183,59,0.2)'; this.style.transform='scale(1)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                            </svg>
                        </a>
                        <a href="#"
                            style="width: 40px; height: 40px; background: rgba(245,183,59,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px; transition: all 0.3s;"
                            onmouseover="this.style.background='#F5B73B'; this.style.transform='scale(1.1)'"
                            onmouseout="this.style.background='rgba(245,183,59,0.2)'; this.style.transform='scale(1)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                            </svg></a>
                        <a href="#"
                            style="width: 40px; height: 40px; background: rgba(245,183,59,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px; transition: all 0.3s;"
                            onmouseover="this.style.background='#F5B73B'; this.style.transform='scale(1.1)'"
                            onmouseout="this.style.background='rgba(245,183,59,0.2)'; this.style.transform='scale(1)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                            </svg>
                        </a>
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
</body>

</html>