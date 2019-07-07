<?php
namespace Shop\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ShopController extends AbstractActionController
{
    private $apiConfig;
    
    public function __construct($apiConfig){
        
        $this->apiConfig = $apiConfig;
    }
    
    public function indexAction()
    {
        
        $products = new \Products\Business\ProductsBusiness($this->apiConfig['products']);
        
        return new ViewModel([
            'products' => $products->getAllProducts(),
        ]);
    }

}