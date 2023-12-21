<?php
    namespace Core;

    use Core\Abstracts\CRUDAbstract;

    class User extends CRUDAbstract {
        protected int $id;
        public string $name;
        public string $last_name;

        public function __construct($name = '', $last_name = '') {
            $this->name = $name;
            $this->last_name = $last_name;

            parent::__construct();
        }
    }
?>