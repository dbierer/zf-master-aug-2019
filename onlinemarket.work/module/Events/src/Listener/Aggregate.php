<?php
namespace Events\Listener;

use Interop\Container\ContainerInterface;
use Zend\EventManager\ {AbstractListenerAggregate,EventManagerInterface,LazyListener};

class Aggregate extends AbstractListenerAggregate
{

    protected $eventManager;
    protected $serviceContainer;

    public function __construct(ContainerInterface $container)
    {
        $this->serviceContainer = $container;
    }
    //*** attach "onLog()" as a listener to the modification event using a wildcard identifier
    public function attach(EventManagerInterface $e, $priority = 100)
    {
        $shared = $e->getSharedManager();
        //*** LAZY LISTENER LAB: attach the "onLog()" method as a Lazy Listener
        //$lazy = new LazyListener(???);
        //$this->listeners[] = $shared->attach(???);
    }
    public function onLog($e)
    {
        error_log(get_class($e->getTarget()) . ': REGISTRATION ADDED : ' . $e->getParam('registration'));
    }
}
