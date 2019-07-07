<?php
namespace Shop;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getServiceConfig()
    {
        return [
            
            'factories' => [
                
                'api-config' => function ($container) {
                    
                    return $container->get('config')['api'];
                },
            ]
            
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                
                Controller\ShopController::class => function ($container) {

                    return new Controller\ShopController($container->get('api-config'));
                }
            ]
        ];
    }
}