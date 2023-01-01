<?= $this->extend('admin/layouts/page') ?>
<?= $this->section('content') ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>General Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="my-3">
                    <a href="<?= base_url('admin/slider/create') ?>">
                        <button type="button" class="btn btn-success">Create</button>
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Table with stripped rows</h5>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Media</th>
                                    <th scope="col">Media Desc</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($model['data'] as $key => $value) : ?>
                                    <tr>
                                        <th scope="row"><?= ($key + 1) ?></th>
                                        <td><img src="<?= $value['path'] ?>" alt="<?= $value['path'] ?>" class="img-wrapper-size"/></td>
                                        <td><?= $value['path_description'] ?></td>
                                        <td><?= $value['created_at'] ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/slider/edit/' . md5($value['id'])) ?>">
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill">Edit</button>
                                            </a>
                                            <form action="<?= base_url('admin/slider/delete/' . md5($value['id'])) ?>" method="delete">
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

                <div class="pagination justify-content-end">
                    <?= $model['pager']->links('pg-custom', 'custom_pagination') ?>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection() ?>