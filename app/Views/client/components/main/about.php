    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Tentang Kami</h2>
                <p>PT.BENDERA NUSANTARA LOGISTIK adalah perusahaan yang bergerak dalam bidang usaha jasa angkutan barang dengan tujuan seluruh Propinsi dan Kabupaten yang ada di Indonesia, serta melayani pengiriman barang dan dokumen ke luar negeri. Saat ini kami menguasai hampir 100% daerah tujuan pengiriman barang di Indonesia, dari Sabang sampai Merauke.</p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <h3>VISI & MISI</h3>
                    <div class="slides swiper rounded-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            <?php foreach ($clients['slider'] as $slider) : ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item">
                                            <div class="d-flex align-items-center">
                                                <img src="<?= $slider['path'] ?>" class="testimonial-img flex-shrink-0 img-fluid" alt="">
                                                <div>
                                                    <h3><?php // echo $slider['created_at'] ?></h3>
                                                    <h4>Ceo &amp; Founder</h4>
                                                    <div class="stars">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                <i class="bi bi-quote quote-icon-left"></i>
                                                <?= $slider['path_description'] ?>
                                                <i class="bi bi-quote quote-icon-right"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            <?php endforeach ?>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <p>Memajukan dan mengembangkan perusahaan jasa titipan / cargo dengan manajemen resiko yang handal, terkemuka dan dipercaya oleh masyarakat di seluruh Indonesia, serta mensejahterakan masyarakat kurang mampu dan akan membangun sarana penunjang cargo yang dapat terintegrasi dengan aplikasi, untuk memudahkan pelanggan dalam menctracking barang yang dititipkan kepada kami sehingga meningkatkan kepercayaan masyarakat kepada kami..</p>
                    <p>Anda Bisa mempercayakan bersama kami keamanan dan ketepatan waktu pengiriman</p>
                </div>
                <div class="col-lg-6">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            Berikut beberapa misi kami :
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> Menyediakan produk jasa angkutan/titipan ke seluruh pelosok tanah air dengan mengutamakan kepuasan pelanggan.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Menyelenggarakan kegiatan usaha yang menciptakan iklim kerja yang kondusif bagi komunitas perusahaan untuk berkonstribusi secara maksimal demi pertumbuhan dan kelangsungan hidup perusahaan.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Berperan serta dalam usaha pengembangan ekonomi nasional.</li>
                        </ul>
                        <p>
                            dan tentunya membuka lapangan kerja bagi masyarakat luas, terutama masyarakat menengah kebawah dengan penghasilan minimal sesuai ketentuan Pemerintah.
                        </p>

                        <div class="position-relative mt-4">
                            <img src="<?= base_url($url . '/img_own/a5.jpg') ?>" class="img-fluid rounded-4" alt="">
                            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->