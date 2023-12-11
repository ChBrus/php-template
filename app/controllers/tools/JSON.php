<?php
    namespace Tools;

    class JSON {
        /**
         * Decodifica el JSON que se envió por método POST a la página y lo inserta en el valor de $_POST
         *
         * @return void
         */
        public static function decode() {
            $json = self::getJSON();

            $_POST = json_decode($json, true);
        }

        /**
         * Obtiene todo el JSON que se pasó por método POST a X página
         *
         * @return bool | string
         */
        public static function getJSON() {
            return file_get_contents("php://input");
        }
    }
?>