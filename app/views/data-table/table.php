<?php
    $header = (int) $_POST['header'];
    $maxRows = (int) $_POST['maxRows'];
?>
<div class="data-table"
<?php if (isset($_POST['globalLocation'])): ?> global-location="<?= $_POST['globalLocation'] ?>" <?php endif; ?>
<?php if (isset($_POST['localLocation'])): ?> local-location="<?= $_POST['localLocation'] ?>" <?php endif; ?>
>
    <div class="header columns-<?= $header ?>">
        <?php for($i = 0; $i < $header; $i++): ?>
            <div class="h-col">[Undefined]</div>
        <?php endfor ?>
    </div>
    <div class="body columns-<?= $header ?>" max-rows="<?= $maxRows ?>">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <!-- <?php for($i = 0; $i < $maxRows; $i++): ?>
            <div class="dataRow">
                <?php for($j = 0; $j < $header; $j++): ?>
                    <div class="d-col"><?= $j . $i ?></div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?> -->
    </div>
</div>