<?php
namespace PhpSession;

use Zend\Mvc\MvcEvent;
//*** SESSIONS LAB: add the appropriate "use" statements
use Zend\Session\ {SessionManager, SessionConfig, Container};

class Module
{
    public function getConfig()
    {
		return [
            //*** SESSIONS LAB: the "session_config" key is used by Zend\Session\Service\SessionConfigFactory
            //*** SESSIONS LAB: enter the type of Config to use
			'session_config' => [ 'config_class' => 'Zend\Session\Config\SessionConfig' ],
            //*** SESSIONS LAB: the "type" key is used by Zend\Session\Service\SessionStorageFactory
            //*** SESSIONS LAB: enter the type of storage to use
			'session_storage' => ['type' => 'Zend\Session\Storage\SessionArrayStorage' ],
		];
    }
    public function onBootstrap(MvcEvent $e)
    {
        $em = $e->getApplication()->getEventManager();
        //*** SESSIONS LAB: attach a listener which starts the session using the constructed session manager
        $em->attach(MvcEvent::EVENT_DISPATCH, [$this, 'startSession'], 9999);
    }
    public function startSession(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
		//*** SESSIONS LAB: set this session manager as a default for all session containers
		Container::setDefaultManager($sm->get(SessionManager::class));
    }
    public function getServiceConfig()
    {
        return [
            'factories' => [
                // NOTE: Do not need to define a specific SessionManager factory.  
                //       As long as the Config keys "session_config" and "session_storage" are present,
                //       Zend\Session\Service\SessionManagerFactory is used
                //       when the service container is asked to return a Zend\Session\SessionManager instance
                Container::class => function($container) {
					return new Container(__NAMESPACE__);
				},
            ],
        ];
    }
}
