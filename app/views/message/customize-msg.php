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
<?php endif ?>
    <div class="alert alert-<?= $_POST['color'] ?? 'black' ?> query-msg" role="alert">
      <?php if (isset($_POST['header'])): ?>
        <h4 class="alert-heading">
          <?= $_POST['header'] ?>
        </h4>
        <hr>
      <?php endif ?>
      <?php if (isset($_POST['msg'])): ?>
        <p class="description">
          <?= $_POST['msg'] ?>
        </p>
      <?php endif ?>
      <?php if (isset($_POST['is_btn'])): ?>
        <button type="button" class="btn btn-outline-<?= $_POST['color'] ?? 'black' ?> w-100" id="query-msg-btn-icon" location="<?= $_POST['location'] ?>">
          <?= isset($_POST['icon']) ? $_POST['icon'] : '' ?>
          <span class="btn-description"><?= isset($_POST['btn_description']) ? $_POST['btn_description'] : 'Confirmar' ?></span>
        </button>
      <?php endif ?>
    </div>
<?php if (isset($_POST['script'])): ?>
    <?= $_POST['script'] ?>
  </body>
<?php endif ?>