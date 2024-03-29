<?php

namespace Zoop\Test\Helper;

use Doctrine\ODM\MongoDB\DocumentManager;

class DataHelper
{
    /**
     * @param DocumentManager $dm
     * @param mixed $document
     * @param string $id
     * @return mixed
     */
    public static function get(DocumentManager $dm, $document, $id)
    {
        return $dm->getRepository($document)
            ->find($id);
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function getCreateZoopUser()
    {
        return self::getJson('DataModel/User/Zoop/CreateUser');
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function createZoopUser(DocumentManager $dm, $dbName)
    {
        $json = self::getJson('DataModel/User/Zoop/User');
        self::insertDocument($dm, $dbName, 'Users', $json);
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function createPartnerUser(DocumentManager $dm, $dbName)
    {
        $json = self::getJson('DataModel/User/Partner/User');
        self::insertDocument($dm, $dbName, 'Users', $json);
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function createCustomerUser(DocumentManager $dm, $dbName)
    {
        $json = self::getJson('DataModel/User/Customer/User');
        self::insertDocument($dm, $dbName, 'Users', $json);
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function createPartner(DocumentManager $dm, $dbName)
    {
        $json = self::getJson('DataModel/Partner/Partner');
        self::insertDocument($dm, $dbName, 'Entities', $json);
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function createEntity(DocumentManager $dm, $dbName)
    {
        $json = self::getJson('DataModel/Entity/Entity');
        self::insertDocument($dm, $dbName, 'Entities', $json);
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     */
    public static function createEntities(DocumentManager $dm, $dbName)
    {
        $json = self::getJson('DataModel/Entity/Entities');
        $stores = json_decode($json, true);
        foreach ($stores as $store) {
            self::insertDocument($dm, $dbName, 'Entities', json_encode($store));
        }
    }

    /**
     * @param string $fileName
     * @return boolean
     */
    protected static function getJson($fileName)
    {
        return file_get_contents(__DIR__ . '/../' . $fileName . '.json');
    }

    /**
     * @param DocumentManager $dm
     * @param string $dbName
     * @param string $collectionName
     * @param string $json
     * @return boolean
     */
    protected static function insertDocument(DocumentManager $dm, $dbName, $collectionName, $json)
    {
        $data = json_decode($json, true);
        $db = $dm->getConnection()->selectDatabase($dbName);

        $collection = $db->selectCollection($collectionName);
        return $collection->insert($data);
    }
}
