<?php function bold($text) { 
    ob_start(); ?>

    <b class="text-printed"><?= $text ?></b>

<?php return ob_get_clean();
} ?>

<?php function italicized($text) { 
    ob_start(); ?>

    <i class="text-printed"><?= $text ?></i>

<?php return ob_get_clean();
} ?>

<?php function underlined($text) { 
    ob_start(); ?>

    <u class="text-printed"><?= $text ?></u>

<?php return ob_get_clean();
} ?>