<?php
    require_once '../../../vendor/autoload.php';

    use Core\Exception\DatabaseException;
    use Core\Response;
    use Tools\Env;

    try {
        Env::getEnv();

        throw new DatabaseException('No se especificó el archivo de peticiones. Intentelo más tarde', 404);
    } catch (Exception $e) {
        $errorResponse = new Response(
            $e->getCode(),
            $e->getMessage()
        );

        echo $errorResponse->__toString();
    }