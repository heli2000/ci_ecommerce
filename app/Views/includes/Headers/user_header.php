<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hex Commerce</title>

    <?= $this->include('includes\cssLibraries.php') ?>

</head>

<body>
    <header class="header-top">
        <nav class="navbar navbar-light">
            <div class="navbar-left">
                <div class="logo-area">
                    <a class="" href="<?= base_url('/') ?>">
                        <!-- <img class="dark" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="logo"> -->
                        <img class="light" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="logo">
                    </a>
                    <a href="#" class="sidebar-toggle">
                        <img class="svg" src="<?= base_url("resources/img/svg/align-center-alt.svg") ?>" alt="img"></a>
                </div>
                <div class="top-menu">
                    <div class="hexadash-top-menu position-relative">
                        <ul>
                            <li>
                                <a href="<?= base_url("/") ?>" class="<?= current_url() == base_url() ? 'active' : '' ?>">Dashboard</a>
                            </li>
                            <?php

                            function renderCategory($category_list, $isFirst = true)
                            {
                                foreach ($category_list as $key => $value) {
                                    $hasChildren = property_exists($value, 'children') && !empty($value->children);
                                    $class = $hasChildren ? ($isFirst ? 'has-subMenu' : 'has-subMenu-left') : '';

                            ?>
                                    <li class="<?= $class ?>">
                                        <a href="#" class=""><?= $value->name ?></a>
                                        <?php if ($hasChildren) { ?>
                                            <ul class="subMenu">
                                                <?php renderCategory($value->children, false); ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                            <?php renderCategory(service('sharedData')->categoryData); ?>
                            <li>
                                <a href="<?= base_url("/category/viewAll") ?>" class="<?= current_url() == base_url('category/viewAll') ? 'active' : '' ?>">More</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ends: navbar-left -->
            <div class="navbar-right">
                <ul class="navbar-right__menu">
                    <li class="nav-search">
                        <a href="#" class="search-toggle active">
                            <i class="uil uil-search"></i>
                            <i class="uil uil-times"></i>
                        </a>
                        <form action="/" class="search-form-topMenu show">
                            <span class="search-icon uil uil-search"></span>
                            <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search Product..." aria-label="Search">
                        </form>
                    </li>
                    <!-- ends: nav-message -->
                    <?php
                    if (session('user')) {
                    ?><li class="nav-notification">
                            <div class="dropdown-custom">
                                <a href="javascript:;" class="nav-item-toggle icon-active">
                                    <img class="svg" src="<?= base_url('resources/img/svg/alarm.svg') ?>" alt="img">
                                </a>
                                <div class="dropdown-parent-wrapper">
                                    <div class="dropdown-wrapper">
                                        <h2 class="dropdown-wrapper__title">Notifications <span class="badge-circle badge-warning ms-1">4</span></h2>
                                        <ul>
                                            <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                                <div class="nav-notification__type nav-notification__type--primary">
                                                    <img class="svg" src="img/svg/inbox.svg" alt="inbox">
                                                </div>
                                                <div class="nav-notification__details">
                                                    <p>
                                                        <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                                        <span>sent you a message</span>
                                                    </p>
                                                    <p>
                                                        <span class="time-posted">5 hours ago</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                                <div class="nav-notification__type nav-notification__type--secondary">
                                                    <img class="svg" src="img/svg/upload.svg" alt="upload">
                                                </div>
                                                <div class="nav-notification__details">
                                                    <p>
                                                        <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                                        <span>sent you a message</span>
                                                    </p>
                                                    <p>
                                                        <span class="time-posted">5 hours ago</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                                <div class="nav-notification__type nav-notification__type--success">
                                                    <img class="svg" src="img/svg/log-in.svg" alt="log-in">
                                                </div>
                                                <div class="nav-notification__details">
                                                    <p>
                                                        <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                                        <span>sent you a message</span>
                                                    </p>
                                                    <p>
                                                        <span class="time-posted">5 hours ago</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                                <div class="nav-notification__type nav-notification__type--info">
                                                    <img class="svg" src="img/svg/at-sign.svg" alt="at-sign">
                                                </div>
                                                <div class="nav-notification__details">
                                                    <p>
                                                        <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                                        <span>sent you a message</span>
                                                    </p>
                                                    <p>
                                                        <span class="time-posted">5 hours ago</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                                <div class="nav-notification__type nav-notification__type--danger">
                                                    <img src="img/svg/heart.svg" alt="heart" class="svg">
                                                </div>
                                                <div class="nav-notification__details">
                                                    <p>
                                                        <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                                        <span>sent you a message</span>
                                                    </p>
                                                    <p>
                                                        <span class="time-posted">5 hours ago</span>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="" class="dropdown-wrapper__more">See all incoming activity</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <!-- ends: .nav-notification -->
                    <li class="nav-author">
                        <?php
                        if (session('user')) {
                        ?>
                            <div class="dropdown-custom">
                                <a href="javascript:;" class="nav-item-toggle"><img src="<?= base_url('resources/img/author-nav.jpg') ?>" alt="" class="rounded-circle">
                                    <span class="nav-item__title">
                                        <?php echo explode(" ", session('user')['name'])[0];
                                        ?>
                                        <i class="las la-angle-down nav-item__arrow"></i></span>
                                </a>
                                <div class="dropdown-parent-wrapper">
                                    <div class="dropdown-wrapper">
                                        <div class="nav-author__info">
                                            <div class="author-img">
                                                <img src="<?= base_url('resources/img/author-nav.jpg') ?>" alt="" class="rounded-circle">
                                            </div>
                                            <div>
                                                <h6>
                                                    <?php
                                                    if (session('user')) {
                                                        echo session('user')['name'];
                                                    } ?>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="nav-author__options">
                                            <ul>
                                                <li>
                                                    <a href="">
                                                        <i class="uil uil-user"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="uil uil-setting"></i>
                                                        Settings</a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="uil uil-key-skeleton"></i> Billing</a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="uil uil-users-alt"></i> Activity</a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="uil uil-bell"></i> Help</a>
                                                </li>
                                            </ul>
                                            <a href="<?= base_url('/logout') ?>" class="nav-author__signout">
                                                <i class="uil uil-sign-out-alt"></i> Sign Out</a>
                                        </div>
                                    </div>
                                    <!-- ends: .dropdown-wrapper -->
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <a class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal signIn-createBtn" href="<?= base_url('/login') ?>">
                                Sign In
                            </a>
                        <?php
                        } ?>
                    </li>
                    <!-- ends: .nav-author -->
                </ul>
                <!-- ends: .navbar-right__menu -->
                <div class="navbar-right__mobileAction d-md-none">
                    <a href="#" class="btn-search">
                        <img src="<?= base_url("resources/img/svg/search.svg") ?>" alt="search" class="svg feather-search">
                        <img src="<?= base_url("resources/img/svg/x.svg") ?>" alt="x" class="svg feather-x"></a>
                    <a href="#" class="btn-author-action">
                        <img class="svg" src="<?= base_url("resources/img/svg/more-vertical.svg") ?>" alt="more-vertical"></a>
                </div>
            </div>
            <!-- ends: .navbar-right -->
        </nav>
    </header>

</html>