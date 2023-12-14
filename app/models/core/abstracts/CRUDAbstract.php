<?php
    namespace Core\Abstracts;

    use Core\DB;
    use Core\Exception\DatabaseException;
    use PDOException;
    use Core\Interfaces\CRUDInterface;
    use Tools\Env;

    abstract class CRUDAbstract implements CRUDInterface {
        public int $startIndex;
        protected array $tables;
        protected array $views;
        protected int $limitQuery;
        private DB $database;

        public function __construct() {
            try {
                Env::getEnv();

                if (!isset($_ENV)) throw new DatabaseException('Las variables de entorno no cargaron', 16);

                $this->database = new DB();
                $this->limitQuery = (int) $_ENV['maxRows'];
                $this->tables = array();
                $this->views = array();
            } catch (DatabaseException $e) {
                die($e->show());
            }
        }

        public function create($table = 0) : array {
            try {
                $query = $this->database->prepare(
                    "INSERT INTO `{$_ENV['DB']}`.`{$this->tables[$table]}`"
                );
                return [];
            } catch (DatabaseException $e) {
                return [
                    "status" => 500,
                    "response" => $e->show()
                ];
            }
        }

        public function update($table = 0) : array {return [];}

        public function delete($table = 0) : array {return [];}

        public function select($columns = '*', $conditions = [], $isView = false, $table_or_view = 0) : array {
            try {
                if (empty($columns)) throw new DatabaseException('No se especificó ninguna columna');

                if ($columns !== '*') {
                    $columns_array = explode(', ', $columns);
                    $attributes_array = array_keys($this->getAttributes());
                    $array_diff_columns_attributes = array_diff($columns_array, $attributes_array);
                }

                if (!empty($array_diff_columns_attributes)) throw new DatabaseException('No existe la columna / las columnas: ' . implode(', ', $array_diff_columns_attributes));

                $query = $this->database->prepare(
                    "SELECT {$columns} FROM `{$_ENV['DB']}`.`" .
                    ($isView ? $this->views[$table_or_view] : $this->tables[$table_or_view]) . "`" .
                    (!empty($conditions) ?
                    " WHERE " . rtrim(
                        array_reduce($conditions, function($carry, $item) {
                            return $carry . " (" . $item . ") AND";
                        }), ' AND'
                    ) : '') .
                    "LIMIT {$this->startIndex},{$this->limitQuery};"
                );

                $response = $query->execute();

                if ($response === false) throw new DatabaseException("Something happened");

                $result = $query;

                return [
                    "status"=> 200,
                    "response"=> $result
                ];
            } catch (DatabaseException $e) {
                return [
                    "status" => 500,
                    "response" => $e->show()
                ];
            } catch(PDOException $e) {
                $pdoException = new DatabaseException($e->getMessage());

                return [
                    "status" => 500,
                    "response" => $pdoException->show()
                ];
            }
        }

        public function __get($property) : mixed {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
            return null;
        }

        /**
         * Obtiene los atributos del objeto en un arreglo asociativo
         *
         * @return array
         */
        public function getAttributes() : array {
            $jsonObject = json_encode($this);

            $jsonDecode = json_decode($jsonObject, true);

            return $jsonDecode;
        }

        /**
         * Acompañado de @method array getAttributes() puedes obtener un JSON del arreglo dado
         *
         * @return string
         */
        public function getJSONObject() : string {
            return json_encode($this->getAttributes());
        }

        /**
         * Añade una tabla a la lista de tablas que tiene acceso la clase
         *
         * @param string $table
         * @return void
         */
        public function addTable($table) {
            array_push($this->tables, $table);
        }

        /**
         * Elimina una tabla de la lista de tablas que tiene acceso la clase
         *
         * @param string $table
         * @return void
         */
        public function dropTable($table) {
            define('table', $table);
            
            $this->tables = array_filter($this->tables, function($table) {
                return $table !== table ? $table : null;
            });
        }

        /**
         * Añade una tabla a la lista de tablas que tiene acceso la clase
         *
         * @param string $view
         * @return void
         */
        public function addView($view) {
            array_push($this->views, $view);
        }

        /**
         * Elimina una tabla de la lista de tablas que tiene acceso la clase
         *
         * @param string $view
         * @return void
         */
        public function dropView($view) {
            define('view', $view);
            
            $this->views = array_filter($this->views, function($view) {
                return $view !== view ? $view : null;
            });
        }

        /**
         * Cambia el limite de datos que nos llevamos de cualquier tabla/vista
         *
         * @param int $limitQuery
         * @return void
         */
        public function setLimitQuery(int $limitQuery) {
            $this->limitQuery = $limitQuery;
        }
    }
?>