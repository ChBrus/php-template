<?php
    require_once '../../../vendor/autoload.php';

    use Core\Exception\DatabaseException;
    use Core\Response;
    use Tools\Env;

    try {
        Env::getEnv();

        throw new DatabaseException(
            bold("Estado: ") . 'No se especificó el archivo de peticiones. Intentelo más tarde',
            404);
    } catch (Exception $e) {
        $pdoException = new DatabaseException($e->getMessage(), (int) $e->getCode(), $e->getPrevious());
        $errorResponse = new Response(
            $e->getCode(),
            $pdoException->show()
        );

        echo $errorResponse->__toString();
    }