<?php
namespace Products;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\ProductsController::class => InvokableFactory::class,
        ],
    ],
    
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'products' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/products[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProductsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    
    'view_manager' => [
        'template_path_stack' => [
            'products' => __DIR__ . '/../view',
        ],
    ],
];