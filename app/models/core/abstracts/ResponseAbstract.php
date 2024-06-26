<?php
    namespace Core\Abstracts;

    use Build\PageBuilder;
    use Core\Abstracts\BaseAbstract;
    use Core\Exception\DatabaseException;
    use Core\Response;
    use Exception;
    use Tools\JSON;

    abstract class ResponseAbstract extends BaseAbstract {
        public static final function getResponse() {
            try {
                if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
                    header('Location: ' . PageBuilder::getProjectURL());
                    exit();
                }

                JSON::decode();

                match ($_SERVER['REQUEST_METHOD']) {
                    'POST' => static::POST(),
                    'GET' => static::GET(),
                    'PUT' => static::PUT(),
                    'PATCH' => static::PATCH(),
                    'DELETE' => static::DELETE(),
                    default => static::ERROR()
                };
            } catch (Exception $e) {
                $exception = new DatabaseException('Ocurrió un error en el envío de la petición al servidor', $e->getCode(), $e->getPrevious());

                $error = new Response($e->getCode(), $exception->getMessage());

                die ($error->__toString());
            }
        }

        public static function GET() {echo self::ERROR();}

        public static function POST() {echo self::ERROR();}

        public static function PUT() {echo self::ERROR();}

        public static function PATCH() {echo self::ERROR();}
        
        public static function DELETE() {echo self::ERROR();}

        public static function ERROR() {return self::messageError()->__toString();}

        public static function messageError() {
            $error = new DatabaseException('No existe ninguna funcionalidad que se parezca a la solicitada');
            $response = new Response(404, $error->getMessage());

            return $response;
        }

        /**
         * Cuenta la cantidad de ítems en una tabla
         *
         * @param string $table
         * @param \Core\Abstracts\DBALAbstract $object
         * @return void
         */
        protected static final function count($table, $object) {
            $queryBuilder = $object->getQueryBuilder();

            $query = $queryBuilder
                ->select('COUNT(*)')
                ->from($table)
                ->executeQuery()
            ;

            $maxData = $query->fetchOne();
            $maxData = ceil($maxData / $object->__get('maxResults'));

            setcookie('maxPages', $maxData, time() + 60*60*24, '/');
        }

        /**
         * Busca ciertos valores de una columna de la tabla
         *
         * @param string $table
         * @param \Core\Abstracts\DBALAbstract $object
         * @return string
         */
        protected static final function search($table, $object) {
            try {
                $queryBuilder = $object->getQueryBuilder();

                if ($_GET['columna'] === 'Columna') throw new Exception('La columna insertada no se reconoce en la base de datos');

                $queryResponse = $queryBuilder
                    ->select('*')
                    ->from($table)
                    ->where($queryBuilder->expr()->like($_GET['columna'], '\'%' . $_GET['searchVal'] . '%\''))
                    ->executeQuery()
                ;

                $response = new Response(200, $queryResponse->fetchAllAssociative());

                return $response->__toString();
            } catch (Exception $e) {
                $errorResponse = new Response($e->getCode(), $e->getMessage());
                $errorResponse->setAlert('Estatus: ' . $e->getMessage(), 'La función de búsqueda tuvo unos problemas');

                return $errorResponse->__toString();
            }
        }
    }