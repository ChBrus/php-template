<?php
    require_once './vendor/autoload.php';
    use Build\{PageBuilder, Message};
    use Tools\Env;

    Env::getEnv();

    $msg = new Message('Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus distinctio, laboriosam ipsam quae magnam cum numquam dicta est impedit facilis similique deserunt deleniti quasi aspernatur, cupiditate tempora doloribus iste! Error?', 'Se recibió el mensaje');
    $msg->setAttribute('icon', true);

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
    <?= $msg->successMsg() ?>
    <?= $msg->dangerMsg() ?>
</body>
</html>