<?= $this->extend('Layouts\login_layout.php') ?>
<?= $this->section('content') ?>
<html lang="en" dir="ltr">

<body>
    <main class="main-content">
        <?= form_open(base_url('/login')) ?>
        <div class="admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                        <div class="edit-profile">
                            <?php
                            if ($validation->showError('EmailFailed')) {
                            ?> <div class=" alert alert-error  alert-dismissible fade show " role="alert">
                                    <div class="alert-content">
                                        <p><?php
                                            echo $validation->showError('EmailFailed');

                                            ?></p>
                                        <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                                            <img src="<?= base_url('resources/img/svg/x.svg') ?>" alt="x" class="svg" aria-hidden="true">
                                        </button>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if (session()->getFlashdata('message') != null) {
                            ?> <div class=" alert alert-success  alert-dismissible fade show " role="alert">
                                    <div class="alert-content">
                                        <p><?php
                                            echo session()->getFlashdata('message');

                                            ?></p>
                                        <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                                            <img src="<?= base_url('resources/img/svg/x.svg') ?>" alt="x" class="svg" aria-hidden="true">
                                        </button>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="edit-profile__logos">
                                <a href="<?= base_url("/") ?>">
                                    <img class="dark" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="">
                                    <img class="light" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="">
                                </a>
                            </div>
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="edit-profile__title">
                                        <h6>Sign in</h6>
                                    </div>
                                </div>
                                <center><span class="help-block"><?= $validation->showError('login') ?></span></center>
                                <div class="card-body">
                                    <div class="edit-profile__body">
                                        <div class="form-group mb-25">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
                                            <span class="help-block"><?= $validation->showError('email') ?></span>
                                        </div>
                                        <div class="form-group mb-15">
                                            <label for="password-field">password</label>
                                            <div class="position-relative">
                                                <input id="password-field" type="password" class="form-control" name="password" placeholder="Password">
                                                <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2">
                                                </div>
                                                <span class="help-block"><?= $validation->showError('password') ?></span>
                                            </div>
                                        </div>
                                        <div class="admin-condition">
                                            <a href="<?= base_url('/forget-password') ?>">forget password?</a>
                                        </div>
                                        <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                            <button class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn ">
                                                sign in
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- End: .card-body -->
                                <div class="admin-topbar">
                                    <p class="mb-0">
                                        Don't have an account?
                                        <a href="<?= base_url('/register') ?>" class="color-primary">
                                            Sign up
                                        </a>
                                    </p>
                                </div><!-- End: .admin-topbar  -->
                            </div><!-- End: .card -->
                        </div><!-- End: .edit-profile -->
                    </div><!-- End: .col-xl-5 -->
                </div>
            </div>
        </div><!-- End: .admin-element  -->
        <?= form_close() ?>
    </main>
    <div id="overlayer">
        <div class="loader-overlay">
            <div class="dm-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </div>
    </div>
    <div class="enable-dark-mode dark-trigger">
        <ul>
            <li>
                <a href="#">
                    <i class="uil uil-moon"></i>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>
<?= $this->endSection('content') ?>