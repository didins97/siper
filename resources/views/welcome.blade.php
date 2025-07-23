<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Shuffle Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('FE') }}/img/favicon.png" rel="icon">
    <link href="{{ asset('FE') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('FE') }}/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('FE') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('FE') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('FE') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('FE') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('FE') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('FE') }}/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Shuffle
  * Template URL: https://bootstrapmade.com/bootstrap-3-one-page-template-free-shuffle/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- CSS for Floating WhatsApp Button -->
    <style>
        .whatsapp-floating {
            position: fixed;
            bottom: 15px;
            right: 15px;
            background-color: #25D366;
            color: white;
            font-size: 14px;
            padding: 10px 15px;
            border-radius: 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            text-decoration: none;
            z-index: 1000;
            transition: background-color 0.3s;
        }

        .whatsapp-floating:hover {
            background-color: #128C7E;
        }

        .whatsapp-floating i {
            font-size: 20px;
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <!-- Slide 1 -->
                    <div class="carousel-item active"
                        style="background-image: url({{ asset('FE') }}/img/slide/slide-1.jpg);">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Selamat Datang Di <span>Punggawa
                                        Digital Printing</span></h2>
                                <p class="animate__animated animate__fadeInUp">Punggawa Digital Printing adalah solusi
                                    terbaik untuk semua kebutuhan cetak Anda. Kami menyediakan layanan cetak berkualitas
                                    tinggi dengan harga terjangkau.</p>

                                @if (!Auth::check())
                                    <a href="{{ route('register') }}"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Daftar</a>
                                    <a href="{{ route('login') }}"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Masuk</a>
                                @else
                                    <a href="
                                    @switch(auth()->user()->role)
                                        @case('admin')
                                            {{ route('admin.dashboard') }}
                                            @break
                                        @case('user')
                                            {{ route('user.dashboard') }}
                                            @break
                                        @case('operator')
                                            {{ route('operator.dashboard') }}
                                            @break
                                        @default
                                            {{ route('user.dashboard') }}
                                    @endswitch
                                    "
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Dashboard</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item"
                        style="background-image: url({{ asset('FE') }}/img/slide/slide-2.jpg);">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Keunggulan Layanan Kami</h2>
                                <p class="animate__animated animate__fadeInUp">Kami menawarkan layanan cetak dengan
                                    kualitas terbaik, kecepatan pengerjaan, dan harga yang kompetitif.</p>

                                @if (!Auth::check())
                                    <a href="{{ route('register') }}"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Daftar</a>
                                    <a href="{{ route('login') }}"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Masuk</a>
                                @else
                                    <a href="
                                    @switch(auth()->user()->role)
                                        @case('admin')
                                            {{ route('admin.dashboard') }}
                                            @break
                                        @case('user')
                                            {{ route('user.dashboard') }}
                                            @break
                                        @case('operator')
                                            {{ route('operator.dashboard') }}
                                            @break
                                        @default
                                            {{ route('user.dashboard') }}
                                    @endswitch
                                    "
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Dashboard</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item"
                        style="background-image: url({{ asset('FE') }}/img/slide/slide-3.jpg);">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Solusi Cetak Terlengkap</h2>
                                <p class="animate__animated animate__fadeInUp">Dari cetak brosur hingga baliho, kami
                                    siap memenuhi kebutuhan cetak Anda dengan layanan profesional.</p>

                                @if (!Auth::check())
                                    <a href="{{ route('register') }}"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Daftar</a>
                                    <a href="{{ route('login') }}"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Masuk</a>
                                @else
                                    <a href="
                                    @switch(auth()->user()->role)
                                        @case('admin')
                                            {{ route('admin.dashboard') }}
                                            @break
                                        @case('user')
                                            {{ route('user.dashboard') }}
                                            @break
                                        @case('operator')
                                            {{ route('operator.dashboard') }}
                                            @break
                                        @default
                                            {{ route('user.dashboard') }}
                                    @endswitch
                                    "
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Dashboard</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>


                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-double-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-double-right" aria-hidden="true"></span>
                </a>

            </div>
        </div>
    </section><!-- End Hero -->

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1 class="text-light"><a href="index.html"><span>Punggawa</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="{{ asset('FE') }}/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
                    <li><a class="nav-link scrollto" href="#portfolio">Produk</a></li>
                    <li><a class="nav-link scrollto" href="#team">Tim</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>Tentang Kami</h2>
                    <p>Kami adalah perusahaan percetakan yang berkomitmen untuk memberikan layanan terbaik dengan hasil
                        cetakan berkualitas tinggi. Dengan pengalaman bertahun-tahun, kami siap membantu Anda dari
                        konsep hingga hasil akhir.</p>
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <img src="{{ asset('FE') }}/img/about.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Counts Section ======= -->
        <section class="counts section-bg">
            <div class="container">

                <div class="row no-gutters">

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="bi bi-emoji-smile"></i>
                            <span data-purecounter-start="0" data-purecounter-end="200" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Pelanggan Puas</strong> yang mempercayakan kebutuhan cetak kepada kami</p>
                            <a href="#">Pelajari lebih lanjut &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="450" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Proyek Cetak</strong> yang telah berhasil kami selesaikan dengan hasil memuaskan
                            </p>
                            <a href="#">Pelajari lebih lanjut &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="bi bi-headset"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1000"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>Jam Dukungan</strong> pelanggan yang selalu siap membantu kapan saja</p>
                            <a href="#">Pelajari lebih lanjut &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Tim Profesional</strong> yang bekerja keras untuk hasil cetakan terbaik</p>
                            <a href="#">Pelajari lebih lanjut &raquo;</a>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->


        <!-- ======= Layanan Kami Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>Layanan Kami</h2>
                    <p>Kami menawarkan berbagai layanan percetakan yang siap membantu kebutuhan cetak Anda dengan
                        kualitas terbaik dan harga yang kompetitif. Lihat layanan unggulan kami di bawah ini:</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-printer"></i></div>
                            <h4 class="title"><a href="#">Percetakan Digital</a></h4>
                            <p class="description">Layanan percetakan cepat dan tepat untuk berbagai keperluan seperti
                                brosur, pamflet, dan dokumen lainnya.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-book"></i></div>
                            <h4 class="title"><a href="#">Percetakan Buku</a></h4>
                            <p class="description">Kami menyediakan layanan pencetakan buku dengan berbagai pilihan
                                ukuran, jenis kertas, dan jilid.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-paint"></i></div>
                            <h4 class="title"><a href="#">Desain Grafis</a></h4>
                            <p class="description">Kami membantu Anda menciptakan desain yang menarik untuk kebutuhan
                                branding, logo, dan materi promosi.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-package"></i></div>
                            <h4 class="title"><a href="#">Pencetakan Merchandise</a></h4>
                            <p class="description">Cetak kaos, mug, dan merchandise lainnya dengan desain kustom untuk
                                promosi bisnis atau acara spesial.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Layanan Kami Section -->


        <!-- ======= Cta Section ======= -->
        <section class="cta">
            <div class="container">

                <div class="text-center">
                    <h3>Butuh Layanan Percetakan Cepat?</h3>
                    <p>Hubungi kami sekarang dan dapatkan penawaran terbaik untuk kebutuhan cetak Anda! Kami siap
                        membantu mencetak segala kebutuhan Anda dengan cepat, berkualitas, dan terjangkau.</p>
                    <a class="cta-btn" href="#">Hubungi Kami Sekarang</a>
                </div>

            </div>
        </section><!-- End Cta Section -->


        <!-- ======= Layanan Lainnya Section ======= -->
        <section class="more-services section-bg">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="card">
                            <img src="{{ asset('FE') }}/img/more-service-1.jpg" class="card-img-top"
                                alt="Percetakan Poster">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#">Percetakan Poster</a></h5>
                                <p class="card-text">Kami menyediakan layanan percetakan poster dengan kualitas cetak
                                    tajam, cocok untuk promosi atau dekorasi.</p>
                                <a href="#" class="btn">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="card">
                            <img src="{{ asset('FE') }}/img/more-service-2.jpg" class="card-img-top"
                                alt="Percetakan Kalender">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#">Percetakan Kalender</a></h5>
                                <p class="card-text">Dapatkan kalender kustom untuk promosi bisnis atau keperluan
                                    pribadi dengan berbagai desain menarik.</p>
                                <a href="#" class="btn">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="card">
                            <img src="{{ asset('FE') }}/img/more-service-3.jpg" class="card-img-top"
                                alt="Percetakan Kartu Nama">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#">Percetakan Kartu Nama</a></h5>
                                <p class="card-text">Buat kartu nama profesional dengan berbagai pilihan desain dan
                                    bahan cetakan yang sesuai dengan kebutuhan Anda.</p>
                                <a href="#" class="btn">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Layanan Lainnya Section -->


        <!-- ======= Info Box Section ======= -->
        <section class="info-box py-0">
            <div class="container-fluid">

                <div class="row">

                    <div
                        class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">

                        <div class="content">
                            <h3>Solusi Cetak <strong>Profesional dan Terjangkau</strong></h3>
                            <p>
                                Kami menyediakan layanan cetak yang berkualitas tinggi untuk berbagai kebutuhan Anda,
                                mulai dari cetak poster, kartu nama, hingga brosur dan booklet. Nikmati kemudahan
                                memesan secara online melalui sistem informasi percetakan kami.
                            </p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse"
                                        data-bs-target="#accordion-list-1"><span>01</span> Bagaimana cara memesan
                                        cetakan? <i class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show"
                                        data-bs-parent=".accordion-list">
                                        <p>
                                            Cukup login ke sistem kami, pilih jenis cetakan yang Anda butuhkan, unggah
                                            file desain, dan pilih metode pembayaran. Pesanan Anda akan diproses segera
                                            setelah konfirmasi.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2"
                                        class="collapsed"><span>02</span> Apa saja jenis produk cetak yang tersedia? <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Kami menawarkan berbagai produk cetak, seperti poster, kartu nama, banner,
                                            brosur, booklet, stiker, dan masih banyak lagi. Semua dapat disesuaikan
                                            dengan kebutuhan Anda.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3"
                                        class="collapsed"><span>03</span> Berapa lama waktu pengerjaan cetak? <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Waktu pengerjaan tergantung pada jenis produk dan jumlah pesanan. Namun,
                                            kami berkomitmen untuk memberikan layanan cepat dengan kualitas terbaik,
                                            biasanya dalam waktu 1-3 hari kerja.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style="background-image: url({{ asset('FE') }}/img/printing-info.jpg);">&nbsp;</div>
                </div>

            </div>
        </section><!-- End Info Box Section -->


        <!-- ======= Our Portfolio Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Produk Kami</h2>
                    <p>Kami menawarkan berbagai produk percetakan berkualitas tinggi untuk memenuhi kebutuhan bisnis dan
                        pribadi Anda. Dari kartu nama hingga kalender, semua produk kami dicetak dengan teknologi
                        terbaik untuk hasil maksimal.</p>

                </div>

                <div class="row portfolio-container">

                    @foreach ($featuredProduct as $item)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-poster">
                            <div class="portfolio-wrap">
                                @php
                                    $imagePath = public_path('storage/images/products/' . $item->image);
                                    $imageUrl = $imageUrl = \Illuminate\Support\Facades\File::exists($imagePath)
                                        ? asset('storage/images/products/' . $item->image)
                                        : asset('assets/img/noimage.jpg');
                                @endphp
                                <img src="{{ $imageUrl }}" class="img-fluid"
                                    alt="Poster">
                                <div class="portfolio-info">
                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ $item->desc }}</p>
                                </div>
                                <div class="portfolio-links">
                                    <a href="{{ $imageUrl }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox"
                                        title="Poster Promosi"><i class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </section><!-- End Our Portfolio Section -->

        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team">
            <div class="container">

                <div class="section-title">
                    <h2>Tim Kami</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="member">
                            <img src="{{ asset('FE') }}/img/team/team-1.jpg" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Walter White</h4>
                                    <span>Chief Executive Officer</span>
                                </div>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6" data-wow-delay="0.1s">
                        <div class="member">
                            <img src="{{ asset('FE') }}/img/team/team-2.jpg" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Sarah Jhonson</h4>
                                    <span>Product Manager</span>
                                </div>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6" data-wow-delay="0.2s">
                        <div class="member">
                            <img src="{{ asset('FE') }}/img/team/team-3.jpg" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>William Anderson</h4>
                                    <span>CTO</span>
                                </div>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6" data-wow-delay="0.3s">
                        <div class="member">
                            <img src="{{ asset('FE') }}/img/team/team-4.jpg" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Amanda Jepson</h4>
                                    <span>Accountant</span>
                                </div>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Our Team Section -->

        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact section-bg">

            <div class="container">
                <div class="section-title">
                    <h2>Contact Us</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-6 d-flex align-items-stretch infos">

                        <div class="row">

                            <div class="col-lg-6 info d-flex flex-column align-items-stretch">
                                <i class="bx bx-map"></i>
                                <h4>Address</h4>
                                <p>A108 Adam Street,<br>New York, NY 535022</p>
                            </div>
                            <div class="col-lg-6 info info-bg d-flex flex-column align-items-stretch">
                                <i class="bx bx-phone"></i>
                                <h4>Call Us</h4>
                                <p>+1 5589 55488 55<br>+1 5589 22548 64</p>
                            </div>
                            <div class="col-lg-6 info info-bg d-flex flex-column align-items-stretch">
                                <i class="bx bx-envelope"></i>
                                <h4>Email Us</h4>
                                <p>contact@example.com<br>info@example.com</p>
                            </div>
                            <div class="col-lg-6 info d-flex flex-column align-items-stretch">
                                <i class="bx bx-time-five"></i>
                                <h4>Working Hours</h4>
                                <p>Mon - Fri: 9AM to 5PM<br>Sunday: 9AM to 1PM</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 d-flex align-items-stretch contact-form-wrap">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label for="email">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" rows="8" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Us Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>Percetakan XYZ</h3>
                        <p>
                            Jl. Contoh No.123<br>
                            Jakarta, Indonesia<br><br>
                            <strong>Phone:</strong> +62 8123 4567 890<br>
                            <strong>Email:</strong> info@percetakanxyz.com<br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Link Berguna</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Beranda</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang Kami</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Layanan</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Portofolio</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Kebijakan Privasi</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Layanan Kami</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Desain Grafis</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Percetakan Digital</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Percetakan Offset</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Pembuatan Brosur</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Pembuatan Spanduk</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Newsletter Kami</h4>
                        <p>Dapatkan informasi terbaru dan penawaran spesial dari kami dengan berlangganan newsletter.
                        </p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Langganan">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Shuffle</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootstrap-3-one-page-template-free-shuffle/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->


    <a href="https://wa.me/081243934985?text=Halo Punggawa Digital" class="whatsapp-floating" target="_blank">
        <i class="bx bxl-whatsapp"></i> Order via WhatsApp
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('FE') }}/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('FE') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('FE') }}/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('FE') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('FE') }}/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('FE') }}/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="{{ asset('FE') }}/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('FE') }}/js/main.js"></script>

</body>

</html>
