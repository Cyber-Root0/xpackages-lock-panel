<?php
namespace CyberRoot0\WpLockPanel\Api;
use CyberRoot0\WpLockPanel\Model\ManagerLock;
class Lock
{
    private static $instance;
    private $config;
    public const ROUTE_PREFIX = 'wlplock';
    private function __construct(){
        $this->config = ManagerLock::getInstance();
    }    
    /**
     * provide a simple shared instance
     *
     * @return self
     */
    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }    
    /**
     * Main Execution
     *
     * @return void
     */
    public function execute(){
        add_action('rest_api_init', array($this,'registerLock'));
        add_action('rest_api_init', array($this,'registerUnlock'));
    }    
    /**
     * Register lock route endpoint
     *
     * @return void
     */
    public function registerLock(){
        register_rest_route( self::ROUTE_PREFIX, '/lock/(?P<key>.+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'lock'),
            'permission_callback' => '__return_true',
        ));
    }    
    /**
     * Register unlock route endpoint
     *
     * @return void
     */
    public function registerUnlock(){
        register_rest_route(self::ROUTE_PREFIX, '/unlock/(?P<key>.+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'unlock'),
            'permission_callback' => '__return_true',
        ));
    }    
    /**
     * lock the panel with api call
     *
     * @param  mixed $request
     * @return array
     */
    public function lock($request){
        $key = $request['key'];
        $key = $request['key'];
        if ($this->canStart($key)){
            $this->config->setStatus(true);
            $this->config->save();
            return [
                "status" => 200,
                'msg' => 'Panel locked with successfully'
            ];
        }
        return [
            "status" => 400,
            'msg' => 'Forbidden'
        ];
    }       
    /**
     * unlock the panel with api call
     *
     * @param  mixed $request
     * @return array
     */
    public function unlock($request){
        $key = $request['key'];
        if ($this->canStart($key)){
            $this->config->setStatus(false);
            $this->config->save();
            return [
                "status" => 200,
                'msg' => 'Panel Unlocked with successfully'
            ];
        }
        return [
            "status" => 400,
            'msg' => 'Forbidden'
        ];
    }    
    /**
     * Compare if the key is eq the save in bd
     *
     * @param  string $key
     * @return bool
     */
    private function canStart(string $key){
        $key= urldecode($key);
        return $this->config->getKey() == $key;
    }
}