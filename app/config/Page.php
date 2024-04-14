<?php

namespace Config;

use Build\{PageBuilder, StatusEnum};

class Page {
    /**
     * Inicializa el estado de la página
     *
     * @return void
     */
    public static function init() {
        switch(PAGE_STATUS) {
            case StatusEnum::DEV:
                header('location: ' . PageBuilder::getProjectURL() . 'dev/');
                exit;
            case StatusEnum::ERROR_SERVER:
                header('location: ' . PageBuilder::getProjectURL() . 'error_server/');
                exit;
        }
    }

    public static function dev() { self::updateStatus(StatusEnum::DEV); }
    public static function error_server() { self::updateStatus(StatusEnum::ERROR_SERVER); }

    /**
     * Actualiza el estado de una página
     *
     * @param StatusEnum $status
     * @return void
     */
    public static function updateStatus($status) {
        define('PAGE_STATUS', $status);

        self::init();
    }
}