<?php
    namespace Core;

    use Doctrine\DBAL\Query\QueryBuilder;
    use Tools\Env;
    use Core\Interfaces\DBALInterface;
    use Core\Exception\DatabaseException;
    use Core\Response;
    use Doctrine\DBAL\{DriverManager, Connection};
    use Exception;

    class DBAL implements DBALInterface {
        protected string $host;
        protected string $user;
        protected string $password;
        protected string $database;
        protected string $driver;
        protected string $charset;
        private Connection $connection;

        /**
         * Hace la conexion a la base de datos
         */
        public function __construct() {
            try {
                Env::getEnv();

                if (empty($_ENV)) throw new DatabaseException(bold('Estado de base de datos: ') . 'Imposible hacer una conexión a la base de datos');

                $this->host = $_ENV['DBHost'];
                $this->user = $_ENV['DBName'];
                $this->password = $_ENV['DBPassword'];
                $this->database = $_ENV['DB'];
                $this->charset = $_ENV['DBCharset'];
                $this->driver = 'pdo_mysql';

                $this->connection = DriverManager::getConnection($this->getParamsConnection());
            } catch (Exception $e) {
                $errorResponse = new Response($e->getCode(), $e->getMessage());
                $errorResponse->setAlert('Estatus: ' . $e->getMessage(), 'Error de conexión a la base de datos');

                die($errorResponse->__toString());
            }
        }

        public function getConn() : Connection {
            return $this->connection;
        }

        public function getQueryBuilder() : QueryBuilder {
            return $this->getConn()->createQueryBuilder();
        }

        /**
         * Obtiene los parámetros para hacer una conexión a la base de datos
         *
         * @return array
         */
        private function getParamsConnection() : array {
            return [
                'dbname' => $this->database,
                'user' => $this->user,
                'password' => $this->password,
                'host' => $this->host,
                'driver' => $this->driver,
                'charset' => $this->charset
            ];
        }
    }
?>