<?php

class DomainModel {
    
    protected $_data = array();
    
    public function __construct(array $data) {

        if(key($data) === 0) {
            $this->makeProperties($data);   
        } else {
            $this->populate($data);
        }

    }
    
    public function __set($name, $value) {
 
        if(!array_key_exists($name, $this->_data)) {
            throw new Exception('Essa propriedade não existe');
        }
        
        $this->_data[$name] = $value;
    }
    
    public function __get($name) {
        
        if(!array_key_exists($name, $this->_data)) {
            throw new Exception('Essa propriedade não existe');
        } 
        
        return $this->_data[$name];
        
    }
    
    public function __isset($name) {
        
        return isset($this->_data[$name]);
    }
    
    public function __unset($name) {
        
        if(isset($name)) {
            $this->_data[$name] = null;
        }
        
    }
    
    protected function populate(array $data) {
        
        $this->_data = array_combine(array_keys($data), array_values($data));
        
    }
    
    protected function makeProperties(array $property) {
        
        foreach ($property as $key => $valor) {
            $this->_data[$valor] = null;
        }
        
    }
}

new DomainModel(array(2 => 23,3));