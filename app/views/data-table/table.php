<?php
    $columns = (int) $_POST['columns'];
    $maxRows = (int) $_POST['maxRows'];
?>
<div class="data-table"
<?php if (isset($_POST['globalLocation'])): ?> global-location="<?= $_POST['globalLocation'] ?>" <?php endif; ?>
<?php if (isset($_POST['localLocation'])): ?> local-location="<?= $_POST['localLocation'] ?>" <?php endif; ?>
>
    <div class="header columns-<?= $columns ?>">
        <?php for($i = 0; $i < $columns; $i++): ?>
            <div class="h-col">[Undefined]</div>
        <?php endfor ?>
    </div>
    <div class="body columns-<?= $columns ?>">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>