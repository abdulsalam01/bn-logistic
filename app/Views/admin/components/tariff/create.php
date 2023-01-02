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
                        <form class="row g-3" method="post" action="<?= $isUpdate ? base_url('admin/tariff/update') : base_url('admin/tariff/create') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Source - Destination</label>
                                <input type="text" class="form-control" id="inputNanme4" name="raw_source" value="<?= $data['raw_source'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme5" class="form-label">Packet Type</label>
                                <input type="text" class="form-control" id="inputNanme5" name="packet_type" value="<?= $data['packet_type'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme6" class="form-label">Estimation Time Range (Days)</label>
                                <input type="datetime-local" class="form-control" id="inputNanme6" name="estimation_time" value="<?= $data['estimation_time'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme7" class="form-label">Weight Range</label>
                                <input type="text" class="form-control" id="inputNanme7" name="weight_range" value="<?= $data['weight_range'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme8" class="form-label">Price Range (Rp.)</label>
                                <input type="text" class="form-control" id="inputNanme8" name="price_range" value="<?= $data['price_range'] ?>">
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