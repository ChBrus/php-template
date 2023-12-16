<?php
    require_once './vendor/autoload.php';
    use Build\{PageBuilder};
    use Tools\Env;

    Env::getEnv();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= PageBuilder::buildCustomBootstrap() ?>
    <title>Ejemplo proyecto</title>
</head>
<body>
    <?= view('data-table/table', [
        'columns' => 4,
        'maxRows' => $_ENV['maxRows'],
        'globalLocation' => PageBuilder::getProjectURL(),
    ]) ?>
    <?= script('data-table/index', true) ?>
</body>
</html>