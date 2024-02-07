<?php
    require_once '../../../vendor/autoload.php';

    use Tools\JSON;

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') JSON::decode();
?>
<?php if (isset($_POST['head'])): ?>
    <head>
        <?= $_POST['head'] ?>
        <title>¡Alerta!</title>
    </head>
    <body>
<?php endif; ?>
<div class="alert alert-success query-msg" role="alert">
    <?php if (isset($_POST['header'])): ?>
        <h4 class="alert-heading">
            <?= $_POST['header'] ?>
        </h4>
        <hr>
    <?php endif; ?>
    <p class="description">
        <?= $_POST['msg'] ?>
    </p>
    <?php if (isset($_POST['icon'])): ?>
        <button type="button" class="btn btn-outline-success w-100" id="query-msg-btn-icon" location="<?= $_POST['location'] ?>">
            <?= $_POST['icon'] ?>
            <span class="btn-description">Confirmar</span>
        </button>
    <?php endif; ?>
</div>
<?php if (isset($_POST['script'])): ?>
        <?= $_POST['script'] ?>
    </body>
<?php endif; ?>