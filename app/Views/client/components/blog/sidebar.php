<div class="sidebar-item search-form">
    <h3 class="sidebar-title">Search</h3>
    <form action="" class="mt-3">
        <input type="text">
        <button type="submit"><i class="bi bi-search"></i></button>
    </form>
</div><!-- End sidebar search formn-->

<div class="sidebar-item categories">
    <h3 class="sidebar-title">Categories</h3>
    <ul class="mt-3">
        <?php foreach ($category as $elem) : ?>
            <li><a href="#"><?= $elem['name'] ?> <span>(<?= $elem['cnt'] ?>)</span></a></li>
        <?php endforeach ?>
    </ul>
</div><!-- End sidebar categories-->

<div class="sidebar-item recent-posts">
    <h3 class="sidebar-title">Recent Posts</h3>

    <div class="mt-3">

        <?php foreach($clients['news'] as $elem): ?>
            <div class="post-item mt-3">
                <img src="<?= $elem['path'] ?>" alt="">
                <div>
                    <h4><a href="blog-details.html"><?= $elem['title'] ?></a></h4>
                    <time datetime="<?= $elem['created_at'] ?>"><?= $elem['created_at'] ?> </time>
                </div>
            </div><!-- End recent post item-->
        <?php endforeach ?>

    </div>

</div><!-- End sidebar recent posts-->

<div class="sidebar-item tags tags-extends">
    <h3 class="sidebar-title">Tags</h3>
    <ul class="mt-3">
        <li><a href="#">App</a></li>
        <li><a href="#">IT</a></li>
        <li><a href="#">Business</a></li>
        <li><a href="#">Mac</a></li>
        <li><a href="#">Design</a></li>
        <li><a href="#">Office</a></li>
        <li><a href="#">Creative</a></li>
        <li><a href="#">Studio</a></li>
        <li><a href="#">Smart</a></li>
        <li><a href="#">Tips</a></li>
        <li><a href="#">Marketing</a></li>
    </ul>
</div><!-- End sidebar tags-->