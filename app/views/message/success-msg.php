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
        <button type="button" class="btn btn-outline-success w-100">
            <i class="<?= $_POST['icon'] ?>"> Confirmar</i>
        </button>
    <?php endif; ?>
</div>