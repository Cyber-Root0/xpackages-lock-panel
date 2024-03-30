<?php
namespace CyberRoot0\WpLockPanel\View;

use CyberRoot0\WpLockPanel\Model\ManagerLock;
class Form
{
    public const FORM_NAME = "WP Lock Panel";
    public const USER_PERMISSON = "manage_options";
    public const SLUG = "wp-lock-panel";
    public const SETTING_NAME = "wp-lock-panel";
    private $config;
    private static $instance;
    private function __construct()
    {
        $this->config = ManagerLock::getInstance();
    }
    /**
     * provide a simple shared instance
     *
     * @return self
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function execute()
    {
        add_action('admin_menu', array($this, 'addMenu'));
    }
    public function addMenu()
    {
        add_menu_page(
            self::FORM_NAME,
            self::FORM_NAME,
            self::USER_PERMISSON,
            self::SLUG,
            array($this, 'render'),
            "dashicons-lock",
            3
        );
        add_settings_section(
            self::SLUG,
            self::FORM_NAME,
            function(){
                ?>
                <p>Página de Variavéis Globais, usadas pela Bring E-commerce</P>
                <?php
            },
            self::SLUG
        );
        add_settings_field(
            self::SETTING_NAME.'key',
            'Chave',
            function(){
                ?>
                 <input type="text" id="wp-lock-panelkey" name="wp-lock-panelkey" value="<?= $this->config->getKey(); ?>" required>
                <?php
            },
            self::SLUG,
            self::SLUG
        );
        register_setting(
            self::SETTING_NAME,
            self::SETTING_NAME . 'key',
            function ($key) {
                $sanitized_key = sanitize_key($key);
                $this->config->setKey($sanitized_key);
                $this->config->save();
                return $sanitized_key;
            }
        );
    }
    public function render(){
        ?>
        <h1>WP Lock Panel</h1>
        <form method="POST" action="options.php">
        <?php
            settings_errors();
            do_settings_sections(self::SETTING_NAME);
            settings_fields(self::SETTING_NAME);
            submit_button();
        ?>
        </form>
        <?php
    }
}
