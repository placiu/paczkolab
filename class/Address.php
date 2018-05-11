<?php

class Address implements Action
{
    private $city;
    private $code;
    private $street;
    private $flat;
    /**
     * @var Database
     */
    public static $db;

    public function __construct($city, $code, $street, $flat)
    {
        $this->city = $city;
        $this->code = $code;
        $this->street = $street;
        $this->flat = $flat;
    }

    public function save()
    {
        self::$db->query("INSERT INTO Address(id, city, code, street, flat) VALUES (null, '".$this->getCity()."', '".$this->getCode()."', '".$this->getStreet()."', '".$this->getFlat()."')");
        return self::$db->execute();
    }

    public function update($id = null)
    {
        self::$db->query("UPDATE Address SET city = '".$this->getCity()."', code = '".$this->getCode()."', street = '".$this->getStreet()."', flat = '".$this->getFlat()."' WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM Address WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function load($id = null) {
        self::$db->query("SELECT * FROM Address WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->single();
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM Address");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getFlat()
    {
        return $this->flat;
    }

    public function setFlat($flat)
    {
        $this->flat = $flat;
    }


}