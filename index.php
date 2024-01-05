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
    <?= view('data-table/table', [
        'columns' => 3,
        'maxRows' => 100,
        'dataFile' => bridgeConnection('table-test')
    ]) ?>
    <?= script('data-table/index', true) ?>
</body>
</html>