<?php
namespace Checkout;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            #Controller\CheckoutController::class => InvokableFactory::class,
        ],
    ],
    
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'checkout' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/checkout[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CheckoutController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    
    'view_manager' => [
        'template_path_stack' => [
            'checkout' => __DIR__ . '/../view',
        ],
    ],
];