<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $tmpUsers = [];
    if (isset($pathId) && !empty($pathId)) {
        $user = User::load($pathId);
        $tmpUsers[0]['id'] = $user['id'];
        $tmpUsers[0]['name'] = $user['name'];
        $tmpUsers[0]['surname'] = $user['surname'];
        $tmpUsers[0]['credits'] = $user['credits'];
        $tmpUsers[0]['address_id'] = $user['address_id'];
    } else {
        $users = User::loadAll();
        foreach ($users as $k => $user) {
            $tmpUsers[$k]['id'] = $user['id'];
            $tmpUsers[$k]['name'] = $user['name'];
            $tmpUsers[$k]['surname'] = $user['surname'];
            $tmpUsers[$k]['credits'] = $user['credits'];
            $tmpUsers[$k]['address_id'] = $user['address_id'];
        }
    }
    $response = $tmpUsers;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $user = new User($patch_vars['name'], $patch_vars['surname'], $patch_vars['credits'], $patch_vars['address_id']);
    if ($user->save()) $response = ['add'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $user = new User($patch_vars['name'], $patch_vars['surname'], $patch_vars['credits'], '');
    if ($user->update($patch_vars['id'])) $response = ['patch'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    if (User::delete($patch_vars['id'])) $response = ['delete'];

} else {
    $response = ['error' => 'Wrong request method'];
}