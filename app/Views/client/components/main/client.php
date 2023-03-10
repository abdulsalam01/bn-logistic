    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-out">

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <?php foreach($data[1] as $client): ?>
                        <div class="swiper-slide"><img src="<?= base_url($url . '/img/clients/client-1.png') ?>" class="img-fluid" alt=""></div>
                    <?php endforeach ?>
                </div>
            </div>

        </div>
    </section><!-- End Clients Section -->
    
    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6">
                    <img src="<?= base_url($url . '/img_own/a3.jpg') ?>" alt="" class="img-fluid-extends">
                </div>

                <div class="col-lg-6">

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Happy Clients</strong> consequuntur quae diredo para mesta</p>
                    </div><!-- End Stats Item -->

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Projects</strong> adipisci atque cum quia aut</p>
                    </div><!-- End Stats Item -->

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="453" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </div>
    </section><!-- End Stats Counter Section -->