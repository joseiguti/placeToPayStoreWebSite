<?php
namespace Shop\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Orders\Model\OrdersTable;

class ShopController extends AbstractActionController
{
    // Add this property:
    private $table;
    
    // Add this constructor:
    public function __construct(OrdersTable $table)
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        
    }

}