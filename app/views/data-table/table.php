<?php
    require_once '../../../vendor/autoload.php';

    use Build\{PageBuilder, Table};

    $table = new Table(...$_POST);

    $columns = $table->__get('columns');
    $dataFile = $table->__get('dataFile');
    $maxRows = $table->__get('maxRows');
    $stripped = $table->__get('stripped') ? ' table-strip' : '';
    $options = $table->__get('options');
?>
<section class="data-table<?= $stripped ?>" id="data-table" data-file="<?= $dataFile ?>" data-length=<?= getLengthConnection() ?>>
    <?php if ($options): ?>
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