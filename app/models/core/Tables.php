<?php
    namespace Core;

    class Tables {
        private string $tableName;

        /**
         * Genera el objeto de tablas para los enumeradores
         *
         * @param string $tableName
         */
        public function __construct(string $tableName) {
            $this->tableName = $tableName;
        }

        /**
         * Obtiene el nombre de la tabla
         *
         * @return string
         */
        public function getTableName(): string {
            return $this->tableName;
        }
    }
?>