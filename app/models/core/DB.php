<?php
    namespace Core;

    use PDO;
    use PDOException;
    use Core\Exception\DatabaseException;
    use Tools\Env;

    class DB extends PDO {
        protected $host;
        protected $user;
        protected $password;
        protected $database;
        protected $charset;

        /**
         * Hace la conexion a la base de datos
         */
        public function __construct() {
            try {
                Env::getEnv();

                $this->host = $_ENV['DBHost'];
                $this->user = $_ENV['DBName'];
                $this->password = $_ENV['DBPassword'];
                $this->database = $_ENV['DB'];
                $this->charset = $_ENV['DBCharset'];

                parent::__construct("mysql:host={$this->host};dbname={$this->database};charset={$this->charset}", $this->user, $this->password);
            } catch (DatabaseException $e) {
                die($e->show());
            } catch (PDOException $e) {
                $pdoException = new DatabaseException($e->getMessage());

                $alertHeader = match($e->getCode()) {
                    1045 => 'El usuario para la conexion no tiene permisos'
                };

                $pdoException->setAttribute(\Enums\DB\Properties::alertHeader, (strlen($alertHeader) > 0 ? $alertHeader : "Error con la conexion PDO"));

                die($pdoException->show());
            }
        }
    }
?>