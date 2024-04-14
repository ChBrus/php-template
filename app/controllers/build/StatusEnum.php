<?php

namespace Build;

use Build\Message\{Message, Properties};
use Core\Response;

enum StatusEnum {
    case ENABLED;
    case DEV;
    case ERROR_SERVER;

    public static function get($status) {
        return match($status) {
            'ENABLED' => self::ENABLED,
            'DEV' => self::DEV,
            'ERROR_SERVER' => self::ERROR_SERVER,
        };
    }

    public function build() {
        $msg = match($this) {
            self::DEV => new Message('Este apartado no estará hábil por un tiempo, ya que entro a un ambiente de desarrollo o actualización.', 'Sección en desarrollo'),
            self::ERROR_SERVER => new Message('Se bloqueó este sitio porque se encontraron errores.', 'Error del servidor')
        };

        $msg->setAttribute(Properties::buildScripts, true);

        $response = match($this) {
            self::ENABLED => new Response(200, [
                'status' => self::ENABLED,
                'class' => '',
                'response' => $msg->dangerMsg()
            ]),
            default => new Response(200, [
                'status' => null,
                'class' => 'disabled',
                'response' => $msg->dangerMsg()
            ])
        };

        $response->response['status'] = match($this) {
            self::DEV => self::DEV,
            self::ERROR_SERVER => self::ERROR_SERVER
        };

        return $response;
    }
}