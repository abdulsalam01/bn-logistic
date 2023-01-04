    <!-- ======= Header ======= -->
    <section id="topbar" class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">cs@bnlogistik.co.id</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>Pamekasan : 0811 900 222 90 - Bandung : 0811 900 222 80</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section><!-- End Top Bar -->

    <header id="header" class="header d-flex align-items-center">

        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="<?= base_url('/') ?>" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="<?= base_url($url . '/img_own/a1.png') ?>" alt="">
                <!-- <h1>PT. BNL<span>.</span></h1> -->
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="<?= base_url('/') ?>">Home</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#portfolio">Portofolio</a></li>
                    <li><a href="#team">Team</a></li>
                    <li class="dropdown"><a href="#"><span>Cabang</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <?php foreach($data[2] as $branch): ?>
                                <li>
                                    <a href="#"><?=$branch['name']?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                </ul>
            </nav><!-- .navbar -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->
    <!-- End Header -->