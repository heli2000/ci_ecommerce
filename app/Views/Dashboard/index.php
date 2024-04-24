<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<div class="contents">
    <div class="demo5 mt-30 mb-25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 mb-25">
                    <div class="card banner-feature--18 d-flex">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card-body px-25">
                                        <h1 class="banner-feature__heading color-white">Welcome To Hex Ecommerce</h1>
                                        <p class="banner-feature__para color-white">Step into our world where an extensive array of meticulously chosen products awaits, meticulously selected to meet your every requirement, all enveloped in the warmth of our genuine commitment to quality and customer satisfaction.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="banner-feature__shape px-md-25 px-25 py-sm-0 pt-15 pb-30 d-flex justify-content-sm-end justify-content-center">
                                        <img src="<?= base_url("resources/img/banner.jpg") ?>" alt="img" class="svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="global-slider-wrapper">
                <div class="global-slider-category slick-slider slick-dots-bottom" data-dots-slick='true'>
                    <?php
                    foreach ($all_category_data as $key => $value) {
                    ?>
                        <div class="feature-cards">
                            <figure class="feature-cards__figure slider-img-size">
                                <img src="<?= base_url('/file/download/' . $value->image) ?>" />
                                <figcaption>
                                    <h4><?= $value->name ?></h4>
                                    <p><?= $value->description_one_line ?></p>
                                </figcaption>
                            </figure>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection('content') ?>