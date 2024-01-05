<?php
    namespace Core\Interfaces;

    interface BaseInterface {
        /**
         * Retorna alguna propiedad de la clase
         *
         * @param string $property
         * @return mixed
         */
        public function __get($property) : mixed;

        /**
         * Obtiene las características del objeto como un JSON
         *
         * @return mixed
         */
        public function __toString();

        /**
         * Transforma las características del objeto en un
         * diccionario
         *
         * @return array
         */
        public function __toArray();
    }
?>