<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/includes
 */

namespace PolderKnowledge\Boilerplate;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    PluginName
 * @subpackage PluginName/includes
 * @author     Your Name <email@example.com>
 */
class Plugin
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      PluginName_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $pluginname    The string used to uniquely identify this plugin.
     */
    protected $pluginname = 'pk-boilerplate';


    protected $basename = '';

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version = '1.0.0';

    /**
     * Define the core functionality of the plugin.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     */
    public function __construct($basename)
    {
        $this->basename = $basename;
        $this->loader = new Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the I18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function setLocale()
    {
        $plugin_i18n = new I18n();
        $plugin_i18n->setDomain($this->getName());
        $plugin_i18n->loadPluginTextdomain();
    }

    /**
     * Register all of the hooks related to the dashboard functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function defineAdminHooks()
    {
        $dependencies = new dependencies($this);
        $plugin_admin = new Admin($this);

        /**
         * Check for depencencies if failed turnoff the plugin
         */
        //$this->loader->addAction('admin_init', $dependencies, 'requirements', 9999);

        $this->loader->addAction('admin_enqueue_scripts', $plugin_admin, 'enqueueStyles');
        $this->loader->addAction('admin_enqueue_scripts', $plugin_admin, 'enqueueScripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function defineFrontendHooks()
    {
        $plugin_frontend = new Frontend($this);
        //$this->loader->addAction('wp_enqueue_scripts', $plugin_frontend, 'enqueueStyles');
        //$this->loader->addAction('wp_enqueue_scripts', $plugin_frontend, 'enqueueScripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * Load the dependencies, define the locale, and set the hooks for the Dashboard and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->setLocale();
        $this->defineAdminHooks();
        $this->defineFrontendHooks();
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function getName()
    {
        return $this->pluginname;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    PluginName_Loader    Orchestrates the hooks of the plugin.
    */
    public function getLoader()
    {
        return $this->loader;
    }

    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }
}
