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
                                    <li class="breadcrumb-item active" aria-current="page"><?= isset($category_data) && count($category_data) > 0 ? 'Edit Category' : 'Add Category' ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card card-default card-md mb-4">
                        <div class="card-header">
                            <h6><?= isset($category_data) && count($category_data) > 0 ? 'Edit Category' : 'Add Category' ?></h6>
                            <a type="button" class="btn btn-sm btn-primary me-0 radius-md" href="<?= base_url("/admin/category/get") ?>">
                                <span class="toggle-icon"></span>Go to List</a>
                        </div>
                        <div class="card-body">
                            <div class="basic-form-wrapper">
                                <?php

                                use PhpParser\Node\Expr\Print_;

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
                                        <label>Category Name</label>
                                        <input class="form-control form-control-lg" type="text" name="category_name" placeholder="category name" value="<?= isset($category_data) && count($category_data) > 0 ? set_value('category_name', $category_data['name']) : set_value('category_name') ?>">
                                        <span class="help-block"><?= $validation->showError('category_name') ?></span>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Category One Line Description</label>
                                        <input class="form-control form-control-lg" type="text" name="category_one_line_description" placeholder="One Line Description" value="<?= isset($category_data) && count($category_data) > 0 ? set_value('category_name', $category_data['description_one_line']) : set_value('category_one_line_description') ?>">
                                        <span class="help-block"><?= $validation->showError('category_one_line_description') ?></span>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Category Detailed Description</label>
                                        <input class="form-control form-control-lg" type="text" name="category_detailed_description" placeholder="Detailed Description" value="<?= isset($category_data) && count($category_data) > 0 ? set_value('category_name', $category_data['description_detail']) : set_value('category_detailed_description') ?>">
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
                                                            <img class="avatrSrc" src="<?= isset($category_data) && count($category_data) > 0 ? base_url('/file/download/' . $category_data['image']) : base_url('resources/img/upload.png') ?>" alt="Avatar Upload">
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
                                            <select id="select-search" class="form-control" name="parent_category" value="<?= isset($category_data) && count($category_data) > 0 ? set_value('category_name', $category_data['parent_category_id']) : set_value('parent_category') ?>">
                                                <option value="0">Select Parent Category</option>
                                                <?php
                                                if (isset($category_list)) {
                                                    foreach ($category_list as $category) {
                                                ?><option value="<?= $category->id ?>"><?= $category->name ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
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