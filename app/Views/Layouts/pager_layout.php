<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav class="dm-page" aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="dm-pagination d-flex">
        <li class="dm-pagination__item">
            <?php if ($pager->hasPrevious()) : ?>
                <a href="<?= $pager->getFirst() ?>" class="dm-pagination__link pagination-control">
                    <span class="la la-angle-left"></span>
                </a>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <a href="<?= $link['uri'] ?>" class="dm-pagination__link <?= $link['active'] ? 'active' : '' ?>"><span class="page-number">
                        <?= $link['title'] ?></span>
                </a>
            <?php endforeach ?>
            <?php if ($pager->hasNext()) : ?>
                <a href="<?= $pager->getNext() ?>" class="dm-pagination__link pagination-control">
                    <span class="la la-angle-right"></span>
                </a>
            <?php endif ?>
            <a href="#" class="dm-pagination__option"> </a>
        </li>
    </ul>
</nav>