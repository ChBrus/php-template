<?php
    namespace Core\Interfaces;

    interface CRUDInterface {
        /**
         * Undocumented function
         *
         * @param integer $table
         * @return array
         */
        public function create($table = 0) : array;

        /**
         * Método para hacer peticiones de datos que quiera de una tabla de la base de datos
         * 
         * @param array | string $columns
         * @param array $conditions
         * Ejemplo de como hacer estas condiciones:
         * @code
         * [
         *  "name = 'Nombre'",
         * "last_name = 'Apellido'"
         * ]
         * @param int $table_or_view
         * @return array
         */
        public function select($columns = '*', $conditions = [], $table_or_view = 0) : array;

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

        /**
         * Obtiene la cantidad de filas que tiene la tabla a la que se hace referencia
         *
         * @param int $table_or_view
         * @return array
         */
        public function getRows($table_or_view = 0) : array;

        /**
         * Retorna alguna propiedad de la clase
         *
         * @param string $property
         * @return mixed
         */
        public function __get($property) : mixed;
    }
?>