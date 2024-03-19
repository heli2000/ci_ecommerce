<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<div class="contents">
    <div class="dm-page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Form</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Form</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card card-default card-md mb-4">
                        <div class="card-header">
                            <h6>Basic</h6>
                        </div>
                        <div class="card-body">
                            <div class="basic-form-wrapper">

                                <form action="#">
                                    <div class="form-basic">
                                        <div class="form-group mb-25">
                                            <label>Username or Email Address</label>
                                            <input class="form-control form-control-lg" type="text" name="username" placeholder="name@example.com">
                                        </div>
                                        <div class="form-group mb-25">
                                            <label for="password-field">Password</label>
                                            <div class="position-relative">
                                                <input id="password-field" type="password" class="form-control form-control-lg" name="password" value="secret">
                                                <span class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></span>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-lg btn-primary btn-submit">Log In</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- ends: .card -->

                </div>
                <!-- ends: .col-lg-6 -->
            </div>
        </div>
    </div>
    <!-- ends: .dm-page-content -->
</div>
<?= $this->endSection('content') ?>