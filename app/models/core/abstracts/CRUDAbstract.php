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
        private const TYPE_MAPPING = [
            'integer' => DB::PARAM_INT,
            'boolean' => DB::PARAM_BOOL,
            'NULL' => DB::PARAM_NULL,
            'string' => DB::PARAM_STR
        ];

        public function __construct() {
            try {
                Env::getEnv();

                if (!isset($_ENV)) throw new DatabaseException('Las variables de entorno no cargaron', 16);

                $this->database = new DB();
                $this->limitQuery = (int) $_ENV['maxRows'];
                $this->table_or_view = '';
            } catch(Exception $e) {
                $error = new Response(500, $e->getMessage());
                die($error->__toString());
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
                    $currentPointer = $array_pointer[$pointerIndex];
                    $classPointer = str_replace(':', '', $currentPointer);
                    $pointerType = gettype($this->$classPointer);

                    $query->bindValue($currentPointer, $this->$classPointer, self::TYPE_MAPPING[$pointerType] ?? DB::PARAM_STR);
                }

                $query->execute();

                if ($query === false) throw new DatabaseException('Algo ha pasado al momento de ejecutar la petición al servidor');

                return new Response(200, true);
            } catch(Exception $e) {
                return new Response(500, $e->getMessage());
            }
        }

        public function update($columns = null, $conditions = []) : Response {
            try {
                # Columns and pointers config
                list(
                    'column' => $column,
                    'pointer' => $pointers
                ) = array_map(fn($value) => explode(', ', $value) , $this->getColumnPointer($columns));

                $queryString = "UPDATE `{$_ENV['DB']}`.`{$this->table_or_view}`
                SET ";

                for ($columnIndex = 0; $columnIndex < count($column); $columnIndex++) {
                    $queryString .= "{$column[$columnIndex]} = {$pointers[$columnIndex]}";

                    if ($columnIndex !== count($column) - 1) $queryString .= ", ";
                }

                $queryString .= (!empty($conditions) ?
                " WHERE" . rtrim(
                    array_reduce($conditions, function($carry, $item) {
                        return $carry . " (" . $item . ") AND";
                    }), ' AND'
                ) . ';' : ';');

                $query = $this->database->prepare($queryString);

                foreach ($pointers as $pointer) {
                    $classPointer = str_replace(':', '', $pointer);
                    $pointerType = gettype($this->$classPointer);

                    $query->bindValue($pointer, $this->$classPointer, self::TYPE_MAPPING[$pointerType] ?? DB::PARAM_STR);
                }

                echo '<pre>';
                var_dump(new Response(200, [$column, $pointers, $queryString]));
                echo '</pre>';

                $query->execute();

                if ($query === false) throw new DatabaseException('Algo ha pasado al momento de ejecutar la petición al servidor');

                return new Response(200, [$column, $pointers, $queryString]);
            } catch (Exception $e) {
                return new Response(500, $e->getMessage());
            }
        }

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
                    " WHERE" . rtrim(
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
                $user_array = str_replace(' ', '', $columns); // Quitamos espacios en blanco
                $user_array = explode(',', $user_array); // Transformamos a array
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
         * Agregas un valor a la propiedad table_or_view
         *
         * @param string $table_or_view
         * @return void
         */
        public function addFrom($table_or_view) {
            $this->table_or_view = $table_or_view;
        }

        /**
         * Eliminas el valor de la propiedad table_or_view
         *
         * @return void
         */
        public function dropFrom() {
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