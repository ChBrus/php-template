<?php
    namespace Tools;

    use Dotenv\Dotenv;

    class Env {
        /**
         * Devuelve el directorio dónde se ubica el archivo .env
         *
         * @return string
         */
        public static function getEnvFile()
        {
            $parent_reference = "";
            $sdir = function ($pr) {
                return scandir(__DIR__ . "/" . $pr);
            };

            $directory = $sdir($parent_reference);

            while (!array_search('.env', $directory)) {
                $parent_reference .= "../";
                $directory = $sdir($parent_reference);
            }

            $parent_reference = str_replace('/', '\\', $parent_reference);
            $parent_reference = substr($parent_reference, 0, strlen($parent_reference) - 1);

            return __DIR__ . '\\' . $parent_reference;
        }

        /**
         * Obtiene todas las variables del archivo .env
         *
         * @return void
         */
        public static function getEnv() {
            $dotenv = Dotenv::createImmutable(self::getEnvFile());
            $dotenv->load();
        }
    }
?>