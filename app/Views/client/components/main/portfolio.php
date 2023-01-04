    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Portfolio</h2>
                <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem uia reprehenderit sunt deleniti</p>
            </div>

            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                <div>
                    <ul class="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <?php foreach ($enum['portfolio'] as $elem) : ?>
                            <li data-filter=".<?= $elem ?>"><?= ucfirst($elem) ?></li>
                        <?php endforeach ?>
                    </ul><!-- End Portfolio Filters -->
                </div>

                <div class="row gy-4 portfolio-container">

                    <?php foreach ($clients['portfolio'] as $portfolio) : ?>
                        <div class="col-xl-4 col-md-6 portfolio-item <?= $portfolio['type']?>">
                            <div class="portfolio-wrap">
                                <a href="<?= $portfolio['path'] ?>" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= $portfolio['path'] ?>" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="#" title="More Details"><?= $portfolio['title']?></a></h4>
                                    <p><?= $portfolio['description'] ?></p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                    <?php endforeach ?>

                </div><!-- End Portfolio Container -->

            </div>

        </div>
    </section><!-- End Portfolio Section -->