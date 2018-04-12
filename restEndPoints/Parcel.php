<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $parcels = Parcel::loadAll();
    $tmpParcels = [];
    foreach ($parcels as $k => $parcel) {
        $tmpParcels[$k]['id'] = $parcel['id'];
        $tmpParcels[$k]['user_id'] = $parcel['user_id'];
        $tmpParcels[$k]['size_id'] = $parcel['size_id'];
        $tmpParcels[$k]['address_id'] = $parcel['address_id'];
    }
    $response = $tmpParcels;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $parcel = new Parcel($patch_vars['user_id'], $patch_vars['size_id'], $patch_vars['address_id']);
    if ($parcel->save()) $response = ['add'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    if (Parcel::delete($patch_vars['id'])) $response = ['delete'];

} else {
    $response = ['error' => 'Wrong request method'];
}