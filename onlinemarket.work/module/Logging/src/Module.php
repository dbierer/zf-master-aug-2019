<?php
namespace Logging;

use Zend\Mvc\ {MvcEvent};
use Zend\Log\Logger;
use Zend\Log\Writer\ {Stream, FirePhp};

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $em = $e->getApplication()->getEventManager();
        $em->attach(MvcEvent::EVENT_ROUTE, [$this, 'setLogService'], 99);
    }

    public function setLogService(MvcEvent $e)
    {
        $logger = $e->getApplication()->getServiceManager()->get('logging-logger');
        Logger::registerErrorHandler($logger);
        Logger::registerExceptionHandler($logger);
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'logging-logger' => function ($container) {
                    $writerStream = new Stream($container->get('logging-error-log-filename'));
                    $writerFirePhp = new FirePhp();
                    $logger = new Logger();
                    $logger->addWriter($writerStream);
                    $logger->addWriter($writerFirePhp);
                    return $logger;
                },
                //*** DATABASE EVENTS LAB: inject database adapter platform into constructor for "logging-listener"
                Listener::class => function ($container) {
					return new Listener($container->get('logging-logger'));
                },
            ],
        ];
    }

}
