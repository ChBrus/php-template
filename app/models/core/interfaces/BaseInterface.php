<?php
    namespace Core\Interfaces;

    interface BaseInterface {
        /**
         * Agrega un valor a la propiedad que se especifíque en
         * $property
         *
         * @param string $property
         * @param mixed $value
         * @return void
         */
        public function __set($property, $value) : void;

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
         * @return bool | string
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