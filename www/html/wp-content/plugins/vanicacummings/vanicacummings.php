<?php namespace VanicaCummings;

/**
 * Plugin Name:       VanicaCummings
 * Description:       The VanicaCummings Plugin
 * Version:           1.0.0
 * Author:            Josh Cummings
 * Author URI:        https://joshcummingsdesign.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jcdwp
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

if (!class_exists(__NAMESPACE__ . '\VanicaCummings')) {

  /**
   * The main VanicaCummings class (Singleton).
   */
  final class VanicaCummings {

    /**
     * The minimum PHP version needed to run VanicaCummings.
     */
    const PHP_MIN_VERISON = '7.0';

    /**
     * The base directory where the views live.
     */
    const VIEWS_BASE_DIR = 'views';

    /**
     * The asset destination directory for the theme.
     */
    const THEME_ASSET_DIR = 'dist';

    /**
     * The name of the rev manifest file.
     */
    const THEME_ASSET_REV = 'rev-manifest.json';

    /**
     * The CoreAddons class instance.
     *
     * @var object
     */
    private $coreAddons;

    /**
     * The PluginAddons class instance.
     *
     * @var object
     */
    private $pluginAddons;

    /**
     * The ThemeSupport class instance.
     *
     * @var object
     */
    private $themeSupport;

    /**
     * The ImageSizes class instance.
     *
     * @var object
     */
    private $imageSizes;

    /**
     * The ThemeAssets class instance.
     *
     * @var object
     */
    private $themeAssets;

    /**
     * The ThemeMenus class instance.
     *
     * @var object
     */
    private $themeMenus;

    /**
     * The ThemeCustomFields class instance.
     *
     * @var object
     */
    private $themeFields;

    /**
     * The TinyMCE class instance.
     *
     * @var object
     */
    private $tinymce;

    /**
     * The AdminAssets class instance.
     *
     * @var object
     */
    private $adminAssets;

    /**
     * The AdminMenus class instance.
     *
     * @var object
     */
    private $adminMenus;

    /**
     * The ViewLoader class instance.
     *
     * @var object
     */
    private $viewLoader;

    /**
     * The VanicaCummings class instance.
     *
     * @var object
     */
    private static $instance;

    /**
     * Returns the main VanicaCummings class instance.
     *
     * @return object VanicaCummings
     */
    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * The VanicaCummings class constructor.
     */
    public function __construct() {

      // Bail if minimum PHP version requirement is not met.
      if (version_compare(self::PHP_MIN_VERISON, phpversion(), '>')) {
        add_action('admin_notices', [$this, 'phpUpdateNotice']);
        return;
      }

      $this->constants();
      $this->includes();
      $this->initCore();
      $this->initTheme();
      $this->initAdmin();
      $this->initHelpers();
    }

    /**
     * VanicaCummings core initialization.
     */
    public function initCore() {
      $this->coreAddons   = new Helpers\Core\CoreAddons();
      $this->pluginAddons = new Helpers\Core\PluginAddons();
    }

    /**
     * VanicaCummings theme initialization.
     */
    public function initTheme() {

      $this->themeSupport = new Helpers\Theme\ThemeSupport();
      $this->imageSizes   = new Helpers\Theme\ImageSizes();
      $this->themeAssets  = new Helpers\Theme\ThemeAssets();
      $this->themeMenus   = new Helpers\Theme\ThemeMenus();
      $this->themeFields  = new Helpers\Theme\ThemeCustomFields();
    }

    /**
     * VanicaCummings admin initialization.
     */
    public function initAdmin() {
      $this->adminAssets = new Helpers\Admin\AdminAssets();
      $this->adminMenus  = new Helpers\Admin\AdminMenus();
      $this->tinymce     = new Helpers\Admin\TinyMCE();
    }

    /**
     * Helper initialization.
     */
    public function initHelpers() {
      $this->viewLoader = new Helpers\ViewLoader(self::VIEWS_BASE_DIR);
    }

    /**
     * Define plugin constants.
     */
    private function constants() {
      define('JCDWP_PLUGIN_DIR', plugin_dir_path(__FILE__));
      define('JCDWP_PLUGIN_URI', plugins_url('/', __FILE__));
      define('JCDWP_THEME_DIR', get_theme_file_path());
      define('JCDWP_THEME_URI', get_theme_file_uri());
      define('JCDWP_THEME_ASSET_DIR', JCDWP_THEME_DIR . '/' . self::THEME_ASSET_DIR);
      define('JCDWP_THEME_ASSET_URI', JCDWP_THEME_URI . '/' . self::THEME_ASSET_DIR);
      define('JCDWP_THEME_ASSET_REV', self::THEME_ASSET_REV);
    }

    /**
     * Include required files.
     */
    private function includes() {
      require_once JCDWP_PLUGIN_DIR . 'vendor/autoload.php';
      require_once JCDWP_PLUGIN_DIR . 'utilities/enviroment.php';
      require_once JCDWP_PLUGIN_DIR . 'utilities/pretty-print.php';
      require_once JCDWP_PLUGIN_DIR . 'utilities/normalize-data.php';
    }


    /**
     * Cloning is forbidden.
     */
    public function __clone() {
      _doing_it_wrong(__FUNCTION__, __('VanicaCummings cannot be cloned.', 'jcdwp'), '1.0.0');
    }

    /**
     * Unserializing is forbidden.
     */
    public function __wakeup() {
      _doing_it_wrong(__FUNCTION__, __('VanicaCummings cannot be unserialized.', 'jcdwp'), '1.0.0');
    }

    /**
     * Show PHP update notice.
     */
    public function phpUpdateNotice() {
      if (!is_admin()) {
        return;
      }
      $notice_heading = __('PHP Update Required', 'jcdwp');
      $notice_body = sprintf(__('VanicaCummings requires PHP version %s or later.', 'jcdwp'), self::PHP_MIN_VERISON);
      $notice_markup .= '<p><strong>' . $notice_heading . '</strong></p>';
      $notice_markup .= '<p>' . $notice_body . '</p>';
      $notice = sprintf('<div class="notice notice-error">%1$s</div>', $notice_markup);
      echo $notice;
    }
  }
}

/**
 * Start VanicaCummings
 * The main function responsible for returning
 * the one true VanicaCummings instance.
 *
 * @return object VanicaCummings
 */
function VanicaCummings() {
  return VanicaCummings::getInstance();
}
VanicaCummings();
