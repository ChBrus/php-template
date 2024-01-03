<?php
    require_once '../../../vendor/autoload.php';

    use Core\Exception\DatabaseException;
    use Tools\Env;

    try {
        Env::getEnv();

        throw new DatabaseException(bold("Estado de base de datos: ") . 'No se especificó ningún archivo de dónde sacar los datos a insertar');
    } catch (Exception $e) {
        $pdoException = new DatabaseException($e->getMessage(), (int) $e->getCode(), $e->getPrevious());

        echo json_encode([
            'status'=> $e->getCode() > 500 ? $e->getCode() : 500,
            'response' => $pdoException->show()
        ]);
    }
?>