<?php
    namespace Core\Abstracts;

    use Core\DBAL;
    use Core\Exception\DatabaseException;
    use Core\Abstracts\BaseAbstract;
    use Core\Interfaces\DBALInterface;
    use Core\Response;
    use Doctrine\DBAL\Connection;
    use Doctrine\DBAL\Query\QueryBuilder;
    use Exception;
    use Tools\Env;

    abstract class DBALAbstract extends BaseAbstract implements DBALInterface {
        protected int $firstResult;
        protected int $maxResults;
        private DBAL $conn;

        public function __construct() {
            try {
                Env::getEnv();

                if (!isset($_ENV)) throw new DatabaseException('Las variables de entorno no cargaron');

                $this->conn = new DBAL();
                $this->maxResults = (int) $_ENV['maxRows'];
                $this->firstResult = 0;
            } catch(Exception $e) {
                $errorResponse = new Response($e->getCode(), $e->getMessage());
                $errorResponse->setAlert($errorResponse->response);

                die($errorResponse->__toString());
            }
        }

        public function getConn() : Connection {
            return $this->conn->getConn();
        }

        public function getQueryBuilder() : QueryBuilder {
            return $this->conn->getQueryBuilder();
        }

        /**
         * Cambia el limite de datos que nos llevamos de cualquier tabla/vista
         *
         * @param int $maxResults
         * @return void
         */
        public function setMaxResults($maxResults) {
            $this->maxResults = (int) $maxResults;
        }

        /**
         * Pone un valor inicial de a partir de cual fila, obtenemos datos
         *
         * @param int | string $page_number
         * @return void
         */
        public function setFirstResult($page_number) {
            $this->firstResult = ((int) $page_number) * $this->maxResults;
        }
    }