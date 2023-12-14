<?php
    namespace Core;

    use Core\Abstracts\CRUDAbstract;

    class User extends CRUDAbstract {
        public $id;
        public $name;
        public $last_name;

        public function __construct($id, $name, $last_name) {
            $this->id = $id;
            $this->name = $name;
            $this->last_name = $last_name;
            parent::__construct();
        }
    }
?>