<?php
    namespace Core;

    use Core\Interfaces\BaseInterface;
    use PDOStatement;
    use Exception;

    class Response implements BaseInterface {
        public int $status;
        public string | PDOStatement | bool | array $response;

        /**
         * Construye el objeto Response
         *
         * @param int $status
         * @param string | PDOStatement | bool | array $response
         */
        public function __construct($status, $response = true) {
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

        public function __set($property, $value) : void {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        public function __get($property) : mixed {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
            return null;
        }
    }
?>