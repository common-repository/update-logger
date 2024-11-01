<?php

/**
 * Plugin Name: Update Logger
 * Plugin URI: https://wordpress.org/plugins/update-logger/
 * Description: Log WordPress updates, so you can exclude 3rd party plugins from your repo.
 * Author: Poly Plugins
 * Version: 1.0.1
 * Author URI: https://www.polyplugins.com
 * License: GPL3
 * Requires Plugins: loginator
 */

namespace PolyPlugins;

if (!defined('ABSPATH')) exit;

class Update_Logger {

  /**
	 * Full path and filename of plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin    Full path and filename of plugin.
	 */
  private $plugin;

  /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_slug    The ID of this plugin.
	 */
  private $plugin_slug;

  /**
	 * The plugin name
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    Name of the plugin
	 */
  private $plugin_name;

  /**
	 * Store admin notices
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $admin_notice    Store admin notices
	 */
  private $admin_notice;
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct() {
    $this->plugin      = __FILE__;
    $this->plugin_slug = dirname(plugin_basename($this->plugin));
    $this->plugin_name = __(mb_convert_case(str_replace('-', ' ', $this->plugin_slug), MB_CASE_TITLE), $this->plugin_slug);
  }

  /**
   * Initialize the plugin
   *
   * @return void
   */
  public function init()
  {
    add_action('init', array($this, 'loaded'));
  }
    
  /**
   * Plugin loaded
   *
   * @return void
   */
  public function loaded() {
    if (class_exists('Loginator')) {
      add_action('upgrader_process_complete', array($this, 'log_updates'), 10, 2);
    } else {
      $this->add_notice('"' . $this->plugin_name . '"' . " requires <a href='/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=loginator&amp;TB_iframe=true&amp;width=772&amp;height=608' class='thickbox open-plugin-details-modal' aria-label='More information about Loginator' data-title='Loginator'>Loginator</a> to be installed.");
    }
  }
  
  /**
   * Log Updates
   *
   * @param  mixed $upgrader_object
   * @param  mixed $options
   * @return void
   */
  public function log_updates($upgrader_object, $options) {
    loginator($options['plugins'], 'd', 'update');
  }

  /**
   * Display the notice on the admin backend
   *
   * @return void
   */
  public function display_notice() {
    ?>
    <div class="notice notice-<?php echo $this->admin_notice['type']; ?>">
      <p><?php echo $this->admin_notice['message']; ?></p>
    </div>
    <?php
  }
  
  /**
   * Enqueue the admin notice
   *
   * @param  string $message The message being displayed in admin
   * @param  string $type Optional. The type of message displayed. Default error.
   * @return void
   */
  private function add_notice($message, $type = 'error') {
    $this->admin_notice = array(
      'message' => $message,
      'type'   => $type
    );

    add_action('admin_notices', array($this, 'display_notice'));
  }

}

$update_logger = new Update_Logger;
$update_logger->init();