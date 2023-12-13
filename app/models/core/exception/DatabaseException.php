<?php
    namespace Core\Exception;

    use PDOException;
    use Throwable;
    use Build\Message;
    use Enums\Msg\Properties as MsgProperties;
    use Enums\DB\Properties;

    class DatabaseException extends PDOException
    {
        private Message $alert;
        private string $alertHeader;

        /**
         * Excepciones para las peticiones y conexiones a bases de datos
         *
         * @param string $message
         * @param int $code
         * @param Throwable|null $previous
         */
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);

            $this->alert = new Message($message);
            $this->alertHeader = 'Database error connection';
        }

        /**
         * Muestra el mensaje de error con una alerta
         *
         * @return string
         */
        public function show()
        {
            $this->alert->setAttribute(MsgProperties::header, $this->alertHeader);
            return htmlentities($this->alert->dangerMsg());
        }

        /**
         * Pone un valor a una propiedad de la clase
         *
         * @param Properties $propertyName
         * @param mixed $value
         * @return void
         */
        public function setAttribute(Properties $propertyName, $value) {
            $name = $propertyName->getValue();

            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }

        /**
         * Configura los atributos de la alerta
         *
         * @param MsgProperties $propertyName
         * @param mixed $value
         * @return void
         */
        public function configAlert(MsgProperties $propertyName, $value) {
            $this->alert->setAttribute($propertyName, $value);
        }

        /**
         * Regresa el valor de cualquier atributo en el objeto
         *
         * @param string $name
         * @return mixed
         */
        public function __get($name) {
            if (property_exists($this, $name)) {
                return $this->$name;
            }
        }
    }
?>