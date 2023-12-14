<?php
    $columns = (int) $_POST['columns'];
    $maxRows = (int) $_POST['maxRows'];
?>
<div class="data-table"
<?php if (isset($_POST['globalLocation'])): ?> global-location="<?= $_POST['globalLocation'] ?>" <?php endif; ?>
<?php if (isset($_POST['localLocation'])): ?> local-location="<?= $_POST['localLocation'] ?>" <?php endif; ?>
>
    <div class="accordion" id="tableOptions">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#optionsList" aria-expanded="false" aria-controls="optionsList">
                    Options
                </button>
            </h2>
            <div id="optionsList" class="accordion-collapse collapse" data-bs-parent="#tableOptions">
                <div class="accordion-body">
                    A
                </div>
            </div>
        </div>
    </div>
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