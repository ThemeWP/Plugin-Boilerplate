<?php
namespace PolderKnowledge\Boilerplate;

class Dependencies
{
    /**
     * The plugin's instance.
     *
     * @since  1.0.0
     * @access private
     * @var    Plugin $plugin This plugin's instance.
     */
    private $plugin;

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function requirements()
    {
        if (!$this->meetsRequirements()) {
            add_action('all_admin_notices', array($this, 'notice'));
            deactivate_plugins($this->plugin->getBasename());
        }
    }

    public function meetsRequirements()
    {
        return false;
    }

    public function notice()
    {
        ?>
        <div class="error">
            <p>Dit is een custom bericht na het activeren van de plugin </p>
        </div>
        <?php
    }
}
