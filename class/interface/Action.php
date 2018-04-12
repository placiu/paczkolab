<?php

interface Action
{
    const db = null;

    public function save();

    public function update($id = null);

    public static function delete($id = null);

    public static function load($id = null);
    
    public static function loadAll();

    public static function setDb(Database $db);
}
