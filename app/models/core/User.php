<?php
    namespace Core;

    use Core\Abstracts\CRUDAbstract;

    class User extends CRUDAbstract {
        public $id;
        public $name;
        public $last_name;

        public function __construct() {
            parent::__construct();
        }
    }
?>