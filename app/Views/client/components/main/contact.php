    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Hubungi Kami :</h2>
                <p>Kami sebaik mungkin melayani anda. jika ada kritik dan saran seputar pelayanan kami, harap anda mengirimkan Saran ataupun keluhan anda pada kami melalui form di bawah ini :</p>
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-4">

                    <div class="info-container d-flex flex-column align-items-center justify-content-center">
                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>PAMEKASAN</h4>
                                <p>Jl. Jokotole No.122, Murleke, Barurambat Tim., Kec. Pademawu, Kabupaten Pamekasan, Jawa Timur 69321</p>
                                <h4>BANDUNG</h4>
                                <p>Jl. Gatot Subroto No.96, Lkr. Sel., Kec. Lengkong, Kota Bandung, Jawa Barat 40262</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>cs@bnlogistik.co.id</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <p>Pamekasan : 081190022290</p>
                                <p>Bandung : 081190022280</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-clock flex-shrink-0"></i>
                            <div>
                                <h4>Jam Pelayanan:</h4>
                                <p>Setiap Hari , jam 08.00-16.00</p>
                            </div>
                        </div><!-- End Info Item -->
                    </div>

                </div>

                <div class="col-lg-8">
                    <form action="<?= base_url('contact') ?>" method="post" role="form" class="php-email-form">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Pesan Terkirim, silahkan tunggu balasan !</div>
                        </div>
                        <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End Contact Section -->