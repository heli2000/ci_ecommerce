<?= $this->extend('Layouts\login_layout.php') ?>
<?= $this->section('content') ?>
<html lang="en" dir="ltr">

<body>
    <main class="main-content">
        <?= form_open(base_url('/
        ')) ?>
        <div class="admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                        <div class="edit-profile">
                            <div class="edit-profile__logos">
                                <a href="<?= base_url("/") ?>">
                                    <img class="dark" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="">
                                </a>
                            </div>
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="edit-profile__title">
                                        <h6>Sign Up</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="edit-profile__body">
                                        <div class="edit-profile__body">
                                            <div class="form-group mb-20">
                                                <label for="name">name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>" placeholder="Full Name">
                                                <span class="help-block"><?= $validation->showError('name') ?></span>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= set_value('phoneNumber') ?>" placeholder="Phone Number">
                                                <span class="help-block"><?= $validation->showError('phoneNumber') ?></span>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label for="email">Email Adress</label>
                                                <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" placeholder="name@example.com">
                                                <span class="help-block"><?= $validation->showError('email') ?></span>
                                            </div>
                                            <div class="form-group mb-15">
                                                <label for="password-field">password</label>
                                                <div class="position-relative">
                                                    <input id="password-field" type="password" class="form-control" name="password" value="<?= set_value('password') ?>" placeholder="Password">
                                                    <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></div>
                                                    <span class="help-block"><?= $validation->showError('password') ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-15">
                                                <label for="cpassword-field">Confirm password</label>
                                                <div class="position-relative">
                                                    <input id="password-field" type="password" class="form-control" name="cpassword" value="<?= set_value('cpassword') ?>" placeholder="Confirm Password">
                                                    <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></div>
                                                    <span class="help-block"><?= $validation->showError('cpassword') ?></span>
                                                </div>
                                            </div>
                                            <div class="admin-condition">
                                                <div class="checkbox-theme-default custom-checkbox ">
                                                    <input class="checkbox" type="checkbox" id="admin-1">
                                                    <label for="admin-1">
                                                        <span class="checkbox-text">Creating an account means you’re okay
                                                            with our <a href="#" class="color-primary">Terms of
                                                                Service</a> and <a href="#" class="color-primary">Privacy
                                                                Policy</a>
                                                            my preference</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                                <button class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn ">
                                                    Create Account
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End: .card-body -->
                                <div class="admin-topbar">
                                    <p class="mb-0">
                                        Don't have an account?
                                        <a href="<?= base_url('/login') ?>" class="color-primary">
                                            Sign In
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