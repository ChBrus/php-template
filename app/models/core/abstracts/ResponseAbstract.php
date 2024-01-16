<?php
    namespace Core\Abstracts;

    use Core\Abstracts\BaseAbstract;
    use Core\Exception\DatabaseException;
    use Core\Response;
    use Exception;
    use Tools\JSON;

    abstract class ResponseAbstract extends BaseAbstract {

        public static function getResponse() {
            try {
                JSON::decode();

                match ($_SERVER['REQUEST_METHOD']) {
                    'POST' => self::POST(),
                    'GET' => self::GET(),
                    default => self::ERROR()
                };
            } catch (Exception $e) {
                $exception = new DatabaseException($e->getMessage(), $e->getCode(), $e->getPrevious());

                $error = new Response($e->getCode(), $exception->show());

                die ($error->__toString());
            }
        }

        public static function GET() {
            $response = new Response(200, bold('Estado: ') . $_GET['msg']);

            echo $response->__toString();
        }

        public static function POST() {
            $response = new Response(500, bold('Estado: ') . 'No existe funciones en este tipo de Request');

            echo $response->__toString();
        }

        public static function ERROR() {
            $response = new Response(500, bold('Estado: ') . 'No se insertó el método de petición correcto');

            echo $response->__toString();
        }
    }