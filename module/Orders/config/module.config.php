<?php
namespace Orders;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\OrdersController::class => InvokableFactory::class,
        ],
    ],
    
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'orders' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/orders[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\OrdersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    
    'view_manager' => [
        'template_path_stack' => [
            'orders' => __DIR__ . '/../view',
        ],
    ],
];