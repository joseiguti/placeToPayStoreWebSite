<?php
namespace Orders\Business;

use Zend\Http\Request;
use Zend\Http\Client;


class OrdersBusiness {
    
    private $apiConfig = [];
    
    public function __construct($apiConfig = [])
    {
        $this->apiConfig = $apiConfig;
    }    
    
    public function updateById ($id, $status){
        
        if ($status == 'approved'){
            
        }
        
        $url = $this->apiConfig['end-point'] . $this->apiConfig['uri'].'/'.$id;
        
        $ch = curl_init($url);
        
        $jsonData = [

            'status' => $status,
            
        ];
        
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($jsonData));
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        return $response;
    }
    
    public function getOrders (){
        
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
    
    public function getOrderById ($id){
    
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
    
    public function getStatusRequest ($apiConfig, $request_id){
        
        $request = new Request();
        
        $request->getHeaders()->addHeaders([
            'Accept' => 'application/json'
        ]);
        
        $request->setUri($apiConfig['end-point'] . $apiConfig['uri'].'/'.$request_id);
        
        $request->setMethod('GET');
        
        $client = new Client();
        
        $response = $client->dispatch($request);
        
        return json_decode($response->getBody(), true);
    }
    
    
}