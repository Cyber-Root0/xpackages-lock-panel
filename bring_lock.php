<?php
/*
 
 * @package           BringLock
 * @author            Bruno Alves
 * @copyright         2023  - Bring E-commerce
 * Plugin Name:       Bring Lock
 * Plugin URI:        https://bring.com.br
 * Description:       Plugin da Bring E-commerce, bloqueio automático de lojas com pagamentos pendentes.
 * Version:           1.0.1
 * Author:            Bruno Alves
 * Author URI:        https://github.com/Cyber-Root0
 * Text Domain:       bring-lock

*/
if (!defined('ABSPATH')){
    die;
}
require_once plugin_dir_path(__FILE__).'/includes/front.php';
require_once plugin_dir_path(__FILE__).'/includes/back.php';


// SCRIPTS SWEET ALERT __> Alert Beautiful
function bring_lock_sweet_alert() {
     
    wp_enqueue_script( 'admin-js-sweetalert', plugin_dir_url( __FILE__ ).'includes/js/sweetalert2.all.min.js',false);
    wp_enqueue_script( 'admin-js-bring-lock', plugin_dir_url( __FILE__ ).'includes/js/bring-lock.js',false);
    wp_enqueue_style( 'admin-js-sweetalert-css', plugin_dir_url( __FILE__ ).'includes/css/sweetalert2.min.css',false);

}
      
add_action( 'login_enqueue_scripts', 'bring_lock_sweet_alert' );

?>