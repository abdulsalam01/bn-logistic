<?= $this->extend('client/layouts/page') ?>

<?= $this->section('content-top') ?>
    <!-- keep empty! -->
<?= $this->endSection() ?>

<!-- main content -->
<?= $this->section('content') ?>

    <?= $this->include('client/components/blog/hero') ?>
    <?= $this->include('client/components/blog/content') ?>

<?= $this->endSection() ?>