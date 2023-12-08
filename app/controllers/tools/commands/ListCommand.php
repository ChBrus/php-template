<?php
    namespace Tools\Commands;

    class ListCommand {
        public const LIST_CUSTOM = 0;
        public const LIST_ONLYDIR = 1;

        /**
         * Ejecuta un comando parecido a 'ls' de bashshell
         *
         * @param string $directory
         * La carpeta a la que queremos obtener un listado de archivos y/o carpetas
         * @param int $options
         * Existen 2 diferentes opciones
         * @abstract LIST_CUSTOM
         * Con esta opción puedes pedir listar cualquier tipo de archivo y carpetas, o solo archivos
         * @abstract LIST_ONLYDIR
         * Con esta opción puedes listar solo carpetas
         * @return mixed
         */
        public static function execute($directory = './*', $options = 1) {
            switch ($options) {
                case self::LIST_CUSTOM:
                    return glob($directory);
                case self::LIST_ONLYDIR:
                    $directories = glob($directory, GLOB_ONLYDIR);
                    return self::list_onlydir($directories);
            }
        }

        /**
         * Lista solo carpetas, esta es una función especial y específica
         *
         * @param array $directories
         * @return array
         */
        private static function list_onlydir($directories) {
            $array = array();
            $wordsUnnedded = [
                './app',
                './test',
                './vendor'
            ];

            foreach ($directories as $d) {
                $isntRepeated = false;
                for ($i = 0; $i < count($wordsUnnedded); $i++) {
                    if (!str_contains($wordsUnnedded[$i], $d)) {
                        $isntRepeated = true;
                    } else {
                        $isntRepeated = false;
                        break;
                    }
                }

                if ($isntRepeated) {
                    array_push($array, $d);
                }
            }

            return $array;
        }
    }
?>