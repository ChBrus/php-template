<?php
    namespace User;

    use Core\Abstracts\DBALAbstract;

    class User extends DBALAbstract {
        protected int $id;
        public string $name;
        public string $last_name;
        public function __construct($name = '', $last_name = '') {
            $this->name = $name;
            $this->last_name = $last_name;

            parent::__construct();
        }
    }