<div class="alert alert-danger query-msg" role="alert">
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
        <button type="button" class="btn btn-outline-danger w-100" id="query-msg-btn-icon">
            <?= $_POST['icon'] ?>
            <span class="btn-description">Confirmar</span>
        </button>
        <script>
            const URLToGo = '<?= $_POST['location'] ?>';
        </script>
    <?php endif; ?>
</div>