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
                                    <li class="breadcrumb-item active" aria-current="page"><?= isset($url) && str_contains($url, 'edit') > 0 ? 'Add Product' : 'Add Product' ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-header">
                            <h6>Add Product</h6>
                        </div>
                        <div class="card-body py-md-30">
                            <form>
                                <div class="row">

                                    <div class="col-md-6 mb-25">
                                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="City">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="Country">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="Company">
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="Email">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="layout-button mt-0">
                                            <button type="button" class="btn btn-default btn-squared btn-light px-20 ">cancel</button>
                                            <button type="button" class="btn btn-primary btn-default btn-squared px-30">save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>