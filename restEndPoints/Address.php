<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $tmpAddress = [];
    if (isset($pathId) && !empty($pathId)) {
        $address = Address::load($pathId);
        $tmpAddress[0]['id'] = $address['id'];
        $tmpAddress[0]['city'] = $address['city'];
        $tmpAddress[0]['code'] = $address['code'];
        $tmpAddress[0]['street'] = $address['street'];
        $tmpAddress[0]['flat'] = $address['flat'];
    } else {
        $addresses = Address::loadAll();
        foreach ($addresses as $k => $address) {
            $tmpAddress[$k]['id'] = $address['id'];
            $tmpAddress[$k]['city'] = $address['city'];
            $tmpAddress[$k]['code'] = $address['code'];
            $tmpAddress[$k]['street'] = $address['street'];
            $tmpAddress[$k]['flat'] = $address['flat'];
        }
    }
    $response = $tmpAddress;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $address = new Address($patch_vars['city'], $patch_vars['code'], $patch_vars['street'], $patch_vars['flat']);
    if ($address->save()) $response = ['add'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $address = new Address($patch_vars['city'], $patch_vars['code'], $patch_vars['street'], $patch_vars['flat']);
    if ($address->update($patch_vars['id'])) $response = ['patch'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    if (Address::delete($patch_vars['id'])) $response = ['delete'];

} else {
    $response = ['error' => 'Wrong request method'];
}