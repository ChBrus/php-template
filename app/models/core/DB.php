<?php
    namespace Models\Core;

    use PDO;
    use PDOException;
    use Tools\Env;
    use Build\{PageBuilder, Message};

    class DB extends PDO {
        protected $host;
        protected $user;
        protected $password;
        protected $database;
        protected $charset;

        public function __construct() {
            try {
                Env::getEnv();

                $this->host = $_ENV['DBHost'];
                $this->user = $_ENV['DBName'];
                $this->password = $_ENV['DBPassword'];
                $this->database = $_ENV['DB'];
                $this->charset = $_ENV['DBCharset'];

                parent::__construct("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
            } catch (PDOException $e) {
                $danger = new Message($e->getMessage(), 'Database error conection');
                $danger->setAttribute('icon', true);
                echo PageBuilder::buildCustomBootstrap();

                die($danger->dangerMsg());
            }
        }
    }
?>