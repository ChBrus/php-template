<?php
    namespace Core\Abstracts;

    use Core\{DB, Response};
    use Core\Exception\DatabaseException;
    use Exception;
    use Core\Interfaces\{CRUDInterface, BaseInterface};
    use Tools\Env;

    abstract class CRUDAbstract implements CRUDInterface, BaseInterface {
        protected int $startIndex;
        protected string $table_or_view;
        protected int $limitQuery;
        private DB $database;

        public function __construct() {
            try {
                Env::getEnv();

                if (!isset($_ENV)) throw new DatabaseException('Las variables de entorno no cargaron', 16);

                $this->database = new DB();
                $this->limitQuery = (int) $_ENV['maxRows'];
                $this->tables = '';
            } catch(Exception $e) {
                die(
                    json_encode([
                        "status" => 500,
                        "response" => $e->getMessage()
                    ])
                );
            }
        }

        public function create($columns = null) : Response {
            try {
                $columnPointer = $this->getColumnPointer($columns);
                $column = $columnPointer['column'];

                $pointer = $columnPointer['pointer'];

                $query = $this->database->prepare(
                    "INSERT INTO `{$_ENV['DB']}`.`{$this->table_or_view}`({$column})
                    VALUES ({$pointer})"
                );

                $array_pointer = explode(', ', $pointer);

                for ($pointerIndex = 0; $pointerIndex < count($array_pointer); $pointerIndex++) {
                    $typeMapping = [
                        'integer' => DB::PARAM_INT,
                        'boolean' => DB::PARAM_BOOL,
                        'NULL' => DB::PARAM_NULL,
                        'string' => DB::PARAM_STR
                    ];

                    $currentPointer = $array_pointer[$pointerIndex];
                    $classPointer = str_replace(':', '', $currentPointer);
                    $pointerType = gettype($this->$classPointer);

                    $query->bindValue($currentPointer, $this->$classPointer, $typeMapping[$pointerType] ?? DB::PARAM_STR);
                }

                $query->execute();

                if ($query === false) throw new DatabaseException('Algo ha pasado al momento de ejecutar la petición al servidor');

                return new Response(200, true);
            } catch(Exception $e) {
                return new Response(500, $e->getMessage());
            }
        }

        public function update() : Response {return new Response(500, 'Unaccessable function');}

        public function delete() : Response {return new Response(500, 'Unaccessable function');}

        public function select($columns = '*', $conditions = []) : Response {
            try {
                if (empty($columns)) throw new DatabaseException('No se especificó ninguna columna');

                if ($columns !== '*') {
                    $columns_array = explode(', ', $columns);
                    $attributes_array = array_keys($this->__toArray());
                    $array_diff_columns_attributes = array_diff($columns_array, $attributes_array);
                }

                if (!empty($array_diff_columns_attributes)) throw new DatabaseException('No existe la columna / las columnas: ' . implode(', ', $array_diff_columns_attributes));

                $query = $this->database->prepare(
                    "SELECT {$columns} FROM `{$_ENV['DB']}`.`{$this->table_or_view}`" .
                    (!empty($conditions) ?
                    " WHERE " . rtrim(
                        array_reduce($conditions, function($carry, $item) {
                            return $carry . " (" . $item . ") AND";
                        }), ' AND'
                    ) : '') .
                    "LIMIT {$this->startIndex},{$this->limitQuery};"
                );

                $response = $query->execute();

                if ($response === false) throw new DatabaseException('Algo ha pasado al momento de ejecutar la petición al servidor');

                $result = $query;
                $query = null;

                return new Response(200, $result);
            } catch(Exception $e) {
                return new Response(500, $e->getMessage());
            }
        }

        public function getRows() : Response {
            try {
                $query = $this->database->prepare(
                    "SELECT COUNT(*) FROM `{$_ENV['DB']}`.`{$this->table_or_view}`;"
                );

                $response = $query->execute();

                if ($response === false) throw new DatabaseException("Something happened");

                $maxData = $query->fetchColumn();
                
                $maxData = ceil($maxData / $this->limitQuery);

                setcookie('maxPages', $maxData, time() + 60*60*24,'/');

                return new Response(200, true);
            } catch(Exception $e) {
                return new Response(500, $e->getMessage());
            }
        }

        public function __set($property, $value) : void {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        public function __get($property) : mixed {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
            return null;
        }

        public function __toString() {
            return json_encode($this);
        }

        public function __toArray() {
            $jsonObject = $this->__toString();

            $jsonDecode = json_decode($jsonObject, true);

            return $jsonDecode;
        }

        /**
         * Obtiene la columna y el puntero para usar en la petición SQL
         *
         * @param string|null $columns
         * @return array
         */
        private function getColumnPointer($columns = null) {
            $user_array = array_keys($this->__toArray());

            if (!empty($columns)) {
                try {
                    $user_array = explode(', ', $columns);
                } catch (Exception $e) {
                    $user_array = explode(',', $columns);
                }
            }

            $user_array_column = array_map(function($value) {
                return "`{$value}`";
            }, $user_array);

            $user_array_pointer = array_map(function($value) {
                return ":{$value}";
            }, $user_array);

            return [
                'column' => implode(', ', $user_array_column),
                'pointer' => implode(', ', $user_array_pointer)
            ];
        }

        /**
         * Añade una tabla a la lista de tablas que tiene acceso la clase
         *
         * @param string $name
         * @return void
         */
        public function addTableOrView($name) {
            $this->table_or_view = $name;
        }

        /**
         * Elimina una tabla de la lista de tablas que tiene acceso la clase
         *
         * @return void
         */
        public function dropTableOrView() {
            $this->table_or_view = '';
        }

        /**
         * Cambia el limite de datos que nos llevamos de cualquier tabla/vista
         *
         * @param int $limitQuery
         * @return void
         */
        public function setLimitQuery($limitQuery) {
            $this->limitQuery = $limitQuery;
        }

        /**
         * Cambia el valor de isView de la clase
         *
         * @param bool $isView
         * @return void
         */
        public function setIsView($isView) {
            $this->isView = $isView;
        }

        /**
         * Pone valor a la variable startIndex
         *
         * @param int | string $page
         * @return void
         */
        public function setStartIndex($page) {
            $this->startIndex = ((int) $page) * $this->limitQuery;
        }
    }
?>