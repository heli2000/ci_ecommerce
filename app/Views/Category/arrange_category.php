<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<div class="contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-breadcrumb">

                    <div class="breadcrumb-main">
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="uil uil-estate"></i>Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Arrange Category</li>
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
                <div class="card card-default card-md mb-4">
                    <div class="card-header">
                        <h6>Arrange Category</h6>
                        <a type="button" class="btn btn-sm btn-warning me-0 radius-md" href="<?= base_url("/admin/category/get") ?>"><span class="toggle-icon"></span>Save</a>
                    </div>
                    <div class="card-body">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                <?php
                                // Assuming $hierarchicalCategories contains the hierarchical categories array
                                function generateCategoryHTML($categories)
                                {
                                    foreach ($categories as $category) {
                                        echo '<li class="dd-item" data-id="' . $category->id . '">';
                                        echo '<div class="dd-handle">' . $category->name . '</div>';
                                        if (isset($category->children) && !empty($category->children)) {
                                            echo '<ol class="dd-list">';
                                            generateCategoryHTML($category->children);
                                            echo '</ol>';
                                        }
                                        echo '</li>';
                                    }
                                }

                                generateCategoryHTML($category_data);
                                ?>
                            </ol>
                            <input type="hidden" name="sequence_obj" id="sequence_obj" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>