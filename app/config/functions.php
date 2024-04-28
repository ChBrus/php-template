<?php

function initProjectName() {
    match (boolval($_ENV['ProjectRoot'])) {
        false => setcookie('projectName', '/' . $_ENV['ProjectName'] . '/', time() + (60*60*24), '/'),
        true => setcookie('projectName', '/', time() + (60*60*24), '/')
    };
}