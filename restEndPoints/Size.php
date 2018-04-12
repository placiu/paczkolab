<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $tmpSizes = [];
    if (isset($pathId) && !empty($pathId)) {
        $size = Size::load($pathId);
        $tmpSizes[0]['id'] = $size['id'];
        $tmpSizes[0]['size'] = $size['size'];
        $tmpSizes[0]['price'] = $size['price'];
    } else {
        $sizes = Size::loadAll();
        foreach ($sizes as $k => $size) {
            $tmpSizes[$k]['id'] = $size['id'];
            $tmpSizes[$k]['size'] = $size['size'];
            $tmpSizes[$k]['price'] = $size['price'];
        }
    }
    $response = $tmpSizes;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $size = new Size($patch_vars['size'], $patch_vars['price']);
    if ($size->save()) $response = ['add'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $size = new Size($patch_vars['size'], $patch_vars['price']);
    if ($size->update($patch_vars['id'])) $response = ['patch'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    if (Size::delete($patch_vars['id'])) $response = ['delete'];

} else {
    $response = ['error' => 'Wrong request method'];
}