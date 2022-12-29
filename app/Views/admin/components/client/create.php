<?= $this->extend('admin/layouts/page') ?>
<?= $this->section('content') ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Layouts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vertical Form</h5>

                        <?= session()->getFlashdata('error') ?>
                        <?= service('validation')->listErrors() ?>

                        <!-- Vertical Form -->
                        <form class="row g-3" method="post" action="<?= $isUpdate ? base_url('admin/client/update') : base_url('admin/client/create') ?>">
                            <?= csrf_field() ?>

                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="inputNanme4" name="name" value="<?= $data['name'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Icon</label>
                                <input type="tel" class="form-control" id="inputPassword4" name="icon" value=<?=$data['icon'] ?>>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection() ?>