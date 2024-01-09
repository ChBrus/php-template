<?php
    namespace Core\Abstracts;

    use Core\Interfaces\BaseInterface;

    abstract class BaseAbstract implements BaseInterface {
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

        public function __toString() {
            return json_encode($this);
        }

        public function __toArray() {
            $jsonObject = $this->__toString();

            $jsonDecode = json_decode($jsonObject, true);

            return $jsonDecode;
        }
    }
?>