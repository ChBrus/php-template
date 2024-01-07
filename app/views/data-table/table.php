<?php
    require_once '../../../vendor/autoload.php';

    use Build\PageBuilder;
    use Tools\Env;

    Env::getEnv();

    $columns = (int) $_POST['columns'];
    $maxRows = (int) ($_POST['maxRows'] ?? $_ENV['maxRows']);
?>
<section class="data-table data-striped" id="data-table" dataFile="<?= $_POST['dataFile'] ?? PageBuilder::getProjectURL() . 'app/controllers/connection/null' ?>">
    <?php if (!isset($_POST['options']) || (isset($_POST['options']) && boolval($_POST['options']))): ?>
        <article class="accordion columns-<?= $columns ?>" id="tableOptions">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#optionsList" aria-expanded="false" aria-controls="optionsList">
                        Opciones
                    </button>
                </h2>
                <div id="optionsList" class="accordion-collapse collapse" data-bs-parent="#tableOptions">
                    <div class="accordion-body table-toolbar">
                        <input type="number" class="btn btn-gray max-rows" value="<?= $maxRows ?>"/>
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group me-2" role="group" aria-label="First group">
                                <button type="button" class="btn btn-gray prev">Anterior</button>
                                <button type="button" class="btn btn-gray active page-number">...</button>
                                <button type="button" class="btn btn-gray next">Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endif; ?>
    <article class="header columns-<?= $columns ?>" id="header">
        <?php for($i = 0; $i < $columns; $i++): ?>
            <div class="h-col">[Undefined]</div>
        <?php endfor ?>
    </article>
    <article class="body columns-<?= $columns ?>" id="body">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </article>
</section>