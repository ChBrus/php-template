<?php
    namespace Core\Interfaces;

    interface CRUDInterface {
        /**
         * Método para hacer peticiones de incersión en una tabla de la base de datos
         *
         * @return bool
         */
        public function create() : bool;

        /**
         * Método para hacer peticiones de datos que quiera de una tabla de la base de datos
         *
         * @return array
         */
        public function select() : array;

        /**
         * Método para hacer peticiones de actualizaciones de datos en una tabla de la base de datos
         *
         * @return bool
         */
        public function update() : bool;

        /**
         * Método para hacer peticiones de eliminación de datos en una tabla de la base de datos
         *
         * @return bool
         */
        public function delete() : bool;
    }
?>