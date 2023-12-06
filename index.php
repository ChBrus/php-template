<?php
    require_once './vendor/autoload.php';
    use Build\PageBuilder;
    use Tools\Env;

    Env::getEnv();

    $database = new \Models\Core\DB();
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
    <?= view('welcome', [
        "project-name" => $_ENV['ProjectName']
    ]) ?>
    <?= script('index', true) ?>
</body>
</html>