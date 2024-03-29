<?php
namespace PrivateMessages;

use PrivateMessages\Hydrator\ {PrivateHydrator,BlockCipherHydrator,FormHydrator,TableHydrator};
use PrivateMessages\Model\Message;

use Zend\Hydrator\ClassMethods;
use Zend\Mvc\MvcEvent;
use Zend\Crypt\BlockCipher;
use Zend\Crypt\Symmetric\Exception\NotFoundException;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class Module
{

    const ERROR_OPENSSL = 'ERROR: the OpenSSL extension is not available on this server';
    const ERROR_ALGO    = 'ERROR: none of the preferred algorithms or modes are supported on this server';

    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
				BlockCipherHydrator::class => function ($container) {
					$hydrator = new BlockCipherHydrator();
					$hydrator->setBlockCipher($container->get('encryption-block-cipher'));
					return $hydrator;
				},
                'private-messages-hydrator' => function ($container) {
					//*** BLOCK CIPHER LAB: create a hydratory which is an aggregate of classmethods + block cipher hydrators
					$hydroChain = new AggregateHydrator();
					$hydroChain->add(new TableHydrator());
					$hydroChain->add($container->get(BlockCipherHydrator::class));
					return $hydroChain;
                },
            ],
        ];
    }
}
