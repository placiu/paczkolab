<?php

class User implements Action
{
    private $name;
    private $surname;
    private $credits;
    private $addressId;
    /**
     * @var Database
     */
    public static $db;

    public function __construct($name, $surname, $credits, $addressId)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->credits = $credits;
        $this->addressId = $addressId;
    }

    public function save()
    {
        self::$db->query("INSERT INTO User(id, name, surname, credits, address_id) VALUES (null, '".$this->getName()."', '".$this->getSurname()."', ".$this->getCredits().", ".$this->getAddressId().")");
        return self::$db->execute();
    }

    public function update($id = null)
    {
        self::$db->query("UPDATE User SET name = '".$this->getName()."', surname = '".$this->getSurname()."', credits = ".$this->getCredits()." WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM User WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function load($id = null) {
        self::$db->query("SELECT * FROM User WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->single();
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM User");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getCredits()
    {
        return $this->credits;
    }

    public function setCredits($credits)
    {
        $this->credits = $credits;
    }

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
    }

}