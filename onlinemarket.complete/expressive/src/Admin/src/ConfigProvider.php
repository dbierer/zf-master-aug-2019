<?php

namespace Admin;

/**
 * The configuration provider for the Admin module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */

use PDO;
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'services' => [
                'db-config' => [
                    'driver' => 'pdo_mysql',
                    'dsn' => 'mysql:host=localhost;dbname=course',
                    'username' => 'vagrant',
                    'password' => 'vagrant',
                    'options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
                ],
            ],
            'factories'  => [
                Service\Listing::class => Service\ListingFactory::class,
                Action\AdminPageAction::class => Action\AdminPageFactory::class,
                Action\ListPageAction::class => Action\ListPageFactory::class,
                Action\DeletePageAction::class => Action\DeletePageFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'admin'  => [__DIR__ . '/../templates/admin'],
            ],
        ];
    }
}
