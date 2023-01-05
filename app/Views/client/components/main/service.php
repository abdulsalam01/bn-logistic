    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
        <div class="container text-center" data-aos="zoom-out">
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
            <h3>Call To Action</h3>
            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a class="cta-btn" href="#">Call To Action</a>
        </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Our Services Section ======= -->
    <section id="services" class="services sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Services</h2>
                <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>
            </div>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                <?php foreach($data[0] as $type): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <h3><?= $type['name'] ?></h3>
                            <p><?= $type['description'] ?></p>
                            <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item -->
                <?php endforeach ?>

            </div>

        </div>
    </section><!-- End Our Services Section -->