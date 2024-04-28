<?php
    require_once './vendor/autoload.php';
    use Build\PageBuilder;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= PageBuilder::buildCustomBootstrap() ?>
    <title>Home</title>
    <?= PageBuilder::buildJQuery() ?>
</head>
<body>
    
</body>
</html>