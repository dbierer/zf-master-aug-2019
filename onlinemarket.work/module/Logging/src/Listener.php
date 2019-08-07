<?php
namespace Logging;

use Zend\Log\Logger;
use Zend\EventManager\ {EventManagerInterface, AbstractListenerAggregate};

//*** DATABASE EVENTS LAB: add appropriate "use" statements

class Listener extends AbstractListenerAggregate
{

    protected $logger;
    protected $platform;
	//*** DATABASE EVENTS LAB: add $platform to constructor arguments
    public function __construct($logger)
    {
        $this->logger = $logger;
    }
    public function attach(EventManagerInterface $e, $priority = 100)
    {
        //*** attach a series of listeners using the shared manager
        $shared = $e->getSharedManager();
		$this->listeners[] = $shared->attach('*', Event::EVENT_SOMETHING, [$this, 'logMessage']);
 		//*** DATABASE EVENTS LAB: complete an "attach()" for INSERT and SELECT table operations
    }
    public function logInsert($e)
    {
        $this->logger->info(__METHOD__ . ':' . $e->getParam('insert'));
    }
    public function logSelect($e)
    {
        $this->logger->info(__METHOD__ . ':' . $e->getParam('select')->getSqlString($this->platform));
    }
	public function logMessage($e)
	{
		$level = $e->getParam('level', Logger::INFO);
		$message = $e->getParam('message', '');
		if ($message) $this->logger->log($level, strip_tags($message));
	}
}
