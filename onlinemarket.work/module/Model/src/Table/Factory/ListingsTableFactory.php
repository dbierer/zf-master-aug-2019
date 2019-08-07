<?php
namespace Model\Table\Factory;

use Model\Entity\Listing;
use Model\Table\ListingsTable;
use Interop\Container\ContainerInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\ServiceManager\Factory\FactoryInterface;

//*** DATABASE EVENTS LAB: add appropriate "use" statements

class ListingsTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $adapter = $container->get('model-primary-adapter');
        $entity  = new Listing();

        //*** AGGREGATE HYDRATOR LAB: get aggregate hydrator from service container (see Module class)
        $hydrator = $container->get('model-listings-hydrator');
        $resultSet = new HydratingResultSet($hydrator, $entity);

        //*** DATABASE EVENTS LAB: create EventFeature instance using service container to get an EventManager instance
        //*** DATABASE EVENTS LAB: use the EventFeature in ListingsTable creation
        return new ListingsTable(ListingsTable::TABLE_NAME, $adapter, NULL, $resultSet);
    }
}
