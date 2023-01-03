    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Recent Blog Posts</h2>
                <p>Consequatur libero assumenda est voluptatem est quidem illum et officia imilique qui vel architecto accusamus fugit aut qui distinctio</p>
            </div>

            <div class="row gy-4">

                <?php foreach($data[1] as $news) : ?>
                    <div class="col-xl-4 col-md-6">
                        <article>

                            <div class="post-img">
                                <img src="<?= base_url($url . '/img/blog/blog-1.jpg') ?>" alt="" class="img-fluid">
                            </div>

                            <p class="post-category">Politics</p>

                            <h2 class="title">
                                <a href="<?= base_url('news/' . md5($news['id'])) ?>">Dolorum optio tempore voluptas dignissimos</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <img src="<?= base_url($url . '/img/blog/blog-author.jpg') ?>" alt="" class="img-fluid post-author-img flex-shrink-0">
                                <div class="post-meta">
                                    <p class="post-author">Maria Doe</p>
                                    <p class="post-date">
                                        <time datetime="2022-01-01">Jan 1, 2022</time>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                <?php endforeach ?>

            </div><!-- End recent posts list -->

        </div>
    </section><!-- End Recent Blog Posts Section -->