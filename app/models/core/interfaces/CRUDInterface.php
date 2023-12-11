<?php
    namespace Core\Interfaces;

    interface CRUDInterface {
        /**
         * Método para hacer peticiones de incersión en una tabla de la base de datos
         *
         * @return array
         */
        public function create($table = 0) : array;

        /**
         * Método para hacer peticiones de datos que quiera de una tabla de la base de datos
         *
         * @param array | string $columns
         * @param int $table
         * @param string $conditions
         * @return array
         */
        public function select($columns = '*', $table = 0, $conditions = '') : array;

        /**
         * Método para hacer peticiones de actualizaciones de datos en una tabla de la base de datos
         *
         * @return array
         */
        public function update($table = 0) : array;

        /**
         * Método para hacer peticiones de eliminación de datos en una tabla de la base de datos
         *
         * @return array
         */
        public function delete($table = 0) : array;
    }
?>