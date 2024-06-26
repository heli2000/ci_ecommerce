<!doctype html>
<html lang="en" dir="ltr">

<body class="layout-light <?= session('user') && session('user')['isAdmin'] == true ? '' : 'top-menu' ?>">
    <div class="mobile-search">
        <form action="/" class="search-form">
            <img src="<?= base_url("resources/img/svg/search.svg") ?>" alt="search" class="svg">
            <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search Product" aria-label="Search">
        </form>
    </div>
    <div class="mobile-author-actions"></div>
    <?php
    if (session('user') && session('user')['isAdmin'] == true) {
        echo $this->include('includes\Headers\admin_header.php');
    } else {
        echo $this->include('includes\Headers\user_header.php');
    }
    ?>
    <main class="main-content">
        <?= $this->renderSection('content') ?>
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
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>
    <?= $this->include('includes\Footers\footer.php') ?>
</body>

</html>