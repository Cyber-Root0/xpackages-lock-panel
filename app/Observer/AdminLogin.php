<?php
namespace CyberRoot0\WpLockPanel\Observer;
use CyberRoot0\WpLockPanel\Model\ManagerLock;
class AdminLogin
{
    private static $instance;
    private $config;
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
    public function execute(){
        $this->showMsg();
        add_action('init', array($this, 'afterLogin'));
    }    
    public function afterLogin(){
        if ($this->rules()){
            wp_clear_auth_cookie();
            header('Location: '.wp_login_url().'?lock=true');
        }
    }
    /**
     * valid if the painel is locked and the user is Logged
     *
     * @return bool
     */
    private function rules(){
        if (!$this->config->getStatus()){
            return false;
        }
        if (!is_admin() || !str_contains(wp_get_referer(), wp_login_url())){
            return false;
        }
        return true;
    }
    public function showMsg(){
        if (str_contains(wp_login_url(), $_SERVER['SERVER_NAME'] ) ){
            $query = sanitize_text_field($_SERVER['QUERY_STRING']);
            if ($query=="lock=true"){
                add_action( 'login_footer', function(){
                    ?>
                        <script>hook();</script>
                    <?php
                } );	
            }
            
        }
    }
}