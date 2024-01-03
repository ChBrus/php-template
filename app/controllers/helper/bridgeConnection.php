<?php
    use Build\PageBuilder;

    function bridgeConnection() {
        return PageBuilder::getProjectURL() . 'app/controllers/connection/';
    }
?>