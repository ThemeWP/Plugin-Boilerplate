<?php
/**
 * Plugin Name: PK Boilerplate
 * Description: The description of the plugin.
 * Author: Oscar Weijman
 * Author URI: http://polderknowledge.nl
 * Plugin URI: http://polderknowledge.nl
 * Text Domain: _pk_
 * Version: 1.0.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    exit;
}

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in lib/Activator.php
 */
register_activation_hook(__FILE__, '\PolderKnowledge\Boilerplate\Activator::activate');

/**
 * The code that runs during plugin deactivation.
 * This action is documented in lib/Deactivator.php
 */
register_deactivation_hook(__FILE__, '\PolderKnowledge\Boilerplate\Deactivator::deactivate');


/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
add_action('plugins_loaded', function () {
    $plugin = new \PolderKnowledge\Boilerplate\Plugin(plugin_basename(__FILE__));
    $plugin->run();
});
