<?php
namespace Checkout\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Checkout\Form\CheckoutForm;
use Checkout\Business\CheckoutBusiness;
use Products\Business\ProductsBusiness;
use Orders\Business\OrdersBusiness;

class CheckoutController extends AbstractActionController
{
    private $apiConfig;
    
    public function __construct($apiConfig){
    
        $this->apiConfig = $apiConfig;
    }
    
    public function validationAction (){
        
        $orderId = $this->params()->fromRoute('id', 0);
    
        $orderBusiness = new OrdersBusiness($this->apiConfig['pay']);
        
        $response = $orderBusiness->getOrderById($orderId);
        
        $requestId = $response[0]['request_id'];
        
        $status = $orderBusiness->getStatusRequest($this->apiConfig['query'], $requestId);
        
        $orderBusiness->updateById($requestId, $status['status']);
        
        var_export($response);
    }
    
    public function indexAction()
    {
        $productId = $this->params()->fromRoute('id', 0);
        
        $productsBusiness = new ProductsBusiness($this->apiConfig['products']);
        
        $productInfo = $productsBusiness->getProductById($productId);
        
        $form = new CheckoutForm($productId);
        
        $form->get('submit')->setValue('Checkout');
        
        $request = $this->getRequest();
        
        /**
         * En caso de que no exista peticion POST
         */
        if (! $request->isPost()){
            
            return ['form' => $form, 'product_id' => $productId];
        }
        
        $checkoutBusiness = new CheckoutBusiness($this->apiConfig['pay']);
        
        $form->setInputFilter($checkoutBusiness->getInputFilter());
        
        $form->setData($request->getPost());

        /**
         * Valida si los campos del formulario está correctos.
         */
        if (! $form->isValid()){
            
            return ['form' => $form, 'product_id' => $productId, 'errors' => $form->getMessages()];
            
        }else{
            
            $checkoutBusiness->exchangeArray($form->getData());
            
            $response = $checkoutBusiness->sendToPlaceToPay($productInfo, $this->apiConfig['domain']);

            $this->redirect()->toUrl($response->processUrl);
            
        }
        

    }

}