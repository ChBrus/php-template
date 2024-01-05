<?php
    require_once '../../../vendor/autoload.php';

    use Core\{DB, Response, User};
    use Core\Exception\DatabaseException;
    use Build\PageBuilder;
    use Tools\{JSON, Env};

    Env::getEnv();
    JSON::decode();

    if ($_POST['password'] !== 'javascript-async-fetch') header('location: ' . PageBuilder::getProjectURL());

    try {
        $user = new User();
        $user->addTableOrView('users');

        if (isset($_POST['data']['maxRows'])) $user->setLimitQuery($_POST['data']['maxRows']);

        $user->setStartIndex($_POST['data']['page']);

        # User
        $userResponse = $user->select();

        # Count
        $countResponse = $user->getRows();

        if ($userResponse->status === 500) throw new DatabaseException($userResponse->response);
        else if ($countResponse->status === 500) throw new DatabaseException($countResponse->response);

        $lastResponse = $userResponse->response->fetchAll(DB::FETCH_ASSOC);

        if (empty($lastResponse)) throw new DatabaseException(bold("Estado de base de datos:") . " No se encontró ningún dato en la tabla " . bold($user->__get('table_or_view')), 501);

        echo json_encode([
            'status' => $userResponse->status,
            'response' => $lastResponse
        ]);
    } catch (Exception $e) {
        $pdoException = new DatabaseException($e->getMessage(), (int) $e->getCode(), $e->getPrevious());

        echo json_encode([
            'status'=> $e->getCode() > 500 ? $e->getCode() : 500,
            'response' => $pdoException->show()
        ]);
    }
?>