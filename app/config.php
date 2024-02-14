<?php
    use Build\PageBuilder;
    use Tools\Env;

    Env::getEnv();

    define('CONNECTION_PATH', PageBuilder::getProjectURL() . 'api/');

    match (boolval($_ENV['ProjectIsRoot'])) {
        false => setcookie('projectName', '/' . $_ENV['ProjectName'] . '/', time() + (60*60*24), '/'),
        true => setcookie('projectName', '/', time() + (60*60*24), '/')
    };