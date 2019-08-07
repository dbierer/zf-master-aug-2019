<?php
namespace MyDoctrine;

use PDO;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'doctrine' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/doctrine',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'admin' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/admin[/][:event]',
                            'defaults' => [
                                'controller' => Controller\AdminController::class,
                                'action'     => 'index',
                            ],
                            'constraints' => [
                                'event' => '[0-9]+',
                            ],
                        ],
                    ],
                    'signup' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/signup[/][:event]',
                            'defaults' => [
                                'controller' => Controller\SignupController::class,
                                'action'     => 'index',
                            ],
                            'constraints' => [
                                'event' => '[0-9]+',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [__DIR__ . '/../view'],
    ],
    'doctrine' => [
        'driver' => [
            //*** DOCTRINE LAB: define an annotation driver with two paths, and name it `doctrine_annotation_driver`
            'doctrine_annotation_driver' => [
                //*** DOCTRINE LAB
            ],

            //*** DOCTRINE LAB
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default' => [
                'drivers' => [
                    //*** DOCTRINE LAB
                    // register `doctrine_annotation_driver` for any entity under namespace `MyDoctrine\Entity`
                ]
            ],
        ],
        // NOTE: "connection" and "configuration" are in the /config/autoload/doctrine.local.php file
    ],
    'navigation' => [
        'default' => [
            'doctrine' => ['label' => 'Doctrine', 'route' => 'doctrine', 'resource' => 'menu-doctrine']
        ],
    ],
    'access-control-config' => [
        'resources' => [
            'doctrine-index' => 'MyDoctrine\Controller\IndexController',
            'doctrine-admin' => 'MyDoctrine\Controller\AdminController',
            'doctrine-sign'  => 'MyDoctrine\Controller\SignupController',
            'menu-doctrine'        => 'menu-doctrine',
        ],
        'rights' => [
            'guest' => [
                'doctrine-index' => ['allow' => NULL],
                'doctrine-sign'  => ['allow' => NULL],
                'menu-doctrine'        => ['allow' => NULL],
            ],
            'admin' => [
                'doctrine-admin' => ['allow' => NULL],
            ],
        ],
    ],
];
