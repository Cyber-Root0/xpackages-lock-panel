<?php
namespace CyberRoot0\WpLockPanel\Model;
use CyberRoot0\WpLockPanel\Helper\Data;
class ManagerLock
{
    private string $key;
    private bool $status;
    private static $instance;    
    /**
     * __construct
     *
     * @return void
     */
    private function __construct(
        string $key = '',
        $status = ''
    ){
        $this->init();
        $key == '' ? : $this->key = $key;
        if (!empty($status)){
            $this->status = $status === 'true' ? true : false;
        }
    }    
    /**
     * provide a shared instance class
     *
     * @param  string $key
     * @param  bool $status
     * @return self
     */
    public static function getInstance(string $key = '', bool $status = false){
        if (self::$instance === null){
            self::$instance = new self($key, $status);
        }
        return self::$instance;
    } 
    /**
     * initialize actual
     *
     * @return void
     */
    private function init(){
        $this->setKey(get_option(Data::KEY));
        $this->setStatus(get_option(Data::STATUS) === 'true' ? true : false );
    }    
    /**
     * get current status from db to firts initialization
     *
     * @return bool
     */
    public function getStatus(){
        return $this->status;
    }    
    /**
     * get curret key
     * 
     * @return string
     */
    public function getKey(){
        return $this->key;
    }    
    /**
     * set new key
     *
     * @param  string $key
     * @return self
     */
    public function setKey(string $key){
        $this->key = $key;
        return $this;
    }    
    /**
     * set new status
     *
     * @param  bool $status
     * @return self
     */
    public function setStatus(bool $status){
        $this->status = $status;
        return $this;
    }       
    /**
     * update key and status
     *
     * @return bool
     */
    public function save(){
        update_option(Data::KEY, $this->getKey());
        update_option(Data::STATUS, $this->getStatus() === false ? 'false' : 'true');
        return true;
    }
}