<?php
    require_once './vendor/autoload.php';

    use Core\{DB, User};
    use Tools\JSON;

    JSON::decode();

    if ($_POST['password'] !== 'javascript-async-fetch') header('location: ./');

    $user = new User();
    $user->addTable('users');
    $user->startIndex = ((int) $_POST['page']) * ((int) $user->__get('limitQuery'));

    list(
        "status" => $status,
        "response" => $response
    ) = $user->select();

    list(
        "status" => $countStatus,
        "response" => $countResponse
    ) = $user->getRows();

    if ($status === 500) {
        die(json_encode([
            'status'=> $status,
            'response' => $response
        ]));
    } else if ($countStatus === 500) {
        die(json_encode([
            'status'=> $countStatus,
            'response'=> $countResponse
        ]));
    }

    $lastResponse = $response->fetchAll(DB::FETCH_ASSOC);

    if (empty($lastResponse)) {
        die(json_encode([
            'status' => 500,
            'response' => 'Something went wrong'
        ]));
    }

    echo json_encode([
        "status" => $status,
        "response" => $lastResponse
    ]);
?>