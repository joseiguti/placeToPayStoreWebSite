<?php
namespace Checkout\Form;

use Zend\Form\Form;

class CheckoutForm extends Form
{
    public function __construct($productId, $name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('Checkout');

        $this->setAttribute('method', 'POST');
        
        $this->add([
            'name' => 'product_id',
            'type' => 'hidden',
            'options' => [
                
             ],
            'attributes' => [         // Array of attributes
                'id'  => 'product_id',
                'value' => $productId,
             ],
        ]);
        
        $this->add([
            'name' => 'customer_name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);
        
        $this->add([
            'name' => 'customer_email',
            'type' => 'text',
            'options' => [
                'label' => 'Email',
            ],
        ]);
        
        $this->add([
            'name' => 'customer_mobile',
            'type' => 'text',
            'options' => [
                'label' => 'Mobile number',
            ],
        ]);
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}