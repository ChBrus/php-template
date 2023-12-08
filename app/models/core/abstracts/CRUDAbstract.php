<?php
    namespace Core\Abstracts;

    use Core\DB;
    use Core\Exception\DatabaseException;
    use Core\Interfaces\CRUDInterface;
    use Tools\Env;

    abstract class CRUDAbstract implements CRUDInterface {
        protected $tables;
        protected $maxRows;
        private DB $database;

        public function __construct() {
            try {
                Env::getEnv();

                if (!isset($_ENV)) throw new DatabaseException('Las variables de entorno no cargaron', 16);

                $this->database = new DB();
                $this->maxRows = $_ENV['maxRows'];
                $this->tables = array();
            } catch (DatabaseException $e) {
                die($e->show());
            }
        }

        public function addTable($table) {

        }
    }
?>