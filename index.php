<?php
    require_once './vendor/autoload.php';
    use Build\{PageBuilder};
    use Tools\Env;

    Env::getEnv();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= PageBuilder::buildCustomBootstrap() ?>
    <title>Ejemplo proyecto</title>
    <?= PageBuilder::buildJQuery() ?>
</head>
<body>
    <div class="btn-toolbar" role="toolbar" aria-label="jquery-test">
        <div class="btn-group" role="group" aria-label="jquery-test-btn-group">
        <button type="button" class="btn btn-blue">
                JavaScript
            </button>
            <button type="button" class="btn btn-blue">
                PHP
            </button>
            <button type="button" class="btn btn-blue">
                CSS
            </button>
            <button type="button" class="btn btn-blue">
                HTML
            </button>
        </div>
    </div>
    <div class="testing-ajax">

    </div>
    <?= script('jquery-test/index', true) ?>
</body>
</html>