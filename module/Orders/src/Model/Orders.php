<?php
namespace Orders\Model;

class Orders {
    
    public $id;
    
    public $customer_name;
    
    public $customer_email;
    
    public $customer_mobile;
    
    public $status;
    
    public $created_at;
    
    public $updated_at;

    public function exchangeArray(array $data) {
        
        $this->id               = !empty($data['id']) ? $data['id'] : null;
        
        $this->customer_name    = !empty($data['customer_name']) ? $data['customer_name'] : null;
        
        $this->customer_email   = !empty($data['customer_email']) ? $data['customer_email'] : null;
        
        $this->customer_mobile  = !empty($data['customer_mobile']) ? $data['customer_mobile'] : null;
        
        $this->status           = !empty($data['status']) ? $data['status'] : null;
        
        $this->created_at       = !empty($data['created_at']) ? $data['created_at'] : null;
        
        $this->updated_at       = !empty($data['updated_at']) ? $data['updated_at'] : null;
        
    }
    
}