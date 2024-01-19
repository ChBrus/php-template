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
                    'POST' => static::POST(),
                    'GET' => static::GET(),
                    'PUT' => static::PUT(),
                    'PATCH' => static::PATCH(),
                    'DELETE' => static::DELETE(),
                    default => static::ERROR()
                };
            } catch (Exception $e) {
                $exception = new DatabaseException(bold('Estado: ') . 'Ocurrió un error en el envío de la petición al servidor', $e->getCode(), $e->getPrevious());

                $error = new Response($e->getCode(), $exception->show());

                die ($error->__toString());
            }
        }

        public static function GET() {echo self::messageError()->__toString();}

        public static function POST() {echo self::messageError()->__toString();}

        public static function PUT() {echo self::messageError()->__toString();}

        public static function PATCH() {echo self::messageError()->__toString();}
        
        public static function DELETE() {echo self::messageError()->__toString();}

        public static function ERROR() {echo self::messageError()->__toString();}

        public static function messageError() {
            $error = new DatabaseException(bold('Estado: ') . 'No existe ninguna funcionalidad que se parezca a la solicitada');
            $response = new Response(500, $error->show());

            return $response;
        }
    }