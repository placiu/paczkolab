<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

require_once __DIR__.'/../class/interface/Action.php';
require_once __DIR__.'/../class/Address.php';

class AddressTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @return \PHPUnit\DbUnit\Database\Connection
     */
    protected function getConnection()
    {
    }

    /**
     * @return \PHPUnit\DbUnit\DataSet\IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/fixtures.xml');
    }

    public function testSave()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('Address'));
        $address = new Address('Opole', '33-333', 'Krakowska', '3');
        //$address::setDb(new ...);
        Address::$db = $this->getConnection();
        $this->assertTrue($address->save());
    }


}