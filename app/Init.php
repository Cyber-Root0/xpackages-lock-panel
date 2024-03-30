<?php
namespace CyberRoot0\WpLockPanel;
use CyberRoot0\WpLockPanel\View\Form;
use CyberRoot0\WpLockPanel\Api\Lock;
use CyberRoot0\WpLockPanel\Observer\AdminLogin;
class Init
{
    private static $instance;
    private function __construct(){
        $this->registers();
    }    
    /**
     * provide a simple shared instance
     *
     * @return void
     */
    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }    
    /**
     * register 
     *
     * @return void
     */
    private function registers(){
       $this->__styles();
       Form::getInstance()->execute();
       Lock::getInstance()->execute();
       AdminLogin::getInstance()->execute();
    }
    private function __styles(){
        wp_enqueue_script( 'admin-js-sweetalertjs',WLP_ROOT_URL.'assets/vendor/sweetalert2.all.min.js',false);
        wp_enqueue_script( 'admin-js-wlp1-lock', WLP_ROOT_URL.'assets/js/wplock.js',false);
        wp_enqueue_style( 'admin-js-sweetalert-css', WLP_ROOT_URL.'assets/vendor/sweetalert2.min.css',false);
    }
}