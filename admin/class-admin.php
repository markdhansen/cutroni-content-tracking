<?php

class Content_Tracking_Admin {

    var $page_title = 'Cutroni Content Tracking with Google Analytics';
    var $menu_title = 'Content Tracking with GA';
    var $menu_slug = 'jcact';
    var $optionName = JCACT_OPTION_NAME;
    var $optionsSection = 'jcact_options_section';

    function __construct() {

        $this->upgrade();

        /* Register the settings page */
        add_action('admin_menu', array($this, 'plugin_admin_add_page'));
        /* Initialize the admin settings */
        add_action('admin_init', array($this, 'plugin_admin_init'));
        /* Put needed javascript in the page header */
        // add_action('admin_head', array($this, 'config_page_head'));
        /* Put needed javascript in the header */
        add_action('admin_enqueue_scripts', array($this, 'plugin_enqueue_scripts'));
        // Register AJAX endpoint for Megalytic authentication
        // add_action('wp_ajax_get_megalytic_account', array($this, 'get_megalytic_account'));
    }

    function plugin_enqueue_scripts() {
        // TODO need option to put script in footer
        wp_register_script('jcact_admin_script', plugins_url('js/jcact-admin.js', __FILE__), array('jquery'), JCACT_VERSION, false);
        wp_enqueue_script('jcact_admin_script');
    }

    function plugin_admin_add_page() {
        add_options_page($this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, array(&$this, 'plugin_options_page'));
    }

    function plugin_options_page() {
        ?>
        <div class="wrap">
            <h2><?php echo $this->page_title ?></h2>
            <h3>implemented by <a href="http://megalytic.com/" target="_blank">Megalytic</a></h3>
            <form method="post" action="options.php"> 
                <?php settings_fields($this->optionName); ?>
                <?php do_settings_sections($this->optionName); ?>
                <?php submit_button(); ?>
                <?php
                $other_attributes = array('onclick' => 'resetOptions()');
                submit_button('Reset to Defaults', 'secondary', 'reset_button', false, $other_attributes);
                ?>
            </form>
        </div>

        <?php
    }

    function plugin_admin_init() {
        register_setting($this->optionName, $this->optionName, array(&$this, 'plugin_options_validate'));
        add_settings_section($this->optionsSection, '', array(&$this, 'plugin_primary_section_text'), $this->optionName);
        add_settings_field('debugMode', 'Run in debug mode?', array(&$this, 'plugin_setting_debugMode'), $this->optionName, $this->optionsSection);
        add_settings_field('contentSelector', 'jQuery selector for the content DIV.', array(&$this, 'plugin_setting_contentSelector'), $this->optionName, $this->optionsSection);
        add_settings_field('delayAfterScroll', 'Delay after scroll event before checking location (milliseconds).', array(&$this, 'plugin_setting_delayAfterScroll'), $this->optionName, $this->optionsSection);
        add_settings_field('startedReadingLocation', 'Distance from top of content that indicates reading has started (pixels)', array(&$this, 'plugin_setting_startedReadingLocation'), $this->optionName, $this->optionsSection);
    }

    function plugin_setting_startedReadingLocation() {
        $options = get_option($this->optionName);
        $startedReadingLocationValue = 150;
        if (!empty($options['startedReadingLocation'])) {
            $startedReadingLocationValue = $options['startedReadingLocation'];
        }
        echo "<input id='plugin_setting_startedReadingLocation' name='{$this->optionName}[startedReadingLocation]' size='10' type='number' value='{$startedReadingLocationValue}' />";
    }

    function plugin_setting_delayAfterScroll() {
        $options = get_option($this->optionName);
        $delayAfterScrollValue = 100;
        if (!empty($options['delayAfterScroll'])) {
            $delayAfterScrollValue = $options['delayAfterScroll'];
        }
        echo "<input id='plugin_setting_delayAfterScroll' name='{$this->optionName}[delayAfterScroll]' size='10' type='number' value='{$delayAfterScrollValue}' />";
    }

    function plugin_setting_debugMode() {
        $options = get_option($this->optionName);
        $debugModeValue = 'false';
        if (!empty($options['debugMode'])) {
            $debugModeValue = $options['debugMode'];
        }
        if ($debugModeValue == 'false') {
            echo "<label>True <input id='plugin_setting_debugMode_radioTrue' name='{$this->optionName}[debugMode]' type='radio' value='true' /></label>";
            echo "<label>&nbsp;False <input id='plugin_setting_debugMode_radioFalse' name='{$this->optionName}[debugMode]' type='radio' value='false' checked='checked' /></label>";
        } else {
            echo "<label>True <input id='plugin_setting_debugMode_radioTrue' name='{$this->optionName}[debugMode]' type='radio' value='true' checked='checked' /></label>";
            echo "<label> False <input id='plugin_setting_debugMode_radioFalse' name='{$this->optionName}[debugMode]' type='radio' value='false' /></label>";
        }
    }

    function plugin_setting_contentSelector() {
        $options = get_option($this->optionName);
        $contentSelectorValue = '.entry-content';
        if (!empty($options['contentSelector'])) {
            $contentSelectorValue = $options['contentSelector'];
        }
        echo "<input id='plugin_setting_contentSelector' name='{$this->optionName}[contentSelector]' size='40' type='text' value='{$contentSelectorValue}' />";
    }

    function plugin_primary_section_text() {
        
    }

// TODO
    function plugin_options_validate($input) {
        error_log("called plugin_options_validate with input: " . print_r($input, true));
        return $input;
    }

    function upgrade() {
        
    }

}

// create an instance of the class to run the admin page
$jcact_admin = new Content_Tracking_Admin();