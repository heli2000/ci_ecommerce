<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<div class="contents">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">Categories</h4>
            </div>
        </div>
        <div class="row view-all-cat-page">
            <?php
            foreach ($category_data as $key => $value) {
            ?>
                <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 mb-25">
                    <a href="#">
                        <div class="feature-cards">
                            <figure class="feature-cards__figure">
                                <img src="<?= base_url('/file/download/' . $value["image"]) ?>" alt="">
                                <figcaption>
                                    <h4><?= $value["name"] ?></h4>
                                    <p><?= $value['description_detail'] ?></p>
                                </figcaption>
                            </figure>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<?= $this->endSection('content') ?>