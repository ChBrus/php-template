<?php
    require_once '../../../vendor/autoload.php';

    $columns = (int) $_POST['columns'];
    $dataFile = $_POST['dataFile'];
    $maxRows = (int) $_POST['maxRows'];
    $stripped = boolval($_POST['stripped']) ? ' table-strip' : '';
    $options = boolval($_POST['options']);
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
                    <div class="accordion-body">
                        <div class="table-toolbar">
                            <div class="d-flex flex-row gap-2 toolbar-item">
                                <button type="button" class="btn btn-gray btn-reload" id="reload">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                                <input type="number" class="btn btn-gray max-rows" value="<?= $maxRows ?>"/>
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group me-2" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-gray prev">Anterior</button>
                                        <button type="button" class="btn btn-gray active page-number">...</button>
                                        <button type="button" class="btn btn-gray next">Siguiente</button>
                                    </div>
                                </div>
                            </div>
                            <div class="toolbar-item">
                                <form class="d-flex gap-2 search-form" role="search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                    <div class="select-container">
                                        <select class="form-select" name="columna" id="columna" aria-label="Seleccione una columna">
                                            <option selected disabled>Columna</option>
                                        </select>
                                    </div>
                                    <input class="form-control me-2" type="search" id="search-control" placeholder="Search" aria-label="Search">
                                </form>
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