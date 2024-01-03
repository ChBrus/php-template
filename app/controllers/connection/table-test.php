<?php
    require_once '../../../vendor/autoload.php';

    use Core\{DB, User};
    use Core\Exception\DatabaseException;
    use Build\PageBuilder;
    use Tools\{JSON, Env};

    Env::getEnv();
    JSON::decode();

    if ($_POST['password'] !== 'javascript-async-fetch') header('location: ' . PageBuilder::getProjectURL());

    try {
        $user = new User();
        $user->addTable('users');
        $user->setStartIndex($_POST['page']);
    
        # User
        list(
            "status" => $status,
            "response" => $response
        ) = $user->select();
    
        # Count
        list(
            "status" => $countStatus,
            "response" => $countResponse
        ) = $user->getRows();

        if ($status === 500) throw new DatabaseException($response);
        else if ($countStatus === 500) throw new DatabaseException($countResponse);

        $lastResponse = $response->fetchAll(DB::FETCH_ASSOC);

        if (empty($lastResponse)) throw new DatabaseException(bold("Estado de base de datos:") . " No se encontró ningún dato en la tabla " . bold($user->__get('tables')[0]), 501);

        echo json_encode([
            "status" => $status,
            "response" => $lastResponse
        ]);
    } catch (Exception $e) {
        $pdoException = new DatabaseException($e->getMessage(), (int) $e->getCode(), $e->getPrevious());

        echo json_encode([
            'status'=> $e->getCode() > 500 ? $e->getCode() : 500,
            'response' => $pdoException->show()
        ]);
    }
?>