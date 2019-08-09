<?php
namespace Admin\Service;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
class ListingFactory
{
    public function __invoke(ContainerInterface $container) {
        $service = new Listing();
        $adapter = new Adapter($container->get('db-config'));
        $table   = new TableGateway('listings', $adapter);
        $service->setTable($table);
        return $service;
    }
}
