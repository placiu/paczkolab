<?php

class Size implements Action
{
    private $size;
    private $price;
    /**
     * @var Database
     */
    public static $db;

    public function __construct($size, $price)
    {
        $this->size = $size;
        $this->price = $price;
    }

    public function save()
    {
        self::$db->query("INSERT INTO Size(id, size, price) VALUES (null, '".$this->getSize()."', ".$this->getPrice().")");
        return self::$db->execute();
    }

    public function update($id = null)
    {
        self::$db->query("UPDATE Size SET size = '".$this->getSize()."', price = ".$this->getPrice()." WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM Size WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function load($id = null) {
        self::$db->query("SELECT * FROM Size WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->single();
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM Size");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}