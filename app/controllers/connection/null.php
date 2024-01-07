<?php
    require_once '../../../vendor/autoload.php';

    use Core\Exception\DatabaseException;
    use Core\Response;
    use Tools\Env;

    try {
        Env::getEnv();

        throw new DatabaseException(bold("Estado de base de datos: ") . 'No se especificó ningún archivo de dónde sacar los datos a insertar', 501);
    } catch (Exception $e) {
        $pdoException = new DatabaseException($e->getMessage(), (int) $e->getCode(), $e->getPrevious());
        $errorResponse = new Response(
            $e->getCode() > 500 ? $e->getCode() : 500,
            $pdoException->show()
        );

        echo $errorResponse->__toString();
    }
?>