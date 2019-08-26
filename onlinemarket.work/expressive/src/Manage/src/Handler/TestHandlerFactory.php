<?php

declare(strict_types=1);

namespace Manage\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TestHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TestHandler
    {
        return new TestHandler($container->get(TemplateRendererInterface::class));
    }
}
