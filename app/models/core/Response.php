<?php
    namespace Core;

    use Core\Interfaces\BaseInterface;

    class Response implements BaseInterface {
        public int $status;
        public mixed $response;

        /**
         * Construye el objeto Response
         *
         * @param int $status
         * @param mixed $response
         */
        public function __construct($status, $response) {
            $this->status = $status;
            $this->response = $response;
        }

        public function __toArray() {
            $jsonObject = $this->__toString();

            $jsonDecode = json_decode($jsonObject, true);

            return $jsonDecode;
        }

        public function __toString() {
            return json_encode($this);
        }

        public function __get($property) : mixed {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
            return null;
        }
    }
?>