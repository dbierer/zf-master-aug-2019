<?php
namespace PrivateMessages\Model;

use PrivateMessages\Hydrator\PrivateHydrator;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\HydratorInterface;

class MessagesTable
{
    public static $tableName = 'messages';
    protected $hydrator;
    protected $tableGateway;
    public function __construct(HydratorInterface $hydrator, Adapter $adapter)
    {
        $this->setHydrator($hydrator);
        $this->setTableGateway($adapter);
    }
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }
    public function setTableGateway(Adapter $adapter)
    {
        //*** BLOCK CIPHER LAB: set up the tablegateway to use a HydratingResultSet which incorporates the private hydrator
        $hydroResultSet = new HydratingResultSet($this->hydrator, new Message());
        $this->tableGateway = new TableGateway(static::$tableName, $adapter, NULL, $hydroResultSet);
    }
    public function findMessagesSent($email)
    {
        return $this->tableGateway->select(['from_email' => $email]);
    }
    public function findMessagesReceived($email)
    {
        return $this->tableGateway->select(['to_email' => $email]);
    }
    public function save(Message $message)
    {
        $message->setDateTime(date('Y-m-d H:i:s'));
        error_log(__METHOD__ . ':' . __LINE__ . ':' . var_export($message, TRUE));
        $data = $this->hydrator->extract($message);
        error_log(__METHOD__ . ':' . __LINE__ . ':' . var_export($data, TRUE));
        return $this->tableGateway->insert($data);
    }
    public function setPrivateHydrator(PrivateHydrator $hydrator)
    {
        $this->privateHydrator = $hydrator;
    }
}
