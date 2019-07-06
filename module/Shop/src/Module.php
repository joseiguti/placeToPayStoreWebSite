<?php
namespace Shop;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Orders\Model\Orders;
use Orders\Model\OrdersTable;

class Module implements ConfigProviderInterface
{

    public function getConfig(){
        
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig(){
        
        return [
            'factories' => [
                OrdersTable::class => function ($container) {
                    
                    $tableGateway = $container->get(Orders\Model\OrdersTableGateway::class);
                    
                    return new OrdersTable($tableGateway);
                },
                
                Orders\Model\OrdersTableGateway::class => function ($container) {
                    
                    $dbAdapter = $container->get(AdapterInterface::class);
                    
                    $resultSetPrototype = new ResultSet();
                    
                    $resultSetPrototype->setArrayObjectPrototype(new Orders());
                    
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                }
            ]
        ];
    }

    public function getControllerConfig(){
        
        return [
            
            'factories' => [
                
                Controller\ShopController::class => function ($container) {
                    
                    return new Controller\ShopController($container->get(OrdersTable::class));
                }
            ]
        ];
    }
}