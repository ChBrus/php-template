<?php function bold($text) { 
    ob_start(); ?>

    <b class="text-printed"><?= $text ?></b>

<?php return ob_get_clean();
} ?>