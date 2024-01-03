<?php
    require_once '../../../vendor/autoload.php';

    use Build\PageBuilder;
    use Tools\Env;

    Env::getEnv();

    $columns = (int) $_POST['columns'];
    $maxRows = (int) $_POST['maxRows'];
?>
<div class="data-table" id="data-table" dataFile="<?= $_POST['dataFile'] ?? PageBuilder::getProjectURL() . 'app/controllers/connection/null' ?>">
    <div class="accordion columns-<?= $columns ?>" id="tableOptions">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#optionsList" aria-expanded="false" aria-controls="optionsList">
                    Opciones
                </button>
            </h2>
            <div id="optionsList" class="accordion-collapse collapse" data-bs-parent="#tableOptions">
                <div class="accordion-body">
                    <div class="d-flex flex-column">
                        <div class="btn-toolbar table-toolbar" role="toolbar">
                            <div class="btn-group me-2" role="group" aria-label="First group">
                                <button type="button" class="btn btn-gray prev">Anterior</button>
                                <button type="button" class="btn btn-gray active page-number">...</button>
                                <button type="button" class="btn btn-gray next">Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header columns-<?= $columns ?>" id="header">
        <?php for($i = 0; $i < $columns; $i++): ?>
            <div class="h-col">[Undefined]</div>
        <?php endfor ?>
    </div>
    <div class="body columns-<?= $columns ?>" id="body">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>