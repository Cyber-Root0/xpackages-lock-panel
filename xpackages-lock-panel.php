<?php
/*
 
 * @package           XPackages - Lock Panel
 * @author            Bruno Alves
 * @copyright         2024  - Bruno Alves
 * Plugin Name:        XPackages - Lock Panel
 * Plugin URI:        https://wa.me/5518997479949
 * Description:       Plugin to block administrative panel through API calls.
 * Version:           1.5.0
 * Author:            Bruno Alves
 * Author URI:        https://github.com/Cyber-Root0
 * Text Domain:       xpackages-lock-panel

*/
if (!defined('ABSPATH')){
    die;
}
require_once(__DIR__.'/vendor/autoload.php');
$url = plugin_dir_url(__FILE__);
define('WLP_ROOT_URL',$url);
use CyberRoot0\WpLockPanel\Init;
add_action('plugins_loaded', array(Init::class, 'getInstance'));