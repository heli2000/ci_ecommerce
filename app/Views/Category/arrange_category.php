<?= $this->extend('Layouts\user_layout.php') ?>
<?= $this->section('content') ?>
<style>
    .dd {
        max-width: 250px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .dd-item {
        display: block;
        margin: 0 0 3px 0;
        padding: 10px;
        color: #333;
        text-decoration: none;
        border: 1px solid #ccc;
        background: #fafafa;
    }

    .dd-handle {
        display: block;
        margin: 0;
        padding: 5px 10px;
        color: #333;
        text-decoration: none;
        border: 1px solid #ddd;
        background: #f3f3f3;
        cursor: pointer;
    }
</style>
<div class="contents">
    <div class="dd" id="nestable">
        <ol class="dd-list">
            <li class="dd-item" data-id="1">
                <div class="dd-handle">Item 1</div>
            </li>
            <li class="dd-item" data-id="1">
                <div class="dd-handle">Item 5</div>
            </li>
            <li class="dd-item" data-id="1">
                <div class="dd-handle">Item 6</div>
            </li>
            <li class="dd-item" data-id="1">
                <div class="dd-handle">Item 7</div>
            </li>
            <li class="dd-item" data-id="1">
                <div class="dd-handle">Item 8</div>
            </li>
            <li class="dd-item" data-id="2">
                <div class="dd-handle">Item 2</div>
                <ol class="dd-list">
                    <li class="dd-item" data-id="3">
                        <div class="dd-handle">Item 3</div>
                    </li>
                    <li class="dd-item" data-id="4">
                        <div class="dd-handle">Item 4</div>
                    </li>
                </ol>
            </li>
        </ol>
    </div>
</div>
<?= $this->endSection('content') ?>