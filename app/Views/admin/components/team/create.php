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
                        <form class="row g-3" method="post" action="<?= $isUpdate ? base_url('admin/team/update') : base_url('admin/team/create') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputPassword4" name="name" value=<?=$data['name'] ?>>
                            </div>
                            <div class="col-12">
                                <label for="inputPassword6" class="form-label">Position/Role</label>
                                <input type="text" class="form-control" id="inputPassword6" name="role" value=<?=$data['role'] ?>>
                            </div>                            
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Media</label>
                                <input type="file" class="form-control" id="inputNanme4" name="path">
                            </div>
                            <div class="col-12">
                                <input type="checkbox" class="form-check-input" id="flexCheckDefault" name="is_active" value=<?=$data['is_active'] ?>>
                                <label class="form-check-label" for="flexCheckDefault">Active</label>
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