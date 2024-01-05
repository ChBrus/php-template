<?php
    namespace Core\Interfaces;

    use Core\Response;

    interface CRUDInterface {
        /**
         * Crea una nueva entidad en la base de datos basándose
         * en los atributos de la clase que heredó este método
         *
         * @param string|null $columns
         * @return Response
         */
        public function create($columns = null) : Response;

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
         * @return Response
         */
        public function select($columns = '*', $conditions = []) : Response;

        /**
         * Método para hacer peticiones de actualizaciones de datos en una tabla de la base de datos
         *
         * @return Response
         */
        public function update() : Response;

        /**
         * Método para hacer peticiones de eliminación de datos en una tabla de la base de datos
         *
         * @return Response
         */
        public function delete() : Response;

        /**
         * Obtiene la cantidad de filas que tiene la tabla a la que se hace referencia
         *
         * @param int $table_or_view
         * @return Response
         */
        public function getRows() : Response;
    }
?>