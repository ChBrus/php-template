<?php
    require_once './vendor/autoload.php';

    use Core\{DB, User};
    use Tools\JSON;

    JSON::decode();

    $user = new User(2, 'Bruno', 'Carrillo');
    $user->addTable('users');

    list(
        "status" => $status,
        "response" => $response
    ) = $user->select('name,last_name');

    if ($status === 500) die(json_encode(['status'=> $status,'response'=> $response]));

    echo json_encode([
        "status" => $status,
        "response" => $response->fetchAll(DB::FETCH_ASSOC)
    ]);
?>