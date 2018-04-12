<?php

class Parcel implements Action
{
    private $userId;
    private $sizeId;
    private $addressId;
    /**
     * @var Database
     */
    public static $db;

    public function __construct($userId, $sizeId, $addressId)
    {
        $this->userId = $userId;
        $this->sizeId = $sizeId;
        $this->addressId = $addressId;
    }

    public function save()
    {
        self::$db->query("INSERT INTO Parcel(id, user_id, size_id, address_id) VALUES (null, ".$this->getUserId().", ".$this->getSizeId().", ".$this->getAddressId().")");
        return self::$db->execute();
    }

    public function update($id = null)
    {
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM Parcel WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function load($id = null)
    {
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM Parcel");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getSizeId()
    {
        return $this->sizeId;
    }

    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;
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