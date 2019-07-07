<?php
namespace Checkout\Business;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\EmailAddress;

class CheckoutBusiness implements InputFilterAwareInterface
{
    public $product_id;
    
    public $customer_name;
    
    public $customer_email;
    
    public $customer_mobile;

    private $inputFilter;
    
    private $apiConfig = [];
    
    public function __construct($apiConfig){
        
        $this->apiConfig = $apiConfig;
    }

    /**
     * Retorna la IP del cliente contectado a la web.
     */
    public function getIpAddress (){
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            
            $ip = $_SERVER['HTTP_CLIENT_IP'];
            
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        } else {
            
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    /**
     * Envia la solicitud a placeToPay
     * @param array $productInfo
     */
    public function sendToPlaceToPay ($productInfo, $urlReturn){
        
        $url = $this->apiConfig['end-point'] . $this->apiConfig['uri'];
        
        $ch = curl_init($url);
        
        $jsonData = [
            
                'customer_name'   => $this->customer_name,
                
                'customer_email'  => $this->customer_email,
                
                'customer_mobile' => $this->customer_mobile,
            
                'product_id'      => $this->product_id,
            
                'unique_code'     => $productInfo['unique_code'],
            
                'name'            => $productInfo['name'],
            
                'description'     => $productInfo['description'],
            
                'url_pic'         => $productInfo['url_pic'],
            
                'price'           => $productInfo['price'],
            
                'ip'              => $this->getIpAddress(),
            
                'userAgent'       => $_SERVER['HTTP_USER_AGENT'],
            
                'urlReturn'       => $urlReturn,
            
        ];
        
        $jsonDataEncoded = json_encode($jsonData);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        
        $result = json_decode(curl_exec($ch));
        
        curl_close($ch);
       
        return $result;
    }
    
    
    public function exchangeArray(array $data)
    {
        $this->customer_name     = !empty($data['customer_name']) ? $data['customer_name'] : null;
        
        $this->customer_email = !empty($data['customer_email']) ? $data['customer_email'] : null;
        
        $this->customer_mobile  = !empty($data['customer_mobile']) ? $data['customer_mobile'] : null;
    }

    /* Add the following methods: */

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'customer_name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'customer_email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => EmailAddress::class,
                    'options' => [
                        'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                        'encoding' => 'UTF-8',
                        'min' => 5,
                        'max' => 120,
                    ],
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'customer_mobile',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 10,
                        'max' => 10,
                    ],
                ],
            ],
        ]);

        $this->inputFilter = $inputFilter;
        
        return $this->inputFilter;
    }
}