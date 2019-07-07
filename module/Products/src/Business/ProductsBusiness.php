<?php
namespace Products\Business;

use Zend\Http\Request;
use Zend\Http\Client;

/**
 * Clase que maneja lo referente a los prodcutos
 * @author josegutierrez
 *
 */
class ProductsBusiness
{
    private $apiConfig = [];

    public function __construct($apiConfig = [])
    {
        $this->apiConfig = $apiConfig;
    }

    public function getProductById ($id){
        
        $apiConfig = $this->apiConfig;
        
        $request = new Request();
        
        $request->getHeaders()->addHeaders([
            'Accept' => 'application/json'
        ]);
        
        $request->setUri($apiConfig['end-point'] . $apiConfig['uri'].'/'.$id);
        
        $request->setMethod('GET');
        
        $client = new Client();
        
        $response = $client->dispatch($request);
        
        return json_decode($response->getBody(), true);
    }
    
    public function getAllProducts()
    {
        $apiConfig = $this->apiConfig;
        
        $request = new Request();
        
        $request->getHeaders()->addHeaders([
            'Accept' => 'application/json'
        ]);
        
        $request->setUri($apiConfig['end-point'] . $apiConfig['uri']);
        
        $request->setMethod('GET');
        
        $client = new Client();
        
        $response = $client->dispatch($request);
        
        return json_decode($response->getBody(), true);
    }
}