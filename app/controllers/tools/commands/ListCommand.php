<?php
    namespace Tools\Commands;

    class ListCommand {
        public const LIST_CUSTOM = 0;
        public const LIST_ONLYDIR = 1;

        public static function execute($directory = './*', $options = 1) {
            switch ($options) {
                case self::LIST_CUSTOM:
                    return glob($directory);
                case self::LIST_ONLYDIR:
                    $directories = glob($directory, GLOB_ONLYDIR);
                    return self::list_onlydir($directories);
            }
        }

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