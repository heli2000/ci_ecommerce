<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<div class="contents">
    <div class="dm-page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="breadcrumb-main">
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= isset($url) && str_contains($url, 'edit') > 0 ? 'Edit Variant' : 'Add Variant' ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card card-default card-md mb-4">
                        <div class="card-header">
                            <h6><?= isset($url) && str_contains($url, 'edit') > 0 ? 'Edit Variant' : 'Add Variant' ?></h6>
                            <a type="button" class="btn btn-sm btn-primary me-0 radius-md" href="<?= base_url("/admin/product/variant/get") ?>">
                                <span class="toggle-icon"></span>Go to List</a>
                        </div>
                        <div class="card-body">
                            <div class="basic-form-wrapper">
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
                                } ?>
                                <?= form_open_multipart(base_url($url)) ?>
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Variant Name</label>
                                        <input class="form-control form-control-lg" type="text" name="variant_name" placeholder="Variant name" value="<?= isset($category_data) && count($category_data) > 0 ? set_value('variant_name', $category_data['name']) : set_value('variant_name') ?>">
                                        <span class="help-block"><?= $validation->showError('variant_name') ?></span>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Variant Description</label>
                                        <input class="form-control form-control-lg" type="text" name="variant_description" placeholder="Variant Description" value="<?= isset($category_data) && count($category_data) > 0 ? set_value('variant_description', $category_data['variant_description']) : set_value('variant_description') ?>">
                                        <span class="help-block"><?= $validation->showError('variant_description') ?></span>
                                    </div>
                                    <div class="dm-tag-mode form-group mb-25">
                                        <label>Variant Options</label>
                                        <div class="dm-select">
                                            <select name="select-tag[]" id="variant-option" class="form-control form-control-lg" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-lg btn-primary btn-submit">Save</button>
                                    </div>
                                </div>
                                <?= form_close() ?>
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