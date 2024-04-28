<?php

use Build\PageBuilder;
use Tools\Env;

Env::getEnv();

define('API_PATH', PageBuilder::getProjectURL() . 'api/');
define('PROJECT_URL', PageBuilder::getProtocol() . PageBuilder::getAbsoluteProjectURL());

initProjectName();