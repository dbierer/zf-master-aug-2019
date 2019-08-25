<?php

declare(strict_types=1);

namespace Manage\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class DeleteHandlerFactory
{
    public function __invoke(ContainerInterface $container) : DeleteHandler
    {
        return new DeleteHandler($container->get(TemplateRendererInterface::class));
    }
}
