<?php

class Salesforce
{
    private $sforce_username;
    private $sforce_password;
    private $sforce_token;
    private $sforce_type;
    private $sforce_sandbox;

    private $conn;

    public function __construct($config = array())
    {
        foreach($config as $key => $value){
            $this->$key = $value;
        }
        
        $wsdl  = APPPATH . 'third_party/salesforce/' . strtolower($this->sforce_type) . ($this->sforce_sandbox ? '.sandbox' : '') . '.wsdl.xml';
        $class = 'Sforce' . ucfirst(strtolower($this->sforce_type)) . 'Client';
        
        require_once(APPPATH . 'third_party/salesforce/' . $class . '.php');
        
        $this->conn = new $class();
        $this->conn->createConnection($wsdl);
        $result = $this->conn->login($this->sforce_username, $this->sforce_password . $this->sforce_token);
    }
    
    public function __call($method, $args)
    {
        return call_user_func_array(array($this->conn, $method), $args);
    }
}
