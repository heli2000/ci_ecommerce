<?= $this->extend('Layouts\login_layout.php') ?>
<?= $this->section('content') ?>
<html lang="en" dir="ltr">

<body>
    <main class="main-content">
        <?= validation_list_errors() ?>

        <?= form_open(base_url('/login')) ?>
        <div class="admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                        <div class="edit-profile">
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
                                <div class="card-body">
                                    <div class="edit-profile__body">
                                        <div class="form-group mb-25">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
                                        </div>
                                        <div class="form-group mb-15">
                                            <label for="password-field">password</label>
                                            <div class="position-relative">
                                                <input id="password-field" type="password" class="form-control" name="password" placeholder="Password">
                                                <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="admin-condition">
                                            <div class="checkbox-theme-default custom-checkbox ">
                                                <input class="checkbox" type="checkbox" id="check-1">
                                                <label for="check-1">
                                                    <span class="checkbox-text">Keep me logged in</span>
                                                </label>
                                            </div>
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