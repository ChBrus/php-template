<?php
    require_once './vendor/autoload.php';

    use Core\{DB, User};
    use Tools\JSON;

    JSON::decode();

    if ($_POST['password'] !== 'javascript-async-fetch') header('location: ./');

    $user = new User(2, 'Bruno', 'Carrillo');
    $user->addTable('users');
    $user->startIndex = ((int) $_POST['page']) * ((int) $user->__get('limitQuery'));

    list(
        "status" => $status,
        "response" => $response
    ) = $user->select();

    if ($status === 500) {
        die(json_encode([
            'status'=> $status,
            'response' => $response
        ]));
    }

    echo json_encode([
        "status" => $status,
        "response" => $response->fetchAll(DB::FETCH_ASSOC)
    ]);
?>