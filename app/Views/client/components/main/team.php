    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Team</h2>
                <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
            </div>

            <div class="row gy-4">

                <?php foreach($clients['team'] as $team): ?>
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <img src="<?= $team['path'] ?>" class="img-fluid" alt="">
                            <h4><?= $team['name'] ?></h4>
                            <span><?= $team['role'] ?></span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                <?php endforeach ?>

            </div>

        </div>
    </section><!-- End Our Team Section -->