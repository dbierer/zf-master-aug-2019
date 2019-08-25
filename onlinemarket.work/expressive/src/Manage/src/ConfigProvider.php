<?php
declare(strict_types=1);
namespace Manage;

/**
 * The configuration provider for the Manage module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                Manage\Handler\DeleteHandler::class => Manage\Handler\DeleteHandlerFactory::class,
                Manage\Handler\ListHandler::class => Manage\Handler\ListHandlerFactory::class,
                Manage\Domain\ListingsService::class => Manage\Domain\ListingsServiceFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'manage'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
