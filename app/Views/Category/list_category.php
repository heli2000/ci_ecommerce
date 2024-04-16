<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<div class="contents">
    <?= form_open(base_url('/admin/category/get'),  ['method' => 'get']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-breadcrumb">

                    <div class="breadcrumb-main">
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                    <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                        <div class="d-flex align-items-center flex-wrap justify-content-center">
                            <div class="project-search order-search  global-shadow mt-10">
                                <form action="/" class="order-search__form">
                                    <img src="<?= base_url('resources/img/svg/search.svg') ?>" alt="search" class="svg">
                                    <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Filter by keyword" aria-label="Search">
                                </form>
                            </div>
                        </div>
                        <div class="content-center">
                            <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                <button type="button" class="order-bg-opacity-secondary text-secondary btn radius-md">Export</button>
                                <a type="button" class="btn btn-sm btn-primary me-0 radius-md" href="<?= base_url("/admin/category/add") ?>">
                                    <i class="la la-plus"></i> Add Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless border-0">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th scope="col">
                                        <div class="d-flex align-items-center">

                                            <div class="bd-example-indeterminate">
                                                <div class="checkbox-theme-default custom-checkbox  check-all">
                                                    <input class="checkbox" type="checkbox" id="check-23">
                                                    <label for="check-23">
                                                        <span class="checkbox-text ">
                                                            categories
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </th>
                                    <th scope="col">
                                        <span class="userDatatable-title">Description</span>
                                    </th>
                                    <th scope="col">
                                        <span class="userDatatable-title">Parent Category Name</span>
                                    </th>
                                    <th scope="col" class="text-end">
                                        <span class="userDatatable-title ">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($category_data as $value) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3 d-flex align-items-center">
                                                    <div class="checkbox-group-wrapper">
                                                        <div class="checkbox-group d-flex me-3">
                                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                <input class="checkbox" type="checkbox" id="check-grp-ellie11">
                                                                <label for="check-grp-ellie11"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="profile-image rounded-circle d-block m-0 wh-32" style="background-image:url('img/tm1.png'); background-size: cover;"></a>
                                                </div>
                                                <div class="orderDatatable-title">
                                                    <p class="d-block mb-0">
                                                        <?= $value['name'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="orderDatatable-title">
                                                <?= $value['description_one_line'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="orderDatatable-title">
                                                <?= $value['parent_name'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                <li>
                                                    <a href="#" class="edit">
                                                        <i class="uil uil-edit"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="remove">
                                                        <i class="uil uil-trash-alt"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-15 pt-25 border-top">
                        <?= $pager->links('default', "custom_pager") ?>
                        <!-- <nav class="dm-page ">
                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
                                    <a href="#" class="dm-pagination__link"><span class="page-number">1</span></a>
                                    <a href="#" class="dm-pagination__link active"><span class="page-number">2</span></a>
                                    <a href="#" class="dm-pagination__link"><span class="page-number">3</span></a>
                                    <a href="#" class="dm-pagination__link pagination-control"><span class="page-number">...</span></a>
                                    <a href="#" class="dm-pagination__link"><span class="page-number">12</span></a>
                                    <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
                                    <a href="#" class="dm-pagination__option">
                                    </a>
                                </li>
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection">
                                            <option value="20">20/page</option>
                                            <option value="40">40/page</option>
                                            <option value="60">60/page</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </nav> -->
                        <li class="dm-pagination__item">
                            <div class="paging-option">
                                <select name="perPage" class="page-selection" onchange="this.form.submit()">
                                    <option value="2">2/page</option>
                                    <option value="3">2/page</option>
                                    <option value="5">5/page</option>
                                </select>
                            </div>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>
<?= $this->endSection('content') ?>