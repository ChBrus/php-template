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
    }
?>