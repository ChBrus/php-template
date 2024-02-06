<?php
    require_once './vendor/autoload.php';
    use Build\{PageBuilder, Table};
    use Tools\Env;

    Env::getEnv();

    $table = new Table(
        columns: 3,
        dataFile: 'test-table',
        options: true
    );
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
    <?= $table->build() ?>
    <?= script('php-template/fetch/index', true) ?>
</body>
</html>