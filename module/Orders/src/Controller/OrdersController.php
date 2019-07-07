<?php
namespace Orders\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Orders\Business\OrdersBusiness;

class OrdersController extends AbstractActionController
{
    private $apiConfig;
    
    public function __construct($apiConfig){
    
        $this->apiConfig = $apiConfig;
    }
    
    public function indexAction()
    {
        $ordersBusiness = new OrdersBusiness($this->apiConfig['pay']);
        
        return ['orders' => $ordersBusiness->getOrders()];
    }

}