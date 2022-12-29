<?= $this->include('admin/partials/header_link') ?>
<?= $this->include('admin/partials/header') ?>
<?= $this->include('admin/partials/sidebar') ?>

<!-- load main content along with reusable views -->
<?= $this->renderSection('content') ?>

<?= $this->include('admin/partials/footer') ?>
<?= $this->include('admin/partials/footer_link') ?>