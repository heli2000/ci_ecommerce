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
                                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card card-default card-md mb-4">
                        <div class="card-header">
                            <h6>Add Category</h6>
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
                                <?= form_open_multipart(base_url('/admin/category/add')) ?>
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Category Name</label>
                                        <input class="form-control form-control-lg" type="text" name="category_name" placeholder="category name" value="<?= set_value('category_name') ?>">
                                        <span class="help-block"><?= $validation->showError('category_name') ?></span>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Category One Line Description</label>
                                        <input class="form-control form-control-lg" type="text" name="category_one_line_description" placeholder="One Line Description" value="<?= set_value('category_one_line_description') ?>">
                                        <span class="help-block"><?= $validation->showError('category_one_line_description') ?></span>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Category Detailed Description</label>
                                        <input class="form-control form-control-lg" type="text" name="category_detailed_description" placeholder="Detailed Description" value="<?= set_value('category_detailed_description') ?>">
                                        <span class="help-block"><?= $validation->showError('category_detailed_description') ?></span>
                                    </div>
                                    <div class="form-group mb-25">
                                        <div class="card card-default card-md mb-4">
                                            <label>
                                                Upload Category Image
                                            </label>
                                            <div class="card-body">
                                                <div class="dm-tag-wrap">

                                                    <div class="dm-upload">
                                                        <div class="dm-upload-avatar">
                                                            <img class="avatrSrc" src="<?= base_url('resources/img/upload.png') ?>" alt="Avatar Upload">
                                                        </div>
                                                        <div class="avatar-up">
                                                            <input type="file" class="upload-avatar-input" name="category_image">
                                                            <span class="help-block"><?= $validation->showError('category_image') ?></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>
                                            Select Parent Category
                                        </label>
                                        <div class="dm-select ">
                                            <select id="select-search" class="form-control" name="parent_category" value="<?= set_value('parent_category') ?>">
                                                <option value="0">Select Parent Category</option>
                                                <option value="02">Option 2</option>
                                                <option value="03">Option 3</option>
                                                <option value="04">Option 4</option>
                                                <option value="05">Option 5</option>
                                            </select>
                                            <span class="help-block"><?= $validation->showError('parent_category') ?></span>
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