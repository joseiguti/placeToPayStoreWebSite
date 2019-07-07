<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return [
    // ...
    
    
    'api' => [
        
        'domain' => 'http://0.0.0.0:8080/checkout/validation/',
        
        'products' => [
            
            'end-point' => 'http://0.0.0.0:8082',
            
            'uri' => '/products'
            
        ],
        
        'pay' => [
        
            'end-point' => 'http://0.0.0.0:8082',
        
            'uri' => '/pay'
        
        ],
        
        'query' => [
        
            'end-point' => 'http://0.0.0.0:8082',
        
            'uri' => '/query'
        
        ],
                
    ],
    
];
