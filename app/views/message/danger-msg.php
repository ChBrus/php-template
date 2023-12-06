<div class="alert alert-danger alert-dismissible query-msg" role="alert">
    <?php if (isset($_POST['header'])): ?>
        <h4 class="alert-heading">
            <?= $_POST['header'] ?>
        </h4>
        <hr>
    <?php endif; ?>
    <p class="description">
        <?= $_POST['msg'] ?>
    </p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php if (isset($_POST['icon'])): ?>
        <button type="button" class="btn btn-outline-danger w-100">
            <i class="<?= $_POST['icon'] ?>"> Confirmar</i>
        </button>
    <?php endif; ?>
</div>