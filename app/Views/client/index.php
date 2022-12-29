<?= $this->extend('client/layouts/page') ?>

<!-- hero on top of page -->
<?= $this->section('content-top') ?>
    <?= $this->include('client/components/main/hero') ?>
<?= $this->endSection() ?>

<!-- main content -->
<?= $this->section('content') ?>

    <?= $this->include('client/components/main/about') ?>
    <?= $this->include('client/components/main/client') ?>
    <?= $this->include('client/components/main/service') ?>
    <?= $this->include('client/components/main/testimonial') ?>
    <?= $this->include('client/components/main/portfolio') ?>
    <?= $this->include('client/components/main/team') ?>
    <?= $this->include('client/components/main/faq_price') ?>
    <?= $this->include('client/components/main/news') ?>
    <?= $this->include('client/components/main/contact') ?>

<?= $this->endSection() ?>