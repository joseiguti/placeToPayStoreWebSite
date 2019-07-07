<?php
namespace Shop;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            #Controller\ShopController::class => InvokableFactory::class,
        ],
    ],
    
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'shop' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/shop[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ShopController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    
    'view_manager' => [
        'template_path_stack' => [
            'shop' => __DIR__ . '/../view',
        ],
    ],
];