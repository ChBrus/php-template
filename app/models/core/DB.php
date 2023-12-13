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
                die(
                    json_encode([
                        'status' => 500,
                        'response' => $e->show()
                    ])
                );
            } catch (PDOException $e) {
                $pdoException = new DatabaseException($e->getMessage());

                $alertHeader = match($e->getCode()) {
                    1045 => 'No tienes permisos para conectarte a la base de datos',
                    default => 'Error con la conexión PDO'
                };

                $pdoException->setAttribute(\Enums\DB\Properties::alertHeader, $alertHeader);

                die(
                    json_encode([
                        "status" => 500,
                        "response" => $pdoException->show()
                    ])
                );
            }
        }
    }
?>