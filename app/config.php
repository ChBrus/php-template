<?php
    use Build\PageBuilder;
    use Tools\Env;

    Env::getEnv();

    define('CONNECTION_PATH', PageBuilder::getProjectURL() . 'app/controllers/connection/')
?>