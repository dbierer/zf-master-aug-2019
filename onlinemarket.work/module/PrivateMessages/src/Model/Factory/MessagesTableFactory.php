<?php
namespace PrivateMessages\Model\Factory;

use PrivateMessages\Model\ {Message, MessagesTable};

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MessagesTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        //*** BLOCK CIPHER LAB: return a MessageTable instance, which needs the private hydrator and adapter as arguments
        $hydrator = $container->get('private-messages-hydrator');
        $adapter = $container->get('model-primary-adapter');
        return new MessagesTable($hydrator, $adapter);
    }
}
