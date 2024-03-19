<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?><div class="contents">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Start: error page -->
                <div class="min-vh-100 content-center">
                    <div class="error-page text-center">
                        <img src="<?= base_url('resources/img/svg/404.svg') ?>" alt="404" class="svg">
                        <div class="error-page__title">404</div>
                        <h5 class="fw-500">Sorry! the page you are looking for doesn't exist.</h5>
                        <div class="content-center mt-30">
                            <a href="<?= base_url('/') ?>" class="btn btn-primary btn-default btn-squared px-30">Return Home</a>
                        </div>
                    </div>
                </div>
                <!-- End: error page -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>