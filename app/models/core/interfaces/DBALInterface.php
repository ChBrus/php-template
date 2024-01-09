<?php
    namespace Core\Interfaces;

    use Doctrine\DBAL\Connection;
    use Doctrine\DBAL\Query\QueryBuilder;

    interface DBALInterface {
        /**
         * Obtenemos la conexión como una instancia del objeto DBAL\Connection
         *
         * @return Connection
         */
        public function getConn() : Connection;

        /**
         * Obtenemos un constructor de queries como una instancia del objeto
         * DBAL\Query\QueryBuilder
         *
         * @return QueryBuilder
         */
        public function getQueryBuilder() : QueryBuilder;
    }
?>