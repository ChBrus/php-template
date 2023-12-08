<?php
    namespace Enums\DB;

    use Core\Tables as TableObject;

    enum Tables {
        /**
         * Constructor para los enums con sus respectivos nombres de tablas
         *
         * @param string $tableName
         */
        private function __construct($tableName) {
            self::$tableName = new TableObject($tableName);
        }
    }
?>