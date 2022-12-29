<?= $this->include('client/partials/header_link') ?>
<?= $this->include('client/partials/header') ?>

<!-- load main content along with reusable views -->
<?= $this->renderSection('content-top') ?>
<main id="main">
    <?= $this->renderSection('content') ?>
</main>

<?= $this->include('client/partials/footer') ?>
<?= $this->include('client/partials/footer_link') ?>