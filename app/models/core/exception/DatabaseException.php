<?php
    namespace Core\Exception;

    use PDOException;
    use Throwable;
    use Build\Message\{Message, Properties};

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
            $this->alert->setAttribute(Properties::header, $this->alertHeader);
            $this->alert->setAttribute(Properties::location, '');

            return $this->alert->dangerMsg();
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